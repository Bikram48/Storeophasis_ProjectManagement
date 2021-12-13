<?php
    session_start();
    if(isset($_POST['submit'])){
        error_reporting(0);
       include "../backend/connect.php";
       $username=$_POST['username'];
       $email=$_POST['email'];
       $phone=$_POST['phone_number'];
       $dob=$_POST['dob'];
       $age=$_POST['age'];
       $password=$_POST['pwd'];
       $newpassword=md5($password);
       $repeat_password=$_POST['confir_pwd'];
       $userType="customer";
       $verified='N';
       $filename=$_FILES['image']['name'];
       $tmpfilename=$_FILES['image']['tmp_name'];
       $source="../customer_images/".$filename;
       move_uploaded_file($tmpfilename,$source);
       $error=$error1=$error2=$error3=$error4=$error5=$error6=$error7=$error8=$error9=$error10=$error11=$error12=$error13=$error14="";
       $pattern_password='/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';
    
        if(empty($username)){
           $error.="Username is required";
        }
        elseif(strlen($username)<7){
            $error12="Username must be at least 7 character long";
        }
        elseif(empty($email)){
            $error1.="Email is required";
        }
        elseif(empty($phone)){
            $error2.="Phone number is required";
        }
        elseif(empty($dob)){
            $error3.="Date of birth is required";
        }
        elseif(empty($age)){
            $error8.="Age is required";
        }
        elseif(empty($password)){
            $error4.="Password is required";
        }
        elseif(empty($repeat_password)){
            $error5.="Confirm password is required";
        }
       
        elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $error13="Invalid email ID";
        }
        elseif($password!==$repeat_password){
            $error6="Password doesn't match";
        }
        elseif(strlen($password)<7){
            $error8="Password must be at least 7 characters long";
        }
        elseif(!preg_match("#[0-9]+#",$password)){
            $error9="Password must contain at least one number";
        }
        elseif(!preg_match("#[A-Z]+#",$password)){
            $error10="Password must contain at least one capital letter";
        }
        elseif(!preg_match("#[\W]+#",$password)){
            $error11="Password must contain at least one special character";
        }
        else{
            $query="SELECT * FROM USERS WHERE USERNAME='$username' OR EMAIL='$email'";
            $parse=oci_parse($connection,$query);
            $execute=oci_execute($parse);
            $row=oci_fetch_array($parse,OCI_ASSOC);
            $count=oci_num_rows($parse);
            if($count>0){
                $error7="Username or email already exists";
            }
            else{
                include "../functions/RandomGenerate.php";
                $verification_code=random_generate();
                $query="INSERT INTO USERS (USERID,USERNAME,EMAIL,USERROLE,AGE,DATEOFBIRTH,PASSWORD,PHONENUMBER,
                        verificationCode,ISVERIFIED,PROFILEPICTURE) VALUES (DEMO_USERS_SEQ.NEXTVAL,'$username','$email','$userType',
                        10,(to_date('$dob','dd/mm/yyyy')),'$newpassword','$phone','$verification_code','$verified',
                        '$filename')";

                $parse=oci_parse($connection,$query);
                $result=oci_execute($parse);
                if($result){
                    $to=$email;
                    $subject="Email Verification";
                    $message="Your Verification code is  ".$verification_code;
                    $headers="From: chandbikram001@gmail.com";

                    if(mail($to,$subject,$message,$headers)){
                        header("Location:emailverificationpage.php?mail=".$to);
                    }
                }
                else{
                    echo "Error detectd";
                }
            }
        }
       /* elseif(!empty($username)){
            header("Location:../pages/traderSignup.php?username=".$username);

        }
        elseif(empty($email)){
            header("Location:../pages/traderSignup.php?error1");

      
        }
        elseif(!empty($email)){
            header("Location:../pages/traderSignup.php?email=".$email);

        }
        */
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/tradersignup.css">
    
    <title>Document</title>
</head>
<body>

    
    <div class="sign-up-form">
        <h1>Signup for Customer</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="text" class="input-box" name='username' value="<?php if(isset($username)){echo $username;}?>" placeholder="Enter Username">
            <span style="font-size:11px;position:absolute;left:48%;color:red;font-weight:bold;font-family: 'Playfair Display', serif;" id="error"><?php if(isset($error)){ echo $error;} if(isset($error7)){echo $error7;}
            if(isset($error12)){ echo $error12;}?></span>
            <input type="email" class="input-box"  name='email' value="<?php if(isset($email)){echo $email;}?>"  placeholder="Enter email">
            <span style="font-size:11px;position:absolute;left:48%;color:red;font-weight:bold;font-family: 'Playfair Display', serif;" id="error"><?php if(isset($error1)){echo $error1;} if(isset($error13)){echo $error13;}?></span>
            <input type="text" class="input-box" name='phone_number' value="<?php if(isset($phone)){echo $phone;}?>" placeholder="Enter Phone Number">
            <span style="font-size:11px;position:absolute;left:48%;color:red;font-weight:bold;font-family: 'Playfair Display', serif;" id="error"><?php if(isset($error2)){echo $error2;}  ?></span>
            <input type="text" class="input-box" name='dob' value="<?php if(isset($dob)){echo $dob;}?>" placeholder="Enter Date Of Birth">
            <span style="font-size:11px;position:absolute;left:48%;color:red;font-weight:bold;font-family: 'Playfair Display', serif;" id="error"><?php if(isset($error3)){echo $error3;} ?></span>
            <input type="text" class="input-box" name='age' value="<?php if(isset($age)){echo $age;}?>" placeholder="Enter Your Age">
            <span style="font-size:11px;position:absolute;left:48%;color:red;font-weight:bold;font-family: 'Playfair Display', serif;" id="error"><?php if(isset($error8)){echo $error5;} if(isset($error8)){echo $error8;} ?></span>
            <input type="password" class="input-box" name='pwd' value="<?php if(isset($password)){echo $password;}?>" placeholder="Enter Password">
            <span style="font-size:11px;position:absolute;left:48%;color:red;font-weight:bold;font-family: 'Playfair Display', serif;" id="error"><?php if(isset($error4)){echo $error4;} 
             if(isset($error8)){echo $error8;} if(isset($error9)){echo $error9;} if(isset($error10)){echo $error10;} if(isset($error10)){echo $error11;}?></span>
            <input type="password" class="input-box" name='confir_pwd' value="<?php if(isset($repeat_password)){echo $repeat_password;}?>" placeholder="Confirm Password">
            <span style="font-size:11px;position:absolute;left:48%;color:red;font-weight:bold;font-family: 'Playfair Display', serif;" id="error"><?php if(isset($error5)){echo $error5;} if(isset($error6)){echo $error6;} ?></span>
            <label style="font-family:sans-serif;font-size:14px;" for="image">Choose a picture</label>
            <input style="margin-left:30px;margin-top:10px;" type="file" name="image" id="image">
            <span style="font-size:11px;position:absolute;left:48%;color:red;font-weight:bold;font-family: 'Playfair Display', serif;" id="error"><?php if(isset($error14)){echo $error14;} ?></span>
            <p><span><input type="checkbox"></span>I agree to the terms of services</p>
            <input type="submit" class="signup-btn" name='submit' value="Signup">
            <hr>
            <p class="or">OR</p>
            <p>Do you have an account ? <a href="Login.php">Sign in</a></p>
        </form>
    </div>
   
</body>
</html>