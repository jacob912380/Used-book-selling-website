<?php
include('connect.php');
include('check.php');

if( isset($_SESSION['login']) === false) 
{ 
    ?>
    <a href="login.php">go to login page</a>
    <?php    
    die('need to login');
}




$userid= $_SESSION['login'];
$street= $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];
if ($pwd != $pwd2){
    header('location: trans_profile_fail.php');
    die;
    ?>
    <a href="profile.php">backe to your profile page</a>
    <?php
    exit();
}


$sql = "update account set street = '{$street}',city = '{$city}',state = '{$state}',zipcode = '{$zipcode}',lastname = '{$lastname}',Firstname = '{$firstname}',phone = '{$phone}', email2 = '{$email}' , pwd = '{$pwd2}' where userid = '{$userid}'";
$mysqli_result = $db-> query($sql);
// $row = $mysqli_result->fetch_array(MYSQLI_ASSOC);

header("location: trans_profile.php");

?>