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
  $Id: paloSantoconfiguracion_general2.class.php,v 1.1 2022-12-12 05:12:10 manuelf manuelf0710@gmail.com Exp $ */
  include_once "/var/www/html/libs/misc.lib.php";
class paloSantoconfiguracionGeneral
{
    public $_DB;
    public $errMsg;
    public $stateJob;

    public function paloSantoconfiguracionGeneral(&$pDB)
    {
        // Se recibe como parámetro una referencia a una conexión paloDB
        if (is_object($pDB)) {
            $this->_DB = &$pDB;
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

    public function unique_multidim_array($array, $key) {
        $temp_array = array();
        $i = 0;
        $key_array = array();
            $response_array = array();
    
        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        $i= 0;
        foreach ($temp_array as $cat) {
            $response_array[$i] = $cat;
            $i++;
        }
    
        return $response_array;
    }   

    public function getTrunksConfig(){
                    $query = 'SELECT nt.id,
                    "-1" trunkid,
                    "dialPlan" name,
                    "" tech,
                    nt.estado,
                    "1" tipo
             FROM notificaciones_troncales nt
             where  nt.id = 1
             union
             SELECT nt.id,
                    t.trunkid,
                    t.name,
                    t.tech,
                    nt.estado,
                    "2" tipo
             FROM trunks t left join notificaciones_troncales nt
              on t.trunkid = nt.trunkid
             where  t.name != ""';

            $result = $this->_DB->fetchTable($query, true);

            if ($result == false) {
            $this->errMsg = $this->_DB->errMsg;
            insertLogToDB($this->_DB->errMsg, "Notificaciones_reportes", "Error", "getTrunksConfig"); 
            return null;
            }

            return $result;        
    }
    
    public function getTrunksDialPatern(){
        $query = 'select a2.* from (
                            SELECT s.route_id, 
                                s.name,
                                s.password,
                                t.trunkid troncal_id,
                                t.name troncal, 
                                t.tech,
                                rp.match_pattern_prefix,
                                rp.match_pattern_pass,
                                rp.match_cid,
                                rp.prepend_digits,
                                "outbound_route" clase,
                                "" patterns
                            FROM outbound_routes s,trunks t, outbound_route_trunks rt,  outbound_route_patterns rp
                            where rt.route_id = s.route_id 
                            and   rt.trunk_id  = t.trunkid
                            and s.route_id =  rp.route_id
                            and t.name != ""
                            ) a2 
                group by troncal_id, match_pattern_pass';

        $result = $this->_DB->fetchTable($query, true);

        if ($result == false) {
            $this->errMsg = $this->_DB->errMsg;
            insertLogToDB($this->_DB->errMsg, "Notificaciones_reportes", "Error", "getTrunksDialPatern");             
            return null;
        }

        $result2 = $this->unique_multidim_array($result, "troncal_id");
        return $result2;
    }

    public function addPattersTrunk($completeArray, $uniqueArray){
        $index = 0;
        foreach($uniqueArray as $unique){
            $uniqueArray[0]['patterns'] = array();
            foreach($completeArray as $completeArray){
                array_push($uniqueArray[0]['patterns'], array("match_pattern_prefix"=>$completeArray['match_pattern_prefix']));
            }
            $index++;
        }
    }

    public function handleJob($url, $param){
        $url ="http://localhost:3000/".$url;
        session_write_close();
        $payload = array("start" => $param);
            
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


    public function getNotificacionesConfiguracion()
    {
         $this->stateJob = '0';
        $estadoJob = $this->handleJob('cronstatus', 'check');
        if($estadoJob != ""){
            $this->stateJob = $estadoJob["message"] == "Activo" ? '1' : '0';     /* 1 activo 0 inactivo */            
        }
        
        

        $query = 'SELECT id, 
                    '.$this->stateJob.' activo, 
                    cant_lineas, 
                    barridos, 
                    fecha_busqueda,
                    hora_inicial_notif,
                    date_format(hora_inicial_notif, "%H") horainicialnot,
                    date_format(hora_inicial_notif, "%i") minutoinicialnot,
                    hora_final_notif, 
                    date_format(hora_final_notif, "%H") horafinalnot,
                    date_format(hora_final_notif, "%i") minutofinalnot,
                    dia_inicial_notif, 
                    dia_final_notif, 
                    ivr_confirmado,
                    activar_confirmado,
                    ivr_restaurado,
                    activar_restaurado,
                    ivr_cancelado,
                    activar_cancelado,
                    ivr_programado,
                    activar_programado,
                    timeout,
                    (
                        select nt.id from notificaciones_troncales nt where estado = 1 limit 1
                    ) notificacion_troncal
                FROM notificaciones_configuracion
            WHERE id =1';

        $result = $this->_DB->getFirstRowQuery($query, true);

        if ($result == false) {
            $this->errMsg = $this->_DB->errMsg;
            insertLogToDB($this->_DB->errMsg, "Notificaciones_reportes", "Error", "getNotificacionesConfiguracion");
            return null;
        }
        return $result;
    }


public function updateNotificacionesConfiguracion($data)
{
    $id=1;

    $hora_inicial_notif = $data['horainicialnot'].":".$data['minutoinicialnot'];
    $hora_final_notif  = $data['horafinalnot'].":".$data['minutofinalnot'];
    $ivr_confirmado = array_key_exists("ivrconfirmado", $data) ? $data['ivrconfirmado'] : null;

    //echo "valor de ivr_confirmado =>".$ivr_confirmado;
    $activar_confirmado = array_key_exists("chkivr_confirmado", $data) ? 1 : 0;
    $ivr_restaurado = array_key_exists("ivrrestaurado", $data) ? $data['ivrrestaurado'] : null;
    $activar_restaurado = array_key_exists("chkivr_restaurado", $data) ? 1 : 0;
    $ivr_cancelado = array_key_exists("ivrcancelado", $data) ? $data['ivrcancelado'] : null;
    $activar_cancelado = array_key_exists("chkivr_cancelado", $data) ? 1 : 0;
    $ivr_programado = array_key_exists("ivrprogramado", $data) ? $data['ivrprogramado'] : null;
    $activar_programado = array_key_exists("chkivr_programado", $data) ? 1 : 0;
    $timeout = $data['timeout'];
    $notificacion_troncal = $data["notificacion_troncal"];

    $sqlUpdateNotificacionTroncal = "UPDATE notificaciones_troncales SET estado = '2' WHERE 1";
    $resultadoUpdateNotificacion = $this->_DB->genQuery($sqlUpdateNotificacionTroncal);

    if($notificacion_troncal == '-1'){
        $sqlUpdateNotificacionTroncal = "UPDATE notificaciones_troncales SET estado = '1' WHERE id = '1'";
        $resultadoUpdateNotificacion = $this->_DB->genQuery($sqlUpdateNotificacionTroncal);        
    }else{
        $query = "select * from notificaciones_troncales where trunkid = '".$notificacion_troncal."'";
        $result = $this->_DB->getFirstRowQuery($query, true);   
        
        
        if(count($result)>0){    
            $sqlUpdateNotificacionTroncal = "UPDATE notificaciones_troncales SET estado = '1' WHERE trunkid = '".$notificacion_troncal."'";
            $resultadoUpdateNotificacion = $this->_DB->genQuery($sqlUpdateNotificacionTroncal);            
        }else{
            $queryInsert = "insert into notificaciones_troncales 
                             (tipo,trunkid,estado) values
                             ('2','".$notificacion_troncal."', '1')";
            $resultadoInsert = $this->_DB->genQuery($queryInsert);                             
        }
    }
/*
    $outgoingroute = "'" . implode("','", $data["outgoingroute"]) . "'";

    $sql = "UPDATE trunks SET enable_notificacion = NULL WHERE trunkid NOT IN ($outgoingroute)";
    $resultado = $this->_DB->genQuery($sql);

    $sql2 = "UPDATE trunks SET enable_notificacion = 1 WHERE trunkid IN ($outgoingroute)";
    $resultado2 = $this->_DB->genQuery($sql2); */   
    
    $actionJob = $data['activar_desactivar'] == '1' ? true : false;
    $estadoJob = $this->handleJob('cronstatus', $actionJob);
    
    
      

    $sPeticionSQL = $this->_DB->construirUpdate(
        "notificaciones_configuracion",
        array(
            "cant_lineas"          =>  $this->_DB->DBCAMPO($data['cant_lineas']),
            "barridos"          =>  $this->_DB->DBCAMPO($data['barridos']),
            "fecha_busqueda"          =>  $this->_DB->DBCAMPO($data['fecha_busqueda']),
            "activo"          =>  $this->_DB->DBCAMPO($data['activar_desactivar']),
            "hora_inicial_notif"   =>  $this->_DB->DBCAMPO($hora_inicial_notif),
            "hora_final_notif"         =>  $this->_DB->DBCAMPO($hora_final_notif),
            "dia_inicial_notif"         =>  $this->_DB->DBCAMPO($data['diainicialnot']),
            "dia_final_notif"         =>  $this->_DB->DBCAMPO($data['diafinalnot']),
            "ivr_confirmado"         =>  $ivr_confirmado,
            "activar_confirmado"         =>  $this->_DB->DBCAMPO($activar_confirmado),
            "ivr_restaurado"         =>  $ivr_restaurado,
            "activar_restaurado"         =>  $this->_DB->DBCAMPO($activar_restaurado),
            "ivr_cancelado"         =>  $ivr_cancelado,
            "activar_cancelado"         =>  $this->_DB->DBCAMPO($activar_cancelado),
            "ivr_programado"         =>  $ivr_programado,
            "activar_programado"         =>  $this->_DB->DBCAMPO($activar_programado),
            "timeout"         =>  $this->_DB->DBCAMPO($timeout),
        ),
        array(
            "id"  => $id
        )
    );

    //echo "<br>".$sPeticionSQL;
    if ($this->_DB->genQuery($sPeticionSQL)) {
        $bExito = true;
    } else {
        $this->errMsg = $this->_DB->errMsg;
        insertLogToDB($this->_DB->errMsg, "Notificaciones_reportes", "Error", "updateNotificacionesConfiguracion");
    }

 

    return 0;
}


    public function updateconfiguracion_general2ById($id, $data)
    {
        if ($data['activo'] == 'Activo') {
            $sql = "UPDATE conexionesbd SET activo = 'Inactivo' WHERE id != '" . $id . "'";
            $result = $this->_DB->genQuery($sql);
        }
    }
}