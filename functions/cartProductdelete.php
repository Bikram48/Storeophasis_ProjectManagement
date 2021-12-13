<?php
     include "../backend/connect.php";
     function deletecartProduct($cartid){
        global $connection;
        $query="DELETE FROM CART_PRODUCT__DETAIL WHERE FK1_PRODUCTID=$cartid";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
            return true;
        }
    }

    function deletecartallProduct($cartid){
        global $connection;
        $query="DELETE FROM CART_PRODUCT__DETAIL WHERE FK2_SHOPPINGCARTID=$cartid";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
            return true;
        }
    }
?>