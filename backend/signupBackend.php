<?php
    //error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
   
    

    //When the submit button clicked the following code will be exexcuted
    if(isset($_POST['submit'])){
         include "connect.php";
        //Storing all the data that comes from the form into the variables
        $username=$_POST['username'];
        $email=$_POST['email'];
        $phone=$_POST['phone_number'];
        $dob=$_POST['dob'];
        $age=$_POST['age'];
        $password=$_POST['pwd'];
        $newpassword=md5($password);
        $repeat_password=$_POST['confirm_pwd'];
        $userType='customer';
        $verified='N';
        $verification_code=md5(time().$username);
     
        
        //variable called msg is declaired to store all the error messages
        $msg='';
       
        //checking wheter all the fields are empty or not
        if(empty($username)){
            $msg.= "Field is empty";
            header("Location:../pages/Signup.php?error1=".$msg);
            exit();
        }
        elseif(empty($email)){
            $msg.= "Field is empty";
            header("Location:../pages/Signup.php?error2=".$msg);
            exit();
        }
         elseif(empty($phone)){
            $msg.= "Field is empty";
            header("Location:../pages/Signup.php?error3=".$msg);
            exit();
        }
         elseif(empty($dob)){
            $msg.= "Field is empty";
            header("Location:../pages/Signup.php?error4=".$msg);
            exit();
        }
         elseif(empty($age)){
            $msg.= "Field is empty";
            header("Location:../pages/Signup.php?error5=".$msg);
            exit();
        }
         elseif(empty($password)){
             $msg.= "Field is empty";
            header("Location:../pages/Signup.php?error6=".$msg);
            exit();
        }
       
        
        
        //condition to check username has at least 6 characters
        elseif(strlen($username)<6){
            $msg.="Username is too short";
            header("Location:../pages/Signup.php?error8=".$msg);
            exit();
        }
        
        //condition to check password has at least 8 characters
        elseif(strlen($password)<8){
            $msg.="Passsword must be at least 8 characters long";
            header("Locaton:../pages/Signup.php?error9=".$msg);
            exit();
        }
        
        //condition to check password has at least 1 number
        elseif(!preg_match("#[0-9]+#",$password))
        {
            $msg.="Password must contain at least one number";
            header("Location:../pages/signup.php?error9=".$msg);
            exit();
        }
        
        //condition to check password has at least 1 capital letter
        elseif(!preg_match("#[A-Z]+#",$password))
        {
            $msg.="Password must contain at least one capital letter";
            header("Location:../pages/signup.php?error9=".$msg);
             exit();
        }
        
        //condition to check password has at least 1 special characters
        elseif(!preg_match("#[\W]+#",$password))
        {
            $msg.="Password must contain at least one special character";
            header("Location:../pages/signup.php?error9=".$msg);
            exit();
        }
        
        elseif(!empty($_FILES['image']['name'])){
            $filename=$_FILES['image']['name'];
            $tmpfilename=$_FILES['image']['tmp_name'];
            $source="../customer_images/".$filename;
            move_uploaded_file($tmpfilename,$source);
        }
        
        //Query to insert values on the database
        $query="INSERT INTO USERS (USERID,USERNAME,EMAIL,USERROLE,AGE,DATEOFBIRTH,PASSWORD,PHONENUMBER,verificationCode,ISVERIFIED,PROFILEPICTURE) VALUES (USERSEQ.NEXTVAL,'$username','$email','$userType',$age,(to_date('$dob','dd/mm/yyyy')),'$newpassword','$phone','$verification_code','$verified','$filename')";
        
        //preparing the data for execution
        $parse=oci_parse ($connection,$query);
        
        //Inserting values on database
        $result=oci_execute($parse);
        
        if($result){
            echo "Successfully inserted";
        }
        else{
            echo "Error detectd";
        }
       
    }
    
    
    

   


    
?>