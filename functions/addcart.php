<?php
    include "../backend/connect.php";
   
    function insertData($userid){
        global $connection;
        $query="INSERT INTO SHOPPING_CART(SHOPPINGCARTID,DATEADDED,FK1_USERID) VALUES(SHOPPINGCARTSEQ.nextval,(to_date(SYSDATE,'dd/mm/yy')),$userid)";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
    }

    function insertProductCart($quantity,$productid,$cartid){
        global $connection;
        $query="INSERT INTO CART_PRODUCT__DETAIL(CARTPRODUCTID,TOTALITEMS,FK1_PRODUCTID,FK2_SHOPPINGCARTID) VALUES(SHOPSEQ.nextval,$quantity,$productid,$cartid)";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
            return true;
        }
        return false;
    }

    function checkProduct($productid,$userid){
        global $connection;
        $query="SELECT * FROM CART_PRODUCT__DETAIL cp, SHOPPING_CART sc WHERE cp.FK1_PRODUCTID=$productid AND sc.FK1_USERID=$userid AND sc.SHOPPINGCARTID=cp.FK2_SHOPPINGCARTID";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        $row=oci_fetch_all($parse,$res);

        if($row>=1){
           return true;
        }
    }

   function sumPrice($cartid){
       
    $qry="SELECT sum(PRICE) FROM PRODUCT p, CART_PRODUCT__DETAIL CP WHERE CP.FK2_SHOPPINGCARTID=$cartid  AND p.PRODUCTID=CP.FK1_PRODUCTID";
    $parse=oci_parse($connection,$qry);
    $result=oci_execute($parse);
   while($row = oci_fetch_assoc($parse)){
       $total_price=$row['SUM(PRICE)'];
       
   }

   return $total_price;
   }

   function checkDiscount($productid){
       global $connection;
       $query="SELECT * FROM DISCOUNT WHERE FK2_PRODUCTID=$productid";
       $parse=oci_parse($connection,$query);
       $result=oci_execute($parse);
       $rows=oci_fetch_all($parse,$res);
       if($rows>=1){
           return true;
       }
       else{
           return false;
       }
   }

   function getTotalAmount($productid){
    global $connection;
	$query="SELECT DISCOUNTAMOUNT from DISCOUNT where FK2_PRODUCTID=$productid";
	$result = oci_parse($connection, $query);
	oci_execute($result);
	while (($row = oci_fetch_array($result, OCI_ASSOC)) != false) {
		$total=$row['DISCOUNTAMOUNT'];
	}
	return $total;
   }

   function updateCartQuantity($productid,$quantity){
        global $connection;
        $query="UPDATE CART_PRODUCT__DETAIL SET TOTALITEMS=$quantity WHERE FK1_PRODUCTID=$productid";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
            return true;
        }
        return false;
   }

   function cartfull($userid){
    global $conn;
    $query="SELECT * from CART_PRODUCT__DETAIL cpd, SHOPPING_CART sc  where sc.SHOPPINGCARTID=cpd.FK2_SHOPPINGCARTID AND sc.FK1_USERID=$userid";
    $result = oci_parse($conn, $query);
    oci_execute($result);
    $numrows = oci_fetch_all($result, $res);
    if ($numrows>=20){
        return true;
    }else{
        return false;
    }
}
    
?>