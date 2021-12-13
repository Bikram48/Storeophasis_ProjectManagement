<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="../CSS/Login.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../script/css/bootstrap.min.css">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	
</head>
<body>
<?php
	session_start();
	
	include "../backend/connect.php";
	if(isset($_POST['submit'])){
		$username=$_POST['username'];
		$password=$_POST['password'];
		$newpassword=md5($password);

		$error1=$error2=$error3="";
		if(empty($username)){
			$error1.="Username is required";
		}
		elseif(empty($password)){
			$error2.="Password is required";
		}
		else{
			 //Query to match the username and password
			 $query="SELECT * FROM USERS WHERE USERNAME= '$username' AND PASSWORD = '$newpassword'";
			 //preparing to execute query
			 $parse=oci_parse($connection,$query);
			 //Executing
			 $result=oci_execute($parse);
			 $row=oci_fetch_array($parse,OCI_ASSOC);
			 //Taking the row who matches the given username and password
			 $count=oci_num_rows($parse);
			 if($row['ISVERIFIED']=='Y'){
			if($count==1){
				
				$_SESSION['userid']=$row['USERID'];
				$userid=$_SESSION['userid'];
				$_SESSION['emailid']=$row['EMAIL'];
				$status=false;
				$error=false;
				$_SESSION['cart_status']=$status;
				$_SESSION['customername']=$username;
				if(isset($_COOKIE['shopping_cart'])){
					include "../functions/addcart.php";
					$cookie_data=stripslashes($_COOKIE['shopping_cart']);
					$cart_data=json_decode($cookie_data,true);
					foreach($cart_data as $keys => $values){
						$item_data= $values['item_id'];
						$item_quantity=$values['item_quantity'];
						if(insertData($userid)){
							$status=true;
						}
						$query="SELECT * FROM SHOPPING_CART WHERE FK1_USERID=$userid";
                    	$parse=oci_parse($connection,$query);
                    	$result=oci_execute($parse);
                    	$row=oci_fetch_assoc($parse);
						$cartid=$row['SHOPPINGCARTID'];
						$_SESSION['cartsid']=$row['SHOPPINGCARTID'];

						$qry="SELECT * FROM CART_PRODUCT__DETAIL WHERE FK2_SHOPPINGCARTID=$cartid";
						$prse=oci_parse($connection,$qry);
						$rslt=oci_execute($prse);
						while($rows=oci_fetch_assoc($prse)){
							$productid=$rows['FK1_PRODUCTID'];
							if($item_data==$productid){
								$error=true;
							}
						}

						
						if($error==false){
							insertProductCart($item_quantity,$item_data,$cartid);
						}
					
					}
					setcookie("shopping_cart", "", time() - 3600);
					
				}

				header("Location:index1.php");
			}
			
				
			}
			elseif($row['ISVERIFIED']=='D'){
			?>
			 <div style="width:80%;margin-left:10%;height:60px;text-align:center;font-size:20px;font-weight:bolder;" class="alert alert-dark alert-dismissible fade show" role="alert">
                Sorry!! Your account is deactivated by the admin..
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
			<?php
			}
			else{
				$error3="Username doesnot exist or Password doesnot match";
			}
		}
	}
?>

	<img class="wave" src="../Images/3.png">
	<div class="container">
	<!-- <img src="Images/Logo2.png"> -->
		<div class="img">
			<img src="../Images/1.svg">
		</div>
		<div class="login-content">
			<form action="Login.php" method="post">
				<img src="../Images/2.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username Or Email</h5>
           		   		<input  type="text" name="username" class="input" value="<?php if(isset($username)){echo $username;}?>"><br><br>
							  <span style="font-size:11px;color:red;font-weight:bold;font-family: 'Playfair Display', serif;"><?php if(isset($error1)){echo $error1;}; if(isset($error3)){echo $error3;};?></span>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" name="password" class="input" ><br><br>
						   <span style="font-size:11px;color:red;font-weight:bold;font-family: 'Playfair Display', serif;"><?php if(isset($error2)){echo $error2;};?></span>
            	   </div>
            	</div>
            	<br>
            	<input type="submit" name="submit" class="btn" value="Login">
                <a href="customerSignup.php">Don't Have An Account?</a>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../JS/Login.js"></script>
</body>
</html>