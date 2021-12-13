<?php
    session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/Navbar.css">
    <link rel="stylesheet" href="../script/autocomplete/autocomplete-0.3.0.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


    <script src="../script/jquery.min.js"></script>
    <script src="../script/popper.min.js"></script>
    <script src="../script/js/bootstrap.js"></script>
      
</head>

<body>
    <header>
            <div class="menu-toggle"></div>
            <a href="index1.php" class="logo"><img src="../Images/Logo2.png" alt="LOGO" style="width:210px;height:80px;"></a>
            <nav>
                <ul>
                    <li><a href="shop_category.php">Categories</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                    <?php error_reporting(E_ERROR); $shopid=$_SESSION['shopid']; if($_SESSION['traderid']):?>
                    <?php echo"<li><a href=../trader/ShopList.php?shopid=".$shopid.">Dashboard</a></li>"?>
                    <?php endif ?>
                    <li><a href="about.php">About</a></li>
                    <!-- <li><a href="#">Search</a></li> -->
                    <div class="search-container">
                     <form action="searchpage.php">
                    <input type="text" placeholder="Search.." name="search-txt" id="search" autocomplete="off">
                    <button name="search" type="submit"><i class="fa fa-search"></i></button>
                     </form>
                     <div id="productlist" >
                    
                     </div>
                     </div>
                    <li><a href="addtocarts.php">Cart<i class="fa fa-shopping-cart"></i></a></li>
                    <?php 
                        include "../backend/connect.php";
                        if(isset($_SESSION['userid'])){
                            $userid=$_SESSION['userid'];
                            $query="SELECT PROFILEPICTURE FROM USERS WHERE USERID=$userid";
                            $parse=oci_parse($connection,$query);
                            $result=oci_execute($parse);
                            $row=oci_fetch_assoc($parse);
                    ?>
                      <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                            <?php echo "<img class='user-avatar rounded-circle' src=../customer_images/".$row['PROFILEPICTURE'].">";?>
                            
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="userprofile.php"><i class="fa fa-user"></i> My Profile</a>
                            <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                    <?php } else{ ?>
                    
                        <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <p><i style="font-size:20px;margin-top:13px;color:black;" class="fas fa-user"></i></p>   
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="userprofile.php"><i class="fa fa-user"></i> My Profile</a>
                            <a class="nav-link" href="Login.php"><i class="fa fa-user"></i> Customer Login</a>
                            <a class="nav-link" href="TraderLogin.php"><i class="fa fa-user"></i> Trader Login</a>
                            <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                        <?php } ?>
                </ul>
            </nav>
            <div class="clearfix">
            
            </div>
    </header>
   


    <script>
        $(document).ready(function(){
            $('#search').keyup(function(){
                var query=$(this).val();

               if(query!=''){
                   $.ajax({
                        url:"../backend/autosearch.php",
                        method:"POST",
                        data:{query:query},
                        success:function(data){
                            $('#productlist').fadeIn();
                            $('#productlist').html(data);
                        }
                   });
               }
               else{
                $('#productlist').fadeOut();
                $('#productlist').html("");
               }
            });

            $(document).on('click','li',function(){
                $('#search').val($(this).text());
                $('#productlist').fadeOut();
            });
        });
    </script>

 
</body>
</html>