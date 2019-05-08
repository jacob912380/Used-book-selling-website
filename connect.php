<?php
$host = 'localhost';
$dbuser = 'it485';
$pws = 'it485';
$dbname = 'baibook';

$db = new mysqli( $host, $dbuser, $pws, $dbname);
if( $db->connect_errno <> 0){
    die('cnnect to databse fail');
}

$db->query("SET NAMES UTF8");


?>