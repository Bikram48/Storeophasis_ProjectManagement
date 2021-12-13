<?php
        include "../backend/connect.php";
    class updatepicture{
        private $filename;
        private $userid;
        function __construct($filename,$userid){
            $this->filename=$filename;
            $this->userid=$userid;
        }

        public function getName(){
            return $this->filename;
        }

        public function changePicture(){
            global $connection;
            $query="UPDATE USERS 
                    SET PROFILEPICTURE='$this->filename'
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