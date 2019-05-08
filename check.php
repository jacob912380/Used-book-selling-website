<?php
include('connect.php');


session_start();


$user = isset($_POST['user'])? $_POST['user'] : ''; 
$pwd = isset($_POST['pwd'])? $_POST['pwd'] : ''; 
if( !empty($user) && !empty($pwd)){

    $sql = "select * from account where user='{$user}' and pwd='{$pwd}'";
    $mysqli_result = $db-> query($sql);
    $row = $mysqli_result->fetch_array(MYSQLI_ASSOC);
    
    
    
    
   
    if ( is_array($row)) {   
        $sql = "select userid from baibook.account where user='{$user}' and pwd='{$pwd}'";
        $idr = $db-> query($sql);

        $row=$idr->fetch_array(MYSQLI_ASSOC);
        
        
        $login = $row['userid'];
        
   
        
        $_SESSION['login'] = $row['userid'];
        $_SESSION['user'] = $user;
        ////////////////////
        $row2 =[];
        $sql = "select email2 from baibook.account where user='{$user}' and pwd='{$pwd}'";
        $em = $db-> query($sql);

        $row2=$em->fetch_array(MYSQLI_ASSOC);
        $email2 = $row2['email2'];
        $_SESSION['email2'] = $email2;
        /////////////////////
        $row3 =[];
        $sql = "select street from baibook.account where user='{$user}' and pwd='{$pwd}'";
        $st = $db-> query($sql);

        $row3=$st->fetch_array(MYSQLI_ASSOC);
        $street = $row3['street'];
        $_SESSION['street'] = $street;
        /////////////////////
        $row4 =[];
        $sql = "select city from baibook.account where user='{$user}' and pwd='{$pwd}'";
        $cy = $db-> query($sql);

        $row4=$cy->fetch_array(MYSQLI_ASSOC);
        $city = $row4['city'];
        $_SESSION['city'] = $city;
        /////////////////////
        $row5 =[];
        $sql = "select state from baibook.account where user='{$user}' and pwd='{$pwd}'";
        $sta = $db-> query($sql);

        $row5=$sta->fetch_array(MYSQLI_ASSOC);
        $state = $row5['state'];
        $_SESSION['state'] = $state;

        /////////////////////
        $row6 =[];
        $sql = "select zipcode from baibook.account where user='{$user}' and pwd='{$pwd}'";
        $zc = $db-> query($sql);

        $row6=$zc->fetch_array(MYSQLI_ASSOC);
        $zipcode = $row6['zipcode'];
        $_SESSION['zipcode'] = $zipcode;

        /////////////////////
        $row7 =[];
        $sql = "select Firstname from baibook.account where user='{$user}' and pwd='{$pwd}'";
        $fn = $db-> query($sql);

        $row7=$fn->fetch_array(MYSQLI_ASSOC);
        $firstname = $row7['Firstname'];
        $_SESSION['Firstname'] = $firstname;

        /////////////////////
        $row8 =[];
        $sql = "select lastname from baibook.account where user='{$user}' and pwd='{$pwd}'";
        $ln = $db-> query($sql);

        $row8=$ln->fetch_array(MYSQLI_ASSOC);
        $lastname = $row8['lastname'];
        $_SESSION['lastname'] = $lastname;

        /////////////////////
        $row9 =[];
        $sql = "select phone from baibook.account where user='{$user}' and pwd='{$pwd}'";
        $ph = $db-> query($sql);

        $row9=$ph->fetch_array(MYSQLI_ASSOC);
        $phone = $row9['phone'];
        $_SESSION['phone'] = $phone;













        
        
        header("location: index.php");
        exit;
    }else{
       
        header("location: trans_login_fail.php");
        die('login fail');
    }
}


?>