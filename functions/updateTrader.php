<?php
    include "../backend/connect.php";
    function updateProfile($shopid,$filename){
        global $connection;
        $query="UPDATE SHOP SET SHOPLOGO='$filename' WHERE SHOPID=$shopid";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }

    function updateShop($shopid,$shopname,$shopcategory,$shopdescription){
        global $connection;
        $query="UPDATE SHOP SET SHOPNAME='$shopname',SHOPDESCRIPTION='$shopdescription',SHOPCATEGORY='$shopcategory' WHERE SHOPID=$shopid";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }

    function updateTraderAccount($userid,$username,$email,$phone,$dob,$pwd){
        global $connection;
        $query="UPDATE USERS SET USERNAME='$username', EMAIL='$email',DATEOFBIRTH='$dob', PASSWORD='$pwd', PHONENUMBER='$phone' WHERE USERID=$userid";
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