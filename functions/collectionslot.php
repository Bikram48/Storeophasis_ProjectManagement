<?php
    include "../backend/connect.php";
    function insertslotdata($date,$day,$time,$collectionName,$orderid){
        global $connection;
        $address="Sitapaila";
        $query="INSERT INTO COLLECTION_SLOT(COLLECTIONSLOTID,ADDRESS,COLLECTIONBYDATE,COLLECTIONDAY,COLLECTIONNAME,TIME,FK1_ORDERID) VALUES(COLLECTIONSEQ.nextval,'$address',(to_date('$date','yyyy-mm-dd')),'$day','$collectionName','$time',$orderid)";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
            return true;
        }
        return false;
    }

    function insertOrderData($cartid){
        global $connection;
        $query="INSERT INTO ORDERS VALUES (orderseq.nextval,(to_date(SYSDATE,'dd-mm-yyyy')),$cartid)";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
            return true;
        }
        return false;
    }
?>