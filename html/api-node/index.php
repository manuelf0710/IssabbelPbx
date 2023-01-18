<?php
include("IssabelExternalConnection.class.php");
if (isset($_GET['action']) && $_GET['action'] != '') {
    $action = $_GET['action'];
    $payload = '';

    $externalConnection = new IssabelExternalConnection();
    if ($action == 'config') {
        $externalConnection->config($payload);
    }
    if ($action == 'test') {
        $externalConnection->config($payload);
    }
}
