<?php
        if(isset($_GET['message'])=='succeed'){
    ?>
    <div style="width:80%;margin-left:10%;height:60px;text-align:center;font-size:20px;font-weight:bolder;" class="alert alert-dark alert-dismissible fade show" role="alert">
        Your Account has been successfully updated
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
        <?php } 

        if(isset($_GET['error4'])){
        
?>
 <div style="width:80%;margin-left:10%;height:60px;text-align:center;font-size:20px;font-weight:bolder;" class="alert alert-dark alert-dismissible fade show" role="alert">
        Pasword must me 7 characters long,one special character,one alphabet letter and one numeric value
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
        <?php } ?>

        <?php 
        if(isset($_GET['error'])){
        
        ?>
         <div style="width:80%;margin-left:10%;height:60px;text-align:center;font-size:20px;font-weight:bolder;" class="alert alert-dark alert-dismissible fade show" role="alert">
                Sorry!! Password doesn't match
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <?php } ?>
                <?php 
        if(isset($_GET['changed-profile'])){
        
        ?>
         <div style="width:80%;margin-left:10%;height:60px;text-align:center;font-size:20px;font-weight:bolder;" class="alert alert-dark alert-dismissible fade show" role="alert">
                Your Profile picture is changed
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <?php } ?>
                <?php 
        if(isset($_GET['profile-error'])){
        
        ?>
         <div style="width:80%;margin-left:10%;height:60px;text-align:center;font-size:20px;font-weight:bolder;" class="alert alert-dark alert-dismissible fade show" role="alert">
                Only png,gif and jpeg files are supported
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <?php } ?>

                <?php 
        if(isset($_GET['password'])){
        
        ?>
         <div style="width:80%;margin-left:10%;height:60px;text-align:center;font-size:20px;font-weight:bolder;" class="alert alert-dark alert-dismissible fade show" role="alert">
               Your Password is changed..
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <?php } ?>
        
<?php include "Navbar.php"; 
      if(isset($_SESSION['userid'])){
        $userid=$_SESSION['userid'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../CSS/userprofile.css">
    <link rel="stylesheet" href="../script/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
</head>
<body>
  
    <div class="container">
        <div class="profile-header">
        <?php
                            include "../backend/connect.php";
                          
                            $query="SELECT * FROM USERS WHERE USERID=$userid";
                            $parse=oci_parse($connection,$query);
                            $result=oci_execute($parse);
                            while($row=oci_fetch_assoc($parse)){
                            
                        ?>
            <div class="profile-img">
                <?php echo "<img src=../Images/".$row['PROFILEPICTURE']." width='200'>"; ?>
            </div>
                           
            <div class="profile-nav-info">
                <h3 class="username"><?php echo $row['USERNAME']; ?></h3>
                <div class="address">
                    <p class="place"><?php echo $row['EMAIL'];?></p>
                   
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="main-bd">
            <div class="left-side">
                <div class="profile-side">
                <?php
                            include "../backend/connect.php";
                          
                            $query="SELECT * FROM USERS WHERE USERID=$userid";
                            $parse=oci_parse($connection,$query);
                            $result=oci_execute($parse);
                            while($row=oci_fetch_assoc($parse)){
                            
                        ?>
                    <form class="profile-picture" action="../backend/updatecustomeraccount.php" method="POST" enctype="multipart/form-data">
                        <label name="image" for="profile">Change Picture</label>
                        <input style="display:none;" type="file" id="profile" name="image">
                        <input type="submit" class="upload" value="Upload" name="uploadprofile">
                    </form>
                    
                    <p class="mobile-no">
                   
                        <?php echo $row['PHONENUMBER']; ?><i class="fas fa-phone"></i>
                    </p>

                    <p class="user-mail">
                        <i class="fa fa-envelope">
                        </i>
                       <?php echo $row['EMAIL']; ?>
                    </p>

                    <div class="user-age">
                        <p class="bio"> Age &nbsp; &nbsp; <?php echo $row['AGE']; ?>
                        </p>
                    </div>

                    <div class="user-dob">
                        <p class="bio"> Date Of Birth &nbsp; &nbsp; <?php echo $row['DATEOFBIRTH'];  ?>
                        </p>
                    </div>
                   
                            <?php } ?>
                </div>
            </div>

            <div class="right-side">
                <div class="nav">
                    <ul>
                        <li onclick="tabs(0)" class="user-post active" >Update Profile</li>
                        <li onclick="tabs(1)" class="user-review">Your Activity</li>
                        <li onclick="tabs(2)" class="user-setting">Change Password</li>
                    </ul>
                </div>
                <div class="profile-body">
                    <div class="profile-posts tab">
                        <h1>Update Profile</h1>
                        <?php
                            include "../backend/connect.php";
                          
                            $query="SELECT * FROM USERS WHERE USERID=$userid";
                            $parse=oci_parse($connection,$query);
                            $result=oci_execute($parse);
                            while($row=oci_fetch_assoc($parse)){
                            
                        ?>
                        <form action="../backend/updatecustomeraccount.php" method="POST">
                            <div  class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                    <input style="background:none;border:1px solid silver;" type="text" value="<?php echo $row['USERNAME']; ?>" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">
                            </div><br>
                            <div  class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" value="<?php echo $row['EMAIL']; ?>"  name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div><br>
                            <div style="width:100%;" class="form-group">
                                <label for="exampleInputEmail1">Phone Number</label>
                                    <input style="background:none;border:1px solid silver;" type="text" value="<?php echo $row['PHONENUMBER']; ?>"  name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter phone number">
                            </div><br>
                            <div style="width:100%;" class="form-group">
                                <label for="exampleInputEmail1">Date of Birth</label>
                                    <input style="background:none;border:1px solid silver;" type="text" value="<?php echo $row['dateofbirth']; ?>" name="dob" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter date of birth">
                            </div><br>
                            <div style="width:100%;" class="form-group">
                                <label for="exampleInputEmail1">Age</label>
                                    <input style="background:none;border:1px solid silver;" type="text" value="<?php echo $row['AGE']; ?>" name="age" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter age">
                            </div><br>
                            <input type="submit" name="profile_update" value="Update Account" class="profile-btn">
                        </form>
                            <?php } ?>
                    </div>
                    <div class="profile-reviews tab">
                      
                        <h2 style="text-align:center;font-size:21px;font-weight:bold;margin-bottom:40px;   font-family: sans-serif;font-variant: small-caps;">Yours Recently Ordered Items</h2>
                      
                       
        <div class="row blog_list">
        <?php
                            $query="SELECT * FROM PAYMENT PA,USERS U,ORDERS O,CART_PRODUCT__DETAIL CP,SHOPPING_CART SC,PRODUCT P WHERE U.USERID=PA.FK1_USERID AND 
                            PA.INVOICENUMBER=O.FK2_INVOICENUMBER AND  SC.SHOPPINGCARTID=O.FK2_SHOPPINGCARTID AND SC.SHOPPINGCARTID=CP.FK2_SHOPPINGCARTID AND P.PRODUCTID=CP.FK1_PRODUCTID AND U.USERID=$userid";
                            $parse=oci_parse($connection,$query);
                            $result=oci_execute($parse);
                            while($row=oci_fetch_assoc($parse)){
                            $image=$row['IMAGE'];
                            
                           
                        ?>
                    <div class="col-xl-5 ml-5">
                        <div class="product-top">
                            <?php echo "<a href=productdescription.php?productid=".$row['PRODUCTID']."><img src=../Images/".$image."></a>"?>
                            <div class="overlay-right">
                                <button type="button" class="btn btn-secondary" title="Quick shop">
                                    <i class="fa fa-eye"></i>
                                </button>
                        <!-- <button type="button" class="btn btn-secondary" title="Add to wishlist">
                            <i class="far fa-heart"></i> -->
                        </button>
                       
                    </div>
                </div>
                <div class="product-bottom text-left">
                    
                    <h3><?php echo $row['PRODUCTNAME']; ?></h3>
                    <h5>Price: <?php echo $row['PRICE']; ?></h5>
                   
                </div>
            </div>

                        <?php } ?>
                            
                            
            
        </div>
    </div>
    

                    </div>
                    <div class="profile-setting tab">
                    <h1>Change Password</h1>
                        <form action="../backend/updatecustomeraccount.php" method="POST">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="pwd" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                            </div><br>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirm Password</label>
                                <input type="password" name="confirm_pwd" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password" required>
                            </div><br>
                            <input type="submit" name="password_change" value="Change Password" class="password-btn">
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../JS/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>