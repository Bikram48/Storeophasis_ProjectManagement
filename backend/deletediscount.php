<?php 
    include "../functions/discountFunctions.php";
    if(isset($_GET['productId'])){
        $productid=$_GET['productId'];
        if(deleteDiscount($productid)==true){
            header("Location:../trader/ViewDiscount.php?success=deleted");
        }
        else{
            echo "Error occured";
        }
    }
?>