<?php 
    $connection = oci_connect('STOREOPHASIS', 'storeophasis', '//localhost/xe'); 
    if (!$connection) {
        $m = oci_error();
        echo $m['message'], "\n";
        exit; 
    } 
    
   
?>