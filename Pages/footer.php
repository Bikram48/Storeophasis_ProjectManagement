<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" 
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" href="../CSS/Footer.css">
</head>
<body>
  <!-- Footer-->

<footer>
    <div class="container-fluid p-0">
      <div class="row text-left">
        <div class="col-md-2 col-sm-12">
          <h4 class="text-light">Category</h4>
          <p class="text-muted"><a href="#">Butchers</a><br><a href="#">Greengrocer</a><br><a href="#">Fishmonger</a>
            <br><a href="#">Bakery</a><br><a href="#">Delicatessen</a></p>
        </div>
        <!------------------- 2nd row ----------------------->
        
        <div class="col-md-2 col-sm-12">
          <h4 class="text-light">Shop</h4>
          <p class="text-muted"><a href="#">The Butcher Shop</a><br><a href="#">Greengrocer Store</a><br><a href="#">The Fishmonger</a>
            <br><a href="#">Bakery Shop</a><br><a href="#">The Delicatessen</a></p>
        </div>


        <div class="col-md-2 col-sm-12">
          <h4 class="text-light">Follow Us</h4>
          <p class="text-muted">Storeophasis club</p>
          <p class="text-muted">Storeophasis Status</p>
          <div class="column text-light">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-youtube"></i>
          </div>
        </div>

        <div class="col-md-5 col-sm-12">
          <h4 class="text-light">Get inspired with us!<br> Subscribe to our news,<br> events and stories.</h4>
          
          <form class="form-inline">
            <div class="col pl-0">
              <div class="input-group pr-5">
                <input type="text" class="form-control bg-dark text-white" id="inlineFormInputGroupUsername2" placeholder="YOUR E-MAIL">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <a href="#" style="color:white;"><i class="fas fa-arrow-right"></i></a>
                  </div>
                </div>
          </form>
        </div>
        </div>
              <p class="text-muted" style="padding-top:10px;">I agree with the processing of personal<br>
               data and wish to receive information about<br> news and special offers.</p>
            </div>
      </div>
    </div>
    
    <div class="bottom">
          <center>
    <p class="pt-4 text-muted">&copy; Copyright <script>document.write(new Date().getFullYear())</script>  &reg; All rights reserved.
            <span> Storeophasis</span>
          </p>
          </center>
</div>

<!-- Back to top button -->
<a id="button"></a>
  </footer>
  <script>
    var btn = $('#button');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});

    </script>
</body>
</html>