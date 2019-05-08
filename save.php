<?php
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$user = $_POST['user'];
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];
$email2 = $_POST['email2'];
$hit = $_POST['hit'];
// include_once('input.php');
if ($pwd != $pwd2){
    header("location: trans_signup_fail.php");
    die;
?>
<br>
<a href="register.html">Back to register page</a>
<?php
    exit;
}
include_once('connect.php');



//check user whether exits
$sql = "select user from account where user= '{$user}'" ;
$mysqli_result2 =$db->query($sql);
$row2 = $mysqli_result2->fetch_array( MYSQLI_ASSOC);
$check_username = $row2['user'];


if ($user == $check_username){
    header("location: trans_account_exits.php");
    die;
}





//insert data to account table
$db->query("SET NAMES UTF8");
$sql = "insert into account (user, pwd, email2, lastname, firstname, hit ) values ('{$user}' , '{$pwd}', '{$email2}', '{$lastname}', '{$firstname}', '{$hit}')"; 
$is = $db->query($sql); ///(insert data to sql)

header("location: trans_create_account.php");
?>
