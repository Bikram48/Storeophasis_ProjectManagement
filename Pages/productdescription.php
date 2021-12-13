<?php
	include "Navbar.php";	
?>
<?php
	
	include "../backend/connect.php";
?>

<?php
	if(isset($_POST['save'])){
		include "../backend/connect.php";
		$uID=$_POST['uID'];
		$ratedIndex=$_POST['ratedIndex'];
		$ratedIndex++;

		if($uID==0){
			$query="INSERT INTO REVIEW(REVIEWID,REVIEWDATE,REVIEW_DESCRIPTION,RATING,FK1_PRODUCTID,FK2_USERID) VALUES(1,(to_date('01/01/2000','dd/mm/yyyy')),'',$ratedIndex,1,$uID)";
			$parse=oci_parse($connection,$query);
			$result=oci_execute($parse);
			if($result){
				echo "successfully inserted";
			}
			else{
				echo "error occured";
			}

		}
		
	}
?>

<?php
	include "../functions/addcart.php";
	$error=false;
	if(isset($_SESSION['userid'])){
		$userid=$_SESSION['userid'];
	}
	if(isset($_GET['productid'])){
		$productid=$_GET['productid'];
	}

	if(isset($_POST['submit'])){
		$quantity=$_POST['number'];
		if(cartfull($userid)==true){
			echo '<script language="javascript">';
  			echo 'alert("Sorry!! Your cart cannot hold more than 20 items")';
  			echo '</script>';
		}
		else{
			if(!isset($_SESSION['userid'])){
			if(isset($_COOKIE['shopping_cart'])){
				$cookie_data=stripslashes($_COOKIE['shopping_cart']);
				$cart_data=json_decode($cookie_data,true);
			}
			else{
				$cart_data=array();
			}
			$item_id_list=array_column($cart_data,'item_id');
			if(in_array($productid,$item_id_list)){
				foreach($cart_data as $keys=>$values){
					if($cart_data[$keys]['item_id']==$productid){
						echo '<script language="javascript">';
  						echo 'alert("This product is already in cart")';
						  echo '</script>';
						$error=true;
					}
				}
			}
			else{
				$item_array=array('item_id' => $productid, 'item_quantity' => $_POST['number']);
				$cart_data[] = $item_array;
			}

			$item_data=json_encode($cart_data);
			setcookie('shopping_cart',$item_data,time()+(86400*30));
			if($error!==true){
				header("Location:addtocarts.php");
			}
		}
		else{
			if(isset($_SESSION['cart_status'])==false){
				if(checkProduct($productid,$userid)==true){
					echo '<script language="javascript">';
					  echo 'alert("This product is already in cart")';
					  echo '</script>';
				}
				else{
					$query="SELECT * FROM SHOPPING_CART WHERE FK1_USERID=$userid";
					$parse=oci_parse($connection,$query);
					$result=oci_execute($parse);
					$row=oci_fetch_assoc($parse);
					$cartid=$row['SHOPPINGCARTID'];
					if(insertProductCart($quantity,$productid,$cartid)==true){
						header("Location:addtocart.php?productid=".$productid);
					}
				}
			}
			else{
			if(checkProduct($productid,$userid)==true){
				echo '<script language="javascript">';
				  echo 'alert("This product is already in cart")';
				  echo '</script>';
			}
			else{
				$query="SELECT * FROM SHOPPING_CART WHERE FK1_USERID=$userid";
				$parse=oci_parse($connection,$query);
				$result=oci_execute($parse);
				$row=oci_fetch_assoc($parse);
				$cartid=$row['SHOPPINGCARTID'];
				if(insertProductCart($quantity,$productid,$cartid)==true){
					header("Location:addtocarts.php?productid=".$productid);
				}
			}
		}
		}
		}
		
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>
	</title>
	<link rel="stylesheet" href="../CSS/productdescription.css">
	<link rel="stylesheet" href="../script/css/bootstrap.min.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="background-image: linear-gradient(to bottom right , #f7f7f7 , #faeee7);">

	<div class= "container">
			<div class= "row">
				<div class= "col-md-5 col-xl-6 col-sm-12 image-part">
					<?php 
						if(isset($_GET['productid'])){
							$productid=$_GET['productid'];
							$query="SELECT * FROM PRODUCT WHERE PRODUCTID=$productid";
							$parse=oci_parse($connection,$query);
							$result=oci_execute($parse);
						
							while($row=oci_fetch_assoc($parse)){
					?>
					<div class="image">
						<?php echo "<img style=height:350px; class=img-fluid  src=../Images/".$row['IMAGE'].">";?>
					</div>
					
					<?php 
						}}
					?>
					<?php
		if(isset($_POST['review_update'])){
			$rating=$_POST['rating_number'];
			$review=$_POST['review'];
			$query="UPDATE REVIEW SET REVIEW_DESCRIPTION='$review',RATING=$rating WHERE FK1_PRODUCTID=$productid AND FK2_USERID=$userid";
			$parse=oci_parse($connection,$query);
			$result=oci_execute($parse);
		}
	 ?>		
			    </div>

				<div class= "col-md-6 col-xl-5 col-sm-12 description">
					<?php
					
						$query="SELECT * FROM PRODUCT WHERE PRODUCTID=$productid";
						$parse=oci_parse($connection,$query);
						$result=oci_execute($parse);
						while($row=oci_fetch_assoc($parse)){
						
					?>
					<h1><?php echo $row['PRODUCTNAME'];?></h1>
						<?php } ?>
					<?php 
						$query="SELECT AVG(RATING) from REVIEW  where FK1_PRODUCTID=$productid";
						$parse=oci_parse($connection,$query);
						$result=oci_execute($parse);
						while($row=oci_fetch_assoc($parse)){
							$rating=(int)$row['AVG(RATING)'];
						}
							
					?>
					<div class="ratings">
					<?php if($rating==1){ ?>
                    <i style="color:orangered;" class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <?php }elseif($rating==2){ ?>
                    <i style="color:orangered;" class="fas fa-star"></i>
                    <i style="color:orangered;" class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <?php } elseif($rating==3){ ?>
                    <i style="color:orangered;" class="fas fa-star"></i>
                    <i style="color:orangered;" class="fas fa-star"></i>
                    <i style="color:orangered;" class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <?php }elseif($rating==4){?>
                    
                        <i style="color:orangered;" class="fas fa-star"></i>
                        <i style="color:orangered;"  class="fas fa-star"></i>
                        <i style="color:orangered;"  class="fas fa-star"></i>
                        <i style="color:orangered;"  class="fas fa-star"></i>
                        <i style="color:black;" class="fas fa-star"></i>
                        
                    <?php } elseif($rating==5){ ?>
                        <i style="color:orangered;"  class="fas fa-star"></i>
                        <i style="color:orangered;"  class="fas fa-star"></i>
                        <i style="color:orangered;"  class="fas fa-star"></i>
                        <i style="color:orangered;" class="fas fa-star"></i>
                        <i style="color:orangered;" class="fas fa-star"></i>
                    <?php } else{ ?>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                     <?php } ?>
						
					</div>
						
					<?php
					
						$query="SELECT * FROM PRODUCT WHERE PRODUCTID=$productid";
						$parse=oci_parse($connection,$query);
						$result=oci_execute($parse);
						while($row=oci_fetch_assoc($parse)){
						
					?>	
					<p class="product-description"><?php echo $row['DESCRIPTION']; ?>
					</p>
						
					<p class="price"><?php echo "Price: £".$row['PRICE'];?> </p>
					<p class="price"><?php echo "Max Order :  ".$row['MAX_ORDER'];?> </p>
					<p class="price"><?php echo "Min Order :  ".$row['MIN_ORDER'];?> </p>
					<p class="stock"><?php echo "Stock Available :  ".$row['QUANTITY'];?> </p>
					<p class="allergy-info"><?php echo $row['ALLERGYINFO']; ?></p>
					<?php 
						}
					?>
					
					<form action="" method="POST">
						<label for="quantity">Quantity</label>
						<input id="quantity" type="text" name="number" value=1>
						<input class="adding-cart" type="submit" name="submit" value="Add to Cart">
					
					
				
					<!--<div style="margin-top:100px;width:520px;" class="row">
					<div class="profile-reviews tab">
                        <h1>Your Activity</h1>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus voluptate ab odio sapiente quibusdam excepturi animi, 
                         </p>
                    </div>
					</div>	
					-->
				</div>
				
				<div class="col-xl-10 col-lg-10 col-md-10 bar">
					<div class="row">
				<?php
					
					$query="SELECT * FROM PRODUCT WHERE PRODUCTID=$productid";
					$parse=oci_parse($connection,$query);
					$result=oci_execute($parse);
					while($row=oci_fetch_assoc($parse)){
					
				?>
				<div class="col-xl-4 col-md-6 show-image">
						<?php echo "<img style=height:50px; class=img-fluid  src=../Images/".$row['IMAGE'].">";?>
						<?php echo $row['PRODUCTNAME']; ?>
					</div>
					<div class="col-xl-2 col-md-1 price-show">
						 <?php echo "£.".$row['PRICE']; ?>
					</div>
					
				<?php 
					}
				?>
					<div class="col-xl-3 col-md-1  cart-add float-right">
						<input class="addsubmit" type="submit" name="submit" value="Add to Cart">
					</div>
					</form>
					</div>
				</div>
			</div>
			<!--<div class="row rating">
				<i  class="fa fa-star" data-index="0"></i>
				<i class="fa fa-star" data-index="1"></i>
				<i class="fa fa-star" data-index="2"></i>
				<i class="fa fa-star" data-index="3"></i>
				<i  class="fa fa-star" data-index="4"></i>
			</div>
						-->

			
	</div>
	
	<?php
		if(isset($_POST['ask'])){
			include "../backend/connect.php";
			$review_text=$_POST['review_text'];
			$rating=$_POST['rating_star'];
			$query="INSERT INTO REVIEW (REVIEWID,REVIEWDATE,REVIEW_DESCRIPTION,RATING,FK1_PRODUCTID,FK2_USERID) VALUES (REVIEWSEQ.nextval,(to_date(SYSDATE,'dd/mm/yyyy')),'$review_text',$rating,$productid,$userid)";
			$parse=oci_parse($connection,$query);
			$result=oci_execute($parse);
		}
	?>
	 <?php
			$query="select * from REVIEW r, PRODUCT p,USERS u where p.PRODUCTID=$productid and p.PRODUCTID=r.FK1_PRODUCTID and u.USERID=r.FK2_USERID";
			$parse=oci_parse($connection,$query);
			$result=oci_execute($parse);
			$count=0;
			while($row=oci_fetch_assoc($parse)){
					$productname=$row['PRODUCTNAME'];
					$description=$row['REVIEW_DESCRIPTION'];
					$rating=$row['RATING'];
					$image=$row['IMAGE'];
			}	
		?>
	<div class="container comment">
		<div class="comments">
      <h2>Product Review And Rating</h2>
        <form action="" method="POST">
          <textarea name="review_text" placeholder='Give Review'></textarea>
		  <input style="position:absolute;	border:1px solid #ccc;
	font-weight: bold;
	height:33px;
	text-align:center;
	width:30px;
	color:black;" type="number" name="rating_star">
            <div class="btn">
				<?php if(isset($_SESSION['userid'])){ ?>
			  <input type="submit" value="Submit" name="ask">   
				<?php } else{?>
					<a href="Login.php"><input type="button" value="Please Login" > </a>
				<?php }?>  
            </div>
		</form>
		
		<div class="row comment-section">
			<h2>Reviews By Customers</h2>
		</div>
		<div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Edit Review And Rating</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action="" method="POST">
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
				<?php echo "<img style='border-radius:4px;width:100%;height:250px;' class='img-fluid' src=../Images/".$image .">"?>
        </div>

        <div class="md-form mb-5">
          Product Name:<input style="width:60%;border:none;border-bottom:1px solid black;outline:none;margin-left:30px;background:none;" type="text" value="<?php echo $productname; ?>" id="form29">
        
        </div>
		<div class="md-form mb-5">
          Product Rating:<input style="width:60%;border:none;border-bottom:1px solid black;outline:none;margin-left:30px;background:none;" type="text" name="rating_number" value="<?php echo $rating; ?>" id="form29">
        
        </div>
        <div class="md-form">
          <textarea style="outline:none;" type="text" id="form8" class="md-textarea form-control" placeholder="Your Review" rows="4" name="review"><?php echo $description; ?></textarea>
        </div>	
		 <div class="modal-footer d-flex justify-content-center">
					<input type="submit" value="UPDATE REVIEW" name="review_update">
      </div>
	  </form>
      </div>
    
	</div>
	

	
  </div>
</div>
		<?php
			$query="select * from REVIEW r, PRODUCT p,USERS u where p.PRODUCTID=$productid and p.PRODUCTID=r.FK1_PRODUCTID and u.USERID=r.FK2_USERID";
			$parse=oci_parse($connection,$query);
			$result=oci_execute($parse);
			$count=0;
			while($row=oci_fetch_assoc($parse)){
				$count++;
				if($count>=1){
					$username=$row['USERNAME'];	
					$date=$row['REVIEWDATE'];
					$description=$row['REVIEW_DESCRIPTION'];
					$rating=$row['RATING'];
		?>
		<div class="row reviews">
			<div class="col-xl-3 user-image">
				<?php echo "<img width=40 height=40 src=../Images/".$row['PROFILEPICTURE'].">" ?>
				
				<p class="author"><?php echo $username; ?></p>
			</div>
			<div class="col-xl-7">
				<div class="ratings">
					<?php if($rating==1){ ?>
						<i class="fas fa-star"></i>
					<?php } elseif($rating==2){ ?>	
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
					<?php } elseif($rating==3){?>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
					<?php } elseif($rating==4){?>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
					<?php } elseif($rating==5){?>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
					<?php } ?>
						<span style="color:silver; padding-left:20px; font-size:13px; font-weight:bold;" class="posted-date">Posted On: <?php echo $date; ?></span>
				</div>
				<p><?php echo $description; ?></p>
			</div>
			<?php if($userid===$row['FK2_USERID']){ ?>
			<div class="col-xl-2 edit-review">
				<a href="" data-toggle="modal" data-target="#modalContactForm">Edit Review</a><br>
				<form action="productdescription.php">
				<!--<a href="" data-toggle="modal" data-target="#modalContactForm">Delete</a>-->
				
				</form>
			</div>
			<?php } ?>
		</div>
		<hr>
				<?php }} ?>
		
	
		
    </div>
		
	</div>
	
	<?php include "footer.php";?>
	<script src="../JS/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script
  src="http://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script src="../script/js/Faq.js"></script>
	
</html>