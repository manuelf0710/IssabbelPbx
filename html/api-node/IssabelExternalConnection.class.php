<?php
/* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 4.0                                                  |
  | http://www.issabel.org                                               |
  +----------------------------------------------------------------------+
  | Copyright (c) 2017 Issabel Foundation                                |
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
*/

class IssabelExternalConnection
{

    var $_DB; // instancia de la clase paloDB
    var $errMsg;
    //var $urlNode = 'http://192.168.0.101:3000/';
    var $urlNode = 'http://localhost:3000/';

    function external_auth($user, $password, $payload)
    {
        session_write_close();
        $ch = curl_init();
        //curl_setopt($ch, CURLOPT_URL,"http://192.168.0.101:3000/auth");
        curl_setopt($ch, CURLOPT_URL, $this->urlNode . "auth");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataConn));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response    = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $httpcode    = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $header      = substr($response, 0, $header_size);
        $body        = substr($response, $header_size);
        curl_close($ch);
        session_start();

        echo json_encode($body);
        if ($httpcode == '200') {
            $data = json_decode($body);
            return $data;
        } else {
            return $body;
        }
    }


    function config($payload)
    {
        session_write_close();
        $ch = curl_init();
        //curl_setopt($ch, CURLOPT_URL,"http://192.168.0.101:3000/auth");
        curl_setopt($ch, CURLOPT_URL, $this->urlNode . "config");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataConn));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response    = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $httpcode    = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $header      = substr($response, 0, $header_size);
        $body        = substr($response, $header_size);
        curl_close($ch);
        session_start();
        echo json_encode($body);
        /*if ($httpcode == '200') {
            $data = json_decode($body);
            return $data;
        } else {
            return $body;
        } */
    }

    function test($payload)
    {
        session_write_close();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->urlNode."test");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataConn));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response    = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $httpcode    = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $header      = substr($response, 0, $header_size);
        $body        = substr($response, $header_size);
        curl_close($ch);
        session_start();

        echo json_encode($body);
       
        /*if ($httpcode == '200') {
            $data = json_decode($body);
            return $data;
        } else {
            return $body;
        }*/
    }
}