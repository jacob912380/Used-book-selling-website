<?php

include('connect.php');
include('check.php');
require_once('vendor/autoload.php');

$order = (int) $_GET['id'];



$sql = "select * from cart where orderid = {$order};";

$rows = [];
$mysqli_result =$db->query($sql);
$row = $mysqli_result->fetch_array( MYSQLI_ASSOC);
if($mysqli_result == false){
   echo "SQL fail";
   exit;
}
$bookname = $row['bookname'];

$sellerid = $row['userid'];
$buyerid = $row['buyerid'];
$selleremail = $row['email'];
$pic = $row['pic'];
$price = $row['price'];
$bookid = $row['id'];
$status = 1;
$confirm = 1;
$sellerusername = $row['sellerusername'];
$buyer = $row['buyerusername'];
$ordertime = date("Y-m-d");
$bookprice= $price*100;
if(isset($_POST['stripeToken'])){

    $token = $_POST['stripeToken'];

    try {
        \Stripe\Stripe::setApiKey("");
        \Stripe\Charge::create([
            "amount" => $bookprice,
            "currency" => "usd",
            "card" => $token, // obtained with Stripe.js
            "description" => "123@123.com"
          ]);


    } catch(Stripe_CardError $e){ 

    }

    

/////////
$sql = "select * from account where userid = {$buyerid}";
 
    $rows2 = [];
   $mysqli_result =$db->query($sql);
   $row2 = $mysqli_result->fetch_array( MYSQLI_ASSOC);
   if($mysqli_result == false){
       echo "SQL fail";
       exit;
   }
   $buyeremail = $row2['email2'];
   $buyerphone = $row2['phone'];
   ///////////////////address
    $street =$row2['street'];
    $city = $row2['city'];
    $state = $row2['state'];
    $zipcode = $row2['zipcode'];

    $shipaddress = "$street $city $state,$zipcode";

    $check = "$street" . "$city" . "$state"  . "$zipcode";
   if ($check == ''){
        header('location: trans_charge_fail.php');
       
       die;
   }

    

    $db->query("SET NAMES UTF8");

    $sql = "insert into orders (sellerid, selleremail, buyerid, buyeremail, buyerphone,shipaddress, status, confirm, bookid, bookname, pic, price, ordertime, sellerusername ) values ('{$sellerid}' , '{$selleremail}', '{$buyerid}', '{$buyeremail}', '{$buyerphone}', '{$shipaddress}', '{$status}', '{$confirm}', '{$bookid}', '{$bookname}', '{$pic}', '{$price}', '{$ordertime}', '{$sellerusername}' )"; //{} can have or not  use it more safe

    $is = $db->query($sql);
    echo "seller email $selleremail";

    
    $sql = "DELETE FROM book WHERE id='{$bookid}'";
    $is1= $db->query($sql);


    $sql = "DELETE FROM cart WHERE id='{$bookid}'";
    $is2= $db->query($sql);
    //////////////send email auto
    

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
    $mail->setFrom("baibook.umass@gmail.com", "Order#$bookid: received Buyer:$buyer email: $buyeremail");
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
    $mail->Subject = "Order recived item:'$bookname'";
    $mail->Body    = "Buyer:$buyer has placed a book $bookname from you on $ordertime $$price. The order number is:$bookid. Please wait for Baibook responding";
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    if ($mail->ErrorInfo <> ''){
        header('location: errormassage.php');
    }else{
        header('location: trans_finish_payment.php');
    }
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

    exit();
}
?>
