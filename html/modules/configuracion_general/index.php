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
    include_once "modules/$module_name/libs/paloSantoconfiguraciongeneral.class.php";

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
    $configuracionNotificaciones = new paloSantoconfiguraciongeneral($pDB);
    //$pDB = "";
    //$dsn = generarDSNSistema('root', '');
    $modelIvr = new IvrModel(new \paloDB($dsnAsterisk));
    //$modelOutgoingRoutes = new RutaSalienteModel(new \paloDB($dsnAsterisk));
    $modelConexionesBD = new ConexionesModel(new \paloDB($dsnAsterisk));
    $IvrList = $modelIvr->index();
    $conexionesLista = $modelConexionesBD->lista();
    //$outgoingRouteList = $modelOutgoingRoutes->index();
    //$outgoingRouteList = $configuracionNotificaciones->getTrunksDialPatern();
    $dialplanAndRouteList = $configuracionNotificaciones->getTrunksConfig();

    $arrOptionsDias = array(
        "1" => "Lunes",
        "2" => "Martes",
        "3" => "Miercoles",
        "4" => "Jueves",
        "5" => "Viernes",
        "6" => "Sabado",
        "0" => "Domingo",
    ); 
    $optionsHours = array(''=>'...');
    $optionsMins = array(''=>'...');
    for($i = 0; $i < 24; $i++){
        $i < 10 ? $optionsHours["0$i"] ="0".$i : $optionsHours["$i"] = $i;
    }
    for($i = 0; $i < 60; $i++){  
        $i < 10 ? $optionsMins["0$i"] ="0".$i : $optionsMins["$i"] = $i;   
    }       

    $infoToView = array("ivrLista" => $IvrList, "outgoingRouteList" => $dialplanAndRouteList, 
    "conexionesLista" => $conexionesLista, "diasLista" => $arrOptionsDias, "optionsHours" => $optionsHours, 
    "optionsMins" => $optionsMins
    );

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
        default: // view_form
            $content = viewFormconfiguracion_general2($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
            break;
    }
    return $content;
}

function viewFormconfiguracion_general2($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf, $infoToView)
{
    $pconfiguracion_general2 = new paloSantoconfiguraciongeneral($pDB);
    $configuracionGeneral = $pconfiguracion_general2->getNotificacionesConfiguracion();
    //echo json_encode($configuracionGeneral);
    $arrFormconfiguracion_general2 = createFieldForm();
    $oForm = new paloForm($smarty, $arrFormconfiguracion_general2);
    $dataForm = array("configuracionGeneral"=>$configuracionGeneral);


    //begin, Form data persistence to errors and other events.
    $_DATA  = $_POST;
    $action = getParameter("action");
    //$id     = getParameter("id");

    //echo('elidddd='.$_DATA['id']);
    $smarty->assign("ID", 1); //persistence id with input hidden in tpl

    if ($action == "view")
        $oForm->setViewMode();
    else if ($action == "view_edit" || getParameter("save_edit"))
        $oForm->setEditMode();
    //end, Form data persistence to errors and other events.

    if ($action == "view" || $action == "view_edit") { // the action is to view or view_edit.
            $smarty->assign("mb_title", _tr("Error get Data"));
            $smarty->assign("mb_message", $pconfiguracion_general2->errMsg);
    }
    $smarty->assign("SAVE", _tr("Save"));
    $smarty->assign("EDIT", _tr("Edit"));
    $smarty->assign("CANCEL", _tr("Cancel"));
    $smarty->assign("REQUIRED_FIELD", _tr("Required field"));
    $smarty->assign("icon", "images/list.png");
    $smarty->assign("configListas", $infoToView);
    $smarty->assign("dataForm", $dataForm);

    /*echo("<br>");
echo("<br>");
print_r($_DATA);*/

    $htmlForm = $oForm->fetchForm("$local_templates_dir/form.tpl", _tr("configuracion_general2"), $_DATA);
    $content = "<form  method='POST' style='margin-bottom:0;' action='?menu=$module_name' name='form_configuraciongeneral' id='form_configuraciongeneral'>" . $htmlForm . "</form>";

    return $content;
}

function saveNewconfiguracion_general2($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf, $infoToView)
{
    $pconfiguracion_general2 = new paloSantoconfiguracionGeneral($pDB);
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

        // echo"variables posts =>". json_encode($_POST);
         $pconfiguracion_general2->updateNotificacionesConfiguracion($_POST);
        header("Location: index.php?menu=configuracion_general");

        //$content = "Code to save yet undefined.";



    }
    return $content;
}

function createFieldForm()
{
    $arrOptions = array('desactivar' => 'Desactivar', 'activar' => 'Activar');
    $arrOptionsBarridos = array('' => 'Seleccione...', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5');
    $arrOptionsMotor = array('' => 'Seleccione...', 'Oracle' => 'Oracle', 'PostgreSQL' => 'PostgreSQL', 'Mysql' => 'Mysql');
    $arrOptionsActivo = array('' => 'Seleccione...', 'Activo' => 'Activo', 'Inactivo' => 'Inactivo');

    $arrOptionsDias = array(
        "" => "...",
        "1" => "Lunes",
        "2" => "Martes",
        "3" => "Miercoles",
        "4" => "Jueves",
        "5" => "Viernes",
        "6" => "Sabado",
        "0" => "Domingo",
    );
    $optionsHours = array(''=>'...');
    $optionsMins = array(''=>'...');
    for($i = 0; $i < 24; $i++){
        $i < 10 ? $optionsHours["0$i"] ="0".$i : $optionsHours["$i"] = $i;
    }
    for($i = 0; $i < 60; $i++){  
        $i < 10 ? $optionsMins["0$i"] ="0".$i : $optionsMins["$i"] = $i;   
    }    

    $arrFields = array(
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
        "horainicialnot"   => array(
            "LABEL"                  => _tr("Hora Inicial Notificación"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "SELECT",
            "INPUT_EXTRA_PARAM"      => $optionsHours,
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => "",
            "EDITABLE"               => "si",
        ), 
        "minutoinicialnot"   => array(
            "LABEL"                  => _tr("Minuto Inicial Notificación"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "SELECT",
            "INPUT_EXTRA_PARAM"      => $optionsMins,
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => "",
            "EDITABLE"               => "si",
        ),   
        "minutofinalnot"   => array(
            "LABEL"                  => _tr("Minuto Final Notificación"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "SELECT",
            "INPUT_EXTRA_PARAM"      => $optionsMins,
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => "",
            "EDITABLE"               => "si",
        ),              
        "horafinalnot"   => array(
            "LABEL"                  => _tr("Hora final Notificación"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "SELECT",
            "INPUT_EXTRA_PARAM"      => $optionsHours,
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => "",
            "EDITABLE"               => "si",
        ),                 
        "diainicialnot"   => array(
            "LABEL"                  => _tr("Día Inicial Notif"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "SELECT",
            "INPUT_EXTRA_PARAM"      => $arrOptionsDias,
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => "",
            "EDITABLE"               => "si",
        ),  
        "diafinalnot"   => array(
            "LABEL"                  => _tr("Día Final Notif"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "SELECT",
            "INPUT_EXTRA_PARAM"      => $arrOptionsDias,
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => "",
            "EDITABLE"               => "si",
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
            "LABEL"                  => _tr("Cant líneas:"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "TEXT",
            "INPUT_EXTRA_PARAM"      => "",
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => ""
        ),
        "barridos"   => array(
            "LABEL"                  => _tr("Barridos"),
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
    else if (getParameter("action") == "view_edit")
        return "view_form";
    else
        return "report"; //cancel
}