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
  $Id: paloSantoLogs_Table.class.php,v 1.1 2022-12-12 09:12:41 Manuelf manuelf0710@gmail.com Exp $ */
class paloSantoLogs_Table{
    var $_DB;
    var $errMsg;

    function paloSantoLogs_Table(&$pDB)
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

    function getNumLogs_Table($filter_field, $filter_value, $postFilter)
    {
        $where    = "";
        $arrParam = null;
        /*if(isset($filter_field) & $filter_field !=""){
            $where    = "where $filter_field like ?";
            $arrParam = array("$filter_value%");
        }*/
        if(!empty($postFilter)){
            if($postFilter['include_fecha'] !== "1") {
                if($postFilter['fecha_inicial']!= ''){
                    $fechaInicial = $this->convertirToMysqlFormat($postFilter['fecha_inicial']." "."00:00:00");
                    $where .= " and fecha >= str_to_date('".$fechaInicial."', '%Y-%m-%d %H:%i')";
                }
                if($postFilter['fecha_final']!= ''){
                    $fechaFinal = $this->convertirToMysqlFormat($postFilter['fecha_final']." "."23:59:00");
                    $where .= " and fecha <=  str_to_date('".$fechaFinal."', '%Y-%m-%d %H:%i')";
                }
            }
            if($postFilter['tipo']!= '' && $postFilter['tipo']!= 'todos'){
                $where .= " and tipo =  '".$postFilter['tipo']."'";
            } 
            if($postFilter['modulo']!= ''){
                $where .= " and modulo =  '".$postFilter['modulo']."'";
            }                                
        }        

        $query   = "SELECT COUNT(*) FROM notificaciones_logs where 1 $where";

        $result=$this->_DB->getFirstRowQuery($query, false, $arrParam);

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return 0;
        }
        return $result[0];
    }

    function getLogs_Table($limit, $offset, $filter_field, $filter_value, $postFilter)
    {
        $where    = "";
        $arrParam = null;
        if(!empty($postFilter)){
            if($postFilter['include_fecha'] !== "1") {
                if($postFilter['fecha_inicial']!= ''){
                    $fechaInicial = $this->convertirToMysqlFormat($postFilter['fecha_inicial']." "."00:00:00");
                    $where .= " and fecha >= str_to_date('".$fechaInicial."', '%Y-%m-%d %H:%i')";
                }
                if($postFilter['fecha_final']!= ''){
                    $fechaFinal = $this->convertirToMysqlFormat($postFilter['fecha_final']." "."23:59:00");
                    $where .= " and fecha <=  str_to_date('".$fechaFinal."', '%Y-%m-%d %H:%i')";
                }  
            } 
            if($postFilter['tipo']!= '' && $postFilter['tipo']!= 'todos'){
                $where .= " and tipo =  '".$postFilter['tipo']."'";
            }  
            if($postFilter['modulo']!= ''){
                $where .= " and modulo =  '".$postFilter['modulo']."'";
            }                              
        }  
        $query   = "SELECT * FROM notificaciones_logs where 1 $where order by id desc LIMIT $limit OFFSET $offset";


        $result=$this->_DB->fetchTable($query, true, $arrParam);

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return array();
        }
        return $result;
    }

    function getLogs_TableById($id)
    {
        $query = "SELECT * FROM notificaciones_logs WHERE id=?";

        $result=$this->_DB->getFirstRowQuery($query, true, array("$id"));

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return null;
        }
        return $result;
    }
}