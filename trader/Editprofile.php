<?php
  session_start();
  include "../functions/countProduct.php";
  if(isset($_SESSION['traderid'])){
    $traderid=$_SESSION['traderid'];
    }
    if(isset($_SESSION['shid'])){
        $shopid=$_SESSION['shid'];
    }
?>
<?php
    //Checks if trader clicks the image upload button
    if(isset($_POST['img_submit'])){
        $file=false;
        //taking the information of uploaded image
        $logo=$_FILES['logo']['name'];
        $tmpname=$_FILES['logo']['tmp_name'];
        $source="../Images/".$logo;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimetype = finfo_file($finfo, $_FILES['logo']['tmp_name']);
        //checks if trader uploaded the wrong file in system
        if($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/gif' || $mimetype == 'image/png'){
            $file=true;
        }
        else{
            $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Only image format file are supported</div>';
            echo $result;
            $file=false;
        }
        //if there is no error logo will be updated
        if($file=true){
            include "../functions/updateTrader.php";
            move_uploaded_file($tmpname,$source);
            if(updateProfile($shopid,$logo)==true){
                $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Logo has changed successfully</div>';
                echo $result;
            }
        }

    }

    //check if trader click the shop updated button
    if(isset($_POST['shop-update'])){
        include "../functions/updateTrader.php";
        $shopname=$_POST['shopname'];
        $shopcategory=$_POST['shopcategory'];
        $shopdescription=trim($_POST['description']);
        //updating the details of shop
        if(updateShop($shopid,$shopname,$shopcategory,$shopdescription)==true){
            $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Shop has been updated successfully</div>';
            echo $result;
        }

    }

    //check if trader clicks the account update button
    if(isset($_POST['update'])){
        //patterns to check while updating password
        $pattern_password='/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';
        $username=$_POST['username'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $dob=$_POST['dob'];
        $pwd=$_POST['pwd'];
        $password=md5($pwd);
        $confirm_pwd=$_POST['confirm_pwd'];
        $error=false;
            include "../functions/updateTrader.php";
            //if there is any value on password field belows line will be executed
            if(isset($pwd)){
                if($pwd!==$confirm_pwd){
                    $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Password doesnot match</div>';
                    echo $result;
                    $error=true;
                }
                //checking for the patterns
                if(!preg_match($pattern_password,$pwd)){
                    $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Strong password needed</div>';
                    echo $result;
                    $error=true;
                }
            }
            //if there is no any error then the account will be updated
            if($error==false){
            if(updateTraderAccount($traderid,$username,$email,$phone,$dob,$password)){
                $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Account has been updated successfully</div>';
                echo $result;
            
            }
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>View Profile</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <link href="assets/css/demo.css" rel="stylesheet" />

    <link rel="stylesheet" href="assets/css/Editprofile.css">

    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>
<?php
    if(isset($_GET['success'])){
        $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Account updated successfully</div>';
        echo $result;
      }
?>
<div class="wrapper">
    <div class="sidebar" data-color="brown" data-image="assets/img/sidebar-2.jpg">


    	<div class="sidebar-wrapper">
            <div class="logo">
                <img src="Images/Logo2.png" style="width:80%;">
            </div>

            <ul class="nav">
                <li >
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="active">
                    <a href="ViewProducts.php">
                        <i class="pe-7s-user"></i>
                        <p>View Profile</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="pe-7s-menu"></i>
                        <p>View Products</p>
                    </a>
                </li>
                <li>
                    <a href="AddProducts.php">
                        <i class="pe-7s-plus"></i>
                        <p>Add products</p>
                    </a>
                </li>

                <li>
                    <a href="allproducts.php">
                        <i class="pe-7s-note2"></i>
                        <p>All products</p>
                    </a>
                </li>

                <li>
                    <a href="vieworder.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Orders</p>
                    </a>
                </li>

                <li>
                    <a href="ViewDiscount.php">
                        <i class="pe-7s-graph1"></i>
                        <p>View Discount</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">View Profile</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="../pages/logout.php">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>


       
        <section class="panel panel-default">
            <div class="panel-body">
                <form method="POST" action="" enctype="multipart/form-data" class="form-horizontal" role="form">
                <?php
        
                $query="SELECT * FROM USERS WHERE USERID=$traderid";
                $parse=oci_parse($connection,$query);
                $result=oci_execute($parse);
      
                //Taking the row who matches the given username and password
                while($row=oci_fetch_assoc($parse)){
            ?>
                    <div class="form-group">
                        <div class="col-sm-8">
                            <label class="control-label small" for="file_img">USERNAME:</label>
                                 <input type="text" class="form-control" name="username" value="<?php echo $row['USERNAME']; ?>" id="name" placeholder="Enter Here">
                        </div>
                    </div> <!-- form-group // -->
                    <div class="form-group">
                        <div class="col-sm-8">
                            <label class="control-label small" for="file_img">EMAIL:</label>
                                    <input type="text" class="form-control" name="email" id="name"  value="<?php echo $row['EMAIL']; ?>" placeholder="Enter Here">
                        </div>
                    </div> <!-- form-group // -->
                    <div class="form-group">
                            <div class="col-sm-8">
                                <label class="control-label small" for="file_img">PHONE NUMBER:</label>
                                <input type="text" class="form-control" name="phone" id="name" value="<?php echo $row['PHONENUMBER']; ?>" placeholder="Enter Here">
                    </div>
                </div> <!-- form-group // -->
                <div class="form-group">
                         <div class="col-sm-8">
                             <label class="control-label small" for="file_img">DATE OF BIRTH:</label>
                                <input type="text" class="form-control" name="dob" id="name" value="<?php echo $row['DATEOFBIRTH']; ?>" placeholder="Enter Here">
                        </div>
                </div> <!-- form-group // -->
                <div class="form-group">
                        <div class="col-sm-8">
                                <label class="control-label small" for="file_img">PASSWORD:</label>
                                     <input type="Password" class="form-control" name="pwd" id="name"  value="<?php echo $row['PASSWORD']; ?>" placeholder="Enter Here">
                        </div>
                </div> <!-- form-group // -->


                <div class="form-group">
                         <div class="col-sm-8">
                                <label class="control-label small" for="file_img">CONFORM PASSWORD:</label>
                                <input type="password" class="form-control"  id="name"  value="<?php echo $row['PASSWORD']; ?>" name="confirm_pwd" placeholder="Enter Here">
                         </div>
                </div> <!-- form-group // -->

                <hr>
                <?php 
                    }
                ?>
                <div class="form-group">
                    <div class="col-sm-3 col-sm-9">
                    <div class="btn btn-one">
                   <input style="background:none;border:none;" type="submit" name="update" value="UPDATE ACCOUNT">
                </div>
                    </div>
                </div> <!-- form-group // -->
                </form>
  
</div><!-- panel-body // -->
</section><!-- panel// -->

<section class="Image-sec">
<?php
      
        $query="SELECT * FROM SHOP WHERE SHOPID=$shopid";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
      
        //Taking the row who matches the given username and password
        
        while($row=oci_fetch_assoc($parse)){
    ?>
        <div id="viewprofile">
	            
		        <div class="cell small-4 medium-4 large-4">
                <?php //echo "<img src=../Images/".$row['SHOPLOGO'].">";?>
                        <?php echo "<img style='height:250px; width:250px; border:1px solid white; class='thumbnail hundred1' src=../Images/".$row['SHOPLOGO'].">"?>
                       
                        <form action="" method="POST" name="image-submit" enctype="multipart/form-data" >
                        <label style="cursor:pointer;" for="file"> Change Logo <i class="fas fa-cloud-upload-alt file-icon"></i></label>
                        <input style="display:none;" name="logo" type="file" id="file">
                        <input type="submit" name="img_submit" value="Upload">
                        </form>
                        <br/><br/>
                        <form action="" method="POST"  enctype="multipart/form-data" >
                        <table>
  <thead>
    <tr>
      <th>Shop Details</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <td data-column="Shop Description">Shop Description</td>
      <td data-column=""><input type="text" class="form-control" name="description" id="name"  value="<?php echo $row['SHOPDESCRIPTION']; ?>" placeholder=""></td>
    </tr>
    <tr>
      <td data-column="Shop Name">Shop Name</td>
      <td data-column=""><input type="text" class="form-control" name="shopname" id="name" value="<?php echo $row['SHOPNAME']; ?>" placeholder=""></td>
    </tr>
    <tr>
      <td data-column="Shop Category">Shop Category</td>
      <td data-column=""><input type="text" class="form-control" name="shopcategory" id="name" value="<?php echo $row['SHOPCATEGORY']; ?>" placeholder=""></td>
    </tr>
  </tbody>
</table>


		    	</div>
		</div>
      
        <div style="position:relative;left:25%;" class="form-group">
                    <div class="col-sm-3 col-sm-9">
                    <div class="btn btn-one">
                   <input style="background:none;border:none;" type="submit" name="shop-update" value="UPDATE SHOP">
                </div>
                    </div>
                </div> <!-- form-group // -->
                </form>
                <?php } ?>
        </section>
      
</div>
</div>

        <footer class="footer">
            <div class="container-fluid">
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> storeophasis
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<script src="assets/js/demo.js"></script>


</html>
