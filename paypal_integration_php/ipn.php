<?php
session_start();
$paypalConfig = [
    'notify_url' => 'https://localhost/storeophasis/paypal_integration_php/payments.php';
];
if(isset($_SESSION['userid'])){
    $userid=$_SESSION['userid'];

}

if(isset($_SESSION['cartsid']))
{
    $cartid=$_SESSION['cartsid'];

}
//Include DB configuration file
include '../backend/connect.php';

/*
 * Read POST data
 * reading posted data directly from $_POST causes serialization
 * issues with array data in POST.
 * Reading raw POST data from input stream instead.
 */        
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
    $keyval = explode ('=', $keyval);
    if (count($keyval) == 2)
        $myPost[$keyval[0]] = urldecode($keyval[1]);
}

// Read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
    $get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
    if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
        $value = urlencode(stripslashes($value));
    } else {
        $value = urlencode($value);
    }
    $req .= "&$key=$value";
}

/*
 * Post IPN data back to PayPal to validate the IPN data is genuine
 * Without this step anyone can fake IPN data
 */
$paypalURL = "https://www.sandbox.paypal.com/cgi-bin/webscr";
$ch = curl_init($paypalURL);
if ($ch == FALSE) {
    return FALSE;
}
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSLVERSION, 6);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

// Set TCP timeout to 30 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
$res = curl_exec($ch);

/*
 * Inspect IPN validation result and act accordingly
 * Split response headers and payload, a better way for strcmp
 */ 
$tokens = explode("\r\n\r\n", trim($res));
$res = trim(end($tokens));
if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {

    //Payment data
    $txn_id = $_POST['txn_id'];
    echo $txn_id;
    $payment_gross = $_POST['mc_gross'];
    $currency_code = $_POST['mc_currency'];
    $payment_status = $_POST['payment_status'];
    $payer_email = $_POST['payer_email'];
    
    //Check if payment data exists with the same TXN ID.
    $prevPayment="SELECT INVOICENUMBER FROM PAYMENT WHERE TXN_ID=$txn_id";
    $parse=oci_parse($connection,$prevPayment);
    $result=oci_execute($parse);
    $row=oci_num_rows($parse);
    if($row > 0){
        exit();
    }else{
        //Insert tansaction data into the database
        $insertPayment="INSERT INTO payments(INVOICENUMBER,TXN_ID,PAYMENT_GROSS,CURRENCY_CODE,STATUS,PAYER_EMAIL,FK1_USERID) VALUES(paymentseq.nextval,'$txn_id',$payment_gross,'$currency_code','$payment_status','$payer_email',$userid)";
        $parse=oci_parse($connection,$insertPayment);
        $result=oci_execute($parse);
        if($result){
            //Insert order items into the database
            $query="SELECT * FROM PAYMENT WHERE TXN_ID=$txn_id";
            $parse=oci_parse($connection,$query);
            $result=oci_execute($parse);
            $row=oci_fetch_assoc($parse);
            $payment_id = $row['INVOICENUMBER'];
            $num_cart_items = $_POST['num_cart_items'];
            for($i=1;$i<=$num_cart_items;$i++){
                $order_item_number = $_POST['item_number'.$i];
                $order_item_quantity = $_POST['quantity'.$i];
                $order_item_gross_amount = $_POST['mc_gross_'.$i];

                $insertOrderItem="INSERT INTO ORDERS(ORDERID,ORDERDATE,ITEM_NUMBER,GROSS_AMOUNT,FK2_SHOPPINGCARTID,FK2_INVOICENUMBER) VALUES(orderseq.nextval,(to_date(SYSDATE,'dd/mm/yyyy')),$order_item_number,$order_item_gross_amount,$cartid, $payment_id)";
                $parse=oci_parse($connection,$insertOrderItem);
                $result=oci_execute($parse);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <input type='hidden' name='notify_url' value='http://c63d4f8fe7a4.ngrok.io/storeophasis/paypal_integration_php/ipn.php'>   
</body>
</html>