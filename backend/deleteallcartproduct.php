<?php
    if(isset($_GET['cartid'])){
      
        $cartid=$_GET['cartid'];
 
    }

    include "../functions/cartProductdelete.php";
    if(deletecartallProduct($cartid)==true){
        header("Location:../pages/addtocarts.php?alldelete=deleted");
    }
?>