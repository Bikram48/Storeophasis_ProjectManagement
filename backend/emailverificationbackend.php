<?php
    session_start();
    if(isset($_GET['submit'])){
        include "connect.php";
       
            $vkey=$_GET['code'];
           
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
                    header("Location:../pages/verifiedmessage.php");
                }
            }
            else{
                echo "This account invalid or already verified";
            }
    
}
?>