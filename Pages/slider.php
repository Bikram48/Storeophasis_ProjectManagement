<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" type="text/css" href="../CSS/swiper.min.css">
    <link rel="stylesheet" href="../CSS/slider.css">
</head>
<body>
    <div class="swiper-container">
    <div class="swiper-wrapper">

      <div class="swiper-slide">
          <div class="imgBx">
             <a href="shoplist.php?category=Greengrocer">
                <img style ="height:300px;width:300px;" src="../Images/grocery.jpg"></a>
            </div>
            <div class="details">
                <h3>Greengrocer<br><span></span></h3>
            </div>
      </div>

      <div class="swiper-slide">
            <div class="imgBx">
                   <a href="shoplist.php?category=Butcher"> 
                    <img style ="height:300px;width:300px;" src="../Images/11.jpg"></a>
              </div>
              <div class="details">
                  <h3>Butcher <br><span></span></h3>
              </div>
        </div>

            <div class="swiper-slide">
                    <div class="imgBx">
                          <a href="shoplist.php?category=Bakery">
                            <img style ="height:300px;width:300px;" src="../Images/2.jpg"></a>  
                      </div>
                      <div class="details">
                          <h3>Bakery<br><span></span></h3>
                      </div>
                </div>


                                <div class="swiper-slide">
                                        <div class="imgBx">
                                               <a href="shoplist.php?category=Fishmonger">
                                                <img style ="height:300px;width:300px;" src="../Images/7.jpg"></a> 
                                          </div>
                                          <div class="details">
                                              <h3>Fishmonger<br><span></span></h3>
                                          </div>
                                    </div>

                                    <div class="swiper-slide">
                                            <div class="imgBx">
                                                    <a href="shoplist.php?category=Delicatessen">
                                                        <img style ="height:300px;width:300px;" src="../Images/8.jpg"></a>
                                              </div>
                                              <div class="details">
                                                  <h3>Delicatesse<br><span></span></h3>
                                              </div>
                                        </div>

    </div>
    <div class="swiper-pagination"></div>
</div>

<script type="text/javascript" src="../script/swiper.js"></script>
    <!-- JS for swiper -->
  <script>
    var swiper = new Swiper('.swiper-container', {
      effect: 'coverflow',
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: 'auto',
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows : true,
        loop : true,
      },
      pagination: {
        el: '.swiper-pagination',
      },
    });
  </script>

        
      </script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script>s
</script>
</body>
</html>