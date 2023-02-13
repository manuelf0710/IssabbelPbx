<?php
ini_set('display_errors', 1);
error_reporting(E_ALL); 
 
// Número de teléfono al que se desea hacer la llamada
$phone_number = "3222569524";
 
// URL de la API de llamadas de ISSABEL
$url = "http://localhost:8088/call_center/api.php?";
 
// Datos que se envían a la API
$data = array(
    'src' => 'SIP/100',
    'dst' => 'SIP/' . $phone_number,
    'action' => 'call',
);
 
// Crea una petición HTTP GET a la API de ISSABEL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url . http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
 
// Muestra el resultado de la llamada
echo $result;
 
?>