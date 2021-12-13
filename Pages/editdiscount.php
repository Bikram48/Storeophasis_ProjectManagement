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

<?php 
    if(isset($_GET['productId'])){
        $productid=$_GET['productId'];
    }
    if(isset($_SESSION['traderid'])){
      $traderid=$_SESSION['traderid'];
    }

    if(isset($_POST['update_discount'])){
        include "../functions/discountFunctions.php";
        $discount_percentage=$_POST['discount_percentage'];
        $amount=getPrice($productid);
        $discount_amount=$amount-($amount*$discount_percentage)/100;
        if(updateDiscount($discount_percentage,$discount_amount,$productid)==true){
          echo "Data updated successfully";
        }
        else{
          echo "error occured";
        }
    }
?>

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
        <div class="main-form">
        <div class="sideimage">
        <?php
        if(isset($_SESSION['shid'])){
            $shopid=$_SESSION['shid'];
        }
        $query="SELECT * FROM PRODUCT WHERE PRODUCTID=$productid";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
      
        //Taking the row who matches the given username and password
        
        while($row=oci_fetch_assoc($parse)){
    ?>
            <?php echo "<img src=../Images/".$row['IMAGE'].">";?>
        
        </div>
       <form method="POST" action="" enctype="multipart/form-data">
            <div class="forms">

                <label style="margin-left:0;margin-top:0;position:relative;">Discount Percentage</label>
                <input style="margin-top:20px;" type="text" name="discount_percentage" ><br>
                <label style="margin-left:0;margin-top:0;position:relative;">Discount Amount</label>
                <input style="margin-top:20px;" type="text" name="amt" value="<?php if(isset($discount_amount)){echo $discount_amount;} ?>"><br>
                <input style="margin-top:40px;margin-left:25%;height:40px;width:150px;background-color:#07031a;border:none;outline:none;color:white;font-weight:bolder;border-radius:3px;" value="UPDATE DISCOUNT" type="submit" name="update_discount">
            </div>
        </div>
            <div class="forms1">
           
                
                <label>Product Name</label><br>
                <input type="text" name="username" value="<?php echo $row['PRODUCTNAME']; ?>"><br><br>
                <label>Product Description</label><br>
                <input type="text" name="email" value="<?php echo $row['DESCRIPTION']; ?>"><br><br>
                <label>Allergy Info</label><br>
                <input type="text" name="phone" value="<?php echo $row['ALLERGYINFO']; ?>"><br><br>
                <label>Quantity</label><br>
                <input type="text" name="dob" value="<?php echo $row['QUANTITY']; ?>"><br><br>
                <label>Price</label><br>
                <input type="text" name="pwd" value="<?php echo $row['PRICE']; ?>"><br><br>
                <label>Minimum Order</label><br>
                <input type="text" name="confirm_pwd" value="<?php echo $row['MIN_ORDER']; ?>"><br><br>
                <label>MaxiMum Order</label><br>
                <input type="text" name="confirm_pwd" value="<?php echo $row['MAX_ORDER']; ?>"><br><br>
              
                <?php 
                }
            ?>
           
            </div>
        </form>

        
    </div>
 
 
  
</div>

</body>
</html>