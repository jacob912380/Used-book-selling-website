<?php
include('connect.php');

session_start(); 
if( isset($_SESSION['login']) === false) 
{ 
    die('need to login');
}

$id = (int) $_GET['id']; 
if ( $id<1){
    die('no valuable data');
}

$sql = "DELETE FROM book WHERE id='{$id}'";
$is= $db->query($sql);
header("location: manage.php"); 
?>