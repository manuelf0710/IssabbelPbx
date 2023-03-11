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
  $Id: paloSantoevento_tabla.class.php,v 1.1 2022-12-04 11:12:04 manuelf manuelf0710@gmail.com Exp $ */
class paloSantoEventoDetalle_tabla{
    var $_DB;
    var $errMsg;

    function paloSantoEventoDetalle_tabla(&$pDB)
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

    function getNumevento_tabla($filter_field, $filter_value, $postFilter)
    {
        $where    = "";
        $arrParam = null;
        /*if(isset($filter_field) & $filter_field !=""){
            $where    = "where $filter_field like ?";
            $arrParam = array("$filter_value%");
        } */
        if(!empty($postFilter)){

            if($postFilter['criterio'] == 'forcampania_id'){
                $where .= " and nc.id =  '".$postFilter['detalleid_filter']."'";
            }  
            if($postFilter['criterio'] == 'forevento_id'){
                $where .= " and n1.eve_id =  '".$postFilter['detalleid_filter']."'";
            }                          
            
        }        

        $query   = "SELECT count(*)
      FROM notificaciones_campania nc 
     inner join  notificaciones_llamadas n1 on nc.id = n1.campania_id
     where 1 $where";

        $result=$this->_DB->getFirstRowQuery($query, false, $arrParam);

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return 0;
        }
        return $result[0];
    }

    function getevento_tabla($limit, $offset, $filter_field, $filter_value, $postFilter)
    {
        $where    = "";
        $arrParam = null;
        /*if(isset($filter_field) & $filter_field !=""){
            $where    = "where $filter_field like ?";
            $arrParam = array("$filter_value%");
        } */

        if(!empty($postFilter)){

            if($postFilter['criterio'] == 'forcampania_id'){
                $where .= " and nc.id =  '".$postFilter['detalleid_filter']."'";
            }  
            if($postFilter['criterio'] == 'forevento_id'){
                $where .= " and n1.eve_id =  '".$postFilter['detalleid_filter']."'";
            }                          
            
        } 


        $query   = "SELECT n1.uniqueid,
         n1.nus,
        if(n1.celular != '', n1.celular, if(n1.telefono != '0', n1.telefono, '')) tel_marcado,
        n1.estado resultado,
        ifnull(n1.duracion,'0') duracion,
        if(n1.fecha_llamada = '0000-00-00 00:00:00', nc.fecha, n1.fecha_llamada) fecha_llamada, 
        'N/A' agente,
        '' grabacion
      FROM notificaciones_campania nc 
     inner join  notificaciones_llamadas n1 on nc.id = n1.campania_id
     where 1 $where LIMIT $limit OFFSET $offset";

        $result=$this->_DB->fetchTable($query, true, $arrParam);

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return array();
        }
        return $result;
    }

    function getevento_tablaById($id)
    {
        $query = "SELECT eve_id,
                        tipo_evento tipo,
                        fecha_llamada,
                        barridos,
                        '0' cant_usuario,
                        '0' informados,
                        '0' fallidos,
                        '0' destino
         FROM notificaciones_llamadas WHERE id=?";

        $result=$this->_DB->getFirstRowQuery($query, true, array("$id"));

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return null;
        }
        return $result;
    }
}