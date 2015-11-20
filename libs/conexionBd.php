<?php

$db_host = "192.168.20.250";
$db_username = "root";
$db_pass = "root";
$db_database = "bdinventariour";

$cnx = ADONewConnection('mysqli'); 
$cnx->connect($db_host, $db_username, $db_pass, $db_database); 
?>