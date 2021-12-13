<?php

include "../backend/connect.php";

?>

<?php
    include "Navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../script/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/searchpage.css">
    
    <title>Document</title>
</head>
<body>
  
    <div class="container">
        
      
      <h1>Sorted Result</h1>
      <div class="row sorting-part">
       <div class="col-xl-12 col-sm-12">
            <form action="sorting.php" method="POST">
                 <select class="sort"  name="Sorting_value" id="">
                    <option value='option'>Sorting Option</option>
                    <option value='popularity'>Popularity</option>
                    <option value='low'>Price Low To High</option>
                    <option value='high'>Price High To Low</option>
                 </select>
                 <input type="submit" name="submit" value="SORT">
            </form>
        </div>
        </div>
      
        <div class="row">
           <?php 
                if(isset($_POST['submit'])){
                    $check=false;
                    $sorting=$_POST['Sorting_value'];
                    if(isset( $_SESSION['searchtxt'])){
                        $searchtext=$_SESSION['searchtxt'];
                    }
                    switch($sorting){
                        case 'popularity':
                            $query="SELECT r.FK1_PRODUCTID,avg(RATING),p.IMAGE,p.DESCRIPTION,p.PRICE FROM PRODUCT p FULL OUTER JOIN REVIEW r 
                            ON  p.PRODUCTID=r.FK1_PRODUCTID where r.FK1_PRODUCTID in (SELECT PRODUCTID FROM PRODUCT p FULL OUTER JOIN SHOP s ON s.SHOPID=p.FK2_SHOPID
                            where  upper(PRODUCTNAME)like '%$searchtext%' OR upper(DESCRIPTION) like '%$searchtext%' OR  upper(SHOPNAME) like '%$searchtext%' OR 
                            (SHOPCATEGORY) like '%$searchtext%') group by r.FK1_PRODUCTID,p.IMAGE,p.DESCRIPTION,p.PRICE order by avg(RATING) desc";
                        break;
                
                        case 'low':
                            $query="SELECT * FROM PRODUCT p FULL OUTER JOIN SHOP s ON s.SHOPID=p.FK2_SHOPID
                            where  upper(PRODUCTNAME)like '%$searchtext%' OR  upper(DESCRIPTION) like '%$searchtext%' OR  upper(SHOPNAME) like '%$searchtext%' OR 
                            (SHOPCATEGORY) like '%$searchtext%'ORDER BY PRICE ASC";
                        break;
                
                        case 'high':
                            $query="SELECT * FROM PRODUCT p FULL OUTER JOIN SHOP s ON s.SHOPID=p.FK2_SHOPID
                            where  upper(PRODUCTNAME)like '%$searchtext%' OR  upper(DESCRIPTION) like '%$searchtext%' OR  upper(SHOPNAME) like '%$searchtext%' OR 
                            (SHOPCATEGORY) like '%$searchtext%' ORDER BY PRICE DESC";
                        break;
                        default:
                            echo "Undeifined option detected";
                        break;
                    }
                    $parse=oci_parse($connection,$query);
                    $result=oci_execute($parse);
                    $rating=0;
                    while($row=oci_fetch_assoc($parse)){
                        if(oci_num_rows($parse)>0){
                            $productid=$row['PRODUCTID'];
                            $rating=(int)$row['AVG(RATING)'];
           ?>
            
            <div class="card" style="width: 18rem;">
                <div class="hide">
                    <button type="button"><?php echo "<a style=color:white;text-decoration:none; href='productdescription.php?productid=$productid'>PRODUCT DETAILS</a>" ?></button>        
                </div>
                <?php echo "<img class='card-img-top' src=../Images/".$row['IMAGE']." alt='Card image cap'>";?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['PRODUCTNAME']; ?></h5>
                    <p class="card-text"><?php echo substr($row['DESCRIPTION'],0,50);?></p>
                    <p class="price"><?php echo "£ ".$row['PRICE']; ?></p>
                    <div style="margin-left:70px;" class="ratings">
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
            </div>
          
                
        <?php
             }
                }
            }
        ?>
     
            
        </div>
    </div>
  
    <?php 
        include "footer.php";
    ?>
</body>
</html>