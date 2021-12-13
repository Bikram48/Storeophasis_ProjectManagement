<?php
    include "../backend/connect.php";
    function insertData($discount_percentage,$discount_amt,$userid,$productid){
        global $connection;
        $query="INSERT INTO DISCOUNT VALUES(DISCOUNTSEQ.nextval,$discount_amt,$discount_percentage,$userid,$productid)";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
            return true;        
        }
        else{
            return false;
        }
    }

    function getPrice($productid){
        global $connection;
        $query="SELECT * FROM PRODUCT WHERE PRODUCTID=$productid";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        $row=oci_fetch_assoc($parse);
        $price=$row['PRICE'];
        return $price;
    }

    function updateDiscount($discount_percentage,$discount_amount,$productid){
        global $connection;
        $query="UPDATE DISCOUNT SET DISCOUNTAMOUNT=$discount_amount,DISCOUNTPERCENTAGE=$discount_percentage where FK2_PRODUCTID=$productid";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }

    function deleteDiscount($productid){
        global $connection;
        $query="DELETE FROM DISCOUNT WHERE FK2_PRODUCTID=$productid";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }

?>