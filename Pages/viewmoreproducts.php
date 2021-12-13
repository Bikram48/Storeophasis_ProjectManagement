<?php
    session_start();
    include "../backend/connect.php";
    if(isset($_SESSION['shopsid'])){
        $shopsid=$_SESSION['shopsid'];
    }
   
?>

<section class="display">
    <div class="container">
        <div class="row blog_list">
        <?php
            $query="SELECT *
            FROM
              ( SELECT rownum rnum
                     , a.*
                  FROM PRODUCT a 
              ORDER BY PRODUCTID
              )
           WHERE FK2_SHOPID=$shopsid AND rnum BETWEEN 5 AND 10";
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
                    <h5>Price:<?php echo $row['PRICE']; ?></h5>
                   
                </div>
            </div>

          
            <?php }  ?>
            
        </div>

       
        <div class="link text-center">
        <div id="" class="medium">
            <button  type="button" class="btn btn1 show_more"> <a href="#"  style="color:#000; text-decoration: none;" >View more</a> <i class="fas fa-long-arrow-alt-right"> </i></button>
            </div>
                 </div>
        
    </div>
    
</section>
 