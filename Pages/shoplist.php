<?php
    include "Navbar.php";
    include "../backend/connect.php";
?>
<?php
    if(isset($_GET['category'])){
        $category=$_GET['category'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" 
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../CSS/shoplist.css">
    
    <title>Document</title>
</head>
<body>
<div class="banner">
<img src="../Images/Banner1.jpg" alt="Banner">
</div>
<div class="overlay">
            <a href="#">Welcome to the storeophasis</a>
        </div>
        
        
<div class="headbtn">
  <button>
    <span class="text">
      View
    </span>

    <span class="hover">
      more &rarr;
    </span>
  </button>
 
</div>


</div>


<section class="Shops">
<div class="container">
<div class="title_bo">
            <h2>Shop Lists</h2>
        </div>
  <div class="row">
  <?php 
                $query="SELECT * FROM SHOP S,USERS u WHERE u.USERID=S.FK1_USERID and SHOPCATEGORY='$category'";
                $parse=oci_parse($connection,$query);
                $result=oci_execute($parse);
                //$row['SHOPLOGO'].
                while($row=oci_fetch_assoc($parse)){  
                    $logo=$row['SHOPLOGO'];    
                    $shopid=$row['SHOPID'];
                    $tradersid=$row['USERID'];
            ?>
            <div class="card" style="width: 21rem;margin-top:60px;border:none;">
                <?php echo "<img style=width:100%;height:250px; class='card-img-top' src=../Images/".$logo." alt='Card image cap'>"; ?>
  <div class="card-body">
    <h5 class="card-title"> <p class="item_title"><?php echo $row['SHOPNAME']; ?></l></p></h5>
    <p class="card-text"> <p class="item_description"><?php echo $row['SHOPDESCRIPTION']; ?></p></p>
  
    <div style="height: 40px;margin-top:40px;" class="button_cont" align="center">
        <?php echo "<a class='example_f' href='shop_products.php?shopid=$shopid&&tradersid=$tradersid&&category=$category' target='_blank' rel='nofollow'><span>Navigate Products</a>"; ?>
    </div>
  </div>
</div>
  <?php //echo "<a class='item' href='shop_products.php?shopid=$shopid&&tradersid=$tradersid&&category=$category'>"?>
      <?php //echo "<div class='image' style='height:400px;width:100%;background-image: url(../Images/$logo');></div>";?>
     
    </a>
    
    <?php
                }
    ?>

</div>
<br><br><br><br><br>
<br><br><br><br><br>

</section>

<section class="display">
    <div class="container">
        <div class="title_box">
            <h2><?php echo $category." Products"; ?></h2>
        </div>
        <div class="row blog_list">
        <?php
            if(isset($_GET['category'])){
                 include "../backend/connect.php";
                $shopid=$_GET['shopid'];
                $_SESSION['shopsid']=$shopid;
            $query="SELECT * FROM PRODUCT P,SHOP S WHERE S.SHOPID=P.FK2_SHOPID AND S.SHOPCATEGORY='$category'";
            $parse=oci_parse($connection,$query);
            $result=oci_execute($parse);
            
            while($row=oci_fetch_assoc($parse)){
               
    ?>
 <div class="col-md-3">
                <div class="product-top">
                    <?php echo "<a href=productdescription.php?productid=".$row['PRODUCTID']."><img height=230px src=../Images/".$row['IMAGE']."></a>"?>
                    <div class="overlay-right">
                        <button type="button" class="btn btn-secondary" title="Quick shop">
                            <i class="fa fa-eye"></i>
                        </button>
                        <!-- <button type="button" class="btn btn-secondary" title="Add to wishlist">
                            <i class="far fa-heart"></i> -->
                        </button>
                        <button type="button" class="btn btn-secondary" title="Add to cart">
                            <i class="fa fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
                <div class="product-bottom text-left">
                    
                    <h3><?php echo $row['PRODUCTNAME']; ?></h3>
                    <h5>Price: £<?php echo $row['PRICE']; ?></h5>

                    <?php 
                        $productid=$row['PRODUCTID'];
						$query1="SELECT AVG(RATING) from REVIEW  where FK1_PRODUCTID=$productid";
						$parse1=oci_parse($connection,$query1);
						$result=oci_execute($parse1);
						while($row=oci_fetch_assoc($parse1)){
                            $rating=(int)$row['AVG(RATING)'];
						}
							
					?>
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
                        <i style="color:orangered;"  class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
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
            </div>

          
            <?php } } ?>
            
        </div>

       
       
        
    </div>
    
</section>
 
<hr>

<?php include "footer.php"; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" 
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>