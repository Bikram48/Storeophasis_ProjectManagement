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
    <link rel="stylesheet" href="../CSS/categories.css">
    
    <title>category</title>
</head>
<body>
<?php
  include('Navbar.php');?>

    <!-- Slider-->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../Images/Butcher.jpg" class="d-block w-100" alt="Butcher">
    </div>
    <div class="carousel-item">
      <img src="../Images/Greengrocer.jpg" class="d-block w-100" alt="Greengrocer">
    </div>
    <div class="carousel-item">
      <img src="../Images/Fishmonger.jpg" class="d-block w-100" alt="Fishmonger">
    </div>
    <div class="carousel-item">
      <img src="../Images/Bakery.jpg" class="d-block w-100" alt="Bakery">
    </div>
    <div class="carousel-item">
      <img src="../Images/Delicatessen.jpg" class="d-block w-100" alt="Delicatessen">
    </div>
    
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<hr>
<section class="carousel">
<?php
  include('slider.php');?>

</section>
<hr>
<section class="Grid">
<div class="main">
<h1>Category</h1>
		
		<div class="Grid-item">
			<div class="img">
                <img src="../Images/1.jpg" />
                <div class="overlay">
                    <div class="content">
                    <a href="#">Bakery</a>
                    </div>
                </div>
			</div>
			<div class="img">
                <img src="../Images/2.jpg" />
                <div class="overlay">
                    <div class="content">
                    <a href="#">Cake</a>
                    </div>
                </div>
			</div>
			<div class="img">
                <img src="../Images/3.jpg" />
                <div class="overlay">
                    <div class="content">
                        <a href="#">Delicatessen</a>
                    </div>
                </div>
			</div>
			<div class="img">
                <img src="../Images/4.jpg" />
                <div class="overlay">
                    <div class="content">
                    <a href="#">Butchers</a>
                    </div>
                </div>
			</div>
			<div class="img">
                <img src="../Images/5.jpg" />
                <div class="overlay">
                    <div class="content">
                    <a href="#">Greengrocer</a>
                    </div>
                </div>
			</div>
			<div class="img">
                <img src="../Images/6.jpg" />
                <div class="overlay">
                    <div class="content">
                    <a href="#">Fishmonger</a>
                    </div>
                </div>
			</div>
			<div class="img">
                <img src="../Images/7.jpg" />
                <div class="overlay">
                    <div class="content">
                    <a href="#">Seafood</a>
                    </div>
                </div>
			</div>
			<div class="img">
                <img src="../Images/8.jpg" />
                <div class="overlay">
                    <div class="content">
                    <a href="#">Cheese</a>
                    </div>
                </div>
			</div>
			
		</div>
	</div>
</section>

<hr>

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
                <img src="../Images/3.png">
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

    <?php include "footer.php";?>
    
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" 
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
</script>
</body>
</html>