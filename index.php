<?php
require_once('database.php');

// Get category ID

// Get products for selected category
$queryProducts = 'SELECT * FROM products ORDER BY productID';
$statement3 = $db->prepare($queryProducts);
$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();
?>
<!doctype html>
<html>
<body>
<head>
<meta charset="utf-8">
<title>Game page</title>
<script src="slideshow.js"></script>	

<style>
.mySlides {display:none;}
</style>
	
<link rel="stylesheet" href="game.css"
</head>

<header>
    <h1>SHOEBIZZ</h1>


	
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
  <li><a href="games.html">Men</a></li>
  <li><a href="playstation.html">Women</a></li>
  <li><a href="xbox.html">Contact</a></li>
   <li><a href="admin.php">Admin</a></li>
</ul>
	


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
  <p>© Copyright 2018</p>
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
