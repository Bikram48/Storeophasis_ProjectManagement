<?php
  session_start();
  include "../functions/countProduct.php";
  if(isset($_GET['sid'])){
    $sid=$_GET['sid'];
    $_SESSION['shid']=$sid;
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


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>
<?php 

  if(isset($_GET['success'])){
    $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Product has been inserted successfully</div>';
    echo $result;
  }

?>
<div class="wrapper">
    <div class="sidebar" data-color="brown" data-image="assets/img/sidebar-5.jpg">


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
                <li>
                    <a href="Editprofile.php">
                        <i class="pe-7s-user"></i>
                        <p>View Profile</p>
                    </a>
                </li>
                <li>
                    <a href="ViewProducts.php">
                        <i class="pe-7s-menu"></i>
                        <p>View Products</p>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
                        <i class="pe-7s-plus"></i>
                        <p>Add products</p>
                    </a>
                </li>

                <li>
                    <a href="#">
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
                    <a class="navbar-brand" href="#">Trader Dashboard</a>
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
<div class="panel-heading"> 
<h3 class="panel-title">Add products</h3> 
</div> 
<div class="panel-body">
  
<form method="POST" action="../backend/addproductbackend.php"  enctype="multipart/form-data" class="form-horizontal" role="form">

   <div class="form-group">
    <label for="name" class="col-sm-3 control-label">Product Name</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="pname" id="name" placeholder="Enter Product Name Here" required>
    </div>
  </div> <!-- form-group // -->
  <div class="form-group">
    <label for="name" class="col-sm-3 control-label">Price</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" name="price" id="name" placeholder="Enter Price Here" required>
    </div>
  </div> <!-- form-group // -->

  <div class="form-group">
    <label class="col-sm-3 control-label">Order</label>
    <div class="col-sm-3"> 
	  <label class="control-label small" for="date_start">Minimum: </label>
	  <input type="text" class="form-control" name="min" id="date_start" placeholder="Enter Here" required>
    </div>
	<div class="col-sm-3">   
	  <label class="control-label small" for="date_finish">Maximum:</label>
	  <input type="text" class="form-control" name="max" id="date_finish" placeholder="Enter Here" required>
    </div>
  </div> <!-- form-group // -->
  <div class="form-group">
    <label for="about" class="col-sm-3 control-label">Description</label>
    <div class="col-sm-7">
      <textarea name="description" class="form-control" required></textarea>
    </div>
  </div> <!-- form-group // -->

  <div class="form-group">
    <label for="tech" class="col-sm-3 control-label">Quantity</label>
    <div class="col-sm-3">
   <select class="form-control" name="quantity" required>
	<option value="">select</option>
	<option value="">Select…</option>
                <?php for($i=0;$i<=1000;$i++){ 
                        echo "<option value=".$i.">".$i."</option>";
                      } ?>
                    <option value=<?php $i; ?>><?php echo $i;?></option>
   </select>
    </div>
  </div> <!-- form-group // -->
  <div class="form-group">
    <label for="qty" class="col-sm-3 control-label">Allergy Information</label>
    <div class="col-sm-7">
      <textarea  name="allergy_info" class="form-control" required></textarea>
    </div>
  </div> <!-- form-group // -->
  
  <div class="form-group">
    <label for="name" class="col-sm-3 control-label" required>Choose Image</label>
    <div class="col-sm-3">
      <label class="control-label small" for="file_img">Only (jpg/png):</label> <input type="file" name="image">
    </div>
  </div> <!-- form-group // -->
  
  <hr>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button name="submit" type="submit" class="btn btn-primary">Add Product</button>
    </div>
  </div> <!-- form-group // -->
</form>
  
</div><!-- panel-body // -->
</section><!-- panel// -->

  
</div> <!-- container// -->

        </div></div>
        
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

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

</html>
