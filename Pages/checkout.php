
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/checkout.css">
    <link rel="stylesheet" href="../script/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    
<?php
    $paypal=false;
        date_default_timezone_set("Asia/Katmandu");
        $week=date("w");
        $hours=date("H");
        switch($week){
            case 0:
                $A1=date('Y-m-d 10:00', strtotime("+3 day"));
                break;
            
                case 1:
                $A1=date('Y-m-d 10:00', strtotime("+2 day"));
                break;
            
                case 2:
                $A1=date('Y-m-d 10:00', strtotime("+1 day"));
                break;
            
                case 3:
                $A1=date('Y-m-d 10:00', strtotime("+0 day"));
                break;
            
                case 4:
                $A1=date('Y-m-d 10:00', strtotime("-1 day"));
                if ($time>16 && $time<19){
                    $A1=date('Y-m-d H:i', strtotime("+6 day"));
                }
                break;
            
                case 5:
                $A1=date('Y-m-d 10:00', strtotime("+5 day"));
                break;
            
                case 6:
                $A1=date('Y-m-d 10:00', strtotime("+4 day"));
                break;
        }
        $A2=date('Y-m-d H:i', strtotime("$A1 +0 day 3 hours"))." A2";
        $A3=date('Y-m-d H:i', strtotime("$A1 +6 hours"))." A3";
        $B1=date('Y-m-d H:i', strtotime("$A1 +1 day"));
        $B2=date('Y-m-d H:i', strtotime("$B1 +3 hours"))." B2";
        $B3=date('Y-m-d H:i', strtotime("$B1 +6 hours"))." B3";
        $C1=date('Y-m-d H:i', strtotime("$A1 +2 day"));
        $C2=date('Y-m-d H:i', strtotime("$C1 +3 hours"))." C2";
        $C3=date('Y-m-d H:i', strtotime("$C1 +6 hours"))." C3";
        $A1=$A1." A1";
        $B1=$B1." B1";
        $C1=$C1." C1";


        if(isset($_POST['collection_slot'])){
            $slots=$_POST['collectionslot'];
            if(isset($_COOKIE['collection_slot'])){
				$cookie_data=stripslashes($_COOKIE['shopping_cart']);
				$cart_data=json_decode($cookie_data,true);
			}
			else{
				$cart_data=array();
			}
			$item_id_list=array_column($cart_data,'collection_slot');
			if(in_array($slots,$item_id_list)){
				foreach($cart_data as $keys=>$values){
					if($cart_data[$keys]['collection_slot']=$slots){
						echo '<script language="javascript">';
  						echo 'alert("You cannot choose more than one slot at a time")';
						  echo '</script>';
						$error=true;
					}
				}
			}
			else{
				$item_array=array('collection_slot' => $slots);
				$cart_data[] = $item_array;
			}

			$item_data=json_encode($cart_data);
			if(setcookie('colllection_slot',$item_data,time()+(86400*30))){
                $paypal=true;
            }
        }
    ?>
   
    <?php include "Navbar.php"; ?>


   <div class="container">
       <div class="center ml-0">
            <div class="row payment">
                <img src="../icons/payment.png">
            </div>

            <h2>Confirm Your Order</h2>
            <div class="row table">
                <table>
                    <tr>
                    <th style="padding-left:10px;">Item Name</th>
                    <th>Item Price</th>
                    <th>Action</th>
                    </tr>
                    <tr>
                        <td ><img style="width:60px;height:80px;" src="../Images/Bikram.png"><span class="name">BlueBerry</span></td>
                        <td style="padding-left:105px;padding-top:25px;">Rs.100</td>
                        <td style="padding-left:100px;padding-top:25px;">Delete</td>
                    </tr>
                    <tr>
                        <td ><img style="width:60px;height:80px;" src="../Images/Bikram.png"><span class="name">BlueBerry</span></td>
                        <td style="padding-left:105px;padding-top:25px;">Rs.100</td>
                        <td style="padding-left:100px;padding-top:25px;">Delete</td>
                    </tr>
                </table>
            </div>

            
        </div>
        <h4>Payment Method</h4>
        <div class="row payment-method">
        <form action="" method="POST">
            <label for="slot">Choose collection slot</label>
            <?php 
                echo "<select name='collectionslot' id='slot'>";
                echo "<option> Choose Slot </option>";
                if ($week==2 && $time<10){
                    echo "<option value=\"$A1\" > A1 WED 10:00AM TO 1:00PM </option>
                        <option value=\"$A2\" >A2 WED 1:00PM TO 4:00PM </option>
                        <option value=\"$A3\" >A3 WED 4:00PM TO 7:00PM </option>
                        <option value=\"$B1\" >B1 THUR 10:00AM TO 1:00PM </option>
                        <option value=\"$B2\" > B2 THUR 1:00PM TO 4:00PM </option>
                        <option value=\"$B3\" >B3 THUR 4:00PM TO 7:00PM </option>
                        <option value=\"$C1\" > C1 FRI 10:00AM TO 1:00PM </option>
                        <option value=\"$C2\" > C2 FRI 1:00PM TO 4:00PM </option>
                        <option value=\"$C3\" >C3 FRI 4:00PM TO 7:00PM </option>
                        ";
                }else if($week==2 && $time>10 && $time<13){
                    echo "<option value=\"$A2\" >A2 WED 1:00PM TO 4:00PM </option>
                        <option value=\"$A3\" >A3 WED 4:00PM TO 7:00PM </option>
                        <option value=\"$B1\" >B1 THUR 10:00AM TO 1:00PM</option>
                        <option value=\"$B2\" > B2 THUR 1:00PM TO 4:00PM </option>
                        <option value=\"$B3\" >B3 THUR 4:00PM TO 7:00PM </option>
                        <option value=\"$C1\" > C1 FRI 10:00AM TO 1:00PM </option>
                        <option value=\"$C2\" > C2 FRI 1:00PM TO 4:00PM </option>
                        <option value=\"$C3\" >C3 FRI 4:00PM TO 7:00PM </option>";
                }else if($week==2 && $time>13 && $time<16){
                    echo "<option value=\"$A3\" >A3 WED 4:00PM TO 7:00PM </option>
                        <option value=\"$B1\" >B1 THUR 10:00AM TO 1:00PM </option>
                        <option value=\"$B2\" > B2 THUR 1:00PM TO 4:00PM </option>
                        <option value=\"$B3\" >B3 THUR 4:00PM TO 7:00PM </option>
                        <option value=\"$C1\" > C1 FRI 10:00AM TO 1:00PM </option>
                        <option value=\"$C2\" > C2 FRI 1:00PM TO 4:00PM </option>
                        <option value=\"$C3\" >C3 FRI 4:00PM TO 7:00PM </option>";
                }else if($week==2 && $time>16){
                    echo "<option value=\"$B1\" >B1 THUR 10:00AM TO 1:00PM </option>
                        <option value=\"$B2\" > B2 THUR 1:00PM TO 4:00PM </option>
                        <option value=\"$B3\" >B3 THUR 4:00PM TO 7:00PM </option>
                        <option value=\"$C1\" > C1 FRI 10:00AM TO 1:00PM </option>
                        <option value=\"$C2\" > C2 FRI 1:00PM TO 4:00PM </option>
                        <option value=\"$C3\" >C3 FRI 4:00PM TO 7:00PM </option>";
                }else if($week==3 && $time<10){
                    echo "<option value=\"$B1\" >B1 THUR 10:00AM TO 1:00PM </option>
                    <option value=\"$B2\" > B2 THUR 1:00PM TO 4:00PM </option>
                    <option value=\"$B3\" >B3 THUR 4:00PM TO 7:00PM </option>
                    <option value=\"$C1\" > C1 FRI 10:00AM TO 1:00PM </option>
                    <option value=\"$C2\" > C2 FRI 1:00PM TO 4:00PM </option>
                    <option value=\"$C3\" >C3 FRI 4:00PM TO 7:00PM </option>";

                }else if($week==3 && $time>10 && $time<13){
                    echo "<option value=\"$B2\" > B2 THUR 1:00PM TO 4:00PM </option>
                    <option value=\"$B3\" >B3 THUR 4:00PM TO 7:00PM </option>
                    <option value=\"$C1\" > C1 FRI 10:00AM TO 1:00PM </option>
                    <option value=\"$C2\" > C2 FRI 1:00PM TO 4:00PM </option>
                    <option value=\"$C3\" >C3 FRI 4:00PM TO 7:00PM </option>";

                }else if($week==3 && $time>13 && $time<16){
                    echo "<option value=\"$B3\" >B3 THUR 4:00PM TO 7:00PM </option>
                    <option value=\"$C1\" > C1 FRI 10:00AM TO 1:00PM </option>
                    <option value=\"$C2\" > C2 FRI 1:00PM TO 4:00PM </option>
                    <option value=\"$C3\" >C3 FRI 4:00PM TO 7:00PM </option>";

                }else if($week==3 && $time>16){
                    echo "<option value=\"$C1\" > C1 FRI 10:00AM TO 1:00PM </option>
                            <option value=\"$C2\" > C2 FRI 1:00PM TO 4:00PM </option>
                            <option value=\"$C3\" >C3 FRI 4:00PM TO 7:00PM </option>";

                }else if($week==4 && $time<10){
                    echo "<option value=\"$C1\" > C1 FRI 10:00AM TO 1:00PM </option>
                    <option value=\"$C2\" > C2 FRI 1:00PM TO 4:00PM </option>
                    <option value=\"$C3\" >C3 FRI 4:00PM TO 7:00PM </option>";
                }else if($week==4 && $time>10 && $time<13){
                    echo "<option value=\"$C2\" > C2 FRI 1:00PM TO 4:00PM </option>
                    <option value=\"$C3\" >C3 FRI 4:00PM TO 7:00PM </option>";
                }else if($week==4 && $time>13 && $time<16){
                    echo "<option value=\"$C3\" >C3 FRI 4:00PM TO 7:00PM </option>";
                }else if($week==4 && $time>16){
                    echo "<option value=\"$A1\" > A1 WED 10:00AM TO 1:00PM </option>
                            <option value=\"$A2\" >A2 WED 1:00PM TO 4:00PM </option>
                            <option value=\"$A3\" >A3 WED 4:00PM TO 7:00PM </option>
                            <option value=\"$B1\" >B1 THUR 10:00AM TO 1:00PM </option>
                            <option value=\"$B2\" > B2 THUR 1:00PM TO 4:00PM </option>
                            <option value=\"$B3\" >B3 THUR 4:00PM TO 7:00PM </option>
                            <option value=\"$C1\" > C1 FRI 10:00AM TO 1:00PM </option>
                            <option value=\"$C2\" > C2 FRI 1:00PM TO 4:00PM </option>
                            <option value=\"$C3\" >C3 FRI 4:00PM TO 7:00PM </option>";
                }else{ echo "<option value=\"$A1\" > A1 WED 10:00AM TO 1:00PM </option>
                    <option value=\"$A2\" >A2 WED 1:00PM TO 4:00PM </option>
                    <option value=\"$A3\" >A3 WED 4:00PM TO 7:00PM </option>
                    <option value=\"$B1\" >B1 THUR 10:00AM TO 1:00PM </option>
                    <option value=\"$B2\" > B2 THUR 1:00PM TO 4:00PM </option>
                    <option value=\"$B3\" >B3 THUR 4:00PM TO 7:00PM </option>
                    <option value=\"$C1\" > C1 FRI 10:00AM TO 1:00PM </option>
                    <option value=\"$C2\" > C2 FRI 1:00PM TO 4:00PM </option>
                    <option value=\"$C3\" >C3 FRI 4:00PM TO 7:00PM </option>";
                }
                    

                echo "</select>";
            ?>
            <?php if($paypal==false){ ?>
                <input type="submit" value="Confirm Collection Slot" name="collection_slot">
            <?php } ?>
            
          
        </form>
        <form action="payments.php" method="post">
               
               <input type="hidden" name="cmd" value="_cart">
                   <input type="hidden" name="upload" value="1">
                   <input type="hidden" name="no_note" value="1">
                   <input type="hidden" name="lc" value="UK">                                                                                 
                   <!-- Specify a Buy Now button. -->
                
                   <?php
                   
                   if(isset($_SESSION['userid'])){
                    $userid=$_SESSION['userid'];
                }
                $query="SELECT * FROM SHOPPING_CART WHERE FK1_USERID=$userid";
                $parse=oci_parse($connection,$query);
                $result=oci_execute($parse);
                $row=oci_fetch_assoc($parse);
                $cartid=$row['SHOPPINGCARTID'];
                $_SESSION['cartsid']=$cartid;
                        $i=0;
                       $query="SELECT * FROM PRODUCT p,CART_PRODUCT__DETAIL cp  WHERE FK2_SHOPPINGCARTID=$cartid AND p.PRODUCTID=cp.FK1_PRODUCTID";
                       $parse=oci_parse($connection,$query);
                       $execute=oci_execute($parse);
                       while($row=oci_fetch_assoc($parse)){
                           $i++;
                           $productname=$row['PRODUCTNAME'];
                           $quantity=$row['TOTALITEMS'];
                           $price=$row['PRICE'];
                        
                    ?>  
   
                   <input type="hidden" name="item_name_<?php echo $i; ?>" value="<?php echo $productname; ?>">
   
                   <input type="hidden" name="item_number_<?php echo $i; ?>" value="<?php echo $i;?>">
   
                   <input type="hidden" name="amount_<?php echo $i; ?>" value="<?php echo $price;?>">
   
                   <input type="hidden" name="quantity_<?php echo $i; ?>" value="<?php echo $quantity; ?>">
   
                   <!-- Identify your business so that you can collect the payments. -->                                                       
                   <!-- Specify details about the item that buyers will purchase. -->
                  
                   <?php
                   
                   }
               ?>                                                                                         
                   <?php if($paypal==true){ ?><!-- Display the payment button. -->
                        <input style="float:right;margin-top:3px;margin-right:5px;" type="image" name="submit" border="0" src="../icons/rsz_paypal.png">
                   <?php } ?>
                  
               </form>
        </div>
   </div>
   <div class="sidebar">
        <img src="../icons/payment.png">
        <h2>Confirm Your Order</h2>
        <table>
            <tr>
                <th>Item Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <tr>
                <td>Blue Barry</td>
                <td>Rs.1000</td>
                <td>10</td>
            </tr>
            <tr>
                <td>Blue Barry</td>
                <td>Rs.1000</td>
                <td>10</td>
            </tr>
            <tr>
                <td>Blue Barry</td>
                <td>Rs.1000</td>
                <td>10</td>
            </tr>
        </table>
   </div>

   <?php 
        include "footer.php";
   ?>
</body>
</html>