<?php
    if(isset($_GET['cartid'])){
        $cartid=$_GET['cartid'];
    }

    include "../functions/cartProductdelete.php";
    if(deletecartProduct($cartid)==true){
        header("Location:../pages/addtocarts.php?delete=deleted");
    }
?>