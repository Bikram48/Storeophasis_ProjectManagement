<?php
    include "connect.php";
    if(isset($_GET['productId'])){
        $productid=$_GET['productId'];
        $query="DELETE FROM PRODUCT WHERE PRODUCTID=$productid";    
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
          header("Location:../trader/ViewProducts.php?success=productdeleted");
        }
        else{
            echo "error occurred";
        }
    }
?>