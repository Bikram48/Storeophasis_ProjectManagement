<?php session_start(); include "../backend/connect.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Responsive Side Navigation Bar</title>

    <link rel="stylesheet" href="../css/traderdashboard.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<script src="../script/jquery-3.1.1.min.js"></script>

	<script>
		$(document).ready(function(){
			$(".hamburger").click(function(){
			   $(".wrapper").toggleClass("collapse");
			});
		});
	</script>
 
</head>

<body>


<div class="wrapper">
  <div class="top_navbar">
    <div class="hamburger">
       <div class="one"></div>
       <div class="two"></div>
       <div class="three"></div>
    </div>
    <div style="background-color:#162447;" class="top_menu">
      <div class="logo"><img width=150 height=40 src="../Images/Logo2.png"></div>
      <ul>
        <li><a href="#">
          <i class="fas fa-search"></i></a></li>
        <li><a href="#">
          <i class="fas fa-bell"></i>
          </a></li>
        <li><a href="#">
          <i class="fas fa-user"></i>
          </a></li>
      </ul>
    </div>
  </div>
  
  <div class="sidebar">
      <ul>
        <li><a href="traderdashboard.php">
          <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
          <span class="title">Dashboard</span></a></li>
          
        <li><a href="traderviewprofile.php">
          <span class="icon"><i class="fas fa-user-circle"></i></span>
          <span class="title">View Profile</span>
          </a>
        </li>
        <li><a href="traderaddproduct.php">
          <span class="icon"><i class="fas fa-plus"></i></span>
          <span class="title">Add Products</span>
          </a></li>
        <li><a href="editProduct.php">
          <span class="icon"><i class="fas fa-edit"></i></span>
          <span class="title">Edit Products</span>
          </a></li>
        <li><a href="#" class="active">
          <span class="icon"><i class="fas fa-times"></i></span>
          <span class="title">Delete Products</span>
          </a></li>
        <li><a href="#">
          <span class="icon"><i class="fas fa-align-justify"></i></span>
          <span class="title">Orders</span>
          </a></li>
          <li><a href="viewproduct.php">
          <span class="icon"><i class="fas fa-layer-group"></i></span>
          <span class="title">View Product</span>
          </a></li>
         
    </ul>
  </div>
  
    <div class="main_container">
    <div style="overflow:auto;" class="table" >
  <table>
    <tr>
      <th>Product Name</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Description</th>
      <th>Minimum Order</th>
      <th>Maximum Order</th>
      <th>Allergy Information</th>
      <th>Image</th>
      <th>Actions</th>
      
    </tr>
    <?php  if(isset($_SESSION['shid'])){ $shopid=$_SESSION['shid']; $query="select * from product where FK2_SHOPID=$shopid";  
          $parse=oci_parse($connection,$query);
          $result=oci_execute($parse);
         while($row=oci_fetch_assoc($parse)){
           
          ?>
    
    <tr>
        <?php echo "<td>".$row['PRODUCTNAME']."</td>" ?>
        <?php echo "<td>".$row['PRICE']."</td>" ?>
        <?php echo "<td>".$row['QUANTITY']."</td>" ?>
        <?php echo "<td>".$row['DESCRIPTION']."</td>" ?>
        <?php echo "<td>".$row['MIN_ORDER']."</td>" ?>
        <?php echo "<td>".$row['MAX_ORDER']."</td>" ?>
        <?php echo "<td>".$row['ALLERGYINFO']."</td>" ?>
        <?php echo "<td>"."<img style=width:100px; height:100px; src=../Images/".$row['IMAGE'].">"."</td>" ?>
      <?php echo "<td style=width:200px;><button class=btn><a href=editProduct.php?productId=".$row['PRODUCTID']."><i class=fas fa-edit></i> Edit</a></button>
<button class=btn><a href=../backend/deleteproduct.php?productId=".$row['PRODUCTID']."><i class=fas fa-times></i> Delete</a>
</button><button class=btn><a href=addDiscount.php?productId=".$row['PRODUCTID']."><i class=fas fa-eye></i> Add Discount</a></button></td>"?>
     
    </tr>
      <?php
      } }?>    
  </table>
</div>
    </div>
    
   
  </div>
</div>

</body>
</html>