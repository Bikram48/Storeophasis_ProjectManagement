<?php
    include "../backend/connect.php";
    require('../fpdf/fpdf.php');
    if(isset($_SESSION['customername'])){
      $username=$_SESSION['customername'];
   }

   if(isset($_SESSION['payer_email'])){
    $email= $_SESSION['payer_email'];
}
if(isset($_SESSION['slotname'])&&isset($_SESSION['slotTime'])&&isset($_SESSION['slotdate'])&&isset($_SESSION['day'])){
    $slotname=$_SESSION['slotname'];
    $slotTime=$_SESSION['slotTime'];
    $slotdate=$_SESSION['slotdate'];
    $slotday=$_SESSION['day'];
}

    if(isset($_SESSION['transaction_id'])&& isset($_SESSION['payment_gross'])&&$_SESSION['currency_code']){
        $txn_id=$_SESSION['transaction_id'];
        $gross=$_SESSION['payment_gross'];
        $code=$_SESSION['currency_code'];
        $query="SELECT * FROM ORDERS WHERE FK2_INVOICENUMBER='$txn_id'";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        $row=oci_fetch_assoc($parse);
        $orderdate=$row['ORDERDATE'];
    }

    

    $pdf=new FPDF('P','mm','A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','U',30);
    //$pdf->Image('../Images/logo2.png',60,0,40,40);
    $pdf->Cell(219  ,5,'STOREOPHASIS',0,0,'C');
    $pdf->Cell(59   ,17,'',0,1);

    $pdf->SetFont('Arial','',20);
    $pdf->Cell(219  ,5,'YOUR PAYPAL INVOICE',0,0,'C');
    $pdf->Cell(59   ,20,'',0,1);

    $pdf->SetFont('Arial','B',10);
    //$pdf->Image('../Images/logo2.png',60,0,40,40);
    $pdf->Cell(25 ,20,'Paid with:',0,0);
    $pdf->Cell(120  ,20,'PayPal Sandbox',0,0);
    $pdf->SetFont('Arial','B',17);
    $pdf->Cell(25 ,20,'Invoice',0,0);
    $pdf->Cell(59   ,10,'',0,1);

    $pdf->SetFont('Arial','B',10);
    //$pdf->Image('../Images/logo2.png',60,0,40,40);
    $pdf->Cell(30 ,20,'Company Name:',0,0);
    $pdf->Cell(100  ,20,'Storeophasis',0,0);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(30 ,20,'Transaction ID:',0,0);
    $pdf->Cell(25 ,20,$txn_id,0,0);
    $pdf->Cell(59   ,10,'',0,1);

    $pdf->SetFont('Arial','B',10);
    //$pdf->Image('../Images/logo2.png',60,0,40,40);
    $pdf->Cell(20 ,20,'Sent by:',0,0);
    $pdf->Cell(110  ,20,'Storeophasis team',0,0);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(15 ,20,'Date:',0,0);
    $pdf->Cell(25 ,20,$orderdate,0,0);
    $pdf->Cell(59   ,10,'',0,1);

    $pdf->SetFont('Arial','U',18);
    $pdf->Cell(130 ,20,'Bill to:',0,0);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(25 ,20,'Currency:',0,0);
    $pdf->Cell(25 ,20,$code,0,0);
    $pdf->Cell(59,10,'',0,1);

    $pdf->SetFont('Arial','B',10);
    //$pdf->Image('../Images/logo2.png',60,0,40,40);
    $pdf->Cell(30 ,20,'Customer Name:',0,0);
    $pdf->Cell(40 ,20,$username,0,0);
    $pdf->Cell(59   ,6,'',0,1);

    $pdf->Cell(30 ,20,'Customer Email:',0,0);
    $pdf->Cell(40 ,20,$email,0,0);
    $pdf->Cell(59   ,6,'',0,1);

    $pdf->Cell(30 ,20,'Collection Slot:',0,0);
    $pdf->Cell(40 ,20,$slotname,0,0);
    $pdf->Cell(59   ,6,'',0,1);

    $pdf->Cell(30 ,20,'Pickup Date:',0,0);
    $pdf->Cell(40 ,20,$slotdate,0,0);
    $pdf->Cell(59   ,40,'',0,1);

    $pdf->SetFont('Arial','',12);
    if(isset($_SESSION['ordersid'])){
        $order=$_SESSION['ordersid'];
    }

    $pdf->Cell(219  ,5,'Product Details',1,0,'C');
    $pdf->Cell(59   ,5,'',0,1);

    $pdf->Cell(50  ,5,'Product Name',1,0);
    $pdf->Cell(59   ,5,'Quantity',1,0);
    $pdf->Cell(50   ,5,'Price',1,0);
    $pdf->Cell(43  ,5,'Subtotal',1,0);

    $pdf->Cell(59   ,5,'',0,1);
 
    if(isset($_SESSION['cartsid'])){
        $cartid=$_SESSION['cartsid'];
    }
    $query="SELECT * FROM PRODUCT p,CART_PRODUCT__DETAIL cp  WHERE FK2_SHOPPINGCARTID=$cartid AND p.PRODUCTID=cp.FK1_PRODUCTID";
    $parse=oci_parse($connection,$query);
    $execute=oci_execute($parse);
    while($row=oci_fetch_assoc($parse)){
        $total_price=$row['PRICE']*$row['TOTALITEMS'];
    $pdf->Cell(50  ,5,$row['PRODUCTNAME'],1,0);
    $pdf->Cell(59   ,5,$row['TOTALITEMS'],1,0);
    $pdf->Cell(50   ,5,$row['PRICE'],1,0);
    $pdf->Cell(43  ,5,$total_price,1,0);
    $pdf->Cell(59   ,5,'',0,1);
    }
    

  
    $pdf->Cell(150 ,5,'',1,0);
    $pdf->Cell(50  ,5,'Total Amount:'.$gross,1,0);
    $pdf->Cell(59   ,45,'',0,1);

    $pdf->Cell(150 ,5,'',0,0);
    $pdf->Image('../Images/logo2.png',130,200,80,40);
    $pdf->Cell(59   ,3,'',0,1);

    $pdf->Cell(150 ,5,'',0,0);
    $pdf->Image('../Images/thankyou.jpg',0,250,80,40);
    $pdf->Cell(59   ,40,'',0,1);
    

    $pdf->Cell(59   ,3,'',0,1);

    $pdf->SetFont('Arial','',18);
    $pdf->Cell(219  ,5,'===========================================================================================================',0,0,'C');
    $pdf->Cell(59   ,5,'',0,1);

   
// email stuff (change data below)
$to = $email; 
$from = "chandbikram001@gmail.com"; 
$subject = "send email with pdf attachment"; 
$message = "<p>Please see the attachment.</p>";

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$filename = "PayPal_Invoice.pdf";

// encode data (puts attachment in proper format)
$pdfdoc = $pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));

// main header
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
$body .= "This is a MIME encoded message.".$eol;

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;

// attachment
$body .= "--".$separator.$eol;
$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
$body .= "Content-Transfer-Encoding: base64".$eol;
$body .= "Content-Disposition: attachment".$eol.$eol;
$body .= $attachment.$eol;
$body .= "--".$separator."--";

// send message
if(mail($to, $subject, $body, $headers)){
    echo "email send";
}
else{
    echo "sorry";
}

   
   
   
?>