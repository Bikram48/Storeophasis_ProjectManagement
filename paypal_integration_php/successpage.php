<?php session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" 
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="../CSS/successpage.css">
    <title>Payment</title>
</head>
<body>
    <?php
        if(isset($_POST['submit'])){
            $email=$_POST['email'];
            $_SESSION['payer_email']=$email;
            include "../invoice/invoice.php";
        }
    ?>
    <?php



include "../backend/connect.php";
include ('../pages/paypal_functions.php'); //functions required for Paypal
include "../functions/collectionslot.php";



if(isset($_SESSION['cartsid']))
{
    $cartid=$_SESSION['cartsid'];
}
if(isset($_SESSION['emailid'])){
    $payer_email=$_SESSION['emailid'];
}
if(isset($_SESSION['userid'])){
    $userid=$_SESSION['userid'];
}


if(isset($_GET['tx'])&&isset($_GET['amt'])&&isset($_GET['cc'])&&isset($_GET['st'])){

   
    if(isset($_SESSION['slotname'])&&isset($_SESSION['slotTime'])&&isset($_SESSION['slotdate'])&&isset($_SESSION['day'])){
        $slotname=$_SESSION['slotname'];
        $slotTime=$_SESSION['slotTime'];
        $slotdate=$_SESSION['slotdate'];
        $slotday=$_SESSION['day'];

    }
    $txn_id=$_GET['tx'];
    $payment_gross=$_GET['amt'];
    $currency_code=$_GET['cc'];
    $payment_status=$_GET['st'];
    
  

    $_SESSION['transaction_id']=$txn_id;
    $_SESSION['payment_gross']=$payment_gross;
    $_SESSION['currency_code']=$currency_code;

   $inserted=false;

    if(checkTxnid($txn_id)==0){

        if(addPayment($txn_id,$payment_gross,$currency_code,$payment_status,$payer_email,$userid)==true){
           $inserted=true;

        }
        else{
            echo "Error occured";
        }
       
    }

    if($inserted=true){
        $qry="SELECT * FROM PRODUCT p,CART_PRODUCT__DETAIL cp  WHERE FK2_SHOPPINGCARTID=$cartid AND p.PRODUCTID=cp.FK1_PRODUCTID";
        $parse=oci_parse($connection,$qry);
        $result=oci_execute($parse);
        $date=date('Y/m/d');
    
        while($row=oci_fetch_assoc($parse)){
          
            $cartpid=$row['CARTPRODUCTID'];
    
            $traderssid=$row['FK1_USERID'];
    
            $query="INSERT INTO ORDERPRODUCTS VALUES(orderproductseq.nextval,(to_date('$date','YYYY-MM-DD')),$cartpid,$traderssid,'$slotday','$slotTime',(to_date('$slotdate','YYYY-MM-DD')))";
            $final=oci_parse($connection,$query);
            $rslt=oci_execute($final);
            if($rslt){
                echo "Inserted successfulluy";
            }
            else{
                echo "Error occured";
            }
        }
    }
    $order=false;
    $items=getTotalItems($cartid);
    if($inserted=true){
        $query="INSERT INTO ORDERS(ORDERID,ORDERDATE,ITEM_NUMBER,FK2_SHOPPINGCARTID,FK2_INVOICENUMBER) VALUES(ORDERSEQ.nextval,(to_date(SYSDATE,'dd/mm/yyyy')),'$items',$cartid,'$txn_id')";
	    $parse=oci_parse($connection,$query);
	    $result=oci_execute($parse);
	    if($result){
            $order=true;
          
        }
    }
    else{
        //echo "Order not made";
    }

    if($order=true){ 
        $query="SELECT * FROM ORDERS WHERE FK2_INVOICENUMBER='$txn_id'";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        $row=oci_fetch_assoc($parse);
        $orderid=$row['ORDERID'];
        if(insertslotdata($slotdate,$slotday,$slotTime,$slotname,$orderid)==true){
            //echo "Slot is succesfully inserted";
        }
        else{
            //echo "Error occured";
        }
    }

  
}


?>

<?php
    include "../backend/connect.php";
     $query="SELECT * FROM PRODUCT p,CART_PRODUCT__DETAIL cp  WHERE FK2_SHOPPINGCARTID=$cartid AND p.PRODUCTID=cp.FK1_PRODUCTID";
     $parse=oci_parse($connection,$query);
     $execute=oci_execute($parse);
     while($row=oci_fetch_assoc($parse)){
         $productname=$row['PRODUCTNAME'];
         $quantity=$row['TOTALITEMS'];
         $price=$row['PRICE'];
     }
      
?>
    <div class="outside">
    <div class="radius1"></div>
    <div class="radius2"></div>
    
    <h2>Payment Method</h2>
    </div>
    <div class="container">
        <div class="icn">
        <i class="far fa-thumbs-up"></i>
        </div>
        <div class="msg">
            <h2>Your payment is successful ! </h2>
            <p> <strong>Amount : <?php echo $payment_gross; ?></strong></p>
        </div>

        <div class="text">
            <p>If you want to get an invoice<br> drop your email below.</p>
        </div>
                        <form action="" method="POST">
                            <div class="webflow-style-input">
                            
                                <input class="" type="email" placeholder="Email copy of your invoice" name="email"></input>
                                <button name="submit" type="submit"><i class="fas fa-braille"></i></button>
                           
                            </div>
                        </form>
                
                <div class="banner">
                    <a href="../pages/index1.php" class='butn butn__new'><span>Go to Home</span></a>
                </div>
               
    </div>

    
    <div class="bottom">
    <p>If you have any questions check our <a href="#">faq page</a></p>
    </div>
</body>
</html>