<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../script/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/category.css">
    <title>Document</title>
</head>
<body>
 
    <div class="container">
    <?php

                    include "../backend/connect.php";
                    $query="SELECT * FROM SHOP";
                    $parse=oci_parse($connection,$query);
                    $result=oci_execute($parse);
                    while($row=oci_fetch_array($parse,OCI_ASSOC)){
                        ?>
        <div class="row cat">
            <div class="col-xl-4">
                <?php

                    echo "<a href=shop_products.php?shopid=".$row['SHOPID'].">"."<button style=width:100px;height:54px; type=button>".$row['SHOPNAME']."</button></a>" ;
                    ?>
            </div> 
           
        </div>
                    <?php }?>
    </div>
   
</body>
</html>