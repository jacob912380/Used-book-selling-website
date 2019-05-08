<?php
 include('connect.php');


include('check.php');



$id = (int) $_GET['id'];



 $sql = "select * from book where id = {$id};";
 
 $rows = [];
$mysqli_result =$db->query($sql);
$row = $mysqli_result->fetch_array( MYSQLI_ASSOC);
if($mysqli_result == false){
    echo "SQL fail";
    exit;
}

if( isset($_SESSION['user']) === false) 
{       
?>
<a href="login.php">login</a>
<?php
}else{
    $username = $_SESSION['user'];
    echo $username; 
?> 
<br>
<a href="logout.php">logout</a>
<?php
}
var_dump ($row['bookname']);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css.css">
    <script src="main.js"></script>
</head>
<body>
<div class="direct">
    <ul class="menue">
        <li><a href="index.php">home</a></li>
        <li><a href="search.php">search</a></li>
        <li><a href="sell.php">sell</a></li>
        <li><a href="buy.php">buy</a></li>
        <li><a href="manage.php">manage your order</a></li>
        <li><a href="cart.php">Cart</a></li>
    </ul>
    </div>
        
        
        <div class="msg">
            
                Book Name :<span class="user"><?php echo $row['bookname'];?></span><br>
                Book Author :<span class="user"><?php echo $row['bookau'];?></span><br>
                ISBN Number :<span class="user"><?php echo $row['isbn'];?></span><br>
                Course :<span class="user"><?php echo $row['course'];?></span><br>
                Condition :<span class="user"><?php echo $row['conditionss'];?></span><br>
                Edition :<span class="user"><?php echo $row['edition'];?></span><br>
                Contact Email :<span class="user"><?php echo $row['email'];?></span><br>
                price : $<span class="user"><?php echo $row['price'];?></span><br>
                Post time : <span class="user"><?php echo $row['selltime'];?></span><br>
                Sell by : <span class="user"><?php echo $row['sellerusername'];?></span><br>
           
            <div class="content">
                <a onclick='return confirm("are you sure add it to cart?")' href='addcart.php?id=<?php echo $row['id'];?>'>add to cart</a><br>
                
                Book description :<?php echo $row['content'];?>
                <hr>
                book picture: <?php
                if($row['pic']<>''){
                    echo "<img width=250px src='./uploads/{$row['pic']}' />";}else{
                        
                    echo "<img width=250px src='python3.jpg' />";
                    }
                
                ?>
                
        </div>
        <br>

        <div class="add">
            <form action="test.php?id=<?php echo $row['id'];?>" method="POST" enctype="multipart/form-data">
                
                <br>
            
                Contact seller by email
                <br>
                Subject : <input class="lastname" type="text" name="subject"/>
                <br>
                Massage<br>
                <textarea class="content" name="massage"  cols="50" rows="5"></textarea>
                <br>
                <input class="btn" type="submit" name="btn" value="Send message to seller"id=""/>
                
            </form>   
        </div>

       <?php
                
               
                ?>
        </div>

</body>
</html>
