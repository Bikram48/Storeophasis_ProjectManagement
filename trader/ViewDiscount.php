<?php session_start(); include "../backend/connect.php"; ?>
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

    <link rel="stylesheet" href="assets/css/viewdiscount.css">

    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>
<?php 

  if(isset($_GET['success'])){
    $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Product with discount has been deleted successfully</div>';
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
                <li>
                    <a href="#">
                    <i class="pe-7s-plus"></i>
                        <p>Add products</p>
                    </a>
                </li>

                <li class="active">
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
                    <a href="ViewDiscount.php" active>
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
                    <a class="navbar-brand" href="#">View Discount</a>
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


        <div class="shopping-cart">

<div class="column-labels">
  <label class="product-image">Image</label>
  <label class="product-details">Product</label>
  <label class="product-price">Price</label>
  <label class="product-quantity">Quantity</label>
  <label class="product-discount">Discount Percentage</label>
  <label class="product-total">Total Amount</label>
  <label class="product-removal">Action</label>
  
</div>
<?php  
    
    if(isset($_SESSION['traderid'])){
        $traderid=$_SESSION['traderid'];
      }
    if(isset($_SESSION['shid'])){ 
            $shopid=$_SESSION['shid']; 
            //SELECT * FROM product p LEFT JOIN discount d ON p.product_id=d.product_id where p.trader_id=$uid
            $query="select * from PRODUCT P LEFT JOIN DISCOUNT D ON P.PRODUCTID=D.FK2_PRODUCTID where D.FK1_USERID=$traderid";  
          $parse=oci_parse($connection,$query);
          $result=oci_execute($parse);
         while($row=oci_fetch_assoc($parse)){
    ?>
<div class="product">
  
  <div class="product-image">
    <?php echo "<img src=../Images/".$row['IMAGE'].">";?>
  </div>

  <div class="product-details">
    <div class="product-title"><?php echo $row['PRODUCTNAME']; ?></div>
  </div>

  <div class="product-price"><div class="price"><?php echo $row['PRICE']; ?></div></div>

  <div class="product-quantity">
  <div class="qty"><?php echo $row['QUANTITY']; ?></div>
  </div>
  <div class="product-min"><div class="min"><?php echo $row['DISCOUNTPERCENTAGE']; ?></div></div>
  <div class="product-max"><div class="max"><?php echo $row['DISCOUNTAMOUNT']; ?></div></div>

  <div style="margin-left:100px;" class="product-removal"><br>
  <?php
    echo "<a href=../backend/deletediscount.php?productId=".$row['PRODUCTID'].">"?>
    <button class="remove-product">
    <i class="fas fa-trash-alt"></i> Remove
    </button>
<?php echo "</a>"?>
    <?php  echo "<a href=editdiscount.php?productId=".$row['PRODUCTID'].">" ?>
    <button class="remove-product">
    <i class="far fa-edit"></i> Edit
    </button>
    <?php echo "</a>" ?>
  </div>
    
</div>
<?php
      } }
?>  

</div>


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
