
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Responsive Side Navigation Bar</title>
  
    <link rel="stylesheet" href="../css/traderdashboard.css">
    
	
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
          <li><a href="#">
          <span class="icon"><i class="fas fa-layer-group"></i></span>
          <span class="title">Stock levels</span>
          </a></li>
    </ul>
  </div>
  
  <div class="main_container">
  <h1>Edit Product Form</h1>
      <div class="edit">
        <?php
            if(isset($_GET['productId'])){
                include "../backend/connect.php";
                $product_id=$_GET['productId'];
                $query="SELECT * FROM PRODUCT WHERE PRODUCTID=$product_id";  
                $parse=oci_parse($connection,$query);
                $result=oci_execute($parse);
                while($row=oci_fetch_assoc($parse)){
        ?>
        <div class="image">
                <?php echo "<img style=width:100%;height:300px;  src=../Images/".$row['IMAGE'].">"?>
          </div>
        <form method="POST" action=""  enctype="multipart/form-data">
            <label for="image" style="margin-top:45px;" >Image </label>
            <input style="margin-top:45px; margin-left:40px;" type="file" id="image" name="image" ><br>
            <label for="pname">Product name</label>
            <input type="text" id="pname" name="pname" value=<?php echo $row['PRODUCTNAME']?> require><br>
            <label for="price">Price</label>
            <input type="text" id="price" name="price" value=<?php echo $row['PRICE']?> require><br>
            <label for="min">Minimum order</label>
            <input type="text" id="min" name="min" value=<?php echo $row['MIN_ORDER']?> require><br>
            <label for="max">Maximum order</label>
            <input type="text" id="max" name="max" value=<?php echo $row['MAX_ORDER']?> require><br>
            <div class="right-form">
            <label for="description">Description</label>
            <textarea value=<?php echo $row['DESCRIPTION']?> name="description" id="description" cols="27" rows="4" require>
              <?php echo $row['DESCRIPTION']?>
            </textarea><br>
            <label for="quantity">Quantity</label>
            <div class="dropdown dropdown-dark">
            
                <select id="quantity" name="quantity" class="dropdown-select" require>
                <option value="">Select…</option>
                    <?php for($i=0;$i<=100;$i++){ 
                        echo "<option value=".$i.">".$i."</option>";
                      } ?>
                    <option value=<?php $i; ?>><?php echo $i;?></option>
                </select>
            </div><br>
            

            <label  for="allergy_info">Allergy Information</label>
            <textarea name="allergy_info"   id="allergy_info" cols="27" rows="4" require><?php echo $row['ALLERGYINFO']?></textarea><br>
            </div>
            <!--
            <label for="image" style="margin-top:45px;" >Image </label>
            <input style="margin-top:45px; margin-left:40px;" type="file" id="image" name="image" ><br>
            -->
            <?php } }?>
            <input type="submit" value="Update Product" name="submit">
        </form>
      </div>
    </div>
  </div>
</div>
    <?php
    
        if(isset($_POST['submit'])){
            include "../backend/connect.php";
            
        $product_name=$_POST['pname'];
        $price=$_POST['price'];
        $minimum_order=$_POST['min'];
        $maximum_order=$_POST['max'];
        $description=$_POST['description'];
        $quantity=$_POST['quantity'];
        $allergy_info=$_POST['allergy_info'];
        
      
            $filename=$_FILES['image']['name'];
            $tmpfilename=$_FILES['image']['tmp_name'];
            $source="../customer_images/".$filename;
            move_uploaded_file($tmpfilename,$source);
        
        $query="UPDATE PRODUCT 
                SET PRODUCTNAME='$product_name', DESCRIPTION='$description',PRICE=$price,QUANTITY=$quantity,MIN_ORDER=$minimum_order,MAX_ORDER=$maximum_order,IMAGE='$filename',ALLERGYINFO='$allergy_info'
                WHERE PRODUCTID=$product_id";

            $parse=oci_parse($connection,$query);
            $result=oci_execute($parse);
        }
    
    ?>
<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function(){
			$(".hamburger").click(function(){
			   $(".wrapper").toggleClass("collapse");
			});
		});
	</script>
</body>
</html>