<?php
    include "../backend/connect.php";
    function addShop($shopid,$shopname,$address,$description,$category,$filename,$traderid){
        global $connection;
        $query="INSERT INTO SHOP(SHOPID,SHOPNAME,SHOPADDRESS,SHOPDESCRIPTION,SHOPLOGO,SHOPCATEGORY,FK1_USERID)
        VALUES(SHOPSEQ.NEXTVAL,'$shopname','$address','$description','$filename','$category',$traderid)";
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