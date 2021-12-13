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
        <?php
            $count=0;
            include "../backend/connect.php";
             if(isset($_GET['search-txt'])){
                 $searchtext=$_GET['search-txt'];
                 $_SESSION['searchtxt']=$searchtext;
             }
             $query="SELECT * FROM PRODUCT p FULL OUTER JOIN SHOP s ON s.SHOPID=p.FK2_SHOPID
             where  upper(PRODUCTNAME)like '%$searchtext%' OR  upper(DESCRIPTION) like '%$searchtext%' OR  upper(SHOPNAME) like '%$searchtext%' OR 
             (SHOPCATEGORY) like '%$searchtext%'";
                $parse=oci_parse($connection,$query);
                $result=oci_execute($parse);
                 while($row=oci_fetch_assoc($parse)){
                     $_SESSION['search_product']=$row['PRODUCTID'];
                     $count++;
                 }
        
        ?>
      
      <h1><?php echo $count ?> Items Found On the Keyword <?php echo $searchtext ?></h1>
      <?php if($count>0){?>
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
      <?php } ?>
        <div class="row">
            <?php
                include "../backend/connect.php";
                if(isset($_GET['search-txt'])){
                    $searchtext=$_GET['search-txt'];
                }
                $query="SELECT * FROM PRODUCT p FULL OUTER JOIN SHOP s ON s.SHOPID=p.FK2_SHOPID
                where  upper(PRODUCTNAME)like '%$searchtext%' OR  upper(DESCRIPTION) like '%$searchtext%' OR  upper(SHOPNAME) like '%$searchtext%' OR 
                (SHOPCATEGORY) like '%$searchtext%'";
                $parse=oci_parse($connection,$query);
                $result=oci_execute($parse);
                
                 while($row=oci_fetch_assoc($parse)){
                    $productid=$row['PRODUCTID'];
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
                </div>
            </div>
           
        <?php
             }
            
        ?>
     
            
        </div>
    </div>
  
    <?php 
        include "footer.php";
    ?>
</body>
</html>