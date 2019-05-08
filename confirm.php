<?php
include('connect.php');
include('check.php');
require_once('vendor/autoload.php');
session_start(); 
if( isset($_SESSION['login']) === false) 
{ 
    die('need to login');
}

$id = (int) $_GET['id']; 
if ( $id<1){
    die('no valuable data');
}
$buyername = $_SESSION['user'];
$sql = "update orders set status = '4' where ordernumber = '$id'  ";
$is= $db->query($sql);


$sql = "SELECT * from orders where ordernumber = {$id};" ;


$rows = [];
$mysqli_result =$db->query($sql);
$row = $mysqli_result->fetch_array( MYSQLI_ASSOC);
if($mysqli_result == false){
    echo "SQL fail";
    exit;
}
$bookname = $row['bookname'];
$order = $row['bookid'];
$selleremail = $row['selleremail'];
$ordertime = $row['ordertime'];
$price = $row['price'];



require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';
require 'vendor/autoload.php';



$mail = new PHPMailer\PHPMailer\PHPMailer();

try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = "";                     // SMTP username
    $mail->Password   = "";                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom("baibook.umass@gmail.com", "Order#$order: completed Buyer:'$buyername' email: $buyeremail");
    $mail->addAddress("$selleremail", 'seller');     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Order confirm item'$bookname'";
    $mail->Body    = "Buyer '$buyername' has recived the order #$order $bookname on $ordertime $$price";
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    if ($mail->ErrorInfo <> ''){
        header('location: errormassage.php');
    }else{
        header('location: trans_order_complete.php ');
    }
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

    exit();







?>
