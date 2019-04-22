<?php
session_start(); 
require_once('database.php');

// Get category ID

// Get products for selected category
$queryProducts = 'SELECT * FROM products ORDER BY productID';
$statement3 = $db->prepare($queryProducts);
$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();

$connect = mysqli_connect("localhost", "root", "", "21358000");  
if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'          =>     $_GET["id"],  
                     'item_name'           =>     $_POST["hidden_name"], 
                     'item_price'       =>     $_POST["hidden_price"],  
                     'item_quantity'       =>     $_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="women.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="women.php"</script>';  
                }  
           }  
      }  
 }  
 ?>
<!doctype html>
<html>
<body>
<head>
<meta charset="utf-8">
<title>Shoebizz</title>
<script src="slideshow.js"></script>	

<style>
.mySlides {display:none;}
    
.products{
        display: block;
        align-items: center;
        justify-content: center;
        margin: auto;
    }
    
    .quantity {
        height: 30px;
        width: 2%;
        padding: 5px 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid grey;
    }
    
    .btn {
        padding: 10px;
        font-size: 15px;
        color: black;
        background: #c5d66f;
        border: grey solid 1px;
        border-radius: 5px;}
    
    #overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}

#overlayBox{
  position: absolute;
  top: 50%;
  left: 50%;
  background-color: white;
  border-style: solid;
  border-width: 2px;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}
</style>
	
<link rel="stylesheet" href="style.css"
</head>

<header>
	<h1><img src=images/logo.png></h1>
		

	
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="authn/ulogin.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

    </div>

    <div class="container">
	 <h1>Login</h1>
      <p>Please fill in this form to login.</p>
      <hr>
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="passwd" required>
        
      <button type="submit">Login</button>

    </div>


    </div>
  </form>	

<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Register</button>

<div id="id02" class="modal">
  
  <form class="modal-content animate" action="authn/register.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>

    </div>

    <div class="container">
	 <h1>Register</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="passwd" required>
        
      <button type="submit">Register</button>

    </div>


    </div>
  </form>	
	
	
<!--
<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Register</button>

<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content" action="authn/register.php">
    <div class="container">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="passwd" required>
      



      <div class="clearfix">
        <button type="submit" class="signupbtn">Sign Up</button>
      </div>
    </div>
  </form>
</div>
-->
</header>
	
<ul>                                           
  <li><a href="index.php">Home</a></li>
  <li><a href="men.php">Men</a></li>
  <li><a href="women.php">Women</a></li>
  <li><a href="contact.html">Contact</a></li>
    <li><a href="admin.php">Admin</a></li>
    <li><a onclick="on()">Cart</a></li>
</ul>
<script>
        
    function on() {
        document.getElementById("overlay").style.display = "block";
    }
        
    function off() {
        document.getElementById("overlay").style.display = "none";
    }
    
    </script>
<div id="overlay">
<div id="overlayBox" style="padding-left: 10%; padding-right: 10%; padding-bottom: 2%; padding-top: 2%">
      <div style="float: right;">
        <button class="btn" onclick="off()">Back</button>
      </div>
      <br>
      <div>
                <div style="clear:both"></div>  
                <br />  
                <h3>Your Cart</h3>  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="40%">Item Name</th>  
                               <th width="10%">Quantity</th>  
                               <th width="20%">Price</th>  
                               <th width="15%">Total</th>  
                               <th width="5%"></th>  
                          </tr>  
                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values["item_name"]; ?></td>  
                               <td><?php echo $values["item_quantity"]; ?></td>  
                               <td>£ <?php echo $values["item_price"]; ?></td>  
                               <td>£ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                               <td><a href="men.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3" align="right">Total</td>  
                               <td align="right">£ <?php echo number_format($total, 2); ?></td>  
                               <td></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div> 
        </div>	
</div>
	


<div class="div_container">
<div class="slidshow" style="max-width:1200px">
  <img class="mySlides" src="images/placeholder1.jpg" style="width:100%">
  <img class="mySlides" src="images/placeholder2.jpg" style="width:100%">
  <img class="mySlides" src="images/placeholder3.jpg" style="width:100%">
</div>

<h1> Featured Products </h1>


<?php foreach ($products as $product) : ?>
       
	 
<div class="div_box1">

	<img src="<?php echo $product['image'];?>" > 
	
	<div class="ac">
	<?php echo $product['productName']; ?>
	</div>
	
	<div class="new_price">
     <?php echo $product['listPrice']; ?>
	</div>
	
	<a href="checkout2.html">
	<div class="buy">Buy</div>
	</a>
		
</div>
		
	
<a href="checkout2.html">
<!--<div class="div_box1"><div class="buy">Buy</div>
-->

</a>
<?php endforeach; ?>  

</div>

<div>
<footer>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<a href="#" class="fa fa-facebook"></a>
<a href="#" class="fa fa-twitter"></a>
<a href="#" class="fa fa-google"></a>
<a href="#" class="fa fa-linkedin"></a>
<a href="#" class="fa fa-youtube"></a>
<div class="customer"> CUSTOMER SERVICE </div>
<div class="legal"> LEGAL INFORMATION </div>
<div class="about"> ABOUT </div>
<div class="help"> HELP </div>

</footer>
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 6000); 
}

// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Get the modal
var modal = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>



</body>
</html>
