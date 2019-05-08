<?php
include('connect.php');
require_once('vendor/autoload.php');






$newpassword = md5(uniqid());

$user = isset($_POST['user'])? $_POST['user'] : ''; 
$email2 = isset($_POST['email2'])? $_POST['email2'] : ''; 

$hit = isset($_POST['hit'])? $_POST['hit'] : '';

if( !empty($user) && !empty($email2) && !empty($hit)){

    $sql = "select * from account where user='{$user}' and email2='{$email2}' and hit='{$hit}'";
    $mysqli_result = $db-> query($sql);
    $row = $mysqli_result->fetch_array(MYSQLI_ASSOC);
    
    
    
   
    if ( is_array($row)) {   
        $sql = "update account set pwd = '{$newpassword}' where user = '{$user}' ";
        $is = $db->query($sql);

       
    }else{
        
        header('location: trans_reset_fail.php');
        die('Username or Email is not correct!');
    }
        ////////////////// email part
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
    $mail->setFrom("baibook.umass@gmail.com", "User: $user");
    $mail->addAddress("$email2", '$user');     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Baibook password reset";
    $mail->Body    = "Hello $user! <br> Here is your new passwords $newpassword";
    

    $mail->send();

    if ($mail->ErrorInfo <> ''){
        header('location: errormassage.php');
    }else{
        header('location: trans_password_reset.php');
        // echo "New password has sent to your email $email2";
    }
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

    exit();
}
       






      



?>
