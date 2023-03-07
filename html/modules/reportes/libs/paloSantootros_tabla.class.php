<?php
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
  $Id: paloSantootros_tabla.class.php,v 1.1 2022-12-04 11:12:04 manuelf manuelf0710@gmail.com Exp $ */
class paloSantootros_tabla{
    var $_DB;
    var $errMsg;

    function paloSantootros_tabla(&$pDB)
    {
        // Se recibe como parámetro una referencia a una conexión paloDB
        if (is_object($pDB)) {
            $this->_DB =& $pDB;
            $this->errMsg = $this->_DB->errMsg;
        } else {
            $dsn = (string)$pDB;
            $this->_DB = new paloDB($dsn);

            if (!$this->_DB->connStatus) {
                $this->errMsg = $this->_DB->errMsg;
                // debo llenar alguna variable de error
            } else {
                // debo llenar alguna variable de error
            }
        }
    }

    /*HERE YOUR FUNCTIONS*/

    function convertirToMysqlFormat($fecha){
        $getDateAndTime = explode(" ",$fecha);
        $dateFecha = explode("/",$getDateAndTime[0]);
        $timeFecha = $getDateAndTime[1];
        $newFecha = array_reverse($dateFecha);
        $newFecha = join("-",$newFecha);
        return $newFecha.' '.$timeFecha;

    }      

    function getNumotros_tabla($filter_field, $filter_value, $postFilter)
    {
        $where    = "";
        $arrParam = null;
        /*if(isset($filter_field) & $filter_field !=""){
            $where    = "where $filter_field like ?";
            $arrParam = array("$filter_value%");
        } */

        if(!empty($postFilter)){

            if($postFilter['fecha_llamada']!= ''){
                $fechaInicial = $this->convertirToMysqlFormat($postFilter['fecha_llamada']);
                $where .= " and fecha_llamada >= str_to_date('".$fechaInicial."', '%Y-%m-%d %H:%i')";
            }

            if($postFilter['id_eventosotros']!= ''){
                $where .= " and eve_id =  '".$postFilter['id_eventosotros']."'";
            }  

            if($postFilter['nus']!= ''){
                $where .= " and nus =  '".$postFilter['nus']."'";
            }  
            
            if($postFilter['telefono']!= ''){
                $where .= " and (celular =  '".$postFilter['telefono']."' or telefono = '".$postFilter['telefono']."')";
            }             
            
        } 

        $query   = "SELECT COUNT(*) FROM notificaciones_llamadas where 1 $where";

        
        $result=$this->_DB->getFirstRowQuery($query, false, $arrParam);

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return 0;
        }
        return $result[0];
    }

    function getotros_tabla($limit, $offset, $filter_field, $filter_value, $postFilter)
    {
        $where    = "";
        $arrParam = null;
        /*if(isset($filter_field) & $filter_field !=""){
            $where    = "where $filter_field like ?";
            $arrParam = array("$filter_value%");
        } */

        if(!empty($postFilter)){

            if($postFilter['fecha_llamada']!= ''){
                $fechaInicial = $this->convertirToMysqlFormat($postFilter['fecha_llamada']);
                $where .= " and fecha_llamada >= str_to_date('".$fechaInicial."', '%Y-%m-%d %H:%i')";
            }

            if($postFilter['id_eventosotros']!= ''){
                $where .= " and eve_id =  '".$postFilter['id_eventosotros']."'";
            }  

            if($postFilter['nus']!= ''){
                $where .= " and nus =  '".$postFilter['nus']."'";
            }  
            
            if($postFilter['telefono']!= ''){
                $where .= " and (celular =  '".$postFilter['telefono']."' or telefono = '".$postFilter['telefono']."')";
            }             
            
        } 

        $query   = "SELECT nus,
                           if(celular = '' or celular is null, telefono, celular ) telefono,
                           eve_id id_evento,
                           duracion duracion_llamada,
                           estado resultado,
                           if(fecha_llamada = '0000-00-00 00:00:00', '', fecha_llamada) fecha_llamada,
                           agente,
                           '' grabacion
                     FROM notificaciones_llamadas where 1 $where order by campania_id desc LIMIT $limit OFFSET $offset";

                

        $result=$this->_DB->fetchTable($query, true, $arrParam);

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return array();
        }
        return $result;
    }

    function getotros_tablaById($id)
    {
        $query = "SELECT * FROM table WHERE id=?";

        $result=$this->_DB->getFirstRowQuery($query, true, array("$id"));

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return null;
        }
        return $result;
    }
}