<?php
        if(isset($_GET['delete'])){
    ?>
    <div style="width:80%;margin-left:10%;height:60px;text-align:center;font-size:20px;font-weight:bolder;" class="alert alert-dark alert-dismissible fade show" role="alert">
          Selected Items is deleted successfully!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
        <?php } ?>

        <?php
        if(isset($_GET['alldelete'])){
    ?>
    <div style="width:80%;margin-left:10%;height:60px;text-align:center;font-size:20px;font-weight:bolder;" class="alert alert-dark alert-dismissible fade show" role="alert">
        All items are deleted successfully!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
        <?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../script/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="stylesheet" href="../CSS/addtocarts.css">
    <title>Add to cart</title>
</head>
<body>
    <?php include "Navbar.php"; ?>
    <?php
        include "../functions/addcart.php";
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

       
      
    ?>
   
    <?php
   
    if(isset($_GET['cartid'])){
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values)
    {
     if($cart_data[$keys]['item_id'] == $_GET["cartid"])
     {
      unset($cart_data[$keys]);
      $item_data = json_encode($cart_data);
      setcookie("shopping_cart", $item_data, time() + (86400 * 30));  
     }
    }
}

    if(isset($_GET['action'])=='clear'){
        setcookie("shopping_cart", "", time() - 3600);
    }
?>
    
    <?php
                    if(isset($_SESSION['userid'])){
                        $userid=$_SESSION['userid'];
                    }
                	$query="SELECT * FROM SHOPPING_CART WHERE FK1_USERID=$userid";
                    $parse=oci_parse($connection,$query);
                    $result=oci_execute($parse);
                    $row=oci_fetch_assoc($parse);
                    $cartid=$row['SHOPPINGCARTID'];
                    
                    $_SESSION['cartsid']=$row['SHOPPINGCARTID'];

                    $query="SELECT * FROM ORDERS WHERE FK2_SHOPPINGCARTID=$cartid";
                    $parse=oci_parse($connection,$query);
                    $result=oci_execute($parse);
                    $row=oci_fetch_assoc($parse);
                    $orderid=$row['ORDERID'];
                    
                    $_SESSION['ordersid']=$row['ORDERID'];
            ?>
    <div class="main">
      <h1>Your Cart</h1>
    </div>
    <div class="header">
        <h1>Your Cart</h1>
    </div>

    <div class="shopping-cart"> 
        <div class="column-labels">
            <label class="product-image"><center>Image</center></label>
            <label class="product-details"><center>Product</center></label>
            <label class="product-price">Price</label>
            <label class="product-quantity">Quantity</label>
            <label class="product-removal">Action</label>
        </div>
        <?php
         
            if(!isset($_SESSION['userid'])){ 
              if(isset($_COOKIE['shopping_cart'])){
                $cookie_data=stripslashes($_COOKIE['shopping_cart']);
                $cart_data=json_decode($cookie_data,true);
                foreach($cart_data as $keys => $values){
                  $item_data= $values['item_id'];
                  $item_quantity=$values['item_quantity'];
                  $query="SELECT * FROM PRODUCT WHERE PRODUCTID=$item_data";
                  $parse=oci_parse($connection,$query);
                  $result=oci_execute($parse);
                  while(($row = oci_fetch_assoc($parse))){
        ?>
        <div class="product">
            <div class="product-image">
                <?php echo "<img src=../Images/".$row['IMAGE'].">"; ?>
            </div>

          <div class="product-details">
              <div class="product-title"><?php echo $row['PRODUCTNAME']; ?></div>
          </div>

          <div class="product-price"><div class="price"><?php echo "£ ".$row['PRICE']; ?></div></div>

          <div style="margin-top:40px;" class="product-quantity">
          <option value=""><?php echo $item_quantity; ?></option>
             
          </div>

          <div class="product-removal">
           <?php echo "<a href='addtocarts.php?cartid=$item_data'>
            <button class='remove-product'>
              <i class='fas fa-trash-alt'></i> Remove
            </button>
            </a>";
            ?>
          </div>

        </div>
        
  
        <?php
              }
            }
          }
        }
        else{
          $count=0;
          $query="SELECT * FROM PRODUCT p, CART_PRODUCT__DETAIL CP WHERE CP.FK2_SHOPPINGCARTID=$cartid AND p.PRODUCTID=CP.FK1_PRODUCTID";

          $parse=oci_parse($connection,$query);
          $result=oci_execute($parse);
          while(($row = oci_fetch_assoc($parse))){
            $count++;
            $max_order=$row['MAX_ORDER'];
            $productid=$row['FK1_PRODUCTID'];
            if($count>0){
        ?>

         <div class="product">
            <div class="product-image">
                <?php echo "<img src=../Images/".$row['IMAGE'].">"; ?>
            </div>

          <div class="product-details">
              <div class="product-title"><?php echo $row['PRODUCTNAME']; ?></div>
          </div>
            
          <div class="product-price"><div class="price"><?php echo "£ ".$row['PRICE']; ?></div></div>
        <form action="" method="POST">
          <input type="hidden" value="<?php echo $row['PRODUCTID']; ?>" name="productid">
          <div class="product-qty">
            <select name="quantity" id="">
              <option value=""><?php echo $row['TOTALITEMS']; ?></option>
              <?php
                  for($j=1;$j<=$max_order;$j++){
                    echo "<option value=".$j.">".$j."</option>";
                  }
              ?>
            </select>
            <input type="submit" name="update_carts" value="UPDATE">
          
        </form>  
         
          </div>

          <div class="product-removal">
          <?php echo "<a href='../backend/deletecartproduct.php?cartid=$productid'>
            <button class='remove-product'>
              <i class='fas fa-trash-alt'></i> Remove
            </button>
            </a>";
            ?>
           
          </div>
          

        </div>
        <?php
            }
            else{
              echo "<h1 style=text-align:center;>"."No items to show"."</h1>";
            }
        }
   
        if(isset($_POST['update_carts'])){
         $productid=$_POST['productid'];
          $quantity=$_POST['quantity'];
          if(updateCartQuantity($productid,$quantity)==true){
            $message= "Cart is updated successfully";
            echo "<script type='text/javascript'>alert('$message');</script>";
          }
  
        }

      }
        ?>


    </div>
<?php   
if(!isset($_SESSION['userid'])){
  if(isset($_COOKIE['shopping_cart'])){
    $total_price=0;
    $cookie_data=stripslashes($_COOKIE['shopping_cart']);
    $cart_data=json_decode($cookie_data,true);
    foreach($cart_data as $keys => $values){
      $item_data= $values['item_id'];
      $item_quantity=$values['item_quantity'];
      $query="SELECT PRICE FROM PRODUCT  WHERE  PRODUCTID=$item_data";
      //$query="SELECT * FROM PRODUCT WHERE PRODUCTID=$item_data";
      $parse=oci_parse($connection,$query);
      $result=oci_execute($parse);
      $row=oci_fetch_assoc($parse);
      $price=$row['PRICE'];
      $total_price=$total_price+($item_quantity*$price);
    }
?>
<div class="sub-total">

<div class="button" onclick="openModal()">
   
   <a class="link">Checkout</a>
   
</div>
<div class="total">
<h2>Total Amount: <?php echo "£ ".$total_price; ?></h2>
<?php echo "<a href='addtocarts.php?action=clear'>
            <button class='clear-all'>
              <i class='fas fa-trash-alt'></i> Clear All
            </button>
            </a>";
            ?>
</div>
</div>
<?php }} else{
  
    $qry="SELECT sum(PRICE*TOTALITEMS) FROM PRODUCT p, CART_PRODUCT__DETAIL CP WHERE CP.FK2_SHOPPINGCARTID=$cartid  AND p.PRODUCTID=CP.FK1_PRODUCTID";
    $parse=oci_parse($connection,$qry);
    $result=oci_execute($parse);
   while($row = oci_fetch_assoc($parse)){
       $total_price=$row['SUM(PRICE*TOTALITEMS)'];
   }
?>   
<div class="sub-total">

<div class="button" onclick="openModal()">
   
   <a class="link">Checkout</a>
   
</div>
<div class="total">
<h2>Total Amount: <?php echo "£ ".$total_price; ?></h2>
<?php echo "<a href='../backend/deleteallcartproduct.php?cartid=$cartid'>
            <button class='clear-all'>
              <i class='fas fa-trash-alt'></i> Clear All
            </button>
            </a>";
            ?>
</div>
</div>
  <?php } ?> 


<?php if(isset($_SESSION['userid'])){ 
    

  ?>
<!------------------------------ Modal-box -------------------------------------->
<div class="dialog">
    <div class="dialog__body">
        <div class="dialog__header">
            <h4>Checkout</h4>
            <button class="dialog__close" onclick="closeModal()"><i class="fas fa-times"></i></button>
        </div>
    
        <div class="dialog__content">
       
        <table>

        <?php 
      
          $query="SELECT * FROM PRODUCT p, CART_PRODUCT__DETAIL CP WHERE CP.FK2_SHOPPINGCARTID=$cartid AND p.PRODUCTID=CP.FK1_PRODUCTID";
      $parse=oci_parse($connection,$query);
      $result=oci_execute($parse);
 
        while(($row = oci_fetch_assoc($parse))){
             $productid=$row['PRODUCTID'];
             
          ?>
      
    <tr>
        <td> <?php echo "<img src=../Images/".$row['IMAGE'].">"; ?></td>
        <td><div class="title" ><?php echo $row['PRODUCTNAME']; ?></div>
        
        <div>Quantity: <input style="width:40px;" type="number" value="<?php echo $row['TOTALITEMS'] ?>" > </div>

        <?php if(checkDiscount($productid)==true){ ?>
        <div class="mny"> <?php $amount=getTotalAmount($productid); echo "<del>".$row['PRICE']."</del> ".$amount; ?></div> 
        <?php } else{ ?>
        <div class="mny"> <?php  echo "£ ".$row['PRICE']; ?></div> 
        <?php }?>
        <hr>
      </td>
      
    </tr>
     
      <?php } ?>
     
   
</table>

<hr>
<div class="dis">
<table>
  <tr>
    <td>Sub-total:</td><td><?php echo "£ ".$total_price ?></td>
</tr>
 

</table>
</div>
   <hr> 

<div class="ttl">
   <table>
  <tr>
    <td>Total:</td><td><div class="ttl-2"><?php echo "£ ".$total_price ?></div></td>
</tr>
</table>
</div>
<div style="margin-top:50px;" class="collection-slot">



<?php
 
?>
<form action="" method="POST">
           
            <?php 
                echo "<select name='collectionslot' id='slot'>";
                echo "<option> Choose Collection Slot </option>";
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
                <input type="submit" value="Confirm_Collection_Slot" name="choose_slot">
            </form>
            </div>
            <?php 
                 if(isset($_POST['choose_slot'])){
         
                  include "../functions/collectionslot.php";
                  $selectedslot=$_POST['collectionslot'];
                  $split=explode(" ",$selectedslot);
                  $slotname=$split[2];
                  $slotTime=$split[1]." - ". date('H:i', strtotime("$split[1] +3 hours"));
          
                  $slotdate=$split[0];
                  $day=date('D',strtotime($slotdate));
                  
                  $_SESSION['slotname']=$slotname;
                  $_SESSION['slotTime']=$slotTime;
                  $_SESSION['slotdate']=$slotdate;
                  $_SESSION['day']=$day;
                  echo "<p style=font-weight:bolder;> Collection Date:".$_SESSION['slotdate']." </p>";
                  echo "<p style=font-weight:bolder;> Collection Time:".$_SESSION['slotTime']." </p>";
                  echo "<p style=font-weight:bolder;> Collection Day:".$_SESSION['day']." </p>";
                }
            ?>
<?php if(isset($_SESSION['slotname'])){ ?>
<div class="button">
  <a class="link">Checkout</a>
  <form action="payments.php" method="post">
               
            <input type="hidden" name="cmd" value="_cart">
                <input type="hidden" name="upload" value="1">
                <input type="hidden" name="no_note" value="1">
                <input type="hidden" name="lc" value="UK">                                                                                 
                <!-- Specify a Buy Now button. -->
             
                <?php
                    
                     $i=0;
                    $query="SELECT * FROM PRODUCT p,CART_PRODUCT__DETAIL cp  WHERE FK2_SHOPPINGCARTID=$cartid AND p.PRODUCTID=cp.FK1_PRODUCTID";
                    $parse=oci_parse($connection,$query);
                    $execute=oci_execute($parse);
                    while($row=oci_fetch_assoc($parse)){
                        $i++;
                        $productname=$row['PRODUCTNAME'];
                        $pidd=$row['PRODUCTID'];
                        $quantity=$row['TOTALITEMS'];
                        if(checkDiscount($pidd)==true){
                          $price=getTotalAmount($pidd);
                      
                        }
                        else{
                          $price=$row['PRICE'];
                        }
                     
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
                <!-- Display the payment button. -->
                <input style="position:relative;left:150px;height:50px;" type="image" name="submit" border="0" src="../icons/rsz_paypal.png">
               
            </form>

   </div>
  </div>
        </div>
    </div>
</div>

<?php }}?>
</section>
<br><br><br><br><br>

<!------------------------------ End of Modal-box -------------------------------------->
<script>
  function openModal(side){
    const dialog = document.querySelector('.dialog');
    if(dialog){
        dialog.classList.add('dialog--open');        
    }
}
function closeModal(){
    const dialog = document.querySelector('.dialog');
    if(dialog){
        dialog.classList.remove('dialog--open');
    }
}
  </script>

</body>
</html>