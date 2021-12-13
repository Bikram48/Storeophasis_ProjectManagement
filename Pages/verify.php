
<?php include "Navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../script/css/bootstrap.min.css">
    <title>Document</title>
    <style>
        .box{
            margin-top:20%;
            width:80%;
            margin-left:10%;
            height:300px;
            -webkit-box-shadow: 0px 1px 8px 1px rgba(145,143,145,1);
            -moz-box-shadow: 0px 1px 8px 1px rgba(145,143,145,1);
            box-shadow: 0px 1px 8px 1px rgba(145,143,145,1);
        }
        .box img{
            width:100px;
            height:100px;
            position:absolute;
            left:45%;
        }

        h1{
            position:absolute;
            top:50%;
            font-size:18px;
            left:42%;
        }
        p{
            position:relative;
            top:60%;
            left:32%;
            font-weight:bolder;
        }

        .addshop{
            width:140px;
            height:35px;
            position:relative;
            top:80%;
            left:100px;
        }

        @media screen and (min-width:350px) and (max-width:475px){
            h1{
                position:absolute;
                left:30%;
            }
            p{
                position:relative;
                left:26%;
            }

            .addshop{
                position:relative;
                top:70%;
            }
        }

        @media screen and (min-width:475px) and (max-width:775px){
            h1{
                position:absolute;
                left:30%;
            }
            p{
                position:relative;
                left:26%;
            }

            .addshop{
                position:absolute;
                top:63%;
                left:40%;
            }
        }
    </style>
</head>

<body>
<?php   
    include "../backend/connect.php";
    if(isset($_GET['userid'])){
        $userid=$_GET['userid'];
    }
    if(isset($_GET['vkey'])){
        $vkey=$_GET['vkey'];

        $query="SELECT ISVERIFIED,VERIFICATIONCODE FROM USERS WHERE ISVERIFIED='N' AND VERIFICATIONCODE='$vkey'";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        $find=oci_fetch_assoc($parse);
        $row=oci_num_rows($parse);
        if($row==1){
            $query="UPDATE USERS SET ISVERIFIED='Y' WHERE VERIFICATIONCODE='$vkey'";
            $parse=oci_parse($connection,$query);
            $result=oci_execute($parse);
            if($result){
    
?>
    <div class="container">
        <div class="row box">
            <img src="../Images/verified.png">
            <h1>Your account has been verified</h1>
            <p>Click Below to add your shop</p>
            <?php echo "<a href=shopdetailsform.php?userid=".$userid."><button class='addshop' type='button'>Add Shop</button></a>" ?>
        </div>
   
    </div>
        <?php }} else{
            ?>
            <h2 style="font-size:23px;font-weight:bolder;text-align:center;margin-top:15%;">Invalid Verification Key Or Verification code is already in used</h1>
        <?php }} ?>
</body>
</html>
