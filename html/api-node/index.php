<?php 
include("IssabelExternalConnection.class.php");
if(isset($_GET['action']) && $_GET['action'] != ''){
    $action = $_GET['action'];
    $payload = json_decode(file_get_contents('php://input'));
    $externalConnection = new IssabelExternalConnection();
    if($action == 'config'){
       return $externalConnection->config2($payload);
    }
    if($action == 'test'){
        
        return $externalConnection->test($payload);
    } 
    if($action == 'connection'){
        echo $externalConnection->getConnection();
    }         


}