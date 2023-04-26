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
  $Id: index.php,v 1.1 2022-12-12 08:12:05 Manuelf manuelf0710@gmail.com Exp $ */
//include issabel framework
include_once "libs/paloSantoGrid.class.php";
include_once "libs/paloSantoForm.class.php";

function _moduleContent(&$smarty, $module_name)
{
    //include module files
    include_once "modules/$module_name/configs/default.conf.php";
    include_once "modules/$module_name/libs/paloSantoLogs2.class.php";

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
    //$pDB = new paloDB($arrConf['dsn_conn_database']);
    $pDB = "";
    $dsnAsterisk = generarDSNSistema('asteriskuser', 'asterisk');
    $pDB = new paloDB($dsnAsterisk);      


    //actions
    $action = getAction();
    $content = "";

    $modulo = getParameter("modulo");
    if(!$modulo){ $modulo = "cronjob";}
    $modulesFiles = array("cronjob","Auditorias","conexionbd");



 

    switch ($action) {
        case "save_new":
            $content = saveNewLogs2($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $modulo);
            if (in_array($modulo, $modulesFiles)) {
                $content .= reportLogs_Table($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $modulo);
            } else{
                $content .= reportLogsFiles_Table($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $modulo);
            }
                         
            break;
        default: // view_form
            $content = viewFormLogs2($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $modulo);
            if (in_array($modulo, $modulesFiles)) {
                $content .= reportLogs_Table($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $modulo);
            } else{
                $content .= reportLogsFiles_Table($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $modulo);
            }
            break;
    }
    return $content;
}

function readErrorLogAsterisk(){
    $arrData = [];
    $ruta_archivo = "/var/log/asterisk/full";

    // Leer el archivo en un array
    $lineas = file($ruta_archivo);

    $log_data = array_slice($lineas, -500, 500);
    
    // Iterar sobre el array y buscar las líneas que te interesan
    foreach ($log_data as $linea) {
        // Dividir el contenido de la línea en diferentes partes utilizando la tubería como separador
        $partes = explode("|", $linea);
        // Hacer algo con las diferentes partes
        /*echo "Fecha: " . $partes[0] . "<br>";
        echo "Canal: " . $partes[1] . "<br>";
        echo "Mensaje: " . $partes[2] . "<br>"; */
        if(count($partes) > 1){
            $arrTmp[0] = $partes[0];
            $arrTmp[1] = "Informativa";
            $arrTmp[2] = $partes[2];
            $arrTmp[3] = "Asterisk";
            $arrTmp[4] ="";
            $arrData[] = $arrTmp;
        }
        
    }



    return $arrData;
}


function validateDatesLogsFilter($desde, $hasta, $fechaDesde, $fechaHasta, $datetime){
    $valid = 1;
    if ($desde != "" || $hasta != "") {
        $fechaComparar = new DateTime($datetime);
    }

    if ($desde != "") {
        $valid = 0;
        if ( $fechaComparar->format('Y-m-d H:i:s') > $fechaDesde->format('Y-m-d H:i:s') ) {
            $valid = 2;
        }
    }

    if ($hasta != "") {
        if ($fechaComparar->format('Y-m-d H:i:s') < $fechaHasta->format('Y-m-d H:i:s')) {
            $valid = 2;
        }else{
            $valid = 0;
        }
    } 
    return $valid;
}

function readErrorLogApache($tipo="", $desde= "", $hasta=""){
    $fechaDesde = "";
    $fechaHasta = "";

    if($desde != ""){
        $fechaDesde = DateTime::createFromFormat('d/m/Y H:i', $desde);    
    }
    if($hasta != ""){
        $fechaHasta = DateTime::createFromFormat('d/m/Y H:i', $hasta);    
    }
    

    $log_file = '/var/log/httpd/error_log';
    $linesToRead = 200;
    $log_data = file($log_file);
    
    // Obtener las últimas 200 líneas del archivo de registro
    $log_data = array_slice($log_data, -500, 500);
    $arrData = [];
    
foreach ($log_data as $line) {
    // Procesa cada línea del archivo de registro
    $parts = explode(' ', $line);
    if (count($parts) > 7) {
        $ip = $parts[0];
        $datetime = date('Y-m-d H:i:s', strtotime(substr($parts[3], 1)));
        $type = $parts[5];
        $type = strpos($parts[5], "error") ? "Error" : "Informativa";
        if (strtoupper($type) == strtoupper($tipo)) {
            
            $valid = validateDatesLogsFilter($desde, $hasta, $fechaDesde, $fechaHasta, $datetime);


            if ($valid > 0) {
                $description =$line;
                $modulo = "Apache";

                $arrTmp[0] = $datetime;
                $arrTmp[1] = $type;
                $arrTmp[2] = $description;
                $arrTmp[3] = $modulo;
                $arrTmp[4] ="";
                $arrData[] = $arrTmp;
            }
        }

        if ($tipo == null || $tipo == "todos") {
            $valid = validateDatesLogsFilter($desde, $hasta, $fechaDesde, $fechaHasta, $datetime);

            if ($valid > 0) {
                $description =$line;
                $modulo = "Apache";

                $arrTmp[0] = $datetime;
                $arrTmp[1] = $type;
                $arrTmp[2] = $description;
                $arrTmp[3] = $modulo;
                $arrTmp[4] ="";
                $arrData[] = $arrTmp;
            }
        
        }
    }
}
    return $arrData;
}


function viewFormLogs2($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf, $modulo)
{
    $pLogs2 = new paloSantoLogs2($pDB);
    $arrFormLogs2 = createFieldForm();
    $oForm = new paloForm($smarty, $arrFormLogs2);

    //begin, Form data persistence to errors and other events.
    $_DATA  = $_POST;
    $action = getParameter("action");
    $id     = getParameter("id");
    $smarty->assign("ID", $id); //persistence id with input hidden in tpl

    if ($action == "view")
        $oForm->setViewMode();
    else if ($action == "view_edit" || getParameter("save_edit"))
        $oForm->setEditMode();
    //end, Form data persistence to errors and other events.

    if ($action == "view" || $action == "view_edit") { // the action is to view or view_edit.
        $dataLogs2 = $pLogs2->getLogs2ById($id);
        if (is_array($dataLogs2) & count($dataLogs2) > 0)
            $_DATA = $dataLogs2;
        else {
            $smarty->assign("mb_title", _tr("Error get Data"));
            $smarty->assign("mb_message", $pLogs2->errMsg);
        }
    }


    $smarty->assign("SAVE", _tr("Save"));
    $smarty->assign("EDIT", _tr("Edit"));
    $smarty->assign("CANCEL", _tr("Cancel"));
    $smarty->assign("REQUIRED_FIELD", _tr("Required field"));
    $smarty->assign("icon", "images/list.png");


    $fecha_inicial = getParameter("fecha_inicial");
    $fecha_final = getParameter("fecha_final");

    if($fecha_inicial == ""){
        // fecha final
       $fecha_inicial = date('d/m/Y', strtotime('-30 days', strtotime($fecha_final)));   
       
       $fecha_final = date('Y-m-d H:i', strtotime('now +1 day')); // fecha final
       $fecha_inicial = date('d/m/Y', strtotime('-30 days', strtotime($fecha_final)))." 00:00"; // fecha inicial
       $fecha_final = date('d/m/Y', strtotime('now +1 day'))." 00:00";
   }     
   
    $tipo = getParameter("tipo");


    $smarty->assign("fecha_inicial",$fecha_inicial);
    $smarty->assign("fecha_final",$fecha_final);    
    $smarty->assign("modulo",$modulo);    
    $smarty->assign("tipo",$tipo);    


    $htmlForm = $oForm->fetchForm("$local_templates_dir/form.tpl", _tr("Logs2"), $_DATA);
    $content = "<form  method='POST' style='margin-bottom:0;' name='form_logs' action='?menu=$module_name'>" . $htmlForm . "</form>";

    return $content;
}

function saveNewLogs2($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf, $modulo)
{
    $pLogs2 = new paloSantoLogs2($pDB);
    $arrFormLogs2 = createFieldForm();
    $oForm = new paloForm($smarty, $arrFormLogs2);

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
        $content = viewFormLogs2($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $modulo);
    } else {
        //NO ERROR, HERE IMPLEMENTATION OF SAVE
        //$content = "Code to save yet undefined.";
        $content = viewFormLogs2($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $modulo);
    }
    return $content;
}

function createFieldForm()
{
    $arrOptions = array('' => 'Seleccione...', 'advertencia' => 'Advertencia', 'error' => 'Error', 'informativa' => 'Informativa',  'todos' => 'Todos');

    $arrFields = array(
        "fecha_inicialf"   => array(
            "LABEL"                  => _tr("Fecha Inicial"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "DATE",
            "INPUT_EXTRA_PARAM"      => array("TIME" => true, "FORMAT" => "%d %b %Y %H:%M", "TIMEFORMAT" => "12"),
            "VALIDATION_TYPE"        => "",
            "EDITABLE"               => "si",
            "VALIDATION_EXTRA_PARAM" => ""
        ),
        "fecha_finalf"   => array(
            "LABEL"                  => _tr("Fecha Final"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "DATE",
            "INPUT_EXTRA_PARAM"      => array("TIME" => true, "FORMAT" => "%d %b %Y %H:%M", "TIMEFORMAT" => "12"),
            "VALIDATION_TYPE"        => "",
            "EDITABLE"               => "si",
            "VALIDATION_EXTRA_PARAM" => ""
        ),
        "tipof"   => array(
            "LABEL"                  => _tr("Tipo"),
            "REQUIRED"               => "no",
            "INPUT_TYPE"             => "SELECT",
            "INPUT_EXTRA_PARAM"      => $arrOptions,
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
    else if (getParameter("action") == "view")      //Get parameter by GET (command pattern, links)
        return "view_form";
    else if (getParameter("action") == "view_edit")
        return "view_form";
    else
        return "report"; //cancel
}


/*
* functions for table logs
 */

 function reportLogs_Table($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf, $modulo)
{
    $pLogs_Table = new paloSantoLogs_Table($pDB);
    $filter_field = getParameter("filter_field");
    $filter_value = getParameter("filter_value");
    $fecha_inicial = getParameter("fecha_inicial");
    $fecha_final = getParameter("fecha_final");        
    $tipo = getParameter("tipo");    

    //begin grid parameters
    $oGrid  = new paloSantoGrid($smarty);
    $oGrid->setTitle(_tr("Logs_Table"));
    $oGrid->pagingShow(true); // show paging section.

    $oGrid->enableExport();   // enable export.
    $oGrid->setNameFile_Export(_tr("Reporte_Logs"));
    $oGrid->setTplFile('themes/customTheme/_custom_list.tpl');

    if($fecha_inicial == ""){
        // fecha final
       $fecha_inicial = date('d/m/Y', strtotime('-30 days', strtotime($fecha_final)));   
       
       $fecha_final = date('Y-m-d H:i', strtotime('now +1 day')); // fecha final
       $fecha_inicial = date('d/m/Y', strtotime('-30 days', strtotime($fecha_final)))." 00:00"; // fecha inicial
       $fecha_final = date('d/m/Y', strtotime('now +1 day'))." 00:00";
   }     

    $postFilter =array(
        "fecha_inicial" => $fecha_inicial,
        "fecha_final" => $fecha_final,
        "tipo" => $tipo,
        "modulo" => $modulo,
    );    

    $url = array(
        "menu"         =>  $module_name,
        "filter_field" =>  $filter_field,
        "filter_value" =>  $filter_value,
        "fecha_inicial" => $fecha_inicial,
        "fecha_final" => $fecha_final,
        "modulo" => $modulo,
        "tipo" => $tipo,
    );

    $smarty->assign("fecha_inicial",$fecha_inicial);
    $smarty->assign("fecha_final",$fecha_final);
    $smarty->assign("modulo",$modulo);
    $smarty->assign("tipo",$tipo);
      

    $oGrid->setURL($url);

    //$arrColumns = array(_tr("Fecha"),_tr("Tipo"),_tr("Descripción"),_tr("Módulo"), _tr("Acción"));
    $arrColumns = array(_tr("Fecha"),_tr("Tipo"),_tr("Descripción"),_tr("Módulo"));
    $oGrid->setColumns($arrColumns);

    $total   = $pLogs_Table->getNumLogs_Table($filter_field, $filter_value, $postFilter);
    
    $arrData = null;
    if($oGrid->isExportAction()){
        $limit  = $total; // max number of rows.
        $offset = 0;      // since the start.
    }
    else{
        $limit  = 20;
        $oGrid->setLimit($limit);
        $oGrid->setTotal($total);
        $offset = $oGrid->calculateOffset();
    }
    $first_record = $offset + 1;
    $last_record = $offset + $limit;
    if($last_record > $total) {
        $last_record = $total;
    }       

    $arrResult =$pLogs_Table->getLogs_Table($limit, $offset, $filter_field, $filter_value, $postFilter);

    if(is_array($arrResult) && $total>0){
        foreach($arrResult as $key => $value){ 
	    $arrTmp[0] = $value['fecha'];
	    $arrTmp[1] = $value['tipo'];
	    $arrTmp[2] = $value['descripcion'];
	    $arrTmp[3] = $value['modulo'];
	    //$arrTmp[4] = $value['accion'];
            $arrData[] = $arrTmp;
        }
    }
    $oGrid->setData($arrData);

    //begin section filter
    $oFilterForm = new paloForm($smarty, createFieldFilter());
    $smarty->assign("SHOW", _tr("Show"));
    $htmlFilter  = $oFilterForm->fetchForm("$local_templates_dir/filter.tpl","",$_POST);
    //end section filter

    //$oGrid->showFilter(trim($htmlFilter));
    if( $total > 0){
        $content = "<div style='margin-top:10px;'>Mostrando $first_record a $last_record de $total registros</div>";
    }else{
        $content = "<div style='margin-top:10px;'>0 registros encontrados</div>";
    }

    $content .= $oGrid->fetchGrid();
    //end grid parameters

    return $content;
}


/*table for reading logs*/
function reportLogsFiles_Table($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf, $modulo)
{
    $pLogs_Table = new paloSantoLogsFile_Table($pDB);
    $filter_field = getParameter("filter_field");
    $filter_value = getParameter("filter_value");
    $fecha_inicial = getParameter("fecha_inicial");
    $fecha_final = getParameter("fecha_final");      
    $tipo = getParameter("tipo");    

    //begin grid parameters
    $oGrid  = new paloSantoGrid($smarty);
    $oGrid->setTitle(_tr("Logs_Table"));
    $oGrid->pagingShow(true); // show paging section.

    $oGrid->enableExport();   // enable export.
    $oGrid->setNameFile_Export(_tr("LogsFile_Table"));
    $oGrid->setTplFile('themes/customTheme/_custom_list.tpl');

    $postFilter =array(
        "fecha_inicial" => $fecha_inicial,
        "fecha_final" => $fecha_final,
        "tipo" => $tipo,
        "modulo" => $modulo,
    );    

    $url = array(
        "menu"         =>  $module_name,
        "filter_field" =>  $filter_field,
        "filter_value" =>  $filter_value,
        "fecha_inicial" => $fecha_inicial,
        "fecha_final" => $fecha_final,
        "modulo" => $modulo,
        "tipo" => $tipo,
    );

    $smarty->assign("fecha_inicial",$fecha_inicial);
    $smarty->assign("fecha_final",$fecha_final);
    $smarty->assign("modulo",$modulo);
    $smarty->assign("tipo",$tipo);
      

    $oGrid->setURL($url);

    //$arrColumns = array(_tr("Fecha"),_tr("Tipo"),_tr("Descripción"),_tr("Módulo"), _tr("Acción"));
    $arrColumns = array(_tr("Fecha"),_tr("Tipo"),_tr("Descripción"),_tr("Módulo"));
    $oGrid->setColumns($arrColumns);

    $dataForTable = null;
    if($modulo == "apache"){
        $dataForTable = readErrorLogApache($tipo, $fecha_inicial, $fecha_final);
    }
    if($modulo == "asterisk"){
        $dataForTable = readErrorLogAsterisk($tipo, $fecha_inicial, $fecha_final);
    }

    $total   = $pLogs_Table->getNumLogsFile_Table($filter_field, $filter_value, $postFilter, count($dataForTable));
    
    $arrData = $dataForTable;
    if($oGrid->isExportAction()){
        $limit  = $total; // max number of rows.
        $offset = 0;      // since the start.
    }
    else{
        $limit  = 20;
        $oGrid->setLimit($limit);
        $oGrid->setTotal($total);
        $offset = $oGrid->calculateOffset();
    }
    $first_record = $offset + 1;
    $last_record = $offset + $limit;
    if($last_record > $total) {
        $last_record = $total;
    }       

    $arrResult =$pLogs_Table->getLogsFile_Table($limit, $offset, $filter_field, $filter_value, $postFilter, $dataForTable);    
    /*if(is_array($arrResult) && $total>0){
        foreach($arrResult as $key => $value){ 
	    $arrTmp[0] = $value['fecha'];
	    $arrTmp[1] = $value['tipo'];
	    $arrTmp[2] = $value['descripcion'];
	    $arrTmp[3] = $value['modulo'];
	    $arrTmp[4] = $value['accion'];
            $arrData[] = $arrTmp;
        }
    } */
    $oGrid->setData($arrResult);

    //begin section filter
    $oFilterForm = new paloForm($smarty, createFieldFilter());
    $smarty->assign("SHOW", _tr("Show"));
    $htmlFilter  = $oFilterForm->fetchForm("$local_templates_dir/filter.tpl","",$_POST);
    //end section filter

    //$oGrid->showFilter(trim($htmlFilter));
    if( $total > 0){
        $content = "<div style='margin-top:10px;'>Mostrando $first_record a $last_record de $total registros</div>";
    }else{
        $content = "<div style='margin-top:10px;'>0 registros encontrados</div>";
    }

    $content .= $oGrid->fetchGrid();
    //end grid parameters

    return $content;
}


 function createFieldFilter(){
    $arrFilter = array(
	    "fecha" => _tr("Fecha"),
	    "tipo" => _tr("Tipo"),
	    "descripci_n" => _tr("Descripción"),
                    );

    $arrFormElements = array(
            "filter_field" => array("LABEL"                  => _tr("Search"),
                                    "REQUIRED"               => "no",
                                    "INPUT_TYPE"             => "SELECT",
                                    "INPUT_EXTRA_PARAM"      => $arrFilter,
                                    "VALIDATION_TYPE"        => "text",
                                    "VALIDATION_EXTRA_PARAM" => ""),
            "filter_value" => array("LABEL"                  => "",
                                    "REQUIRED"               => "no",
                                    "INPUT_TYPE"             => "TEXT",
                                    "INPUT_EXTRA_PARAM"      => "",
                                    "VALIDATION_TYPE"        => "text",
                                    "VALIDATION_EXTRA_PARAM" => ""),
                    );
    return $arrFormElements;
}
/*
* end functions for table logs
 */