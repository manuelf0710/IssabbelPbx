<?php
 ini_set('display_errors', 1);
 error_reporting(E_ALL); 
//phpinfo();
/* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 0.5                                                  |
  | http://www.issabel.org                                               |
  +----------------------------------------------------------------------+
  | Copyright (c) 2006 Palosanto Solutions S. A.                         |
  +----------------------------------------------------------------------+
  | The contents of this file are subject to the General Public License  |
  | (GPL) Version 2 (the "License"); you may not use this file except in |
  | compliance with the License. You may obtain a copy of the License at |
  | http://www.opensource.org/licenses/gpl-license.php                   |
  |                                                                      |
  | Software distributed under the License is distributed on an "AS IS"  |
  | basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See  |
  | the License for the specific language governing rights and           |
  | limitations under the License.                                       |
  +----------------------------------------------------------------------+
  | The Initial Developer of the Original Code is PaloSanto Solutions    |
  +----------------------------------------------------------------------+
  $Id: index.php, Thu 02 Jan 2020 10:38:55 AM EST, nicolas@issabel.com
*/

function asternick($user, $passwordTemp) {
    $host = "localhost"; // Dirección del servidor de la base de datos
    $dbname = "qstats"; // Nombre de la base de datos de Asternic
    $username = $user; // Nombre de usuario de la base de datos
    $password = $passwordTemp; // Contraseña del usuario de la base de datos
    // Intentar establecer la conexión a la base de datos
    try {
        $conAsternic = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conAsternic->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conAsternic;
    } catch(PDOException $e) {
        echo "Error en la conexión a la base de datos: " . $e->getMessage();
    }
}

function handleJob($url, $param){
    $url ="http://localhost:3000/connection";

    $curl = curl_init();
    // Configurar las opciones de cURL
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    // Realizar la petición GET y obtener la respuesta
    $response = curl_exec($curl);
    curl_close($curl);

    return $response;   
}


function spl_issabel_class_autoload($sNombreClase)
{
    if (!preg_match('/^\w+$/', $sNombreClase)) return;

    $sNombreBase = $sNombreClase . '.class.php';
    foreach (explode(':', ini_get('include_path')) as $sDirInclude) {
        if (file_exists($sDirInclude . '/' . $sNombreBase)) {
            require_once($sNombreBase);
            return;
        }
    }
}

function getMatchRole($rolId){
    $matchRole = array();
    $arregloRoles = array(
        array("id"=>1, "name"=> "Admin CCenter", "omsrolid" => 3010),         
        array("id"=>2, "name"=> "Supervisor CCenter", "omsrolid" => 3011),
        array("id"=>3, "name"=> "Agente CCenter", "omsrolid" => 3001),
    );    

    for($i = 0; $i < count($arregloRoles); $i++){
        if($rolId == $arregloRoles[$i]['omsrolid']){
            $matchRole = $arregloRoles[$i];
        }
    }
    return $matchRole;
}

spl_autoload_register('spl_issabel_class_autoload');

// Agregar directorio libs de script a la lista de rutas a buscar para require()
ini_set('include_path', dirname($_SERVER['SCRIPT_FILENAME']) . "/libs:" . ini_get('include_path'));

include_once("libs/misc.lib.php");
include_once "configs/default.conf.php";
include_once "libs/paloSantoDB.class.php";
include_once "libs/paloSantoMenu.class.php";
include_once "libs/paloSantoNotification.class.php";
include_once("libs/paloSantoACL.class.php"); // Don activate unless you know what you are doing. Too risky!
include_once "modules/configuracion_general_module/libs/paloSantoconfiguracion_general2.class.php";



$pp = new IssabelFirstBoot();
load_default_timezone();

session_name("issabelSession");
session_start();
/*
if (!isset($_SESSION['inicio'])) {
    //$_SESSION['inicio'] = time(); // Almacena la fecha y hora actual en la variable de sesión 'inicio'
  } else {
    // Verifica si han pasado más de 10 minutos desde el inicio de la sesión
    if (time() - $_SESSION['inicio'] > 1800) {
      // Si han pasado más de 10 minutos, destruye la sesión y redirige al usuario a la página de inicio de sesión
            if(!isset($_SESSION['extension_user'])){
                session_destroy();
                session_name("issabelSession");
                session_start();
                header("Location: sessdel.php");
                //header("Location: index.php");
                exit;    
            }else{
                $commandAsterisk = "sip show peer ".$_SESSION["extension_user"];
                $output = shell_exec('asterisk -rx "'.$commandAsterisk.'"');
                
                
                $asteriskMessage = explode(":",$output);
                $counter= 0;
                $indexFound = 0;
                foreach($asteriskMessage as $item){
                    
                    if (strpos($item,"Status" ) !== false && $indexFound == 0) {
                        $indexFound = $counter;
                        //echo("item encontrado =>".$item."<br>");
                    }
                $counter++;
                }  
                if($indexFound > 0){
                    if (strpos($asteriskMessage[$indexFound+1], "UNKNOWN") ) {
                    session_destroy();
                    session_name("issabelSession");
                    session_start();
                    header("Location: sessdel.php");
                    //header("Location: index.php");
                    exit;             
                    }
                
                }              
            }

    } else {
      // Si no han pasado más de 10 minutos, actualiza la fecha y hora de inicio de sesión
      $_SESSION['inicio'] = time();
    }
  } */

if (isset($_GET['logout']) && $_GET['logout'] == 'yes') {
    $user = isset($_SESSION['issabel_user']) ? $_SESSION['issabel_user'] : "unknown";
    writeLOG("audit.log", "LOGOUT $user: Web Interface logout successful. Accepted logout for $user from $_SERVER[REMOTE_ADDR].");
    session_destroy();
    session_name("issabelSession");
    session_start();
    header("Location: sessdel.php");
    //header("Location: index.php");
    exit;
}

//cargar el archivo de idioma
load_language();
$lang = get_language();

$it = new RecursiveDirectoryIterator("modules/");
foreach (new RecursiveIteratorIterator($it) as $file) {
    if (preg_match("/langmenu\/$lang\.lang/ui", $file)) {
        include_once "$file";
        global $arrLangMenu;
        global $arrLang;
        $arrLang = array_merge($arrLang, $arrLangMenu);
    }
}

if (file_exists("langmenus/$lang.lang")) {
    include_once "langmenus/$lang.lang";
    global $arrLangMenu;
    global $arrLang;
    $arrLang = array_merge($arrLang, $arrLangMenu);
}

// cargar traducciones de modulos issabelPBX para menu
$it = new RecursiveDirectoryIterator("admin/modules/");
foreach (new RecursiveIteratorIterator($it) as $file) {
    if (preg_match("/titlelang\.php$/ui", $file)) {
        include_once $file;
        if (isset($modTitle[$lang])) {
            foreach ($modTitle[$lang] as $title => $translatedtitle) {
                $arrLang[$title] = $translatedtitle;
            }
        }
    }
}

$dsnAsterisk = generarDSNSistema('asteriskuser', 'asterisk');
$dsnAsteriskqStats = generarDSNSistemaQstats('asteriskuser', 'qstats');

//$pdbACL = new paloDB($arrConf['issabel_dsn']['acl']);
$pdbACLQstats = new paloDB($dsnAsteriskqStats);
$pdbACL = new paloDB($dsnAsterisk);
$pACL = new paloACL($pdbACL);
$pACLQstats = new paloACL($pdbACLQstats);

if (!empty($pACL->errMsg)) {
    //echo "ERROR DE DB: $pACL->errMsg <br>";
}

// Load smarty
$smarty = getSmarty($arrConf['mainTheme'], $arrConf['basePath']);

$smarty->assign("ISSABEL_LICENSED", _tr("is licensed under"));
$smarty->assign("LOGIN_INCORRECT",  '');

// Two Factor Authentication Check
if (isset($_POST['input_code'])) {
    $sec  = $pACL->getTwoFactorSecret($_SESSION['2fa_user']);
    include('modules/sec_2fa/libs/TwoFactorAuth.class.php');
    $tfa  = new TwoFactorAuth('Issabel');
    $code = $tfa->getCode($sec);
    if ($_POST['input_code'] == $code) {
        $iauth = new IssabelAuth();
        list($access_token, $refresh_token) = $iauth->acquire_jwt_token($_SESSION['2fa_user'], $_SESSION['2fa_pass']);
        $_SESSION['access_token']  = $access_token;
        $_SESSION['refresh_token'] = $refresh_token;
        $_SESSION['issabel_user'] = $_SESSION['2fa_user'];
        $_SESSION['issabel_pass'] = $_SESSION['2fa_pass'];
        header("Location: index.php");
        $user = urlencode(substr($_SESSION['2fa_user'], 0, 20));
        writeLOG("audit.log", "LOGIN $user: Web Interface login successful. Accepted password for $user from $_SERVER[REMOTE_ADDR] using two factor authentication.");
        exit;
    } else {
        list($color1, $color2) = $tfa->get_theme_colors();

        $oPn = new paloSantoNavigation(array(), $smarty);
        $oPn->putHEAD_JQUERY_HTML();
        $sCurYear = date('Y');
        if ($sCurYear < '2013') $sCurYear = '2013';
        $smarty->assign("currentyear", $sCurYear);
        $smarty->assign("THEMENAME", 'tenant');
        $smarty->assign("WEBPATH", '');
        $smarty->assign("SUBMIT", _tr('Submit'));
        $smarty->assign("PAGE_NAME", _tr('Two Factor Authentication'));
        $smarty->assign("WELCOME", _tr('Welcome to Issabel'));
        $smarty->assign("CODE", _tr('Code'));
        $smarty->assign("ISSABEL_LICENSED", _tr("is licensed under"));
        $smarty->assign("LOGIN_COLOR_1", $color1);
        $smarty->assign("LOGIN_COLOR_2", $color2);
        $smarty->display("modules/sec_2fa/templates/default/2fa.tpl");
        $user = urlencode(substr($_SESSION['2fa_user'], 0, 20));
        writeLOG("audit.log", "LOGIN $user: Authentication Failure to Web Interface login. Failed two factore code for $user from $_SERVER[REMOTE_ADDR].");
        die();
    }
}

//- 1) SUBMIT. Si se hizo submit en el formulario de ingreso
//-            autentico al usuario y lo ingreso a la sesion



if (isset($_POST['submit_login']) and !empty($_POST['input_user'])) {
    include('modules/sec_2fa/libs/TwoFactorAuth.class.php');
    $pass_md5 = md5($_POST['input_pass']);
    if($_POST['input_user']!='admin'){
        include_once("libs/IssabelExternalAuth.class.php");         
        $iauth = new IssabelExternalAuth();
        $iauthIssabel = new IssabelAuth();
        $pDB = new paloDB($dsnAsterisk);   
        $pconfiguracion_general2 = new paloSantoconfiguracion_general2($pDB);
        $datos = $pconfiguracion_general2->getconfiguracion_general2Active();

        $objetoConnection = array();     

        $passToSha256 = hash('sha256', $_POST['input_pass']);

            if($datos['motor']== 'Mysql' || $datos['motor']== 'MariaDB' || $datos['motor'] == 'SQLServer' || $datos['motor'] = 'PostgreSQL'){          
                $objetoConnection = array(
                    "user" => $_POST['input_user'],
                    "password" => $passToSha256,
                    "table" => array(
                        array("table" => "user", "table_name" => "GEV_USU_USUARIO"),
                        array("table" => "rol", "table_name" => "GEV_ROL_ROL")
                    )
    
                    );
            }

            if($datos['motor']== 'Oracle'){          
                $objetoConnection = array(
                    "user" => $_POST['input_user'],
                    "password" => $passToSha256,
                    "table" => array(
                        array("table" => "user", "table_name" => "GEV_USU_USUARIO"),
                        array("table" => "rol", "table_name" => "GEV_ROL_ROL")
                    ),
                    "connectString"=> $datos['servidor']."/".$datos['basedatos'],    
                    );
            }
            
        /** Pendiente definir donde se hace la peticion para modificar la tabla users de qtats */    
        // $resNode = handleJob();
        // if(is_string($resNode)) {
        //     $jsonTemp = json_decode($resNode);
        //     asternick($jsonTemp->user, $jsonTemp->password);
        // }

        $ingreso = $iauth->external_auth($_POST['input_user'], $passToSha256, $objetoConnection);   

        if(!empty($ingreso) && !array_key_exists('message', $ingreso) && count($ingreso)>0   && array_key_exists('ROL_ID', $ingreso[0])){
            include_once("libs/IssabelExternalAuth.class.php"); 

            $id_user = $pACL->getIdUser($_POST['input_user']);
            $getRole = getMatchRole($ingreso[0]->ROL_ID);
            //echo $id_user;

            if ($id_user !== false) { echo("entra if");
                $crearExtension = false;

                $r = $pACL->updateUser($id_user, $_POST['input_user'], $_POST['input_user'],$crearExtension !== false? $crearExtension : null);

                list($access_token, $refresh_token) = $iauthIssabel->acquire_jwt_token($_POST['input_user'], $_POST['input_pass']); 
                $usuarioFop2 = consultarExtensionUser($dsnAsterisk, $_POST['input_user'], $id_user );
                if($usuarioFop2){
                    $_SESSION['extension_pass'] = $usuarioFop2["secret"];
                    $_SESSION['extension_user'] = $usuarioFop2["exten"];                          
                }
                $_SESSION['access_token']  = $access_token;
                $_SESSION['refresh_token'] = $refresh_token;            
                $_SESSION['issabel_user'] = $_POST['input_user'];
                $_SESSION['issabel_pass'] = $pass_md5; 
                $_SESSION['inicio'] = time();
                
                $pACLQstats->createUserQstats($_POST['input_user'], $_POST['input_pass'], $ingreso[0]->ROL_ID);
                
                if('3010' == $ingreso[0]->ROL_ID){
                    echo("dentro antes del ");
                    $remoteUSersReload = $iauth->getRemoteUSersDatabase(array("getUsers"=>"all"));                      
                    echo("dentro despues del ");
                }
                echo json_encode($_SESSION);
                exit;
                header("Location: index.php");           
            } else{ echo("entra else");
                //$pACL->setUserExtension();

                $r = $pACL->createUser($_POST['input_user'], $ingreso[0]->ROL_NOMBRE, $pass_md5, $extension = NULL);
                
                if (!is_null($id_user)) {
                    /* Versiones viejas del archivo acl.db tienen una fila con
                    * una tupla que asocia al usuario inexistente con ID 2, con
                    * el grupo 2 (Operadores). Se limpia cualquier membresía
                    * extraña. */
                    $listaMembresia = $pACL->getMembership($id_user);
                    if (is_array($listaMembresia) && count($listaMembresia) > 0) {
                        foreach ($listaMembresia as $idGrupo) {
                            $pACL->delFromGroup($id_user, $idGrupo);
                        }
                    }

                    /*echo("ingresa por crear usuario ".json_encode($getRole)."<br>");
                    echo("in valor de iduser ".$id_user."<br>");
                    echo("el valor de get role id = ".$getRole['id']);*/
                    $id_user = $pACL->getIdUser($_POST['input_user']);

                    //$crearExtension = crearActualizarExtension($dsnAsterisk, $_POST['input_user'], $id_user ); 
                    $crearExtension = false;

                    $ru = $pACL->updateUser($id_user, $_POST['input_user'], $_POST['input_user'],$crearExtension !== false? $crearExtension : null);                    

                    // Creo la membresia
                    $r = $pACL->addToGroup($id_user, $getRole['id']);


                    list($access_token, $refresh_token) = $iauthIssabel->acquire_jwt_token($_POST['input_user'], $_POST['input_pass']);                     
                    $usuarioFop2 = consultarExtensionUser($dsnAsterisk, $_POST['input_user'], $id_user );
                    if($usuarioFop2){
                        $_SESSION['extension_pass'] = $usuarioFop2["secret"];
                        $_SESSION['extension_user'] = $usuarioFop2["exten"];                          
                    }
                    $_SESSION['access_token']  = $access_token;
                    $_SESSION['refresh_token'] = $refresh_token;
            
                    $_SESSION['issabel_user'] = $_POST['input_user'];
                    $_SESSION['issabel_pass'] = $pass_md5;  
                    $_SESSION['inicio'] = time();
                    echo "por el else";
                    exit;
                    $pACLQstats->createUserQstats($_POST['input_user'], $_POST['input_pass'], $ingreso[0]->ROL_ID); 
                    if('3010' == $ingreso[0]->ROL_ID){
                        $remoteUSersReload = $iauth->getRemoteUSersDatabase(array("getUsers"=>"all"));                      
                    }
                    exit;
                    header("Location: index.php");  
                }                   
            }
            exit;


            $dbUserVerify = new externalLogin($dsnAsterisk);
            if($dbUserVerify->existeUser($_POST['input_user'])){  
                $activeUser = $dbUserVerify->cargarUser($_POST['input_user']);
                if(!empty($activeUser)){

                    $getRole = getMatchRole($ingreso[0]->ROL_ID);

                    $dbUserVerify->updateUser($activeUser['id'], $activeUser['name'], $activeUser['description'], $pass_md5, null);
                    list($access_token, $refresh_token) = $iauthIssabel->acquire_jwt_token($_POST['input_user'], $_POST['input_pass']); 
                    $_SESSION['access_token']  = $access_token;
                    $_SESSION['refresh_token'] = $refresh_token;
            
                    $_SESSION['issabel_user'] = $_POST['input_user'];
                    $_SESSION['issabel_pass'] = $pass_md5;                      
                    header("Location: index.php");
                }
            }else{
                $getRole = getMatchRole($ingreso[0]->ROL_ID);

                $dbUserVerify->createUser(null, $_POST['input_user'], $ingreso[0]->ROL_NOMBRE, $pass_md5, null);

        

                if($dbUserVerify->lastInsert > 0){

                    if($dbUserVerify->createUserGroup(null, $dbUserVerify->lastInsert, $getRole['id'])){
                        list($access_token, $refresh_token) = $iauthIssabel->acquire_jwt_token($_POST['input_user'], $_POST['input_pass']); 
                        $_SESSION['access_token']  = $access_token;
                        $_SESSION['refresh_token'] = $refresh_token;
                
                        $_SESSION['issabel_user'] = $_POST['input_user'];
                        $_SESSION['issabel_pass'] = $pass_md5; 
                         
                       header("Location: index.php");                                             
                    }
                }
                

            }


        }else{
            $pass_md5 = "errno";
        }


        
    }

    if ($pACL->authenticateUser($_POST['input_user'], $pass_md5)) {
        session_regenerate_id(TRUE);

        if (file_exists('modules/sec_2fa/libs/TwoFactorAuth.class.php')) {
            $tfa  = new TwoFactorAuth('Issabel');
            $tfa_enabled = $tfa->is_licensed();
        } else {
            $tfa_enabled = false;
        }

        // two factor authentication form, if enabled for user, show it instead of login
        if (method_exists($pACL, 'getTwoFactorSecret') && $tfa_enabled == true) {
            $sec = $pACL->getTwoFactorSecret($_POST['input_user']);
            if ($sec <> '') {

                list($color1, $color2) = $tfa->get_theme_colors();

                $oPn = new paloSantoNavigation(array(), $smarty);
                $oPn->putHEAD_JQUERY_HTML();
                $_SESSION['2fa_user'] = $_POST['input_user'];
                $_SESSION['2fa_pass'] = $pass_md5;
                $sCurYear = date('Y');
                if ($sCurYear < '2013') $sCurYear = '2013';
                $smarty->assign("currentyear", $sCurYear);
                $smarty->assign("THEMENAME", 'tenant');
                $smarty->assign("WEBPATH", '');
                $smarty->assign("SUBMIT", _tr('Submit'));
                $smarty->assign("PAGE_NAME", _tr('Two Factor Authentication'));
                $smarty->assign("WELCOME", _tr('Welcome to Issabel'));
                $smarty->assign("CODE", _tr('Code'));
                $smarty->assign("ISSABEL_LICENSED", _tr("is licensed under"));
                $smarty->assign("LOGIN_COLOR_1", $color1);
                $smarty->assign("LOGIN_COLOR_2", $color2);
                $smarty->display("modules/sec_2fa/templates/default/2fa.tpl");
                die();
            }
        }
        
            $iauth = new IssabelAuth();
            list($access_token, $refresh_token) = $iauth->acquire_jwt_token($_POST['input_user'], $_POST['input_pass']);
            $_SESSION['access_token']  = $access_token;
            $_SESSION['refresh_token'] = $refresh_token;
    
            $_SESSION['issabel_user'] = $_POST['input_user'];
            $_SESSION['issabel_pass'] = $pass_md5;
            header("Location: index.php");
        
        writeLOG("audit.log", "LOGIN $_POST[input_user]: Web Interface login successful. Accepted password for $_POST[input_user] from $_SERVER[REMOTE_ADDR].");
        exit;
    } else {
        $user = urlencode(substr($_POST['input_user'], 0, 20));
        if (!$pACL->getIdUser($_POST['input_user'])) {
            writeLOG("audit.log", "LOGIN $user: Authentication Failure to Web Interface login. Invalid user $user from $_SERVER[REMOTE_ADDR].");
        } else {
            writeLOG("audit.log", "LOGIN $user: Authentication Failure to Web Interface login. Failed password for $user from $_SERVER[REMOTE_ADDR].");
        }
        $smarty->assign("LOGIN_INCORRECT", _tr('Incorrect username or password. Please try again.'));
    }
}

// 2) Autentico usuario
if (
    isset($_SESSION['issabel_user']) &&
    isset($_SESSION['issabel_pass']) &&
    $pACL->authenticateUser($_SESSION['issabel_user'], $_SESSION['issabel_pass'])
) {

    $idUser = $pACL->getIdUser($_SESSION['issabel_user']);
    //$pMenu = new paloMenu($arrConf['issabel_dsn']['menu']);
    $pMenu = new paloMenu($dsnAsterisk, 'mariadb');
    $arrMenuFiltered = $pMenu->filterAuthorizedMenus($idUser);
    if (!is_array($arrMenuFiltered)) {
        die("FATAL: unable to filter module list for user: " . $pMenu->errMsg);
    }

    verifyTemplate_vm_email(); // para cambiar el template del email ue se envia al recibir un voicemail

    //traducir el menu al idioma correspondiente
    foreach ($arrMenuFiltered as $idMenu => $arrMenuItem) {
        $arrMenuFiltered[$idMenu]['Name'] = _tr($arrMenuItem['Name']);
    }

    $smarty->assign("WEBPATH", '');
    $smarty->assign("WEBCOMMON", 'libs/');
    $smarty->assign("THEMENAME", $arrConf['mainTheme']);

    /*agregado para register*/

    $smarty->assign("Register", _tr("Register"));
    $smarty->assign("lblRegisterCm", _tr("Register"));
    $smarty->assign("lblRegisteredCm", _tr("Registered"));
    $smarty->assign("Registered", _tr("Register"));

    $smarty->assign("md_message_title", _tr('md_message_title'));
    $sCurYear = date('Y');
    if ($sCurYear < '2013') $sCurYear = '2013';
    $smarty->assign("currentyear", $sCurYear);
    $smarty->assign("LOGOUT", _tr('Logout'));
    $smarty->assign("VersionDetails", _tr('VersionDetails'));
    $smarty->assign("VersionPackage", _tr('VersionPackage'));
    $smarty->assign("AMOUNT_CHARACTERS", _tr("characters left"));
    $smarty->assign("SAVE_NOTE", _tr("Save Note"));
    $smarty->assign("MSG_SAVE_NOTE", _tr("Saving Note"));
    $smarty->assign("MSG_GET_NOTE", _tr("Loading Note"));
    $smarty->assign("LBL_NO_STICKY", _tr("Click here to leave a note."));
    $smarty->assign("ABOUT_ISSABEL", _tr('About Issabel') . " " . $arrConf['issabel_version']);

    // notifications
    $pNot = new paloNotification($pdbACL);
    $notis = $pNot->listPublicNotifications();

    if (count($notis) > 0) {
        $smarty->assign("ANIMATE_NOTIFICATION", "faa-shake animated");
    } else {
        $smarty->assign("ANIMATE_NOTIFICATION", "");
    }

    $selectedMenu = getParameter('menu');

    // Ejecutar una petición a un módulo global del framework
    if (
        !is_null($selectedMenu) && isset($arrConf['elx_framework_globalmodules']) &&
        in_array($selectedMenu, $arrConf['elx_framework_globalmodules']) &&
        file_exists("modules/$selectedMenu/index.php")
    ) {
        require_once "modules/$selectedMenu/index.php";
        echo _moduleContent($smarty, $selectedMenu);
        return;
    }

    /* El módulo pbxadmin que integra a IssabelPBX no construye enlaces con
     * parámetros menu, ni con config.php en todos los casos. Por lo tanto, los
     * usos sucesivos de enlaces en IssabelPBX embebido requiren recordar que se
     * sirven a través de pbxadmin. */
    if (empty($selectedMenu) && !empty($_SESSION['menu']))
        $selectedMenu = $_SESSION['menu'];

    // Inicializa el objeto palosanto navigation
    $oPn = new paloSantoNavigation($arrMenuFiltered, $smarty, $selectedMenu);
    $selectedMenu = $oPn->getSelectedModule();
    $_SESSION['menu'] = $selectedMenu;

    // Guardar historial de la navegación
    // TODO: también para rawmode=yes ?
    putMenuAsHistory($pdbACL, $pACL, $idUser, $selectedMenu);

    // Obtener contenido del módulo, si usuario está autorizado a él
    $bModuleAuthorized = $pACL->isUserAuthorizedById($idUser, "access", $selectedMenu);
    $sModuleContent = ($bModuleAuthorized) ? $oPn->showContent() : '';

    // rawmode es un modo de operacion que pasa directamente a la pantalla la salida
    // del modulo. Esto es util en ciertos casos.
    $rawmode = getParameter("rawmode");
    if (isset($rawmode) && $rawmode == 'yes') {
        echo $sModuleContent;
    } else {
        $oPn->renderMenuTemplates();

        // Generar contenido principal de todos los paneles
        $panels = array();
        foreach (scandir("panels/") as $panelname) {
            if (
                $panelname != '.' && $panelname != '..' &&
                is_dir("panels/$panelname") &&
                file_exists("panels/$panelname/index.php")
            ) {

                if (file_exists("panels/$panelname/lang/en.lang"))
                    load_language_module("../panels/$panelname");
                require_once "panels/$panelname/index.php";

                // No hay soporte de namespace en PHP 5.1, se simula con una clase
                $classname = 'Panel_' . ucfirst($panelname);
                if (class_exists($classname) && method_exists($classname, 'templateContent')) {
                    $tc = call_user_func(
                        array($classname, 'templateContent'),
                        $smarty,
                        $panelname
                    );
                    if (is_array($tc) && isset($tc['content'])) {
                        $panels[$panelname] = $tc;
                    }
                }
            }
        }
        $smarty->assign(array(
            'LBL_ISSABEL_PANELS_SIDEBAR'    =>  _tr('Panels'),
            'ISSABEL_PANELS'                =>  $panels,
        ));

        if (file_exists('themes/' . $arrConf['mainTheme'] . '/themesetup.php')) {
            require_once('themes/' . $arrConf['mainTheme'] . '/themesetup.php');
            themeSetup($smarty, $selectedMenu, $pdbACL, $pACL, $idUser);
        }

        // La muestra de stickynote está ahora habilitada para todos los temas.
        // Se obtiene si ese menu tiene una nota agregada.
        $snvars = array('AUTO_POPUP' => 0, 'STATUS_STICKY_NOTE' => 'false');
        $statusStickyNote = getStickyNote($pdbACL, $idUser, $selectedMenu);
        if ($statusStickyNote['status'] && $statusStickyNote['data'] != "") {
            $snvars['STATUS_STICKY_NOTE'] = 'true';
            if ($statusStickyNote['popup'] == 1) $snvars['AUTO_POPUP'] = 1;
        }
        $smarty->assign($snvars);

        // Autorizacion
        if ($bModuleAuthorized) {
            $smarty->assign("CONTENT", $sModuleContent);
            $smarty->assign('MENU', (count($arrMenuFiltered) > 0)
                ? $smarty->fetch("_common/_menu.tpl")
                : _tr('No modules'));
        }
        $smarty->display("_common/index.tpl");
    }
} else {
    $rawmode = getParameter("rawmode");
    if (isset($rawmode) && $rawmode == 'yes') {
        include_once "libs/paloSantoJSON.class.php";
        $jsonObject = new PaloSantoJSON();
        $jsonObject->set_status("ERROR_SESSION");
        $jsonObject->set_error(_tr("Your session has expired. If you want to do a login please press the button 'Accept'."));
        $jsonObject->set_message(null);
        Header('Content-Type: application/json');
        echo $jsonObject->createJSON();
    } else {
        $oPn = new paloSantoNavigation(array(), $smarty);
        $oPn->putHEAD_JQUERY_HTML();
        $smarty->assign("THEMENAME", $arrConf['mainTheme']);
        $smarty->assign("currentyear", date("Y"));
        $smarty->assign("PAGE_NAME", _tr('Login page'));
        $smarty->assign("WELCOME", _tr('Welcome to Issabel'));
        $smarty->assign("ENTER_USER_PASSWORD", _tr('Please enter your username and password'));
        $smarty->assign("USERNAME", _tr('Username'));
        $smarty->assign("PASSWORD", _tr('Password'));
        $smarty->assign("SUBMIT", _tr('Submit'));

        $smarty->display("_common/login.tpl");
    }
}