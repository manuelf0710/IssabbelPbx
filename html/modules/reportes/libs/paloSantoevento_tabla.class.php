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
class paloSantoevento_tabla{
    var $_DB;
    var $errMsg;

    function paloSantoevento_tabla(&$pDB)
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

            if($postFilter['fecha_inicial']!= ''){
                $fechaInicial = $this->convertirToMysqlFormat($postFilter['fecha_inicial']);
                $where .= " and fecha_llamada >= str_to_date('".$fechaInicial."', '%Y-%m-%d %H:%i')";
            }
            if($postFilter['fecha_final']!= ''){
                $fechaFinal = $this->convertirToMysqlFormat($postFilter['fecha_final']);
                $where .= " and fecha_llamada <=  str_to_date('".$fechaFinal."', '%Y-%m-%d %H:%i')";
            } 
            if($postFilter['id_evento']!= ''){
                $where .= " and eve_id =  '".$postFilter['id_evento']."'";
            }  
            
            if($postFilter['tipo_evento']!= ''){
                $where .= " and tipo_evento =  '".$postFilter['tipo_evento']."'";
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

            if($postFilter['fecha_inicial']!= ''){
                $fechaInicial = $this->convertirToMysqlFormat($postFilter['fecha_inicial']);
                $where .= " and fecha_llamada >= str_to_date('".$fechaInicial."', '%Y-%m-%d %H:%i')";
            }
            if($postFilter['fecha_final']!= ''){
                $fechaFinal = $this->convertirToMysqlFormat($postFilter['fecha_final']);
                $where .= " and fecha_llamada <=  str_to_date('".$fechaFinal."', '%Y-%m-%d %H:%i')";
            } 
            if($postFilter['id_evento']!= ''){
                $where .= " and eve_id =  '".$postFilter['id_evento']."'";
            }  
            
            if($postFilter['tipo_evento']!= ''){
                $where .= " and tipo_evento =  '".$postFilter['tipo_evento']."'";
            }             
            
        }  


        $query   = "SELECT 
        n1.eve_id,
        n1.tipo_evento tipo,
        nc.fecha fecha_llamada,
        count(nc.id) barridos,
        nc.cantidad cant_usuario,
        (select count(distinct n2.nus)
		  from notificaciones_llamadas n2
          where n2.estado = 'Success'
          and n2.campania_id = n1.campania_id
	   ) informados,
	   (select count(distinct n2.nus)
		  from notificaciones_llamadas n2
          where n2.estado = 'Failed'
          and n2.campania_id = n1.campania_id
          and n2.nus not in (
		select distinct n3.nus
		  from notificaciones_llamadas n3
          where n3.estado = 'Success'
          and n3.campania_id = n2.campania_id          
          )
         
	   ) fallidos,
        'IVR' destino,
        nc.id campania
      FROM notificaciones_campania nc 
     inner join  notificaciones_llamadas n1 on nc.id = n1.campania_id
     where 1 $where group by n1.campania_id order by campania_id desc LIMIT $limit OFFSET $offset";
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