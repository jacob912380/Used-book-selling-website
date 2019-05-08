<?php
 include('connect.php');
 include('check.php');
include('page3.php');
include('key.php');


if( isset($_SESSION['login']) === false) 
{ 
    ?>
    <a href="login.php">go to login page</a>
    <?php    
    die('need to login');
}
$userid= $_SESSION['login'];
$email2= $_SESSION['email2'];

 $sql = "select count(*) as t from account, cart where account.userid= {$userid} and account.userid= cart.buyerid";
 $mysqli_result= $db->query($sql);
 $row = $mysqli_result->fetch_array( MYSQLI_ASSOC);

 $dataTotal = $row['t'];
 $pageNum = 5;
 $p = new Page($dataTotal, $pageNum );


 $sql = "SELECT orderid, id ,bookname, bookau, isbn, course, conditionss, edition, email, content, pic, price,sellerusername   FROM account, cart where account.userid= {$userid} and account.userid= cart.buyerid order by orderid DESC LIMIT {$p->offset}, {$pageNum};" ;
 $rows = [];
$mysqli_result =$db->query($sql);
while ($row = $mysqli_result ->fetch_array( MYSQLI_ASSOC)){
     
    $rows[$row['id']]= $row;

}
$username = $_SESSION['user'];

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>baibook</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
    <link rel="stylesheet" href="assets/css/3-Columns-Info-Icons.css">
    <link rel="stylesheet" href="assets/css/account.css">
    <link rel="stylesheet" href="assets/css/buy.css">
    <link rel="stylesheet" href="assets/css/Call-to-Action-Div-with-Icon-Header--Button.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="assets/css/footer-1.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/OcOrato---Login-form.css">
    <link rel="stylesheet" href="assets/css/OcOrato---Login-form1.css">
    <link rel="stylesheet" href="assets/css/orders.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form-1.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form1.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="assets/css/Projects-Horizontal.css">
    <link rel="stylesheet" href="assets/css/search.css">
    <link rel="stylesheet" href="assets/css/sell-item.css">
    <link rel="stylesheet" href="assets/css/sell.css">
    <link rel="stylesheet" href="assets/css/sign-log-form-1.css">
    <link rel="stylesheet" href="assets/css/sign-log-form.css">
    <link rel="stylesheet" href="assets/css/signup.css">
    
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Pretty-Registration-Form.css">
</head>

<body class="marble-bg">
<div>
        <nav class="navbar navbar-light navbar-expand-md fixed-top navigation-clean-button">
            <div class="container"><a class="navbar-brand" href="#"><img src="assets/img/logo.png" id="logo"></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="index.php">HOME</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="search.php">SEARCH</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="sell.php">SELL</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="buy_short.php">BUY</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="contact.php">CONTACT US</a></li>
                    </ul>
                    <?php
                    if( isset($_SESSION['user']) === false) 
                     {
                    ?>   
                     <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="login.php">Log In</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link signup-button" href="signup.php" role="button">Sign Up</a></li>
                    </ul>
                    <?php
                    }else{
                    $username = $_SESSION['user'];
                    ?>
                    
                 

                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="#"><?php echo $username; ?></a></li>
                        
                        
                        <li class="dropdown nav-item"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Account</a>
                            <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="profile.php">Profile</a><a class="dropdown-item" role="presentation" href="manage.php">Selling</a><a class="dropdown-item" role="presentation" href="orderview.php">Orders</a>
                            <a class="dropdown-item" role="presentation" href="logout.php">Log Out</a>
                            </div>
                        </li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="cart.php">Cart</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link signup-button" href="signup.php" role="button">Sign Up</a></li>
                    </ul>
                    <?php
                    }
                    ?>
                    
            </div>
    </div>
    </nav>
    </div>

    
    <div class="fill-div"></div>
    <?php

        foreach( $rows as $row){
        $order = $row['orderid'];
        ?>
    <div class="buyshort cart-list">
        <hr>
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3"><?php
                if($row['pic']<>''){
                    echo "<img width=250px class='float-left my-auto book-img' src='./uploads/{$row['pic']}' />";
                }else{
                        
                    echo "<img width=250px class='float-left my-auto book-img' src='nopicture.jpg' />";
                    }
                
                ?></div>
            <div class="col-sm-8 col-md-6 col-lg-7"><a class="d-block book-link" href="buy_detail.php?id=<?php echo $row['id'];?>"><?php echo $row['bookname'];?>&nbsp;<br></a>
                <p class="book-info">Sold by: <?php echo $row['sellerusername'];?></p>
                <p class="book-info cart-price"><strong>$<?php echo $row['price'];?></strong></p>
            </div>
           


            <form action="charge.php?id=<?php echo $order;?>" method="POST">
                <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
     
                    data-key="<?php echo $sp['publishable']; ?>"
                    data-amount="<?php echo $row['price']; ?>00"
                    data-name="Baibook"
                    data-description="Send money to: <?php echo $row['sellerusername'];?>"
                    
                    data-email="Your email:<?php echo $email2; ?>"
                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                    data-locale="auto">
                </script>
            </form>
            
            
            <a class="d-block dl-link" onclick='return confirm("are you sure delete it?")' href='deletecart.php?id=<?php echo $row['id'];?>'>Delete</a>
        
           
        </div>
        </div>
    </div>
    <?php
        }
        
        ?>   
    <div class="pagebreak-posi">
        <hr class="pgbreak"><?php
    $p->show();
    ?></a></div>
    
    <div class="fill-div"></div>
    <div class="footer-2">
        <div class="container">
            <div class="row">
                <div class="col-6 col-sm-6 col-md-6">
                    <p class="text-left" style="margin-top:5%;margin-bottom:3%;">BAIBOOK © 2019</p>
                </div>
                <div class="col-6 col-sm-6 col-md-6">
                    <p class="text-right" style="margin-top:5%;margin-bottom:8%%;font-size:1em;">Privacy Policy</p>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Profile-Edit-Form.js"></script>
</body>

</html>