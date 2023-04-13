<?php
 ini_set('display_errors', 1);
 error_reporting(E_ALL); 
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
  $Id: index.php,v 1.1 2022-12-15 05:12:21 Manuelf manuelf0710@gmail.com Exp $ */
//include issabel framework
include_once "libs/paloSantoGrid.class.php";
include_once "libs/paloSantoForm.class.php";

function _moduleContent(&$smarty, $module_name)
{
    //include module files
    include_once "modules/$module_name/configs/default.conf.php";
    include_once "modules/$module_name/libs/paloSantoConfiguracionIVRECS2.class.php";

    //include file language agree to issabel configuration
    //if file language not exists, then include language by default (en)
    $lang=get_language();
    $base_dir=dirname($_SERVER['SCRIPT_FILENAME']);
    $lang_file="modules/$module_name/lang/$lang.lang";
    if (file_exists("$base_dir/$lang_file")) include_once "$lang_file";
    else include_once "modules/$module_name/lang/en.lang";

    //global variables
    global $arrConf;
    global $arrConfModule;
    global $arrLang;
    global $arrLangModule;
    $arrConf = array_merge($arrConf,$arrConfModule);
    $arrLang = array_merge($arrLang,$arrLangModule);

    //folder path for custom templates
    $templates_dir=(isset($arrConf['templates_dir']))?$arrConf['templates_dir']:'themes';
    $local_templates_dir="$base_dir/modules/$module_name/".$templates_dir.'/'.$arrConf['theme'];

    //conexion resource
    //$pDB = new paloDB($arrConf['dsn_conn_database']);
    $dsnAsterisk = generarDSNSistema('asteriskuser', 'asterisk');
    $pDB = new paloDB($dsnAsterisk);
    //$pConfiguracionIVRECS2 = new paloSantoConfiguracionIVRECS2($pDB);

    //actions
    $action = getAction();
    $content = "";

    switch($action){
        case "save_new":
            $content = saveNewConfiguracionIVRECS2($smarty, $module_name, $local_templates_dir, $pDB, $arrConf);
            break;
        default: // view_form
            $content = viewFormConfiguracionIVRECS2($smarty, $module_name, $local_templates_dir, $pDB, $arrConf);
            break;
    }
    return $content;
}

function viewFormConfiguracionIVRECS2($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf)
{
    $pConfiguracionIVRECS2 = new paloSantoConfiguracionIVRECS2($pDB);
    $configuracionIVR = $pConfiguracionIVRECS2->getConfiguracionIVRECS2();
    $ivrMiscList = $pConfiguracionIVRECS2->getIvrMisc();
    $queueList = $pConfiguracionIVRECS2->getQueues();
    $arrFormConfiguracionIVRECS2 = createFieldForm();
    $oForm = new paloForm($smarty,$arrFormConfiguracionIVRECS2);

    //begin, Form data persistence to errors and other events.
    $_DATA  = $_POST;
    $action = getParameter("action");
    $id     = getParameter("id");
    $smarty->assign("ID", $id); //persistence id with input hidden in tpl

    if($action=="view")
        $oForm->setViewMode();
    else if($action=="view_edit" || getParameter("save_edit"))
        $oForm->setEditMode();
    //end, Form data persistence to errors and other events.

    if($action=="view" || $action=="view_edit"){ // the action is to view or view_edit.
        $dataConfiguracionIVRECS2 = $pConfiguracionIVRECS2->getConfiguracionIVRECS2ById($id);
        if(is_array($dataConfiguracionIVRECS2) & count($dataConfiguracionIVRECS2)>0)
            $_DATA = $dataConfiguracionIVRECS2;
        else{
            $smarty->assign("mb_title", _tr("Error get Data"));
            $smarty->assign("mb_message", $pConfiguracionIVRECS2->errMsg);
        }
    }

    $smarty->assign("configuracionIVR", $configuracionIVR);
    $smarty->assign("ivrMiscList", $ivrMiscList);
    $smarty->assign("queueList", $queueList);

    $smarty->assign("SAVE", _tr("Guardar"));
    $smarty->assign("EDIT", _tr("Edit"));
    $smarty->assign("CANCEL", _tr("Cancel"));
    $smarty->assign("REQUIRED_FIELD", _tr("Required field"));
    $smarty->assign("icon", "images/list.png");

    $htmlForm = $oForm->fetchForm("$local_templates_dir/form.tpl",_tr("ConfiguracionIVRECS2"), $_DATA);
    $content = "<form  method='POST' style='margin-bottom:0;' action='?menu=$module_name'>".$htmlForm."</form>";

    return $content;
}

function saveNewConfiguracionIVRECS2($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf)
{
    $pConfiguracionIVRECS2 = new paloSantoConfiguracionIVRECS2($pDB);
    $arrFormConfiguracionIVRECS2 = createFieldForm();
    $oForm = new paloForm($smarty,$arrFormConfiguracionIVRECS2);

    if(!$oForm->validateForm($_POST)){
        // Validation basic, not empty and VALIDATION_TYPE 
        $smarty->assign("mb_title", _tr("Validation Error"));
        $arrErrores = $oForm->arrErroresValidacion;
        $strErrorMsg = "<b>"._tr("The following fields contain errors").":</b><br/>";
        if(is_array($arrErrores) && count($arrErrores) > 0){
            foreach($arrErrores as $k=>$v)
                $strErrorMsg .= "$k, ";
        }
        $smarty->assign("mb_message", $strErrorMsg);
        $content = viewFormConfiguracionIVRECS2($smarty, $module_name, $local_templates_dir, $pDB, $arrConf);
    }
    else{
        //NO ERROR, HERE IMPLEMENTATION OF SAVE
        $pConfiguracionIVRECS2->updateNotificacionesConfiguracion($_POST);
        //$content="";
        header("Location: index.php?menu=configuracion_ivrecs");
    }
    return $content;
}

function createFieldForm()
{
    $arrOptions = array(''=> 'Seleccione...','val1' => 'dato 1', 'val2' => 'Dato 2', 'val3' => 'Dato 3');

    $arrFields = array(
            "ip_servidor_oms"   => array(      "LABEL"                  => _tr("IP Servidor OMS"),
                                            "REQUIRED"               => "no",
                                            "INPUT_TYPE"             => "TEXT",
                                            "INPUT_EXTRA_PARAM"      => "",
                                            "VALIDATION_TYPE"        => "text",
                                            "VALIDATION_EXTRA_PARAM" => ""
                                            ),
            "rutao"   => array(      "LABEL"                  => _tr("Ruta"),
                                            "REQUIRED"               => "no",
                                            "INPUT_TYPE"             => "TEXT",
                                            "INPUT_EXTRA_PARAM"      => "",
                                            "VALIDATION_TYPE"        => "text",
                                            "VALIDATION_EXTRA_PARAM" => ""
                                            ),
            "identificador_ivr"   => array(      "LABEL"                  => _tr("Identificador IVR"),
                                            "REQUIRED"               => "no",
                                            "INPUT_TYPE"             => "SELECT",
                                            "INPUT_EXTRA_PARAM"      => $arrOptions,
                                            "VALIDATION_TYPE"        => "text",
                                            "VALIDATION_EXTRA_PARAM" => "",
                                            "EDITABLE"               => "si",
                                            ),
            "cola_desbordeo"   => array(      "LABEL"                  => _tr("Cola Desborde"),
                                            "REQUIRED"               => "no",
                                            "INPUT_TYPE"             => "SELECT",
                                            "INPUT_EXTRA_PARAM"      => $arrOptions,
                                            "VALIDATION_TYPE"        => "text",
                                            "VALIDATION_EXTRA_PARAM" => "",
                                            "EDITABLE"               => "si",
                                            ),
            "usuarioo"   => array(      "LABEL"                  => _tr("Usuario"),
                                            "REQUIRED"               => "no",
                                            "INPUT_TYPE"             => "TEXT",
                                            "INPUT_EXTRA_PARAM"      => "",
                                            "VALIDATION_TYPE"        => "text",
                                            "VALIDATION_EXTRA_PARAM" => ""
                                            ),
            "contrasenao"   => array(      "LABEL"                  => _tr("Contraseña"),
                                            "REQUIRED"               => "no",
                                            "INPUT_TYPE"             => "TEXT",
                                            "INPUT_EXTRA_PARAM"      => "",
                                            "VALIDATION_TYPE"        => "text",
                                            "VALIDATION_EXTRA_PARAM" => ""
                                            ),

            );
    return $arrFields;
}

function getAction()
{
    if(getParameter("save_new")) //Get parameter by POST (submit)
        return "save_new";
    else if(getParameter("save_edit"))
        return "save_edit";
    else if(getParameter("delete")) 
        return "delete";
    else if(getParameter("new_open")) 
        return "view_form";
    else if(getParameter("action")=="view")      //Get parameter by GET (command pattern, links)
        return "view_form";
    else if(getParameter("action")=="view_edit")
        return "view_form";
    else
        return "report"; //cancel
}
?>