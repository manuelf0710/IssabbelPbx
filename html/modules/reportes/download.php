<?php
    function obtenerDatos($file) {
        if ($file) {
            if (file_exists("$file")) {
                header("Cache-Control: private");
                header("Pragma: cache");
                header('Content-Type: application/octet-stream');
                header("Content-Length: ".filesize("$file"));
                header("Content-Disposition: attachment; filename=$file");
                readfile("$file");
            } else {
                header("HTTP/1.1 404 Not Found");
                print "File not found";
            }
        } else {
            header("HTTP/1.1 403 Forbidden");
            print "Invalid file";
        }
    }

    if(isset($_GET['file']) && $_GET['file'] != "") {
        obtenerDatos($_GET['file']);
    }
?>