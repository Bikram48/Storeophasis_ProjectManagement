<?php
    session_start();
    include "connect.php";
    if(isset($_POST['submit'])){
        
        //collecting all the data from the form
        $username=$_POST['username'];
        $password=$_POST['password'];
        $new_password=md5($password);
        
        if(empty($username)){
            echo "Username Field is empty";
        }
        else{
            echo "Password field is empty";
        }
        
        //Query to match the username and password
        $query="SELECT USERID FROM USERS WHERE USERNAME= '$username' AND PASSWORD = '$new_password'";
        //preparing to execute query
        $parse=oci_parse($connection,$query);
        //Executing
        $result=oci_execute($parse);
        $row=oci_fetch_array($parse,OCI_ASSOC);
        //Taking the row who matches the given username and password
        $count=oci_num_rows($parse);
       
       if($count==1){
           $_SESSION['userid']=$row['USERID'];
           $_SESSION['customername']=$username;
           header("Location:../pages/index1.php");
       }
        /*else{
            if($count>1){
                echo "Username already exists";
            }
            else{
                echo "Username doesnot exitst";
            }
        }
        */
    }
?>