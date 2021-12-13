<?php 
    include "connect.php";
    class updatepassword{
        private $password;
        private $userid;

        function __construct($password,$userid){
             $this->password=$password;
             $this->userid=$userid;
        }
        public function getPassword(){
            return $this->password;
        }

        public function changePassword(){
            global $connection;
            $query="UPDATE USERS SET PASSWORD='$this->password' WHERE USERID=$this->userid";
            $parse=oci_parse($connection,$query);
            $result=oci_execute($parse);
            if($result){
                return true;
            }
            return false;
        }
    }
?>