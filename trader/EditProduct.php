<?php error_reporting(E_ERROR | E_PARSE); ?>
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

    <link rel="stylesheet" href="assets/css/EditProduct.css">

    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>
<?php
  include "../backend/connect.php";
 if(isset($_GET['productId'])){
    $product_id=$_GET['productId'];
 }
    if(isset($_POST['product_update'])){
      
        
    $product_name=$_POST['pname'];
    $price=$_POST['price'];
    $minimum_order=$_POST['min'];
    $maximum_order=$_POST['max'];
  
    $query="UPDATE PRODUCT 
            SET PRODUCTNAME='$product_name', PRICE=$price,MIN_ORDER=$minimum_order,MAX_ORDER=$maximum_order
            WHERE PRODUCTID=$product_id";

        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
            $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Product has been updated successfully </div>';
            echo $result;
        }
    }

   
    if(isset($_POST['submit-data'])){
$allergy=$_POST['allergy_information'];
$description=$_POST['description'];
$quantity=$_POST['quantity'];

$query="UPDATE PRODUCT 
SET DESCRIPTION='$description',ALLERGYINFO='$allergy',QUANTITY=$quantity
WHERE PRODUCTID=$product_id";

$parse=oci_parse($connection,$query);
$result=oci_execute($parse);
if($result){
$result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Product has been updated successfully </div>';
echo $result;
}
}

if(isset($_POST['upload'])){
    $file=false;
    //taking the information of uploaded image
    $logo=$_FILES['product-image']['name'];
    $tmpname=$_FILES['product-image']['tmp_name'];
    $source="../Images/".$logo;
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimetype = finfo_file($finfo, $_FILES['product-image']['tmp_name']);
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
    if($file==true){
        include "../functions/updateTrader.php";
        move_uploaded_file($tmpname,$source);
        $query="UPDATE PRODUCT 
        SET IMAGE='$logo'
        WHERE PRODUCTID=$product_id";
        
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
        $result='<div style=width:50%;position:relative;left:30%; class="alert alert-success">Product image has been updated successfully </div>';
        echo $result;
        }
    }

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
                    <a class="navbar-brand" href="#">Edit Products</a>
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



        <?php
            if(isset($_GET['productId'])){
                include "../backend/connect.php";
                $product_id=$_GET['productId'];
                $query="SELECT * FROM PRODUCT WHERE PRODUCTID=$product_id";  
                $parse=oci_parse($connection,$query);
                $result=oci_execute($parse);
                while($row=oci_fetch_assoc($parse)){
        ?>
        <section class="panel panel-default">
            <div class="panel-body">
                <form action="" method="POST" class="form-horizontal" role="form">

                    <div class="form-group">
                        <div class="col-sm-8">
                            <label class="control-label small" for="file_img">Product Name:</label>
                                 <input type="text" class="form-control"  name="pname" value=<?php echo $row['PRODUCTNAME']?> id="name" placeholder="Enter Here">
                        </div>
                    </div> <!-- form-group // -->
                    <div class="form-group">
                        <div class="col-sm-8">
                            <label class="control-label small" for="file_img">Price:</label>
                                    <input type="text" class="form-control" name="price" value=<?php echo $row['PRICE']?> id="name" placeholder="Enter Here">
                        </div>
                    </div> <!-- form-group // -->
                    <div class="form-group">
                            <div class="col-sm-8">
                                <label class="control-label small" for="file_img">Minimum Order:</label>
                                <input type="text" class="form-control" name="min" value=<?php echo $row['MIN_ORDER']?> id="name" placeholder="Enter Here">
                    </div>
                </div> <!-- form-group // -->
                <div class="form-group">
                         <div class="col-sm-8">
                             <label class="control-label small" for="file_img">Maximum Order:</label>
                                <input type="text" class="form-control" name="max" value=<?php echo $row['MAX_ORDER']?> id="name" placeholder="Enter Here">
                        </div>
                </div> <!-- form-group // -->
               

                <hr>
                <div class="form-group">
                    <div class="col-sm-3 col-sm-9">
                    <div class="btn btn-one">
                    <span> <input style="background:none;border:none;" name="product_update" type="submit" value="Update Product"></span>
                </div>
                    </div>
                </div> <!-- form-group // -->
                </form>
  
</div><!-- panel-body // -->
</section><!-- panel// -->
<?php } }?>
<section class="Image-sec">
        <div id="viewprofile">
	            
		        <div class="cell small-4 medium-4 large-4">
                <form method="POST" action="" enctype="multipart/form-data" class="form-horizontal" role="form">
                    <?php   if(isset($_GET['productId'])){
                include "../backend/connect.php";
                $product_id=$_GET['productId'];
                $query="SELECT * FROM PRODUCT WHERE PRODUCTID=$product_id";  
                $parse=oci_parse($connection,$query);
                $result=oci_execute($parse);
                while($row=oci_fetch_assoc($parse)){
                    ?> 
                         <?php echo "<img style='height:250px; width:250px; border:1px solid white; class='thumbnail hundred1' src=../Images/".$row['IMAGE'].">"?>
                        <br/>
                        <label style="cursor:pointer;" for="file"> Change Image </label>
                        <input style="display:none;" type="file" name="product-image" id="file">
                <?php }} ?>
                <input type="submit" name="upload" value="Upload">
                </form>
    <form action="" method="POST" class="form-horizontal" role="form">
        <?php
    if(isset($_GET['productId'])){
                include "../backend/connect.php";
                $product_id=$_GET['productId'];
                $query="SELECT * FROM PRODUCT WHERE PRODUCTID=$product_id";  
                $parse=oci_parse($connection,$query);
                $result=oci_execute($parse);
                while($row=oci_fetch_assoc($parse)){
                    ?>
    <table>
  <thead>
    <tr>
      <th>Product Details</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <td data-column="Description">Description</td>
      <td data-column=""><input type="text" name="description" value=<?php echo $row['DESCRIPTION']?> class="form-control" placeholder=""></td>
    </tr>
    <tr>
      <td data-column="Quantity">Quantity</td>
      <td data-column="">
          <select name="quantity" class="form-control">


    <?php for($i=0;$i<=100;$i++){ 
                        echo "<option value=".$i.">".$i."</option>";
    } ?>
   </select>
    </div></td>
    </tr>
    <tr>
      <td data-column="Allergy Info">Allergy Information</td>
      <td data-column=""><input type="text" class="form-control" value="<?php echo $row['ALLERGYINFO']?>" name="allergy_information" placeholder=""></td>
    </tr>
  </tbody>
</table>


		    	</div>
        </div>
<?php }} ?>
<div class="form-group">
                    <div style="margin-left:50px;"class="col-sm-3 col-sm-9">
                    <div class="btn btn-one">
                    <span> <input style="background:none;border:none;" name="submit-data" type="submit" value="Update Product"></span>
                </div>
                    </div>
                </div> <!-- form-group // -->
                </form>
               
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
