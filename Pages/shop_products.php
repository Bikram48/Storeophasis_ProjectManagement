<?php 
    include "Navbar.php";

    if(isset($_GET['tradersid'])){
        $tradersid=$_GET['tradersid'];
        $_SESSION['tradersid']=$tradersid;
    }

    if(isset($_GET['category'])){
        $category=$_GET['category'];
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" 
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/shop_products.css">

    
  
<link href="load-more-button.css" rel="stylesheet">
    <title>Shop</title>
</head>
<body>
     <!-- Navbar -->
  <?php
  //include('Navbar.php');?>

    <!-- Slider -->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../Images/Butcher.jpg" class="d-block w-100" alt="Butcher">
    </div>
    <div class="carousel-item">
      <img src="../Images/Greengrocer.jpg" class="d-block w-100" alt="Greengrocer">
    </div>
    <div class="carousel-item">
      <img src="../Images/Fishmonger.jpg" class="d-block w-100" alt="Fishmonger">
    </div>
    <div class="carousel-item">
      <img src="../Images/Bakery.jpg" class="d-block w-100" alt="Bakery">
    </div>
    <div class="carousel-item">
      <img src="../Images/Delicatessen.jpg" class="d-block w-100" alt="Delicatessen">
    </div>
    
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<hr>

<!-------------Products display--------------->

<section class="display">
    <div class="container">
        <div class="title_box">
            <h2><?php echo $category; ?></h2>
        </div>
        <div class="row blog_list">
        <?php
            if(isset($_GET['shopid'])){
                 include "../backend/connect.php";
                $shopid=$_GET['shopid'];
                $_SESSION['shopsid']=$shopid;
            $query="SELECT * FROM PRODUCT  WHERE FK2_SHOPID=$shopid AND ROWNUM<=4";
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
                    <h5>Price: £ <?php echo $row['PRICE']; ?></h5>
                  
                </div>
            </div>

          
            <?php } } ?>
            
        </div>

       
        <div class="link text-center">
        <div id="" class="medium">
            <button  type="button" class="btn btn1 show_more"> <a href="#"  style="color:#000; text-decoration: none;" >View more</a> <i class="fas fa-long-arrow-alt-right"> </i></button>
            </div>
                 </div>
        
    </div>
    
</section>
 
<hr>

<!-----------------------second column------------------------>

<section class="display">
    <div class="container">
        <div class="title_box">
            <h2>Most Rated Products</h2>
        </div>
        <div class="row">
        <?php 
         include "../backend/connect.php";
         $query="SELECT r.FK1_PRODUCTID,avg(RATING),p.IMAGE,p.DESCRIPTION,p.PRICE FROM PRODUCT p FULL OUTER JOIN REVIEW r 
         ON  p.PRODUCTID=r.FK1_PRODUCTID where r.FK1_PRODUCTID in (SELECT PRODUCTID FROM PRODUCT p FULL OUTER JOIN SHOP s ON s.SHOPID=p.FK2_SHOPID
         where  SHOPCATEGORY='$category' and ROWNUM<=4) group by r.FK1_PRODUCTID,p.IMAGE,p.DESCRIPTION,p.PRICE order by avg(RATING) desc";
    $parse=oci_parse($connection,$query);
    $result=oci_execute($parse);
    $rating=0;
    while($row=oci_fetch_assoc($parse)){
        $rating=(int)$row['AVG(RATING)'];
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
                    <h5>Price: £ <?php echo $row['PRICE']; ?></h5>
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
            </div>

            <!------product 2----->
    <?php } ?>
                
            
        </div>
        <div class="link text-center">
        <div class="medium">
            <button type="button" class="btn btn1 show_more"> <a href="#"  style="color:#000; text-decoration: none;" >View more</a> 
            <i class="fas fa-long-arrow-alt-right"> </i></button>
            </div>
                 </div>
        
    </div>
    
</section>
<hr>

<section class="website-features">
    <div class="container">
        <div class="row">
            <div class="col-md-3 feature-box">
                <img src="../Images/1.png">
                    <div class="feature-text">
                        <p><strong>100% organic products</strong> are a available</p>
                    </div>
            </div>

            <div class="col-md-3 feature-box">
                <img src="../Images/3.png">
                    <div class="feature-text">
                        <p><strong>Discount</strong> is available in many products</p>
                    </div>
            </div>


            <div class="col-md-3 feature-box">
                <img src="../Images/4.png">
                    <div class="feature-text">
                        <p><strong>Fast Delivery</strong> is available</p>
                    </div>
            </div>

            <div class="col-md-3 feature-box">
                <img src="../Images/6.png">
                    <div class="feature-text">
                        <p><strong>Online Payment</strong> is available</p>
                    </div>
            </div>
        </div>
    </div>

<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(document).on('click','.show_more',function(){
                    var ID = $(this).attr('id');
                    $('.show_more').hide();
                    $.ajax({
                        type:'POST',
                        url:'viewmoreproducts.php',
                        data:'pkBlogId='+ID,
                        success:function(html){
                            $('#show_more_container'+ID).remove();
                            $('.blog_list').append(html);
                        }
                    });
                });
            });
        </script>
 
</body>
</html>