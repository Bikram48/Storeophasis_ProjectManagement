<?php
    session_start();
    include "../functions/updatecustomerprofile.php";
    if(isset($_SESSION['userid'])){
        $userid=$_SESSION['userid'];
    }
    if(isset($_POST['profile_update'])){
        $username=$_POST['username'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $dob=$_POST['dob'];
        $age=$_POST['age'];
        
        $object=new updateaccount($username,$email,$phone,$dob,$age,$userid);
        if($object->UpdateProfile()==true){
            header("Location:../pages/userprofile.php?message=succeed");
            echo "<script type='text/javascript'>alert('Your profile updated successfully');</script>";
        }
        else{
            echo "Error occured";
        }
    }

    if(isset($_POST['password_change'])){
        include "../functions/updatecustomerpassword.php";
        $pattern_password='/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{7,20}$/';
        $password=$_POST['pwd'];
        $confirm_password=$_POST['confirm_pwd'];
      
        if($password!==$confirm_password){
            header("Location:../pages/userprofile.php?error=match");
            exit();
        }
        elseif(!preg_match($pattern_password,$password)){
            header("Location:../pages/userprofile.php?error4=passworderror");
            exit();
        }
        else{
            $newpassword=md5($password);
            $objects=new updatepassword($newpassword,$userid);
            if($objects->changePassword()==true){
                header("Location:../pages/userprofile.php?password=succeed");
            }
            else{
                echo "Error occured";
            }
        }
    }


    if(isset($_POST['uploadprofile'])){
        include "../functions/updateprofilepicture.php";
        $file=false;
            $filename=$_FILES['image']['name'];
            $tmpname=$_FILES['image']['tmp_name'];
            $path="../Images/".$filename;
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimetype = finfo_file($finfo, $_FILES['image']['tmp_name']);
            //checks if trader uploaded the wrong file in system
            if($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/gif' || $mimetype == 'image/png'){
                $file=true;
            }
            else{
                header("Location:../pages/userprofile.php?profile-error=true");
                $file=false;
            }

            if($file==true){
                move_uploaded_file($tmpname,$path);
                $picture=new updatepicture($filename,$userid);
                if($picture->changePicture()){
                    header("Location:../pages/userprofile.php?changed-profile=true");
                }
                else{
                    echo "Error occured";
                }
            }
          
            
        
    }
?>