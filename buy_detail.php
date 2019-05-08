<?php
include('connect.php');
include('check.php');

if( isset($_SESSION['login']) === false) 
{ 
   header("location: trans_require_login.php");

   die;
}

$id = (int) $_GET['id'];

 $sql = "select * from book where id = {$id};";
 
 $rows = [];
$mysqli_result =$db->query($sql);
$row = $mysqli_result->fetch_array( MYSQLI_ASSOC);
if($mysqli_result == false){
    echo "SQL fail";
    exit;
}

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
    <!-- id="profile" -->
    <div class="container profile profile-view" >
        <form>
            <div class="form-row profile-row">
                <div class="col-md-4 relative">
                    <div><?php
                if($row['pic']<>''){
                    echo "<img width=250px class='buybook-pic' src='./uploads/{$row['pic']}' />";}else{
                        
                    echo "<img width=250px  class='buybook-pic' src='nopicture.jpg' />";
                    }
                
                ?></div>
                </div>
                <div class="col-md-8 buy-right-col">
                    <hr>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <p><?php echo $row['bookname'];?></p>
                            </div>
                            <div class="form-group">
                                <p>Seller: <?php echo $row['sellerusername'];?></p>
                            </div>
                            <div class="form-group">
                                <p>Edition: <?php echo $row['edition'];?></p>
                            </div>
                            <div class="form-group">
                                <p>Condition: <?php echo $row['conditionss'];?></p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">

                        
                            <div class="form-group">
                                <p>Author: <?php echo $row['bookau'];?></p>
                            </div>
                            <div class="form-group">
                                <p>ISBN: <?php echo $row['isbn'];?></p>
                            </div>
                            
                            <div class="form-group">
                                <p>Course: <?php echo $row['course'];?></p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <p>Email: <?php echo $row['email'];?></p>
                    </div>
                    <div class="form-group">
                        <p>Description: <?php echo $row['content'];?></p>
                    </div>
                    <div class="form-group">
                        <p>Price: $<?php echo $row['price'];?></p>
                    </div>
                    
                    <hr>
                    <div class="form-row">
                    <div class="col-md-12 content-right">
                    <a class="btn btn-danger btn-lg add-cart" onclick='return confirm("are you sure add it to cart?")' href='addcart.php?id=<?php echo $row['id'];?>'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add to cart<i class="fa fa-shopping-cart cart-icon"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>
                        
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="mx-auto message">
        <form action="test.php?id=<?php echo $row['id'];?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-6 col-xl-5">
                <h5 class="text-center">Having Questions?</h5>
                <h3 class="text-center my-auto message-title">Send a message to seller! <?php echo $row['sellerusername'];?></h3>
            </div>
            <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-5">
                <div class="row">
                    <div class="col-xl-11"><input type="text" placeholder="Subject" class="subject-box" name="subject"></div>
                    <div class="col-sm-12 col-xl-11"><textarea class="form-control-lg message-box" placeholder="Message" name="massage"></textarea><button class="btn btn-primary d-block message-btn" type="submit" name="btn"><strong>SEND</strong></button></div>
                </div>
            </div>
        </div>
        </form> 
    </div>
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