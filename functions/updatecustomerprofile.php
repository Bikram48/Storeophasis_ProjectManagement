<?php
    include "../backend/connect.php";
    class updateaccount{
        private $username;
        private $email;
        private $phone;
        private $dateofbirth;
        private $age;
        private $userid;
      
       function __construct($username,$email,$phone,$dateofbirth,$age,$userid){
            $this->username=$username;
            $this->email=$email;
            $this->phone=$dateofbirth;
            $this->dateofbirth=$dateofbirth;
            $this->age=$age;
            $this->userid=$userid;
        }

       
        public function UpdateProfile(){
            global $connection;
            $query="UPDATE USERS 
                    SET USERNAME='$this->username',
                    EMAIL='$this->email',
                    AGE=$this->age,
                    DATEOFBIRTH=(to_date('$this->dateofbirth','dd/mm/yy')),
                    PHONENUMBER=$this->phone
                    WHERE USERID=$this->userid";
            
            $parse=oci_parse($connection,$query);
            $result=oci_execute($parse);
            if($result){
                return true;
            }
            return false;
        }

       
    }
?>