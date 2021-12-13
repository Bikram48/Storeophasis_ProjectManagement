<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../script/css/bootstrap.min.css">
    <style>
    body{
        background-image: url(../Images/Verify-bg.jpg);
        background-size:cover;
        background-repeat: no-repeat;
        background-position: center;
        width: 100%;
        height:100%;
        }
    .container{
        margin-top: 15%;
        margin-left:40%;
        width: 350px;
        height: 320px;
        border-radius: 15px;
        box-shadow: 0 10px 15px 20px rgba(88, 88, 88, 0.3);
        background-color:transparent;
    }
        .container img{
            margin-left: 20%;
        } 
        .container p{
            text-align: center;
            font-weight:bolder;
            left:45%;
        }

        /* button */

html *,
html *:before,
html *:after {
  box-sizing: border-box;
  transition: 0.5s;
}

span {
  transition: none;
}

*:before,
*:after {
  z-index: -1;
}


a {
  text-decoration: none;
  line-height: 80px;
  color: black;
}

[class^="btn"] {
  position: relative;
  display: block;
  margin: 20px auto;
  width: 100%;
  height: 50px;
  max-width: 250px;
  text-transform: uppercase;
  overflow: hidden;
  border: 1px solid currentColor;
}

.btn {
  color: black;
}
.btn:before, .btn:after,
.btn span:before,
.btn span:after {
  content: '';
  position: absolute;
  top: 0;
  width: 63.5px;
  height: 0;
  background: black;
}
.btn:before {
  left: 0;
}
.btn:after {
  left: 125px;
}

.btn span:before, .btn span:after {
  top: auto;
  bottom: 0;
}
.btn span:before {
  left: 62.5px;
}
.btn span:after {
  left: 187.5px;
}
.btn:hover {
  color: #fff;
}
.btn:hover:before, .btn:hover:after,
.btn:hover span:before,
.btn:hover span:after {
  height: 80px;
}
.btn:active {
  background: #4fb567;
}


    </style>
</head>
<body>
    
    <div class="container">
        <img width=200 src="../Images/verify.png" alt="">
        <p>Email have been successfully verified!</p>

        <a class="btn" href="Login.php"><span>Go To Login Page</span></a>
    </div>

</body>
</html>