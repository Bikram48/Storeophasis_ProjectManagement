<?php
    if(isset($_GET['productid'])&&$_GET['id']){
        $productid=$_GET['productid'];
        $id=$_GET['id'];
        echo $id;
    }
?>
<div class="modal fade" id='<?php echo $id ?>' tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Edit Quantity</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
	  <form action="" method="POST">
      <div class="modal-body mx-3">
      
        <div class="md-form mb-5">
          Quantity: <select name="quantity" id="">
              <option value=""><?php echo $total_items; ?></option>
              <?php
                  for($j=1;$j<=$max_order;$j++){
                    echo "<option value=".$j.">".$j."</option>";
                  }
              ?>
            </select>
        
        </div>
	
       
		 <div class="modal-footer d-flex justify-content-center">
					<input type="submit" value="UPDATE QUANTITY" name="review_update">
      </div>
	  </form>
      </div>
    
    </div>
  </div>
</div>
      
    </div>
    <?php
    
             if(isset($_POST['editquantity'])){
               $quantity=$_POST['quantity'];
               updateCartQuantity($productid,$quantity);
             }
        ?>