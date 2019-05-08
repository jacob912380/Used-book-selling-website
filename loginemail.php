<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="#">
    <script src="main.js"></script>
   
</head>
<body>
    <div class="wrap">    
        <div class="add">
            <form action="test.php" method="POST" enctype="multipart/form-data">
                
                <br>
                Email address: <input class="lastname" type="text" name="buyer_email"/>
                <br>
                Password  : <input class="user" type="password" name="ewd"/>
                <br>
                Seller Email address : <input class="lastname" type="text" name="seller_email"/>
                <br>
                <br>
                Subject : <input class="lastname" type="text" name="subject"/>
                <br>
                Massage<br>
                <textarea class="content" name="massage"  cols="50" rows="5"></textarea>
                <br>
                <input class="btn" type="submit" name="btn" value="Send message to seller"id=""/>
                
            </form>   
        </div>
        
        
    </div>  
</body>
</html>