<?php
require_once('database.php');

// Get category ID
if (!isset($category_id)) {
    $category_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
}
// Get name for selected category
$queryCategory = 'SELECT * FROM categories
                  WHERE categoryID = :category_id';
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$category_name = $category['categoryName'];
$statement1->closeCursor();


// Get all categories
$query = 'SELECT * FROM categories
                       ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();

// Get products for selected category
$queryProducts = 'SELECT * FROM products
                  WHERE categoryID = :category_id
                  ORDER BY productID';
$statement3 = $db->prepare($queryProducts);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();
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
	
<link rel="stylesheet" href="game.css"
</head>

<header>
    <h1>UWL Games</h1>


	
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
  <li><a href="index.php">Featured</a></li>
  <li><a href="games.html">PC Games</a></li>
  <li><a href="playstation.html">Playstation</a></li>
  <li><a href="xbox.html">Xbox</a></li>
    <li><a href="admin.php">Admin</a></li>
</ul>
	

<div class="div_container">


<header><h1>Product Manager</h1></header>
<main>
    <h1>Product List</h1>

    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <nav>
        <ul>
            <?php foreach ($categories as $category) : ?>
            <li><a href=".?category_id=<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>          
    </aside>

    <section>
 <h2><?php echo $category_name; ?></h2>
 <table>
 <tr>
 <th>Code</th>
 <th>Name</th>
 <th class="right">Price</th>
 <th>&nbsp;</th>
 </tr>
 <?php foreach ($products as $product) : ?>
 <tr>
 <td><?php echo $product['productCode']; ?></td>
 <td><?php echo $product['productName']; ?></td>
 <td class="right"><?php echo $product['listPrice'];
 ?></td>
 
 <td><form action="delete_product.php" method="post">
 <input type="hidden" name="product_id"
 value="<?php echo $product['productID']; ?>">
 <input type="hidden" name="category_id"
 value="<?php echo $product['categoryID']; ?>">
 <input type="submit" value="Delete">
 </form></td>
 </tr>
 <?php endforeach; ?>
 </table>
 <p><a href="add_product_form.php">Add Product</a></p>
 </section>
</main>


</div>

<footer>
  <p>© Copyright 2018</p>
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
