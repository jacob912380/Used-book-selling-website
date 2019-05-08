<?php
include('check.php');
$bookname = $_POST['bookname'];
$bookau = $_POST['bookau'];
$isbn = $_POST['isbn'];
$course = $_POST['course'];
$condition = $_POST['condition'];
$edition = $_POST['edition'];
$email = $_POST['email'];
$content = $_POST['content'];
$price = $_POST['price'];
$userid= $_SESSION['login'];
$username = $_SESSION['user'];
$selltime = date("Y-m-d H:i:s");

include('connect.php');
include('upload.php');


$upload = new Upload();

$filename = $upload->up('file1');






$db->query("SET NAMES UTF8");

$sql = "insert into book (bookname, bookau, isbn, course, conditionss, edition, email, content, pic, userid, price, sellerusername, selltime) values ('{$bookname}' , '{$bookau}','{$isbn}', '{$course}', '{$condition}', '{$edition}', '{$email}', '{$content}', '{$filename}', '{$userid}','{$price}','{$username}','{$selltime}')"; //{} can have or not  use it more safe

$is = $db->query($sql); 
echo "you have said bye to the book '$bookname'";

 header("location: trans_sell.php");
?>

