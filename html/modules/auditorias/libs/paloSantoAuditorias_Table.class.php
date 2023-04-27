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
  $Id: paloSantoAuditorias_Table.class.php,v 1.1 2022-12-12 08:12:29 Manuelf manuelf0710@gmail.com Exp $ */

  include_once "/var/www/html/libs/misc.lib.php";
class paloSantoAuditorias_Table{
    var $_DB;
    var $errMsg;

    function paloSantoAuditorias_Table(&$pDB)
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

    function getNumAuditorias_Table($filter_field, $filter_value, $postFilter)
    {

        

        $arrParam = null;
        /*if(isset($filter_field) & $filter_field !=""){
            $where    = "where $filter_field like ?";
            $arrParam = array("$filter_value%");
        }
        */
        $where = '';
        if(!empty($postFilter)){

            if($postFilter['fecha_inicial']!= ''){
                $fechaInicial = $this->convertirToMysqlFormat($postFilter['fecha_inicial']." "."00:00:00");
                $where .= " and fecha >= str_to_date('".$fechaInicial."', '%Y-%m-%d %H:%i')";
            }
            if($postFilter['fecha_final']!= ''){
                $fechaFinal = $this->convertirToMysqlFormat($postFilter['fecha_final']." "."23:59:00");
                $where .= " and fecha <=  str_to_date('".$fechaFinal."', '%Y-%m-%d %H:%i')";
            }        
        }


        $query   = "SELECT COUNT(*) FROM notificaciones_auditorias where 1 $where";

        $result=$this->_DB->getFirstRowQuery($query, false, $arrParam);


        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            insertLogToDB($this->_DB->errMsg, "Auditorias", "Error", "getNumAuditorias_Table");
            return 0;
        }
        return $result[0];
    }

    function getAuditorias_Table($limit, $offset, $filter_field, $filter_value, $postFilter)
    {
        $where    = "";
        $arrParam = null;
        /*if(isset($filter_field) & $filter_field !=""){
            //$where    = "where $filter_field like ?";
            $arrParam = array("$filter_value%");
        } */


        if (!empty($postFilter)) {


            if($postFilter['fecha_inicial']!= ''){
                $fechaInicial = $this->convertirToMysqlFormat($postFilter['fecha_inicial']." "."00:00:00");
                $where .= " and fecha >= str_to_date('".$fechaInicial."', '%Y-%m-%d %H:%i')";
            }
            if($postFilter['fecha_final']!= ''){
                $fechaFinal = $this->convertirToMysqlFormat($postFilter['fecha_final']." "."23:59:00");
                $where .= " and fecha <=  str_to_date('".$fechaFinal."', '%Y-%m-%d %H:%i')";
            }          
        }        


        $query   = "SELECT * FROM notificaciones_auditorias where 1 $where order by fecha desc LIMIT $limit OFFSET $offset";


        $result=$this->_DB->fetchTable($query, true, $arrParam);

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            insertLogToDB($this->_DB->errMsg, "Auditorias", "Error", "getAuditorias_Table");
            return array();
        }
        return $result;
    }

    function getAuditorias_TableById($id)
    {
        $query = "SELECT * FROM notificaciones_auditorias WHERE id=?";

        $result=$this->_DB->getFirstRowQuery($query, true, array("$id"));

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            insertLogToDB($this->_DB->errMsg, "Auditorias", "Error", "getAuditorias_TableById");
            return null;
        }
        return $result;
    }
}