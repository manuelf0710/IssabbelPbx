<?php

if (isset($arrConf['basePath'])) {
    include_once($arrConf['basePath'] . "/libs/paloSantoDB.class.php");
} else {
    include_once("libs/paloSantoDB.class.php");
}

class externalLogin
{

    var $_DB; // instancia de la clase paloDB
    var $mode;
    var $errMsg;
    var $lastInsert;
    var $lastInsertGroup;

    function externalLogin(&$pDB)
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
        print_r($this->_DB);
    }



    function cargarUser($name)
    {
        $sql = 'SELECT * FROM acl_user WHERE name = ?';
        $tupla = $this->_DB->getFirstRowQuery($sql, TRUE, array($name));
        if (!is_array($tupla)) {
            $this->errMsg = $this->_DB->errMsg;
            return [];
        } else {
            return $tupla;
        }
    }

    /**
     * Procedimiento para obtener el listado de los menus.
     * MÉTODO DEPRECADO: sólo existe por compatibilidad con elastix-developer viejo.
     *
     * @return array    Listado de menus
     */
    function getRootMenus()
    {
        $this->errMsg = "";
        $listaMenus = array();
        $sQuery = "SELECT Id, Name FROM menu WHERE IdParent=''";
        $arrMenus = $this->_DB->fetchTable($sQuery);
        if (is_array($arrMenus)) {
            foreach ($arrMenus as $menu) {
                $listaMenus[$menu[0]] = $menu[1];
            }
        } else {
            $this->errMsg = $this->_DB->errMsg;
        }
        return $listaMenus;
    }


    /**
     * Crear un nuevo usuario.
     *

     * @return bool     VERDADERO si el menu se crea correctamente, FALSO en error
     */
    function createUser($id, $name, $description, $md5_password, $extension)
    {
        /*if (!$this->_validateUserParams($id, $name, $id_parent, $type, $link))
            return FALSE; */

        // Verificación de existencia del menú
        /*$e = $this->existeUser($id);
        if (is_null($e)) return FALSE;
        if ($e) {
            $this->errMsg = "user already exists";
            return FALSE;
        } */


        $sqlfields = array(
            'name'      =>  $name,
            'description'      =>  $description,
            'md5_password'      =>  $md5_password,
            'extension'  =>  $extension,
        );
        $sql = 'INSERT INTO acl_user (' .
            implode(', ', array_keys($sqlfields)) . ') VALUES (' .
            implode(', ', array_fill(0, count($sqlfields), '?')) . ')';
        $r = $this->_DB->genQuery($sql, array_values($sqlfields));
        if (!$r) {
            $this->errMsg = $this->_DB->errMsg;
            return FALSE;
        }
        $this->lastInsertId();
        return TRUE;
    }


    function createUserGroup($id, $id_user, $id_group)
    {
        /*if (!$this->_validateUserParams($id, $name, $id_parent, $type, $link))
            return FALSE; */

        // Verificación de existencia del menú
        /*$e = $this->existeUser($id);
        if (is_null($e)) return FALSE;
        if ($e) {
            $this->errMsg = "user already exists";
            return FALSE;
        } */


        $sqlfields = array(
            'id_user'      =>  $id_user,
            'id_group'      =>  $id_group
        );
        $sql = 'INSERT INTO acl_membership (' .
            implode(', ', array_keys($sqlfields)) . ') VALUES (' .
            implode(', ', array_fill(0, count($sqlfields), '?')) . ')';
        $r = $this->_DB->genQuery($sql, array_values($sqlfields));
        if (!$r) {
            $this->errMsg = $this->_DB->errMsg;
            return FALSE;
        }
        $this->lastInsertIdGroup();
        return TRUE;
    }

    /**
     * Actualizar item de menú existente.
     *
     * @param string    $id         Nombre interno del módulo o nodo
     * @param string    $name       Texto a mostrar en GUI para el nodo
     * @param string    $id_parent  Nombre interno del nodo padre, o '' para primer nivel.
     * @param string    $type       Uno de '' 'module' 'framed'. El módulo de primer nivel SIEMPRE es ''.
     * @param string    $link       Para 'framed', el enlace a mostrar en el GUI en un <iframe>
     * @param string    $order      Número de orden de presentación del item
     *
     * @return bool     VERDADERO si el menu se crea correctamente, FALSO en error
     */
    function updateUser($id, $name, $description, $md5_password, $extension)
    {
        /*if (!$this->_validateUserParams($id, $name, $id_parent, $type, $link))
        return FALSE; */

        $sql = 'UPDATE acl_user SET name = ?, description = ?, md5_password = ?, extension = ?';
        $params = array($name, $description, $md5_password, $extension);
        $sql .= ' WHERE id = ?';
        $params[] = $id;
        $r = $this->_DB->genQuery($sql, array_values($params));
        if (!$r) {
            $this->errMsg = $this->_DB->errMsg;
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Procedimiento para verificar si un usuario existe por name.
     *
     * @param   string  $name    El item a buscar.
     *
     * @return mixed    NULL en caso de error, o VERDADERO/FALSO.
     */
    function existeUser($name)
    {

        $sql = 'SELECT COUNT(*) AS N FROM acl_user WHERE name = ?';
        $tupla = $this->_DB->getFirstRowQuery($sql, TRUE, array($name));
        if (!is_array($tupla)) {
            $this->errMsg = $this->_DB->errMsg;
            return NULL;
        }
        return ($tupla['N'] > 0);
    }


    function existeUserGroup($id_user)
    {
        $sql = 'SELECT COUNT(*) AS N FROM acl_membership WHERE id_user = ?';
        $tupla = $this->_DB->getFirstRowQuery($sql, TRUE, array($id_user));
        if (!is_array($tupla)) {
            $this->errMsg = $this->_DB->errMsg;
            return NULL;
        }
        return ($tupla['N'] > 0);
    }

    function lastInsertId()
    {
        $this->lastInsert =  $this->_DB->getLastInsertId();
    }
    function lastInsertIdGroup()
    {
        $this->lastInsertGroup =  $this->_DB->getLastInsertId();
    }
}