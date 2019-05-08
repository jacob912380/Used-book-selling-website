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
$buyerid= $_SESSION['login'];
$user= $_SESSION['user'];


$sql = "insert into cart (id, bookname, bookau, isbn, course, conditionss, edition, email, content, pic, price, userid, buyerid, sellerusername, buyerusername) select id, bookname,bookau, isbn, course, conditionss, edition, email, content, pic, price , userid, '{$buyerid}', sellerusername, '{$user}' from book WHERE id='{$id}'";
$is= $db->query($sql);

header("location: trans_add_to_cart.php");
?>