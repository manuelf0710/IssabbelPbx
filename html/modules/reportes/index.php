|<?php
ini_set('display_errors',1);
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
  $Id: index.php,v 1.1 2022-12-04 12:12:42 Manuelf manuelf0710@gmail.com Exp $ */
//include issabel framework
include_once "libs/paloSantoGrid.class.php";
include_once "libs/paloSantoForm.class.php";
//global $criterioActive;

function _moduleContent(&$smarty, $module_name)
{
    //include module files
    include_once "modules/$module_name/configs/default.conf.php";
    include_once "modules/$module_name/libs/paloSantoReporte_Notificacion_Eventos.class.php";

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
    $pDB = "";
    $dsnAsterisk = generarDSNSistema('asteriskuser', 'asterisk');
    $pDB = new paloDB($dsnAsterisk); 


    //actions
    $action = getAction();
    $content = "";

    /*
    * recibir param post criterio de busqueda
    * var @criterio  post
    */
    
    $criterioActive = getParameter('criterio');
    

    /*
    * Assign filter criterio to smarty template
    */
    $smarty->assign("criterioActive", $criterioActive);

    $arrOptionsTipoEvento = array(
    'Confirmado' => 'Confirmado', 
    'Restaurado' => 'Restaurado', 
    'Cancelado' => 'Cancelado', 
    'Reprogramado' => 'Reprogramado');   
    
    $infoToView = array("tipoEventosLista"=> $arrOptionsTipoEvento);

    if(getParameter("exportcsv") == "yes" || getParameter("exportpdf") == "yes" || getParameter("exportspreadsheet") == "yes"){
        $action = "isReport";
    }    

    switch($action){
        case "save_new":
            $content = saveNewReporte_Notificacion_Eventos($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
            if($criterioActive == 'eventos'){
                $content.="<div id='divcontent_eventos'>";
                $content .= eventosTabla($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
                $content.="</div>";
            }
            if($criterioActive == 'otros'){
                $content .= otrosTabla($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
            }			
            if($criterioActive == 'text2speech'){
                $content.="<div id='divcontent_eventos'>";
                $content .= text2SpeechTabla($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
                $content.="</div>";
            }			
            break;
        case "isReport":
            $module = "Reportes >>".$criterioActive;
            $criterioActive = $criterioActive == "forcampania_id" ? "forcampania_id ".getParameter('detalleid_filter') : $criterioActive; 
            $user = isset($_SESSION['issabel_user']) ? $_SESSION['issabel_user'] : "unknown";
            writeLOG("audit.log", 'Descarga '.$user.': Descarga de reporte '.$criterioActive.'. for '.$user.'  "'.$module.'" from '.$_SERVER["REMOTE_ADDR"]);        

            if($criterioActive == 'eventos'){
                $content.="<div id='divcontent_eventos'>";
                $content .= eventosTabla($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
                $content.="</div>";
            }
            if($criterioActive == 'otros'){
                $content .= otrosTabla($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
            }
            if($criterioActive == 'text2speech'){
                $content.="<div id='divcontent_eventos'>";
                $content .= text2SpeechTabla($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
                $content.="</div>";
            }  
            break;            
        case "isDetailEvent" :
              $content = eventosTablaDetalle($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
            break;

        default: // view_form
            $content = viewFormReporte_Notificacion_Eventos($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
            if($criterioActive == 'eventos'){
                $content.="<div id='divcontent_eventos'>";
                $content .= eventosTabla($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
                $content.="</div>";
            }
            if($criterioActive == 'otros'){
                $content .= otrosTabla($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
            }  
            if($criterioActive == 'text2speech'){
                $content.="<div id='divcontent_eventos'>";
                $content .= text2SpeechTabla($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
                $content.="</div>";
            }                          
            break;
    }
    return $content;
}

function viewFormReporte_Notificacion_Eventos($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf, $infoToView)
{
    $pReporte_Notificacion_Eventos = new paloSantoReporte_Notificacion_Eventos($pDB);
    $criterioActive = getParameter("criterio");
    
    //echo("criterioActive == (".$criterioActive.")");

        if($criterioActive == 'eventos'){
        $arrFormReporte_Notificacion_Eventos = createFieldFormEventos();
    }else{
        $arrFormReporte_Notificacion_Eventos = createFieldFormOtros();
    }
    $oForm = new paloForm($smarty,$arrFormReporte_Notificacion_Eventos);

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
        $dataReporte_Notificacion_Eventos = $pReporte_Notificacion_Eventos->getReporte_Notificacion_EventosById($id);
        if(is_array($dataReporte_Notificacion_Eventos) & count($dataReporte_Notificacion_Eventos)>0)
            $_DATA = $dataReporte_Notificacion_Eventos;
        else{
            $smarty->assign("mb_title", _tr("Error get Data"));
            $smarty->assign("mb_message", $pReporte_Notificacion_Eventos->errMsg);
        }
    }

    $smarty->assign("SAVE", _tr("Save"));
    $smarty->assign("EDIT", _tr("Edit"));
    $smarty->assign("CANCEL", _tr("Cancel"));
    $smarty->assign("ACCEPT", _tr("Aceptar"));
    $smarty->assign("REQUIRED_FIELD", _tr("Required field"));
    $smarty->assign("icon", "images/list.png");

    $fecha_inicial = getParameter("fecha_inicial");
    $fecha_final = getParameter("fecha_final");
    $id_evento = getParameter("id_evento");
    $tipo_evento = getParameter("tipo_evento");  
    $criterio = getParameter("criterio");  

    /*add campos form filter otros */
    $nus = getParameter("nus");  
    $telefono = getParameter("telefono");  
    $fecha_llamada = getParameter("fecha_llamada");  
    $id_eventootros = getParameter("id_eventootros"); 


    
    $smarty->assign("configListas", $infoToView);  




    $smarty->assign("fecha_inicial", $fecha_inicial);  
    $smarty->assign("fecha_final", $fecha_final);    
    $smarty->assign("tipo_evento", $tipo_evento);  
    $smarty->assign("id_evento", $id_evento);
    $smarty->assign("criterioActive", $criterio); 

    $smarty->assign("nus", $nus);
    $smarty->assign("telefono", $telefono);
    $smarty->assign("fecha_llamada", $fecha_llamada);
    $smarty->assign("id_eventootros", $id_eventootros);


    

    $htmlForm = $oForm->fetchForm("$local_templates_dir/form.tpl",_tr("Reporte Notificacion Eventos"), $_DATA);
    $content = "<form  method='POST' style='margin-bottom:0;' action='?menu=$module_name' name='form_reporte' id='form_reporte'>".$htmlForm."</form>";
    return $content;
}

function saveNewReporte_Notificacion_Eventos($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf, $infoToView)
{
    $pReporte_Notificacion_Eventos = new paloSantoReporte_Notificacion_Eventos($pDB);
    
			$criterioActive = getParameter('criterio');
            if($criterioActive == 'eventos'){
				$arrFormReporte_Notificacion_Eventos = createFieldForm();
            }else{
				$arrFormReporte_Notificacion_Eventos = createFieldFormOtros();				
			}
	
    $oForm = new paloForm($smarty,$arrFormReporte_Notificacion_Eventos);

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
        $content = viewFormReporte_Notificacion_Eventos($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);
    }
    else{
        //NO ERROR, HERE IMPLEMENTATION OF SAVE
        //$content = "Code to save yet undefined.";
        $content = viewFormReporte_Notificacion_Eventos($smarty, $module_name, $local_templates_dir, $pDB, $arrConf, $infoToView);        
        //echo json_encode($_POST);
    }
    return $content;
}

function createFieldFormEventos(){
    $arrOptions = array('' => 'Seleccione...', 'eventos' => 'Eventos', 'otros' => 'Otros');
	$arrOptionsTipoEvento = array('' => 'Seleccione...', 'Confirmado' => 'Confirmado', 'Restaurado' => 'Restaurado', 'Cancelado' => 'Cancelado', 'Reprogramado' => 'Reprogramado');

    $arrFields = array(
            "criterio"   => array(      "LABEL"                  => _tr("criterio"),
                                            "REQUIRED"               => "si",
                                            "INPUT_TYPE"             => "SELECT",
                                            "INPUT_EXTRA_PARAM"      => $arrOptions,
                                            "VALIDATION_TYPE"        => "text",
                                            "VALIDATION_EXTRA_PARAM" => "",
                                            "EDITABLE"               => "si",
                                            )

            );
    return $arrFields;
}


function createFieldFormOtros(){
    $arrOptions = array('' => 'Seleccione...', 'eventos' => 'Eventos', 'otros' => 'Otros');

    $arrFields = array(
            "criterio"   => array(      "LABEL"                  => _tr("criterio"),
                                            "REQUIRED"               => "si",
                                            "INPUT_TYPE"             => "SELECT",
                                            "INPUT_EXTRA_PARAM"      => $arrOptions,
                                            "VALIDATION_TYPE"        => "text",
                                            "VALIDATION_EXTRA_PARAM" => "",
                                            "EDITABLE"               => "si",
                                            )                                                                                    


            );
    return $arrFields;
}



function createFieldForm()
{
    $arrOptions = array('' => 'Seleccione...', 'eventos' => 'Eventos', 'otros' => 'Otros');

    $arrFields = array(
            "criterio"   => array(      "LABEL"                  => _tr("criterio"),
                                            "REQUIRED"               => "si",
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
    if(getParameter("save_new")) //Get parameter by POST (submit)
        return "save_new";
    if(getParameter("accept")) //Get parameter by POST (submit)
        return "accept";        
    else if(getParameter("save_edit"))
        return "save_edit";
    else if(getParameter("delete")) 
        return "delete";
    else if(getParameter("new_open")) 
        return "view_form";
    else if(getParameter("action")=="view")      //Get parameter by GET (command pattern, links)
        return "view_form";
    else if(getParameter("action")=="isDetailEvent")      //Get parameter by GET (command pattern, links)
    return "isDetailEvent";        
    else if(getParameter("action")=="view_edit")
        return "view_form";
    else
        return "report"; //cancel
}

function eventosTablaDetalle($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf, $infoToView)
{
    $pevento_tabla = new paloSantoEventoDetalle_tabla($pDB);
    $filter_field = getParameter("filter_field");
    $filter_value = getParameter("filter_value");
    $fecha_inicial = getParameter("fecha_inicial");
    $fecha_final = getParameter("fecha_final");
    $id_evento = getParameter("id_evento");
    $tipo_evento = getParameter("tipo_evento");
    $criterio = getParameter("criterio");
    $detalleid_filter = getParameter("detalleid_filter");

    //begin grid parameters
    $oGrid  = new paloSantoGrid($smarty);
    $oGrid->setTitle(_tr("eventoTabla"));
    $oGrid->pagingShow(true); // show paging section.

    $oGrid->enableExport();   // enable export.
    $oGrid->setNameFile_Export(_tr("eventoTabla"));
    $oGrid->setTplFile('themes/customTheme/_custom_list.tpl');

    $postFilter =array(
        "fecha_inicial" => $fecha_inicial,
        "fecha_final" => $fecha_final,
        "id_evento" => $id_evento,
        "tipo_evento" => $tipo_evento,
        "criterio" => $criterio,
        "detalleid_filter" => $detalleid_filter,
    );    

    $url = array(
        "menu"         =>  $module_name,
        "filter_field" =>  $filter_field,
        "filter_value" =>  $filter_value,
        "fecha_inicial" => $fecha_inicial,
        "fecha_final" => $fecha_final,
        "id_evento" => $id_evento,
        "tipo_evento" => $tipo_evento,
        "criterio" => $criterio

    
    );
    $oGrid->setURL($url);

    $arrColumns = array(_tr("Uniqueid"),_tr("NUS"),_tr("Tel Marcado"),_tr("Resultado"),_tr("Duración LLamada (Seg)"),_tr("Fecha LLamada"),_tr("Agente"),_tr("Grabación"));
    $oGrid->setColumns($arrColumns); 
    $oGrid->addLinkAction("index.php?menu=reportes&action=retornoeventos&criterio=eventos","Volver a lista de Eventos");
      

    $total   = $pevento_tabla->getNumevento_tabla($filter_field, $filter_value, $postFilter);


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



    $arrResult =$pevento_tabla->getevento_tabla($limit, $offset, $filter_field, $filter_value, $postFilter);
    if(is_array($arrResult) && $total>0){
        foreach($arrResult as $key => $value){ 
	    $arrTmp[0] = $value['uniqueid'];
	    $arrTmp[1] = $value['nus'];
	    $arrTmp[2] = $value['tel_marcado'];
	    $arrTmp[3] = $value['resultado'];
	    $arrTmp[4] = $value['duracion'];
	    $arrTmp[5] = $value['fecha_llamada'];
	    $arrTmp[6] = $value['agente'];
	    $arrTmp[7] = ($value['grabacion'] && $value['grabacion'] != "N/A") ? '<a href="/modules/reportes/download.php?file='.$value['grabacion'].'" target="_blank">Descargar</a>' : "N/A";
            $arrData[] = $arrTmp;
        }
    }
    $oGrid->setData($arrData);

    //begin section filter
    $oFilterForm = new paloForm($smarty, createFieldFilterEvento());
    $smarty->assign("SHOW", _tr("Show"));
    $htmlFilter  = $oFilterForm->fetchForm("$local_templates_dir/filter.tpl","",$_POST);
    //end section filter

    //$oGrid->showFilter(trim($htmlFilter));
    
    $content ="";
    if($criterio=="forcampania_id"){
        $content = "<div style='margin-top:1em'>Registros relacionados con ID Campaña $detalleid_filter</div>";
    }
    if($criterio=="forevento_id"){
        $content = "<div style='margin-top:1em'>Registros relacionados con ID Evento $detalleid_filter</div>";
    }

    $content .= "<div style='margin-top:10px;'>Mostrando $first_record a $last_record de $total registros</div>";
    $content .= $oGrid->fetchGrid();
    //end grid parameters

    return $content;
}

/*
* funciones para crear la tabla de eventos
 */
function eventosTabla($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf, $infoToView)
{
    $pevento_tabla = new paloSantoevento_tabla($pDB);
    $filter_field = getParameter("filter_field");
    $filter_value = getParameter("filter_value");
    $fecha_inicial = getParameter("fecha_inicial");
    $fecha_final = getParameter("fecha_final");
    $id_evento = getParameter("id_evento");
    $tipo_evento = getParameter("tipo_evento");
    $criterio = getParameter("criterio");

    //begin grid parameters
    $oGrid  = new paloSantoGrid($smarty);
    $oGrid->setTitle(_tr("eventoTabla"));
    $oGrid->pagingShow(true); // show paging section.

    $oGrid->enableExport();   // enable export.
    $oGrid->setNameFile_Export(_tr("eventoTabla"));
    $oGrid->setTplFile('themes/customTheme/_custom_list.tpl');

    $postFilter =array(
        "fecha_inicial" => $fecha_inicial,
        "fecha_final" => $fecha_final,
        "id_evento" => $id_evento,
        "tipo_evento" => $tipo_evento
    );    

    $url = array(
        "menu"         =>  $module_name,
        "filter_field" =>  $filter_field,
        "filter_value" =>  $filter_value,
        "fecha_inicial" => $fecha_inicial,
        "fecha_final" => $fecha_final,
        "id_evento" => $id_evento,
        "tipo_evento" => $tipo_evento,
        "criterio" => $criterio

    
    );
    $oGrid->setURL($url);

    $arrColumns = array(_tr("ID Evento"),_tr("Fecha llamada"),_tr("Barridos"),_tr("Cant Usuarios"),_tr("Informados"),_tr("Fallidos"),_tr("Destino"),_tr("Estado"),_tr("Campaña"));
    $oGrid->setColumns($arrColumns);
   

    $total   = $pevento_tabla->getNumevento_tabla($filter_field, $filter_value, $postFilter);


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



    $arrResult =$pevento_tabla->getevento_tabla($limit, $offset, $filter_field, $filter_value, $postFilter);

    if(is_array($arrResult) && $total>0){
        foreach($arrResult as $key => $value){ 
	    $arrTmp[0] = $value['eve_id'];
	    $arrTmp[1] = $value['fecha_llamada'];
	    $arrTmp[2] = $value['barridos'];
	    $arrTmp[3] = $value['cant_usuario'];
	    $arrTmp[4] = $value['informados'];
	    $arrTmp[5] = $value['fallidos'];
	    $arrTmp[6] = $value['destino'];
        $arrTmp[7] = $value['estado'];
	    $arrTmp[8] = $value['campania'];
            $arrData[] = $arrTmp;
        }
    }
    $oGrid->setData($arrData);

    //begin section filter
    $oFilterForm = new paloForm($smarty, createFieldFilterEvento());
    $smarty->assign("SHOW", _tr("Show"));
    $htmlFilter  = $oFilterForm->fetchForm("$local_templates_dir/filter.tpl","",$_POST);
    //end section filter

    //$oGrid->showFilter(trim($htmlFilter));
    
    $content = "<div style='margin-top:10px;'>Mostrando $first_record a $last_record de $total registros</div>";
    $content .= $oGrid->fetchGrid();
    //end grid parameters

    return $content;
}
/*
* funciones para crear la tabla de eventos
 */
function text2SpeechTabla($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf, $infoToView)
{
    $pevento_tabla = new paloSantospeech_tabla($pDB);
    $filter_field = getParameter("filter_field");
    $filter_value = getParameter("filter_value");
    $fecha_inicial = getParameter("fecha_inicial");
    $fecha_final = getParameter("fecha_final");
    $id_evento = getParameter("id_evento");
    $tipo_evento = getParameter("tipo_evento");
    $criterio = getParameter("criterio");

    //begin grid parameters
    $oGrid  = new paloSantoGrid($smarty);
    $oGrid->setTitle(_tr("eventoTabla"));
    $oGrid->pagingShow(true); // show paging section.

    $oGrid->enableExport();   // enable export.
    $oGrid->setNameFile_Export(_tr("eventoTabla"));
    $oGrid->setTplFile('themes/customTheme/_custom_list.tpl');

    $postFilter =array(
        "fecha_inicial" => $fecha_inicial,
        "fecha_final" => $fecha_final,
        "id_evento" => $id_evento,
        "tipo_evento" => $tipo_evento
    );    

    $url = array(
        "menu"         =>  $module_name,
        "filter_field" =>  $filter_field,
        "filter_value" =>  $filter_value,
        "fecha_inicial" => $fecha_inicial,
        "fecha_final" => $fecha_final,
        "id_evento" => $id_evento,
        "tipo_evento" => $tipo_evento,
        "criterio" => $criterio

    
    );
    $oGrid->setURL($url);

    $arrColumns = array(_tr("ID Evento speech"),_tr("Fecha llamada"),_tr("Barridos"),_tr("Cant Usuarios"),_tr("Informados"),_tr("Fallidos"),_tr("Destino"),_tr("Estado"),_tr("Campaña"));
    $oGrid->setColumns($arrColumns);
   

    $total   = $pevento_tabla->getNumevento_tabla($filter_field, $filter_value, $postFilter);


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



    $arrResult =$pevento_tabla->getevento_tabla($limit, $offset, $filter_field, $filter_value, $postFilter);

    if(is_array($arrResult) && $total>0){
        foreach($arrResult as $key => $value){ 
	    $arrTmp[0] = $value['eve_id'];
	    $arrTmp[1] = $value['fecha_llamada'];
	    $arrTmp[2] = $value['barridos'];
	    $arrTmp[3] = $value['cant_usuario'];
	    $arrTmp[4] = $value['informados'];
	    $arrTmp[5] = $value['fallidos'];
	    $arrTmp[6] = $value['destino'];
        $arrTmp[7] = $value['estado'];
	    $arrTmp[8] = $value['campania'];
            $arrData[] = $arrTmp;
        }
    }
    $oGrid->setData($arrData);

    //begin section filter
    $oFilterForm = new paloForm($smarty, createFieldFilterEvento());
    $smarty->assign("SHOW", _tr("Show"));
    $htmlFilter  = $oFilterForm->fetchForm("$local_templates_dir/filter.tpl","",$_POST);
    //end section filter

    //$oGrid->showFilter(trim($htmlFilter));
    
    $content = "<div style='margin-top:10px;'>Mostrando $first_record a $last_record de $total registros</div>";
    $content .= $oGrid->fetchGrid();
    //end grid parameters

    return $content;
}

function createFieldFilterEvento(){
    $arrFilter = array(
	    "id_evento" => _tr("ID del evento"),
	    "tipo" => _tr("Tipo"),
	    "fecha_llamada" => _tr("Fecha llamada"),
	    "barridos" => _tr("Barridos"),
	    "cant_usuario" => _tr("Cant Usuarios"),
	    "informados" => _tr("Informados"),
	    "fallidos" => _tr("Fallidos"),
	    "destino" => _tr("Destino"),
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
* end de funciones evento
*/


/*
* funciones para crear la tabla de otros
 */
function otrosTabla($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf, $infoToView)
{
    $potros_tabla = new paloSantootros_tabla($pDB);
    $filter_field = getParameter("filter_field");
    $filter_value = getParameter("filter_value");
    $nus = getParameter("nus");  
    $telefono = getParameter("telefono");  
    $fecha_llamada = getParameter("fecha_llamada");  
    $id_evento = getParameter("id_evento"); 
    $criterio = getParameter("criterio");    

    //begin grid parameters
    $oGrid  = new paloSantoGrid($smarty);
    $oGrid->setTitle(_tr("otrosTabla"));
    $oGrid->pagingShow(true); // show paging section.

    $oGrid->enableExport();   // enable export.
    $oGrid->setNameFile_Export(_tr("OtrosTabla"));
    $oGrid->setTplFile('themes/customTheme/_custom_list.tpl');

    $nus = getParameter("nus");  
    $telefono = getParameter("telefono");  
    $fecha_llamada = getParameter("fecha_llamada");  
    $id_eventootros = getParameter("id_eventootros");  

    $postFilter =array(
        "nus" => $nus,
        "telefono" => $telefono,
        "fecha_llamada" => $fecha_llamada,
        "id_eventosotros" => $id_eventootros
    );  

    $url = array(
        "menu"         =>  $module_name,
        "filter_field" =>  $filter_field,
        "filter_value" =>  $filter_value,
        "nus" => $nus,
        "telefono" => $telefono,
        "fecha_llamada" => $fecha_llamada,
        "id_evento" => $id_evento,
        "criterio" => $criterio
    );
    $oGrid->setURL($url);

    $arrColumns = array(_tr("NUS"),_tr("Teléfono"),_tr("Resultado"),_tr("Duración de la llamada"),_tr("ID evento"),_tr("Fecha llamada"),_tr("Agente"),_tr("Grabación"),);
    $oGrid->setColumns($arrColumns);

    $total   = $potros_tabla->getNumotros_tabla($filter_field, $filter_value, $postFilter);

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

    $arrResult =$potros_tabla->getotros_tabla($limit, $offset, $filter_field, $filter_value, $postFilter);

    if(is_array($arrResult) && $total>0){
        foreach($arrResult as $key => $value){ 
	    $arrTmp[0] = $value['nus'];
	    $arrTmp[1] = $value['telefono'];
	    $arrTmp[2] = $value['resultado'];
	    $arrTmp[3] = $value['duracion_llamada'];
	    $arrTmp[4] = $value['id_evento'];
	    $arrTmp[5] = $value['fecha_llamada'];
	    $arrTmp[6] = $value['agente'];
        $arrTmp[7] = ($value['grabacion'] && $value['grabacion'] != "N/A") ? '<a href="/modules/reportes/download.php?file='.$value['grabacion'].'" target="_blank">Descargar</a>' : "N/A";
            $arrData[] = $arrTmp;
        }
    }
    $oGrid->setData($arrData);

    //begin section filter
    $oFilterForm = new paloForm($smarty, createFieldFilterOtros());
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

function createFieldFilterOtros(){
    $arrFilter = array(
	    "nus" => _tr("nus"),
	    "telefono" => _tr("telefono"),
	    "resultado" => _tr("resultado"),
	    "duracion_llamada" => _tr("duracion_llamada"),
	    "id_evento" => _tr("id_evento"),
	    "fecha_llamada" => _tr("fecha_llamada"),
	    "agente" => _tr("agente"),
	    "grabacion" => _tr("grabacion"),
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
* end de funciones otros
*/
?>