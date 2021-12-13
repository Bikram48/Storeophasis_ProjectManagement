<?php
    session_start();
    if(isset($_SESSION['traderid'])){
        $traderid=$_SESSION['traderid'];
    }
    if(isset($_SESSION['shid'])){
        $shopid=$_SESSION['shid'];
    }
    if(isset($_POST['submit'])){

        include "connect.php";

        $product_name=$_POST['pname'];
        $price=$_POST['price'];
        $minimum_order=$_POST['min'];
        $maximum_order=$_POST['max'];
        $description=$_POST['description'];
        $quantity=$_POST['quantity'];
        $allergy_info=$_POST['allergy_info'];
  
         $filename=$_FILES['image']['name'];
            $tmpfilename=$_FILES['image']['tmp_name'];
            $source="../Images/".$filename;
            move_uploaded_file($tmpfilename,$source);
        
        $query="INSERT INTO PRODUCT(PRODUCTID,PRODUCTNAME,DESCRIPTION,PRICE,QUANTITY,IMAGE,MIN_ORDER,ALLERGYINFO,MAX_ORDER,FK1_USERID,FK2_SHOPID) 
        VALUES (DEMO_PROD_SEQ.NEXTVAL,'$product_name','$description',$price,$quantity,'$filename',$minimum_order,'$allergy_info',$maximum_order,$traderid,$shopid)";

        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
       if($result){
           header("Location:../trader/AddProducts.php?success=inserted");
       }
       else{
           echo "Eror occured";
       }

    }
?>