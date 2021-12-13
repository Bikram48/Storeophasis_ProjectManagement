<?php
    include "../backend/connect.php";
    if(isset($_POST['checkout'])){
        $address="Sitapaila";
        $query="INSERT INTO COLLECTION_SLOT VALUES(collectionseq.nextval,'$address',(to_date('01/01/2000','dd/mm/yyyy')),'Sun','A1',10)";
        $parse=oci_parse($connection,$query);
        $result=oci_execute($parse);
        if($result){
            echo "Inserted";
        }
        else{
            echo "sorry";
        }
    }
   
?>