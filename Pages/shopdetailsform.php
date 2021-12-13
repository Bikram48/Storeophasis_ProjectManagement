<?php
  session_start();
  if(isset($_GET['userid'])){
    $_SESSION['userid']=$_GET['userid'];
  
}

?>
<!DOCTYPE html>
<html>
<title>Demo|Lisenme</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../CSS/shopdetailsform.css">   
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>    
<style>
h1,h2,h3,h4,h5,h6 {font-family: "Oswald"}
body {font-family: "Open Sans"}
</style>
      
    
<body>

<!-- Navigation bar with social media icons -->
<div class="w3-bar w3-black w3-hide-small">

  <a href="https://twitter.com/LisenMee" class="w3-bar-item w3-button"><i class="fa fa-twitter"></i></a>
  <a href="https://www.youtube.com/channel/UCEdC6Qk_DZ9fX_gUYFJ1tsA" class="w3-bar-item w3-button"><i class="fa fa-youtube"></i></a>
  <a href="https://plus.google.com/115714479889692934329" class="w3-bar-item w3-button"><i class="fa fa-google"></i></a>
  <a href="https://www.linkedin.com/in/lisen-me-b017a8137/" class="w3-bar-item w3-button"><i class="fa fa-linkedin"></i></a>
</div>
  
<!-- w3-content defines a container for fixed size centered content, 
and is wrapped around the whole page content, except for the footer in this example -->
<div class="w3-content" style="max-width:1600px">

  <!-- Header -->
  <header class="w3-container w3-center w3-padding-48 w3-white">
    <h1 class="w3-xxxlarge">Storeophasis Team</h1>
    <h6>Welcome to our <span class="w3-tag">Website</span></h6>
  </header>
  
  <!-- Image header -->
 

  <!-- Grid -->
  <form id="msform"  method="POST" action="../backend/shopdetailsformbackend.php?userid" enctype="multipart/form-data">
  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Company Name Setup</li>
    <li>Add Shop Address</li>
    <li>Add Shop Description</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Create your Shop</h2>
    <h3 class="fs-subtitle">This is step 1</h3>
    <input type="text" name="shopname" placeholder="Shop Name" required>
    <div style="box-sizing:border-box;border:1px solid silver;height:35px;padding:5px;" class="category">
    <span style="padding-right:30px;color:silver;">Category:</span>
    <select name="category" required>
        <option>Select Category</option>
        <option>Butcher</option>
        <option>Fishmonger</option>
        <option>Greengrocer</option>
        <option>Bakery</option>
        <option>Delicatessen</option>
    </select>
    </div><br>
    
    <input type="button" name="next" class="next action-button" value="Next" >
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Shop Address</h2>
    <h3 class="fs-subtitle">This is step 2</h3>
    <input type="text" name="address" placeholder="Shop Address" required/>
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Shop Details</h2>
    <h3 class="fs-subtitle">Last Step</h3>
    <textarea name="description" placeholder="Shop Description" required></textarea>
    <input type="file" name="logo" placeholder="CHoose logo" required>
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="submit" name="submit" class="sub action-button" value="Submit">
  </fieldset>
</form>

</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>

    <script src="../JS/index.js"></script>
</body>
</html>
















 
