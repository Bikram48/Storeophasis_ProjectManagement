<?php session_start(); include "../backend/connect.php"; ?>
<?php 
if(isset($_SESSION['slotname'])&&isset($_SESSION['slotTime'])&&isset($_SESSION['slotdate'])&&isset($_SESSION['day'])){
    $slotname=$_SESSION['slotname'];
    $slotTime=$_SESSION['slotTime'];
    $slotdate=$_SESSION['slotdate'];
    $slotday=$_SESSION['day'];
}

    if(isset($_SESSION['transaction_id'])&& isset($_SESSION['payment_gross'])&&$_SESSION['currency_code']){
        $txn_id=$_SESSION['transaction_id'];
        $gross=$_SESSION['payment_gross'];
        $code=$_SESSION['currency_code'];
        $query="SELECT * FROM ORDERS WHERE FK2_INVOICENUMBER='$txn_id'";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        $row=oci_fetch_assoc($parse);
        $orderdate=$row['ORDERDATE'];
    }
     if(isset($_SESSION['shid'])){ $shopid=$_SESSION['shid']; }
    if(isset($_SESSION['allshops'])){
       if(in_array($shopid,$_SESSION['allshops'])==1){
          
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

    <link rel="stylesheet" href="assets/css/vieworder.css">

    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>
<?php 

  if(isset($_GET['success'])){
    $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Product has been deleted successfully</div>';
    echo $result;
  }

?>
<div class="wrapper">
    
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
                    <a class="navbar-brand" href="#">View Products</a>
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
  <label class="product-image">Customer Name</label>
  <label class="product-details">Order Date</label>
  <label class="product-price">Collection Date</label>
  <label class="product-min">Quantity</label>
  <label class="product-max">Payment Status</label>
  <label class="product-discount">Total </label>
  <label class="product-removal">Action</label>
  
</div>
<?php 
     if(isset($_SESSION['shid'])){ $shopid=$_SESSION['shid']; 
        $query="select * from PAYMENT,ORDER O where TRADERID=$shopid";  
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
  <div class="product-min"><div class="min"><?php echo $row['MIN_ORDER']; ?></div></div>
  <div class="product-max"><div class="max"><?php echo $row['MAX_ORDER']; ?></div></div>
  <div class="product-discount"><div class="discount">10</div></div>
  <div class="product-total"><div class="total"></div></div>
  <div class="product-removal"><br>
  <?php
    echo "<a href=../backend/deleteproduct.php?productId=".$row['PRODUCTID'].">"?>
    <button class="remove-product">
    <i class="fas fa-trash-alt"></i> Remove
    </button>
<?php echo "</a>"?>
    <button class="remove-product">
    <i class="far fa-edit"></i> Edit
    </button>
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
