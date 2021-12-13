<?php
    include "../backend/connect.php";

/**
 * Verify transaction is authentic
 *
 * @param array $data Post data from Paypal
 * @return bool True if the transaction is verified by PayPal
 * @throws Exception
 */

function verifyTransaction($data) {
	global $paypalUrl;

	$req = 'cmd=_notify-validate';
	foreach ($data as $key => $value) {
		$value = urlencode(stripslashes($value));
		$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value); // IPN fix
		$req .= "&$key=$value";
	}

	$ch = curl_init($paypalUrl);
	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
	curl_setopt($ch, CURLOPT_SSLVERSION, 6);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
	$res = curl_exec($ch);

	if (!$res) {
		$errno = curl_errno($ch);
		$errstr = curl_error($ch);
		curl_close($ch);
		throw new Exception("cURL error: [$errno] $errstr");
	}

	$info = curl_getinfo($ch);

	// Check the http response
	$httpCode = $info['http_code'];
	if ($httpCode != 200) {
		throw new Exception("PayPal responded with http code $httpCode");
	}

	curl_close($ch);

	return $res === 'VERIFIED';
}

/**
 * Check we've not already processed a transaction
 *
 * @param string $txnid Transaction ID
 * @return bool True if the transaction ID has not been seen before, false if already processed
 */
function checkTxnid($txnid) {
	global $connection;
    $query="SELECT INVOICENUMBER FROM PAYMENT WHERE INVOICENUMBER='$txnid'";
    $parse=oci_parse($connection,$query);
    $result=oci_execute($parse);
    $row=oci_fetch_assoc($parse);
    $count=oci_num_rows($parse);

	return  $count;
}

/**
 * Add payment to database
 *
 * @param array $data Payment data
 * @return int|bool ID of new payment or false if failed
 */
function addPayment($txn_id,$payment_gross,$currency_code,$payment_status,$payer_email,$userid) {
	global $connection;
    $insertPayment="INSERT INTO PAYMENT(INVOICENUMBER,PAYMENT_GROSS,CURRENCY_CODE,STATUS,PAYER_EMAIL,FK1_USERID) VALUES('$txn_id',$payment_gross,'$currency_code','$payment_status','$payer_email',$userid)";
	$parse=oci_parse($connection, $insertPayment);
	$result=oci_execute($parse);
	if($result){
		return true;
	}else{
		return false;
	}

}

function addOrder($itemnumber,$cartid,$txn_id){
	global $connection;
	$date=date('Y/m/d');
	$query="INSERT INTO ORDERS(ORDERID,ORDERDATE,ITEM_NUMBER,FK2_SHOPPINGCARTID,FK2_INVOICENUMBER) VALUES(ORDERSEQ.nextval,to_date('$date','yyyy-mm-dd'),'$itemnumber',$cartid,'$txn_id')";
	$parse=oci_parse($connection,$query);
	$result=oci_execute($parse);
	if($result){
		return true;
	}
	return false;
}

function getTotalItems($cartid){
	global $connection;
	$query="SELECT sum(TOTALITEMS) FROM CART_PRODUCT__DETAIL where FK2_SHOPPINGCARTID=$cartid";
	$parse=oci_parse($connection,$query);
	$result=oci_execute($parse);
	while($row = oci_fetch_assoc($parse)){
		$totalitems=$row['SUM(TOTALITEMS)'];
	}
	return $totalitems;
}

/*function getPaymentID($txn_id){
	global $connection;
	$query="SELECT INVOICENUMBER FROM PAYMENT WHERE TXN_ID='$txn_id'";
	$parse=oci_parse($connection,$query);
	$result=oci_execute($parse);
	while($row=oci_fetch_assoc($parse)){
		$paymentid=$row['INVOICENUMBER'];
	}
	return $paymentid;
}
*/
?>
