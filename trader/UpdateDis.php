<?php
    session_start();
    include "../backend/connect.php";
     if(isset($_GET['productid'])){
        $productid=$_GET['productid'];
    }
    if(isset($_SESSION['traderid'])){
        $traderid=$_SESSION['traderid'];
      }
      if(isset($_POST['discount'])){
        include "../functions/discountFunctions.php";
        $discount_percentage=$_POST['discount_percentage'];
        $amount=getPrice($productid);
        $discount_amount=$amount-($amount*$discount_percentage)/100;
        if(insertData($discount_percentage,$discount_amount,$traderid,$productid)==true){
            $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Discount is added to the product!!</div>';
            echo $result;
        }
        else{
          echo "error occured";
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

    <link rel="stylesheet" href="assets/css/UpdateDis.css">

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
                    <a class="navbar-brand" href="#">Add Discount</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="">
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
                    <div class="form-group">
                        <div class="col-sm-8">
                            <label class="control-label small" for="file_img">Product Name:</label>
                                 <input type="text" class="form-control" name="name" value="<?php echo $row['PRODUCTNAME']; ?>" id="name" placeholder="Enter Here">
                        </div>
                    </div> <!-- form-group // -->
                    <div class="form-group">
                        <div class="col-sm-8">
                            <label class="control-label small" for="file_img">Product Description:</label>
                            <textarea class="form-control"><?php echo $row['DESCRIPTION']; ?></textarea>
                        </div>
                    </div> <!-- form-group // -->
                    <div class="form-group">
                            <div class="col-sm-8">
                                <label class="control-label small" for="file_img">Allergy Info:</label>
                                <textarea class="form-control"><?php echo $row['ALLERGYINFO']; ?></textarea>
                    </div>
                </div> <!-- form-group // -->
                <div class="form-group">
                         <div class="col-sm-8">
                             <label class="control-label small" for="file_img">Quantity:</label>
                             <select class="form-control">
	                                <option value="">--Select--</option>
	                                <option value="texnolog2">1</option>
                                    <option value="texnolog3">2</option>
                                    <option value="texnolog2">3</option>
                                    <option value="texnolog3">4</option>
                                    <option value="texnolog2">5</option>
                                    <option value="texnolog2">6</option>
                                    <option value="texnolog3">7</option>
                                    <option value="texnolog2">8</option>
                                    <option value="texnolog3">9</option>
                                    <option value="texnolog2">10</option>
                            </select>
                        </div>
                </div> <!-- form-group // -->
               
                <div class="form-group">
                        <div class="col-sm-8">
                            <label class="control-label small" for="file_img">Price:</label>
                                 <input type="text" class="form-control" name="name" id="name" value="<?php echo $row['PRICE']; ?>" placeholder="Enter Here">
                        </div>
                    </div> <!-- form-group // -->

                    <div class="form-group">
                        <div class="col-sm-8">
                            <label class="control-label small" for="file_img">Minimum Order:</label>
                                 <input type="text" class="form-control" name="name" id="name" value="<?php echo $row['MIN_ORDER']; ?>" placeholder="Enter Here">
                        </div>
                    </div> <!-- form-group // -->

                    <div class="form-group">
                        <div class="col-sm-8">
                            <label class="control-label small" for="file_img">Maximum Order:</label>
                                 <input type="text" class="form-control" name="name" id="name" value="<?php echo $row['MAX_ORDER']; ?>" placeholder="Enter Here">
                        </div>
                    </div> <!-- form-group // -->

            
        <?php } ?>   
              
  
</div><!-- panel-body // -->
</section><!-- panel// -->
<form method="POST" action="" enctype="multipart/form-data">
<section class="Image-sec">
        <div id="viewprofile">
	            
		        <div class="cell small-4 medium-4 large-4">
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

                        <?php echo "<img class='thumbnail hundred1' src=../Images/".$row['IMAGE']." style=height:250px; width:250px; border:1px solid white;>"?>
                        <br/>
                       
        <?php } ?>
                        <table>
  <thead>
    <tr>
      <th>Shop Details</th>

    </tr>
  </thead>
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
  <tbody>
    <tr>
      <td data-column="Discount Per">Discount Percentage:</td>
      <td data-column=""><input type="text" class="form-control" name="discount_percentage" id="name" placeholder="" required></td>
    </tr>
    <tr>
      <td data-column="Shop Name">Discount Amount:</td>
      <td data-column="">
      <input type="text" class="form-control" name="amt" id="name" value="<?php if(isset($discount_amount)){echo $discount_amount;} ?>" placeholder=""></td>
    
    </tr>

        

  </tbody>
        <?php } ?>
</table>
<div class="form-group">
                    <div class="col-sm-3 col-sm-9">
                    <div class="btn btn-one">
                    <span> <input style="background:none;border:none;" type="submit" name="discount" value="Add Discount"> </span>
                </div>
                    </div>
                </div> <!-- form-group // -->
		    	</div>
		</div>
        </section>
    </form>

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
