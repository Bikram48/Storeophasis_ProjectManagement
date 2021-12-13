<?php
    session_start();
    include "paypal_functions.php";
    if(isset($_SESSION['userid'])){
        $userid=$_SESSION['userid'];
    }
    
    $paypalConfig = [
        'email' => 'rahim.gopali123@gmail.com',
        'return_url' => ' http://515bb3ed44d2.ngrok.io//dashboard/addtocart/storeophasis/paypal_integration_php/successpage.php',
        'cancel_url' => ' http://515bb3ed44d2.ngrok.io/dashboard/addtocart/storeophasis/paypal_integration_php/cancel.php',
        'notify_url' => ' http://515bb3ed44d2.ngrok.io/dashboard/addtocart/storeophasis/pages/payments.php'
    ];

  
    $paypalUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

    if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){

        // Grab the post data so that we can set up the query string for PayPal.
        // Ideally we'd use a whitelist here to check nothing is being injected into
        // our post data.
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = stripslashes($value);
        }
        
        // Set the PayPal account.
        $data['business'] = $paypalConfig['email'];
    
        // Set the PayPal return addresses.
        $data['return'] = stripslashes($paypalConfig['return_url']);
        $data['cancel_return'] = stripslashes($paypalConfig['cancel_url']);
        $data['notify_url'] = stripslashes($paypalConfig['notify_url']);
    
        // Set the details about the product being purchased, including the amount
        // and currency so that these aren't overridden by the form data.
        $data['currency_code'] = 'GBP';
    
    
        // Build the query string from the data.
         $queryString = http_build_query($data);
    
        // Redirect to paypal IPN
        header('location:' . $paypalUrl . '?' . $queryString);
        exit();
    
    } else {
        // Handle the PayPal response.
    
        /*$data=[
            'item_name' => $_POST['item_name'],
            'item_number' => $_POST['item_name'],
            'payment_status' => $_POST['item_name'],
            'payment_amount' => $_POST['item_name'],
            'payment_currency' => $_POST['item_name'],
            'txn_id' => $_POST['item_name'],
            'receiver_email' => $_POST['item_name'],
            'payer_email' => $_POST['item_name'],
            'item_name' => $_POST['item_name'],
        ];
        */
        // Assign posted variables to local data array.
            $orderid=16;
            $customerid=4;
            $txn_id = $_POST['txn_id'];
            $payment_amount = $_POST['mc_gross'];
            $currency_code = $_POST['mc_currency'];
            $payment_status = $_POST['payment_status'];
            $payer_email = $_POST['payer_email'];

 
        // We need to verify the transaction comes from PayPal and check we've not
        // already processed the transaction before adding the payment to our
        // database.
        if (verifyTransaction($_POST) && (checkTxnid($txn_id)==0)){
            if(addPayment($txn_id,$payment_gross,$currency_code,$payment_status,$payer_email,$userid)!=false){
                echo '<script language="javascript">';
                echo 'alert("Payment successfully added")';
                echo '</script>';
            }   
            else{
                echo '<script language="javascript">';
                echo 'alert("Payment is not added")';
                echo '</script>';
            }  
        }
    }
    
?>