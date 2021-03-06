<?php
    session_start();
    include "../backend/connect.php";
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    if(isset($_SESSION['traderid'])){
        $traderid=$_SESSION['traderid'];
    }
    if(isset($_SESSION['shid'])){
      $shopid=$_SESSION['shid'];
  }
    if(isset($_POST['submit'])){
 
      $shopname=$_POST['shopname'];
      $address=$_POST['address'];
      $description=$_POST['description'];
      $category=$_POST['category'];
      $filename=$_FILES['logo']['name'];
      $tmpfilename=$_FILES['logo']['tmp_name'];
      $source="../Images/".$filename;

      $query="SELECT * FROM SHOP WHERE FK1_USERID=$traderid";
      $parse=oci_parse($connection,$query);
      $result=oci_execute($parse);
      $row=oci_fetch_assoc($parse);
      $count=oci_num_rows($parse);
      $shop_category=$row['SHOPCATEGORY'];
    
      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $mimetype = finfo_file($finfo, $_FILES['logo']['tmp_name']);
      //checks if trader uploaded the wrong file in system
      /*
      */
      if($category!==$shop_category){
        $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Invalid shop category.</div>';
        echo $result;
      }
       else {
        include "../functions/trader_function.php";
        /*$file=false;
        if($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/gif' || $mimetype == 'image/png'){
          $file=true;
        }
        elseif($file=false){
          $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Only image format file are supported</div>';
          echo $result;
        }
        */
        $query="SELECT SHOPNAME FROM SHOP WHERE FK1_USERID=$traderid";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        $row=oci_fetch_assoc($parse);
     
        if($shopname===$row['SHOPNAME']){
          $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Cant allow duplicate shopname</div>';
          echo $result;
        }
        else{
        if(addShop($shopid,$shopname,$address,$description,$category,$filename,$traderid)==true){
          $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Shop is added!!</div>';
          echo $result;
        }
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

	<title>Add Products</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <link href="assets/css/demo.css" rel="stylesheet" />

    <link rel="stylesheet" href="assets/css/AddShop.css">

    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="brown" data-image="assets/img/sidebar-2.jpg">


    	<div class="sidebar-wrapper">
            <div class="logo">
                <img src="Images/Logo2.png" style="width:80%;">
            </div>

            <ul class="nav">
            <li>
                    <a href="ShopList.php">
                        <i class="pe-7s-note2"></i>
                        <p>Shop List</p>
                    </a>
                </li>
                
                <li class="active">
                    <a href="#">
                        <i class="pe-7s-plus"></i>
                        <p>Add Shop</p>
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
                    <a class="navbar-brand" href="#">Add Shop</a>
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

        <div class="container">
  
  <section class="panel panel-default">

<div class="panel-body">
  
<form action="" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" >

   <div class="form-group">
    <label for="name" class="col-sm-3 control-label">Shop Name:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="shopname" id="name" placeholder="Enter SHop Name Here" required>
    </div>
  </div> <!-- form-group // -->
  <div class="form-group">
    <label for="name" class="col-sm-3 control-label">Shop Address:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="address" id="name" placeholder="Enter Address Here" required>
    </div>
  </div> <!-- form-group // -->

  <div class="form-group">
    <label for="about" class="col-sm-3 control-label">Description:</label>
    <div class="col-sm-5">
      <textarea name="description" class="form-control" required></textarea>
    </div>
  </div> <!-- form-group // -->

  <div class="form-group">
    <label for="tech" class="col-sm-3 control-label">Category:</label>
    <div class="col-sm-3">
   <select name="category" class="form-control" required>
	<option value="">--Select Category--</option>
	<option value="Bakery">Bakery</option>
	<option value="Butcher">Butchers</option>
    <option value="Greengrocer">Greengrocer</option>
	<option value="Delicatessen">Delicatessen</option>
    <option value="Fishmonger">Fishmonger</option>
   </select>
    </div>
  </div> <!-- form-group // -->
  
  <div class="form-group">
    <label for="name" class="col-sm-3 control-label">Shop Logo:</label>
    <div class="col-sm-3">
      <label class="control-label small" for="file_img">Only (jpg/png):</label> <input type="file" name="logo" style="border:none;" required>
    </div>
  </div> <!-- form-group // -->
  
  <hr>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <div class="btn btn-one">
    <input style="border:none;" type="submit" name="submit" value="Add Shop">
  </div>
    </div>
  </div> <!-- form-group // -->
</form>
  
</div><!-- panel-body // -->
</section><!-- panel// -->


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

	<!-- <script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-gift',
            	message: "Welcome to the trader!"

            },{
                type: 'info',
                timer: 1000
            });

    	});
	</script> -->

</html>
