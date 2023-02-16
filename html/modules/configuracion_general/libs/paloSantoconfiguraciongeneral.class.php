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
class paloSantoconfiguracionGeneral
{
    public $_DB;
    public $errMsg;

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

    public function getNotificacionesConfiguracion()
    {
        $query = 'SELECT id, 
                    activo, 
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
                    timeout
                FROM notificaciones_configuracion
            WHERE id =1';

        $result = $this->_DB->getFirstRowQuery($query, true);

        if ($result == false) {
            $this->errMsg = $this->_DB->errMsg;
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

    $outgoingroute = "'" . implode("','", $data["outgoingroute"]) . "'";

    $sql = "UPDATE outbound_routes SET enable_notificacion = NULL WHERE route_id NOT IN ($outgoingroute)";
    $resultado = $this->_DB->genQuery($sql);

    $sql2 = "UPDATE outbound_routes SET enable_notificacion = 1 WHERE route_id IN ($outgoingroute)";
    $resultado2 = $this->_DB->genQuery($sql2);     
      

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

    echo "<br>".$sPeticionSQL;
    if ($this->_DB->genQuery($sPeticionSQL)) {
        $bExito = true;
    } else {
        $this->errMsg = $this->_DB->errMsg;
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