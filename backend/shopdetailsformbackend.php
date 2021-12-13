<?php
      session_start();
    if(isset($_POST['submit'])){
      
        include "connect.php";
        $shopname=$_POST['shopname'];
        $shopaddress=$_POST['address'];
        $shopdetails=$_POST['description'];
        $category=$_POST['category'];
        $filename=$_FILES['logo']['name'];
        $tmpfilename=$_FILES['logo']['tmp_name'];
        $source="../Images/".$filename;
        move_uploaded_file($tmpfilename,$source);
        $userid= $_SESSION['userid'];

        $query="INSERT INTO SHOP(SHOPID,SHOPNAME,SHOPADDRESS,SHOPDESCRIPTION,SHOPLOGO,SHOPCATEGORY,FK1_USERID)
                VALUES(SHOPSEQ.NEXTVAL,'$shopname','$shopaddress','$shopdetails','$filename','$category',$userid)";

        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
           header("Location:../pages/traderLogin.php");
        }
        else{
            echo "Sorrry";
        }
    
    }
?>