
<?php
  include "Navbar.php";
?>

<?php

  include "../backend/connect.php";
  if(isset($_GET['userid'])){
    $userid=$_GET['userid'];
    $query="SELECT s.SHOPID FROM SHOP s,USERS u WHERE u.USERID=$userid AND u.USERID=s.FK1_USERID";
    $parse=oci_parse($connection,$query);
    $result=oci_execute($parse);
      $row=oci_fetch_array($parse,OCI_ASSOC);
    $_SESSION['shopid']=$row['SHOPID'];
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" 
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
            <!-- --------- Owl-Carousel ------------------->
            <link rel="stylesheet" href="../CSS/owl.carousel.min.css">
    <link rel="stylesheet" href="../CSS/owl.theme.default.min.css">

    <!-- ------------ AOS Library ------------------------- -->
    <link rel="stylesheet" href="../CSS/aos.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../CSS/all.css">

    <title>Home</title>
  </head>
  <body>
  <!-- Navbar -->
 
  <!-- Slider -->
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
<!-- Box -->
<div class="container-fluid text-center">
      <?php 
          $product_count=0;
          $query="SELECT * from PRODUCT";
          $parse=oci_parse($connection,$query);
          $result=oci_execute($parse);
          while($row=oci_fetch_assoc($parse)){
            $product_count++;
          }
      ?>
                        <div class="numbers d-flex flex-md-row flex-wrap justify-content-center">
                            <div class="rect">
                                <h1><?php echo $product_count; ?></h1>
                                <p>Products</p>
                            </div>
                            <?php 
          $user_count=0;
          $query="SELECT * from USERS";
          $parse=oci_parse($connection,$query);
          $result=oci_execute($parse);
          while($row=oci_fetch_assoc($parse)){
            $user_count++;
          }
      ?>
                            <div class="rect">
                                <h1><?php echo $user_count; ?></h1>
                                <p>Customers</p>
                            </div>
                            <?php 
          $order_count=0;
          $query="SELECT * from ORDERS";
          $parse=oci_parse($connection,$query);
          $result=oci_execute($parse);
          while($row=oci_fetch_assoc($parse)){
            $order_count++;
          }
      ?>
                            <div class="rect">
                                <h1><?php echo $order_count; ?></h1>
                                <p>Items sold</p>
                            </div>
                            <?php 
          $shop_count=0;
          $query="SELECT * from SHOP";
          $parse=oci_parse($connection,$query);
          $result=oci_execute($parse);
          while($row=oci_fetch_assoc($parse)){
            $shop_count++;
          }
      ?>
                            <div class="rect">
                                <h1><?php echo $shop_count; ?></h1>
                                <p>Total Branches</p>
                            </div>
                        </div>
                    </div>
<!-- section-0 -->
<section class="lap">
<div class="row lap-section">
  <div class="col-md-12 col-sm-12 col-lg-4 col-xl-4 contents" >
  <h2>Storeophasis</h2>
      <p>
          Storeophasis is an online supermarket for all your daily needs.
          It gives you the ability to order from a few different stores at once.
          You get a friendly personal shopper who will run your errands and you can choose from pick-up or delivery.
      </p>
      <div class="medium">
            <button type="button" class="btn btn1"> <b>Our Shop</b> <i class="fas fa-long-arrow-alt-right"> </i></button>
      </div>
   
  </div>
  <!-- Images -->
<div class="col-md-12 col-sm-12 col-lg-8 col-xl-8 imagess">
      <img src="../Images/Body-banner-3.jpg" class="clsThirdImg"/>
      
      <img src="../Images/Body-banner-2.JPG" class="clsSecondImg"/>

      <img src="../Images/Body-banner-1.jpg" class="clsFirstImg" />
  </div>
  </div>
</section>
<!-- section-1 -->
<section class="section-1">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-6">
                        <div class="pray">
                            <img src="../Images/Banner.jpg" alt="Storeophasis">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel text-left">
                            <h1>Storeophasis</h1>
                            <p class="pt-4">
                            Storeophasis allows in-zone customers to choose between 
                            pick-up and delivery (in some cases, only pick-up is an option). It’s pretty darn close to real 
                            grocery shopping, in that you’ll find all the usual name brands, dairy, meat, deli stuff, frozen food … 
                            really, anything you’d find in a mainstream supermarket.
                            </p>
                            <p>
                            While you can type in what you’re looking for into the search bar, you can browse by aisle, so can still kind of go 
                            “up and down” the ones you need, 
                            in the spirit of exploration. You can also check out the specials, add coupons, and sort products by price.
                            </p>
                        </div>
                       
                    </div>

    </section>
    
  
    
<!-- Video Section -->
<?php include "video.php"; ?>
<!-- card -->
   <!-- Section 4 -->
   <section class="section-4">
      <div class="container text-center">
        <h1 class="text-dark text-left" style="font-family:Arial"><strong>News</strong></h1>
      </div>
      <div class="team row ">
        <div class="col-md-4 col-12 text-center">
            <div class="card mr-2 d-inline-block shadow-lg">
                <div class="card-img-top">
                  <img src="../Images/card_photo1.jpg" class="img-fluid border-radius p-1 " alt="">
                </div>
                <div class="card-body">
                  <h3 class="card-title">Manipulating photosynthesis for food security</h3>
                  <p class="card-text">
                  British scientists have gained new insights into the compound 
                  in plants that plays a vital role in the natural process through which plants grow.
                  </p>
                  <a href="https://www.ift.org/iftnext/2020/june/manipulating-photosynthesis-for-food-security"
                   class="text-secondary text-decoration-none">Click here to read more</a>
                </div>
              </div>
        </div>
        <div class="col-md-4 col-12">
            <div id="carouselExampleControls" class="carousel slide " data-ride="carousel">
                <div class="carousel-inner text-center">
                  <div class="carousel-item active">
                    <div class="card mr-2 d-inline-block shadow">
                      <div class="card-img-top">
                        <img src="../Images/card_photo2.jpg" class="img-fluid w-1 p-1" alt="">
                      </div>
                      <div class="card-body">
                        <h3 class="card-title">New appliance refrigerates, stores, and cooks meals</h3>
                        <p class="card-text">
                        Before the emergence of COVID-19 and stay-at-home orders, one of the biggest complaints of busy individuals was not having 
                        time to prepare and cook balanced meals.
                        </p>
                        <a href="https://www.ift.org/iftnext/2020/may/new-appliance-refrigerates-stores-and-cooks-meals" class="text-secondary text-decoration-none">
                        Click here to read more</a>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="card  d-inline-block mr-2 shadow">
                      <div class="card-img-top">
                        <img src="../Images/card_photo3.jpg" class="img-fluid w-1 p-1" alt="">
                      </div>
                      <div class="card-body">
                        <h3 class="card-title">How ripe is your produce? This sensor can tell you</h3>
                        <p class="card-text">
                        Researchers at MIT have developed a sensor to monitor 
                        the plant hormone ethylene to determine when fruits and vegetables are about to spoil.
                        </p>
                        <a href="https://www.ift.org/iftnext/2020/may/how-ripe-is-your-produce" class="text-secondary text-decoration-none">
                        Click here to read more</a>
                      </div>
                    </div>
                  </div>
              </div>
        </div>
        </div>
        <div class="col-md-4 col-12 text-center">
            <div class="card mr-2 d-inline-block shadow-lg">
                <div class="card-img-top">
                  <img src="../Images/card_photo4.jpg" class="img-fluid border-radius p-1" alt="">
                </div>
                <div class="card-body">
                  <h3 class="card-title">NASA technology put to use to make ‘meat’ from air</h3>
                  <p class="card-text">
                  Air Protein has developed a method of making meat analogues out of carbon dioxide. 
                  Based on NASA ideas about how to grow food on board long journey spacecraft,

                  </p>
                  <a href="https://www.ift.org/iftnext/2020/may/nasa-technology-put-to-use-to-make-meat-from-air" 
                  class="text-secondary text-decoration-none">Click here to read more</a>
                </div>
              </div>
        </div>
      </div>
    </section>
  </main>
  <hr>
<!--blog section-->
<!-- one -->
<section class="blog">
<h1>Category</h1>
<div class="card mb-3" style="max-width: 90%; ">

               <div class="row no-gutters">
              <div class="col-md-3">
                <img src="../Images/2.jpg" class="card-img" alt="Image">
    </div>
    <div class="col-md-8">
      <div class="card-body">
      <h2 class="card-title"><b>Bakery<b></h2>
        <p class="card-text">A bakery is an establishment that produces and sells flour-based 
          food baked in an oven <br> such as bread, cookies, cakes, pastries, and pies.</p>
          
      
                    <div class="col-md-3" style="float:right; text-align:center; bottom:70px; left:100px;" >
                    <button type="button" class="btn btn1"> <b>Our Shop</b> <i class="fas fa-long-arrow-alt-right"> </i></button>
                    </div>
                    
      </div>
      
    </div>
  </div>
</div>
<!-- two -->
<div class="card mb-3" style="max-width: 90%; ">

               <div class="row no-gutters">
              <div class="col-md-3">
                <img src="../Images/7.jpg" class="card-img" alt="Image">
    </div>
    <div class="col-md-8">
      <div class="card-body">
      <h2 class="card-title"><b>Fishmonger<b></h2>
        <p class="card-text">The fishmongers guild, was started in the City of London by a Royal Charter from<br> Edward I 
          soon after he became king in 1272. Guild members could not have foreign<br> partners. </p>
          
      
                    <div class="col-md-3" style="float:right; text-align:center; bottom:70px; left:100px;" >
                    <button type="button" class="btn btn1"> <b>Our Shop</b> <i class="fas fa-long-arrow-alt-right"> </i></button>
                    </div>
                    
      </div>
      
    </div>
  </div>
</div>
<!-- three -->
<div class="card mb-3" style="max-width: 90%; ">

               <div class="row no-gutters">
              <div class="col-md-3">
                <img src="../Images/3.jpg" class="card-img" alt="Image">
    </div>
    <div class="col-md-8">
      <div class="card-body">
      <h2 class="card-title"><b>Delicatessen<b></h2>
        <p class="card-text">A delicatessen or deli is a retail establishment that sells a selection of fine,<br>
         unusual, or foreign prepared foods.</p>
          
      
      
                    <div class="col-md-3" style="float:right; text-align:center; bottom:70px; left:100px;" >
                    <button type="button" class="btn btn1"> <b>Our Shop</b> <i class="fas fa-long-arrow-alt-right"> </i></button>
                    </div>
                    
      </div>
      
    </div>
  </div>
</div>
<!-- Four -->
<div class="card mb-3" style="max-width: 90%; ">

               <div class="row no-gutters">
              <div class="col-md-3">
                <img src="../Images/4.jpg" class="card-img" alt="Image">
    </div>
    <div class="col-md-8">
      <div class="card-body">
      <h2 class="card-title"><b>Butchers<b></h2>
        <p class="card-text">Butchers sell their goods in specialized stores, commonly termed a butcher shop <br>
        (American English), butchery (South African English) or butcher's shop (British English).</p>
          
        <p class="card-text"><small class="text-muted">Price: 10$</small></p>
      
                    <button type="button" class="btn btn1"> <b>Our Shop</b> <i class="fas fa-long-arrow-alt-right"> </i></button>
                    </div>
                    
      </div>
      
    </div>
  </div>
</div>
<!-- Five -->
<div class="card mb-3" style="max-width: 90%; ">

               <div class="row no-gutters">
              <div class="col-md-3">
                <img src="../Images/5.jpg" class="card-img" alt="Image">
    </div>
    <div class="col-md-8">
      <div class="card-body">
      <h2 class="card-title"><b>Greengrocer<b></h2>
        <p class="card-text">A greengrocer is a retail trader in fruit and vegetables; that is, in groceries that<br>
         are mostly green in color.</p>
          
      
     
                    <div class="col-md-3" style="float:right; text-align:center; bottom:70px; left:100px;" >
                    <button type="button" class="btn btn1"> <b>Our Shop</b> <i class="fas fa-long-arrow-alt-right"> </i></button>
                    </div>
                    
      </div>
      
    </div>
  </div>
</div>


<script>
                const text = document.querySelector('.card-text');
                text.innerText= text.innerText.substring(0, 200)
            </script> 

<!-- Footer-->

<?php include "footer.php"; ?>
<!---/footer-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- Jquery Library file -->
    <script src="JS/Jquery3.4.1.min.js"></script>


    <!-- ------------ AOS js Library  ------------------------- -->
    <script src="JS/aos.js"></script>

    <!-- Custom Javascript file -->
    <script src="JS/main.js"></script>
  <script>
    /** Animation*/
let nCount=function(selector){
    $(selector).each(function(){

        $(this).animate(
            {
            Counter: $(this).text()
        },
        {
            duration:4000,
            easing:"swing",
            step:function(value){
                $(this).text(Math.ceil(value));
            }
        }
        );
});
};
let a=0;
$(window).scroll(function(){
    let oTop=$(".numbers").offset().top-window.innerHeight;
    if(a==0 && $(window).scrollTop()>=oTop){
        a++;
        nCount(".rect > h1");
    }
})
    </script>
  </body>
</html>