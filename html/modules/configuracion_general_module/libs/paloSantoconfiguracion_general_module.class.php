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
class paloSantoconfiguracion_general_module
{
    var $_DB;
    var $errMsg;

    function paloSantoconfiguracion_general_module(&$pDB)
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

    function getNumconfiguracion_general2($filter_field, $filter_value)
    {
        $where    = "";
        $arrParam = null;
        if (isset($filter_field) & $filter_field != "") {
            $where    = "where $filter_field like ?";
            $arrParam = array("$filter_value%");
        }

        $query   = "SELECT COUNT(*) FROM asterisk.conexionesbd $where";

        $result = $this->_DB->getFirstRowQuery($query, false, $arrParam);

        if ($result == FALSE) {
            $this->errMsg = $this->_DB->errMsg;
            return 0;
        }
        return $result[0];
    }

    function getconfiguracion_general2($limit, $offset, $filter_field, $filter_value)
    {
        $where    = "";
        $arrParam = null;
        if (isset($filter_field) & $filter_field != "") {
            $where    = "where $filter_field like ?";
            $arrParam = array("$filter_value%");
        }

        $query   = "SELECT * FROM asterisk.conexionesbd $where LIMIT $limit OFFSET $offset";

        $result = $this->_DB->fetchTable($query, true, $arrParam);

        if ($result == FALSE) {
            $this->errMsg = $this->_DB->errMsg;
            return array();
        }
        return $result;
    }

    function getconfiguracion_general2ById($id)
    {
        $query = "SELECT * FROM asterisk.conexionesbd WHERE id=?";

        $result = $this->_DB->getFirstRowQuery($query, true, array("$id"));

        if ($result == FALSE) {
            $this->errMsg = $this->_DB->errMsg;
            return null;
        }
        return $result;
    }

    function getconfiguracion_general2ByName($motor)
    {
        $query = "SELECT * FROM asterisk.conexionesbd WHERE motor=?";

        $result = $this->_DB->getFirstRowQuery($query, true, array("$motor"));

        if ($result == FALSE) {
            $this->errMsg = $this->_DB->errMsg;
            return null;
        }
        return $result;
    }

    function getconfiguracion_general2MariaDB()
    {
        $id = 1;
        $query = "SELECT motormariadb, servidormariadb, usuariomariadb, contrasenamariadb,basedatosmariadb, sslmariadb FROM asterisk.conexionbdmariadb WHERE id=?";

        $result = $this->_DB->getFirstRowQuery($query, true, array("$id"));

        if ($result == FALSE) {
            $this->errMsg = $this->_DB->errMsg;
            return null;
        }
        return $result;
    }

    function getconfiguracion_general2Active()
    {

        $query = "SELECT * FROM asterisk.conexionesbd WHERE activo='Activo'";

        $result = $this->_DB->getFirstRowQuery($query, true);

        if ($result == FALSE) {
            $this->errMsg = $this->_DB->errMsg;
            return null;
        }
        return $result;
    }

    function updateconfiguracion_general2ById($id, $data)
    {

        if ($data['activo'] == 'Activo') {

            $sql = "UPDATE conexionesbd SET activo = 'Inactivo' WHERE id != '" . $id . "'";
            $result = $this->_DB->genQuery($sql);
        }

        $sPeticionSQL = $this->_DB->construirUpdate(
            "conexionesbd",
            array(
                "motor"          =>  $this->_DB->DBCAMPO($data['motor']),
                "servidor"          =>  $this->_DB->DBCAMPO($data['servidor']),
                "usuario"   =>  $this->_DB->DBCAMPO($data['usuario']),
                "contrasena"         =>  $this->_DB->DBCAMPO($data['contrasena']),
                "basedatos"         =>  $this->_DB->DBCAMPO($data['basedatos']),
                "tablavista"         =>  $this->_DB->DBCAMPO($data['tablavista']),
                "activo"         =>  $this->_DB->DBCAMPO($data['activo']),
                "sslmdb"         =>  $this->_DB->DBCAMPO($data['sslmdb']),
            ),
            array(
                "id"  => $id
            )
        );
        if ($this->_DB->genQuery($sPeticionSQL)) {
            $bExito = TRUE;
            echo("noerrorupdate</br>");
        } else {
            echo("</br>errorupdate ".$this->_DB->errMsg);
            $this->errMsg = $this->_DB->errMsg;
        }

        /*
        $result=$this->_DB->getFirstRowQuery($query, true, array("$id"));

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return null;
        } */
        return 0;
    }



    function updateconfiguracion_general2MariaDB($data)
    {
        /*
        if ($data['activo'] == 'Activo') {

            $sql = "UPDATE conexionbdmariadb SET activo = 'Inactivo' WHERE id != '" . $id . "'";
            $result = $this->_DB->genQuery($sql);
        } */

        $sPeticionSQL = $this->_DB->construirUpdate(
            "conexionbdmariadb",
            array(
                "motormariadb"          =>  $this->_DB->DBCAMPO($data['motormariadb']),
                "servidormariadb"          =>  $this->_DB->DBCAMPO($data['servidormariadb']),
                "usuariomariadb"   =>  $this->_DB->DBCAMPO($data['usuariomariadb']),
                "contrasenamariadb"         =>  $this->_DB->DBCAMPO($data['contrasenamariadb']),
                "basedatosmariadb"         =>  'asterisk',
                "sslmariadb"         =>  $this->_DB->DBCAMPO($data['sslmariadb']),
            ),
            array(
                "id"  => 1
            )
        );
        if ($this->_DB->genQuery($sPeticionSQL)) {
            $bExito = TRUE;
        } else {
            $this->errMsg = $this->_DB->errMsg;
        }

        /*
        $result=$this->_DB->getFirstRowQuery($query, true, array("$id"));

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return null;
        } */
        return 0;
    }
}