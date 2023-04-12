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
  $Id: paloSantoConfiguracionIVRECS2.class.php,v 1.1 2022-12-15 05:12:21 Manuelf manuelf0710@gmail.com Exp $ */
class paloSantoConfiguracionIVRECS2{
    var $_DB;
    var $errMsg;

    function paloSantoConfiguracionIVRECS2(&$pDB)
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

    function getNumConfiguracionIVRECS2($filter_field, $filter_value)
    {
        $where    = "";
        $arrParam = null;
        if(isset($filter_field) & $filter_field !=""){
            $where    = "where $filter_field like ?";
            $arrParam = array("$filter_value%");
        }

        $query   = "SELECT COUNT(*) FROM table $where";

        $result=$this->_DB->getFirstRowQuery($query, false, $arrParam);

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return 0;
        }
        return $result[0];
    }

    public function getIvrMisc(){
                                    $query = 'SELECT * FROM miscdests';

                            $result = $this->_DB->fetchTable($query, true);

                            if ($result == false) {
                            $this->errMsg = $this->_DB->errMsg;
                            //insertLogToDB($this->_DB->errMsg, "Notificaciones_reportes", "Error", "getTrunksConfig"); 
                            return null;
                            }

                            return $result;        
        }    

    function getConfiguracionIVRECS2()
    {

        $query = "SELECT * FROM notificaciones_ivrecsconf WHERE id=1";

        $result=$this->_DB->getFirstRowQuery($query, true);

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return null;
        }
        return $result;
    }
    

    function getConfiguracionIVRECS2ById($id)
    {
        $query = "SELECT * FROM notificaciones_ivrecsconf WHERE id=1";

        $result=$this->_DB->getFirstRowQuery($query, true, array("$id"));

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return null;
        }
        return $result;
    }


    public function updateNotificacionesConfiguracion($data)
    {
        $id=1;
    echo json_encode($data);
    
        $sPeticionSQL = $this->_DB->construirUpdate(
            "notificaciones_ivrecsconf",
            array(
                "ip"          =>  $this->_DB->DBCAMPO($data['ip']),
                "ruta"          =>  $this->_DB->DBCAMPO($data['ruta']),
                "identificador"          =>  $this->_DB->DBCAMPO($data['ivr_misc']),
                "cola_desborde"          =>  $this->_DB->DBCAMPO("1"),
                "usuario"   =>  $this->_DB->DBCAMPO($data['usuario']),
                "contrasena"         =>  $this->_DB->DBCAMPO($data['contrasena']),
            ),
            array(
                "id"  => $id
            )
        );
    
        //echo "<br>".$sPeticionSQL;
        if ($this->_DB->genQuery($sPeticionSQL)) {
            $bExito = true;
            echo("exito");
        } else {
            $this->errMsg = $this->_DB->errMsg;
            echo json_encode($this->_DB->errMsg);
            //insertLogToDB($this->_DB->errMsg, "Notificaciones_reportes", "Error", "updateNotificacionesConfiguracion");
        }
    
     
    
        return 0;
    }

}