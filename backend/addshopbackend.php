<?php
    session_start();
    include "connect.php";
    if(isset($_SESSION['traderid'])){
        $traderid=$_SESSION['traderid'];
    }
    if(isset($_POST['submit'])){
        $shopname=$_POST['shopname'];
        $address=$_POST['address'];
        $description=$_POST['description'];
        $category=$_POST['category'];
        $filename=$_FILES['logo']['name'];
        $tmpfilename=$_FILES['logo']['tmp_name'];
        $source="../Images/".$filename;
        move_uploaded_file($tmpfilename,$source);

        $query="INSERT INTO SHOP(SHOPID,SHOPNAME,SHOPADDRESS,SHOPDESCRIPTION,SHOPLOGO,SHOPCATEGORY,FK1_USERID)
        VALUES(SHOPSEQ.NEXTVAL,'$shopname','$address','$description','$filename','$category',$traderid)";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
            echo "Data inserted successfully";
        }
        else{
            echo "Sorrry";
        }
    }
?>