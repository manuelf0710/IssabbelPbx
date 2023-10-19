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
class paloSantospeech_tabla{
    var $_DB;
    var $errMsg;

    function paloSantospeech_tabla(&$pDB)
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
        $url ="http://localhost:3000/reportcount";
        session_write_close();
        $payload = array("start" => "asdf");
        if(!empty($postFilter)){

            if($postFilter['fecha_inicial']!= ''){
                $fechaInicial = $this->convertirToMysqlFormat($postFilter['fecha_inicial']." "."00:00:00");
                $payload["fecha_inicial"] = $fechaInicial;
            }
            if($postFilter['fecha_final']!= ''){
                $fechaFinal = $this->convertirToMysqlFormat($postFilter['fecha_final']." "."23:59:00");
                $payload["fecha_final"] = $fechaFinal;
            } 
            if($postFilter['id_evento']!= ''){
                $payload["fecha_final"] = $postFilter['id_evento'];
            }  
            
            if($postFilter['tipo_evento']!= ''){
                $payload["tipo_evento"] = $postFilter['tipo_evento'];
            }             
            
        }         
            
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataConn));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response    = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $httpcode    = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //$header      = substr($response, 0, $header_size);
        $body        = substr($response, $header_size);
        curl_close($ch);
        session_start();

        $dataa = json_decode($response, true);
        return $dataa[0]['TOTAL_FILAS'];
    }

    function getevento_tabla($limit, $offset, $filter_field, $filter_value, $postFilter)
    {

        $url ="http://localhost:3000/report";
        session_write_close();
        $payload = array("start" => "asdf");
        if(!empty($postFilter)){

            if($postFilter['fecha_inicial']!= ''){
                $fechaInicial = $this->convertirToMysqlFormat($postFilter['fecha_inicial']." "."00:00:00");
                $payload["fecha_inicial"] = $fechaInicial;
            }
            if($postFilter['fecha_final']!= ''){
                $fechaFinal = $this->convertirToMysqlFormat($postFilter['fecha_final']." "."23:59:00");
                $payload["fecha_final"] = $fechaFinal;
            } 
            if($postFilter['id_evento']!= ''){
                $payload["fecha_final"] = $postFilter['id_evento'];
            }  
            
            if($postFilter['tipo_evento']!= ''){
                $payload["tipo_evento"] = $postFilter['tipo_evento'];
            }  
            
            
            $payload["limit"] = $limit;
            $payload["offset"] = $offset;
            
            
        }         
            
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataConn));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response    = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $httpcode    = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //$header      = substr($response, 0, $header_size);
        $body        = substr($response, $header_size);
        curl_close($ch);
        session_start();

        $dataa = json_decode($response, true);
        return $dataa;
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