<?php
    include "../backend/connect.php";
    function countProduct($shopid){
    global $connection;
    $query="SELECT * FROM PRODUCT WHERE FK2_SHOPID=$shopid";
    $parse=oci_parse($connection,$query);
    $result=oci_execute($parse);
  
    //Taking the row who matches the given username and password
    $count=0;
    while($row=oci_fetch_array($parse,OCI_ASSOC)){
        $count++;
    }
        return $count;
    }

    function countShop(){
        global $connection;
        $query="SELECT * FROM SHOP";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
      
        //Taking the row who matches the given username and password
        $count=0;
        while($row=oci_fetch_array($parse,OCI_ASSOC)){
            $count++;
        }
            return $count;
    }


?>

