<?php
require('database.php');
$query = 'SELECT *
 FROM categories
 ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin</title>
<script src="slideshow.js"></script>	

<style>
.mySlides {display:none;}
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
  <li><a href="men.html">Men</a></li>
  <li><a href="women.html">Women</a></li>
  <li><a href="contact.html">Contact</a></li>
   <li><a href="admin.php">Admin</a></li>
</ul>
	

<div class="div_container">

    <header><h1>Product Manager</h1></header>

    <main>
 <h1>Add Product</h1>
 <form action="add_product.php" method="post"
 id="add_product_form">
 <label>Category:</label>
 <select name="category_id">
 <?php foreach ($categories as $category) : ?>
 <option value="<?php echo $category['categoryID']; ?>">
 <?php echo $category['categoryName']; ?>
 </option>
 <?php endforeach; ?>
 </select><br>
 
 <label>Code:</label>
 <input type="text" name="code"><br>

 <label>Name:</label>
 <input type="text" name="name"><br>

 <label>List Price:</label>
 <input type="text" name="price"><br>

 <label>&nbsp;</label>
 <input type="submit" value="Add Product"><br>
 </form>
 <p><a href="admin.php">View Product List</a></p>
 </main>

</div>

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
</script>


<body>
</body>
</html>
