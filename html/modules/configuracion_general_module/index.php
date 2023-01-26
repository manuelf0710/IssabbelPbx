<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
//phpinfo();

/* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version {ISSBEL_VERSION}                                               |
  | http://www.issabel.org                                               |
  +----------------------------------------------------------------------+
  | Copyright (c) 2017 Issabel Foundation                                |
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
  $Id: index.php,v 1.1 2022-12-12 05:12:10 manuelf manuelf0710@gmail.com Exp $ */
//include issabel framework
require_once __DIR__ . '/bootstrap/bootstrap.php';
include_once "libs/paloSantoGrid.class.php";
include_once "libs/paloSantoForm.class.php";

use App\Models\IvrModel;
use App\Models\RutaSalienteModel;
use App\Models\ConexionesModel;

function _moduleContent(&$smarty, $module_name)
{
    //include module files
    include_once "modules/$module_name/configs/default.conf.php";
    include_once "modules/$module_name/libs/paloSantoconfiguracion_general_module.class.php";

    //include file language agree to issabel configuration
    //if file language not exists, then include language by default (en)
    $lang = get_language();
    $base_dir = dirname($_SERVER['SCRIPT_FILENAME']);
    $lang_file = "modules/$module_name/lang/$lang.lang";
    if (file_exists("$base_dir/$lang_file")) include_once "$lang_file";
    else include_once "modules/$module_name/lang/en.lang";

    //global variables
    global $arrConf;
    global $arrConfModule;
    global $arrLang;
    global $arrLangModule;
    $arrConf = array_merge($arrConf, $arrConfModule);
    $arrLang = array_merge($arrLang, $arrLangModule);

    //folder path for custom templates
    $templates_dir = (isset($arrConf['templates_dir'])) ? $arrConf['templates_dir'] : 'themes';
    $local_templates_dir = "$base_dir/modules/$module_name/" . $templates_dir . '/' . $arrConf['theme'];

    //conexion resource
    $dsnAsterisk = generarDSNSistema('asteriskuser', 'asterisk');

    $pDB = new paloDB($dsnAsterisk);
    //$pDB = "";

    $dsn = generarDSNSistema('asteriskuser', 'asterisk');
    $modelIvr = new IvrModel(new \paloDB($dsn));
    $modelOutgoingRoutes = new RutaSalienteModel(new \paloDB($dsn));
    $modelConexionesBD = new ConexionesModel(new \paloDB($dsn));
    $IvrList = $modelIvr->index();
    $conexionesLista = $modelConexionesBD->lista();
    $outgoingRouteList = $modelOutgoingRoutes->index();

    $infoToView = array("ivrLista" => $IvrList, "outgoingRouteList" => $outgoingRouteList, "conexionesLista" => $conexionesLista);

    //actions
    $action = getAction();
    $content = "";


    switch ($action) {
        case "save_new":
            $content = saveNewconfiguracion_general2($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
            break;
        case "savedata":
            $content = saveNewconfiguracion_general2($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
            break;
        case "savemariadb":
            $content = saveNewconfiguracion_generalMariaDB($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
            break;
        default: // view_form
            $content = viewFormconfiguracion_general2($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
            break;
    }
    return $content;
}

function viewFormconfiguracion_general2($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf, $infoToView)
{

    $pconfiguracion_general2 = new paloSantoconfiguracion_general_module($pDB);
    $arrFormconfiguracion_general2 = createFieldForm();
    $oForm = new paloForm($smarty, $arrFormconfiguracion_general2);


    //begin, Form data persistence to errors and other events.
    $_DATA  = $_POST;
    $action = getParameter("action");
    //$id     = getParameter("id");
    //$smarty->assign("ID", $id); //persistence id with input hidden in tpl
    $motor     = getParameter("motor");

    if(empty($motor)){
        $_DATA = $pconfiguracion_general2->getconfiguracion_general2Active();
    }else{
        $_DATA = $pconfiguracion_general2->getconfiguracion_general2ByName($motor);
    }

    $dataconfiguracion_generalMariaDB = $pconfiguracion_general2->getconfiguracion_general2MariaDB();

    if ($_DATA != null) {
        $_DATA = array_merge($_DATA, $dataconfiguracion_generalMariaDB);
    } else {
        $_DATA = $dataconfiguracion_generalMariaDB;
    }
    //echo('elidddd='.$_DATA['id']);

    /*echo"</br>nuevo</br>";
    echo json_encode($nuevo);
    echo"</br></br>";*/
    if(isset($_DATA['id'])){
        $smarty->assign("ID", $_DATA['id']); //persistence id with input hidden in tpl
    }

    if ($action == "view")
        $oForm->setViewMode();
    else if ($action == "view_edit" || getParameter("save_edit"))
        $oForm->setEditMode();
    //end, Form data persistence to errors and other events.

    if ($action == "view" || $action == "view_edit") { // the action is to view or view_edit.
        $dataconfiguracion_general2 = $pconfiguracion_general2->getconfiguracion_general2ById($id);

        /*echo("algoo");
        echo json_encode($dataconfiguracion_generalMariaDB);*/
        if (is_array($dataconfiguracion_general2) & count($dataconfiguracion_general2) > 0) {
            $_DATA = $dataconfiguracion_general2;
        } else {
            $smarty->assign("mb_title", _tr("Error get Data"));
            $smarty->assign("mb_message", $pconfiguracion_general2->errMsg);
        }
    }
    $smarty->assign("SAVE", _tr("Save"));
    $smarty->assign("EDIT", _tr("Edit"));
    $smarty->assign("CANCEL", _tr("Cancel"));
    $smarty->assign("REQUIRED_FIELD", _tr("Required field"));
    $smarty->assign("icon", "images/list.png");
    $smarty->assign("configListas", $infoToView);
    /*
    echo("<br>");
echo("<br>");
echo json_encode($_DATA);
exit;
*/

    $htmlForm = $oForm->fetchForm("$local_templates_dir/form.tpl", _tr("configuracion_general2"), $_DATA);
    $content = "<form  method='POST' style='margin-bottom:0;' action='?menu=$module_name' name='form_configuraciongeneral' id='form_configuraciongeneral'>" . $htmlForm . "</form>";

    return $content;
}

function saveNewconfiguracion_generalMariaDB($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf, $infoToView)
{
    $pconfiguracion_general2 = new paloSantoconfiguracion_general_module($pDB);
    $arrFormconfiguracion_general2 = createFieldForm();
    $oForm = new paloForm($smarty, $arrFormconfiguracion_general2);

    if (!$oForm->validateForm($_POST)) {
        // Validation basic, not empty and VALIDATION_TYPE 
        $smarty->assign("mb_title", _tr("Validation Error"));
        $arrErrores = $oForm->arrErroresValidacion;
        $strErrorMsg = "<b>" . _tr("The following fields contain errors") . ":</b><br/>";
        if (is_array($arrErrores) && count($arrErrores) > 0) {
            foreach ($arrErrores as $k => $v)
                $strErrorMsg .= "$k, ";
        }
        $smarty->assign("mb_message", $strErrorMsg);
        $content = viewFormconfiguracion_general2($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
    } else {
        //NO ERROR, HERE IMPLEMENTATION OF SAVE

        //$id     = getParameter("id");
        $pconfiguracion_general2->updateconfiguracion_general2MariaDB($_POST);

        //$smarty->assign("ID", $id);
        $content = viewFormconfiguracion_general2($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
        //header("Location: index.php?menu=configuracion_general");

        //$content = "Code to save yet undefined.";



    }
    return $content;
}

function saveNewconfiguracion_general2($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf, $infoToView)
{
    $pconfiguracion_general2 = new paloSantoconfiguracion_general_module($pDB);
    $arrFormconfiguracion_general2 = createFieldForm();
    $oForm = new paloForm($smarty, $arrFormconfiguracion_general2);

    if (!$oForm->validateForm($_POST)) {
        // Validation basic, not empty and VALIDATION_TYPE 
        $smarty->assign("mb_title", _tr("Validation Error"));
        $arrErrores = $oForm->arrErroresValidacion;
        $strErrorMsg = "<b>" . _tr("The following fields contain errors") . ":</b><br/>";
        if (is_array($arrErrores) && count($arrErrores) > 0) {
            foreach ($arrErrores as $k => $v)
                $strErrorMsg .= "$k, ";
        }
        $smarty->assign("mb_message", $strErrorMsg);
        $content = viewFormconfiguracion_general2($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
    } else {
        //NO ERROR, HERE IMPLEMENTATION OF SAVE

        $id     = getParameter("id");
        $pconfiguracion_general2->updateconfiguracion_general2ById($id, $_POST);

        $smarty->assign("ID", $id);
        $content = viewFormconfiguracion_general2($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
        //header("Location: index.php?menu=configuracion_general");

        //$content = "Code to save yet undefined.";



    }
    return $content;
}

function createFieldForm()
{
    $arrOptions = array('desactivar' => 'Desactivar', 'activar' => 'Activar');
    $arrOptionsBarridos = array('' => 'Seleccione...', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5');
    $arrOptionsMotor = array('' => 'Seleccione...', 'Oracle' => 'Oracle', 'PostgreSQL' => 'PostgreSQL', 'Mysql' => 'Mysql');
    $arrOptionsMotorMariaDB = array('MariaDB' => 'MariaDB');
    $arrOptionsActivo = array('' => 'Seleccione...', 'Activo' => 'Activo', 'Inactivo' => 'Inactivo');
    $arrOptionsSSL = array('' => 'Seleccione...', 'Si' => 'Si', 'No' => 'No');

    $arrFields = array(
        "motormariadb"   => array(
            "LABEL"                  => _tr("Motor"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "SELECT",
            "INPUT_EXTRA_PARAM"      => $arrOptionsMotorMariaDB,
            "SUPPORT_VALUE"          => "si",
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => "",
            "EDITABLE"               => "si",
        ),
        "sslmariadb"   => array(
            "LABEL"                  => _tr("SslMariadb"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "SELECT",
            "INPUT_EXTRA_PARAM"      => $arrOptionsSSL,
            "SUPPORT_VALUE"          => "si",
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => "",
            "EDITABLE"               => "si",
        ),        
        "servidormariadb"   => array(
            "LABEL"                  => _tr("Servidor"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "TEXT",
            "INPUT_EXTRA_PARAM"      => array("class" => "mariadbconn"),
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => ""
        ),

        "usuariomariadb"   => array(
            "LABEL"                  => _tr("Usuario"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "TEXT",
            "INPUT_EXTRA_PARAM"      => array("class" => "mariadbconn"),
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => ""
        ),
        "contrasenamariadb"   => array(
            "LABEL"                  => _tr("Contraseña"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "password",
            "INPUT_EXTRA_PARAM"      => array("class" => "mariadbconn"),
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => ""
        ),
        "basedatosmariadb"   => array(
            "LABEL"                  => _tr("Base de Datos"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "hidden",
            "INPUT_EXTRA_PARAM"      => "",
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => ""
        ),



        "motor"   => array(
            "LABEL"                  => _tr("Motor"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "SELECT",
            "INPUT_EXTRA_PARAM"      => $arrOptionsMotor,
            "SUPPORT_VALUE"          => "si",
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => "",
            "EDITABLE"               => "si",
        ),
        "activo"   => array(
            "LABEL"                  => _tr("Activo"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "SELECT",
            "INPUT_EXTRA_PARAM"      => $arrOptionsActivo,
            "SUPPORT_VALUE"          => "si",
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => "",
            "EDITABLE"               => "si",
        ),
        "servidor"   => array(
            "LABEL"                  => _tr("Servidor"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "TEXT",
            "INPUT_EXTRA_PARAM"      => array("class" => "omsconn"),
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => ""
        ),
        "usuario"   => array(
            "LABEL"                  => _tr("Usuario"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "TEXT",
            "INPUT_EXTRA_PARAM"      => array("class" => "omsconn"),
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => ""
        ),
        "contrasena"   => array(
            "LABEL"                  => _tr("Contraseña"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "password",
            "INPUT_EXTRA_PARAM"      => array("class" => "omsconn"),
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => ""
        ),
        "basedatos"   => array(
            "LABEL"                  => _tr("Base de Datos"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "TEXT",
            "INPUT_EXTRA_PARAM"      => array("class" => "omsconn"),
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => ""
        ),
        "tablavista"   => array(
            "LABEL"                  => _tr("Tabla o Vista"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "hidden",
            "INPUT_EXTRA_PARAM"      => "",
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => ""
        ),
        "activar_desactivar"   => array(
            "LABEL"                  => _tr("Desactivar / Activar"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "RADIO",
            "INPUT_EXTRA_PARAM"      => $arrOptions,
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => ""
        ),
        "cant_lineas"   => array(
            "LABEL"                  => _tr("Cant líneas"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "TEXT",
            "INPUT_EXTRA_PARAM"      => "",
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => ""
        ),
        "barridos"   => array(
            "LABEL"                  => _tr("barridos"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "SELECT",
            "INPUT_EXTRA_PARAM"      => $arrOptionsBarridos,
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => "",
            "EDITABLE"               => "si",
        ),

        "destino_confirmado"   => array(
            "LABEL"                  => _tr("confirmados"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "SELECT",
            "INPUT_EXTRA_PARAM"      => $arrOptionsBarridos,
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => "",
            "EDITABLE"               => "si",
        ),

    );
    return $arrFields;
}

function getAction()
{
    if (getParameter("save_new")) //Get parameter by POST (submit)
        return "save_new";
    else if (getParameter("save_edit"))
        return "save_edit";
    else if (getParameter("delete"))
        return "delete";
    else if (getParameter("new_open"))
        return "view_form";
    else if (getParameter("action") == "view")
        return "view_form";
    else if (getParameter("action") == "save")     /*function for save info connection */
        return "savedata";
    else if (getParameter("action") == "saveLocal")
        return "savemariadb";
    else if (getParameter("action") == "view_edit")
        return "view_form";
    else
        return "report"; //cancel
}