<?php
    include "../backend/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" 
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/shop_category.css">
    <title>Shop List</title>
</head>
<body>
<?php
  include('Navbar.php');?>

    <!-- Slider-->
    <div class="banner">
<img src="../Images/Banner1.jpg" alt="Banner">
</div>
<div class="overlay">
            <a href="#">Welcome to the storeophasis</a>
        </div>
        
        
<div class="headbtn">
  <button>
    <span class="text">
      View
    </span>

    <span class="hover">
      more &rarr;
    </span>
  </button>
 
</div>


</div>

<section class="website-features">
    <div class="container">
        <div class="row">
            <div class="col-md-3 feature-box">
                <img src="../Images/1.png">
                    <div class="feature-text">
                        <p><strong>100% organic products</strong> are a available</p>
                    </div>
            </div>

            <div class="col-md-3 feature-box">
                <img src="../Images/discount.png">
                    <div class="feature-text">
                        <p><strong>Discount</strong> is available in many products</p>
                    </div>
            </div>


            <div class="col-md-3 feature-box">
                <img src="../Images/4.png">
                    <div class="feature-text">
                        <p><strong>Fast Delivery</strong> is available</p>
                    </div>
            </div>

            <div class="col-md-3 feature-box">
                <img src="../Images/6.png">
                    <div class="feature-text">
                        <p><strong>Online Payment</strong> is available</p>
                    </div>
            </div>
        </div>
    </div>
</section>

<section class="carousel">
<?php
  include('slider.php');?>

</section>
<section class="Grid">
<div class="main">
<div class="Grid-item">
			<div class="img">
                <img src="../Images/1.jpg" />
                <div class="overlay">
                    <div class="content">
                    <a href="shoplist.php?category=Bakery">Bakery</a>
                   
                    </div>
                </div>
			</div>
			<div class="img">
                <img src="../Images/3.jpg" />
                <div class="overlay">
                    <div class="content">
                    <a href="shoplist.php?category=Delicatessen">Delicatessen</a>
                    </div>
                </div>
			</div>
			<div class="img">
                <img src="../Images/6.jpg" />
                <div class="overlay">
                    <div class="content">
                        <a href="shoplist.php?category=Fishmonger">Fishmonger</a>
                    </div>
                </div>
			</div>
			<div class="img">
                <img src="../Images/4.jpg" />
                <div class="overlay">
                    <div class="content">
                    <a href="shoplist.php?category=Butcher">Butchers</a>
                    </div>
                </div>
			</div>
			<div class="img">
                <img src="../Images/5.jpg" />
                <div class="overlay">
                    <div class="content">
                    <a href="shoplist.php?category=Greengrocer">Greengrocer</a>
                    </div>
                </div>
            </div>
</div>
        </div>
</section>

<?php
  include('footer.php');?>


    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" 
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>