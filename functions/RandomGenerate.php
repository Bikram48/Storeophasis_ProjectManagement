<?php

    function random_generate(){
        list($usec, $sec) = explode(" ", microtime());
        $micro = usec + $sec;
 
        $hoy = date("Y-m-d");  
        $str = str_replace('-','',$hoy); 
 
        $finalresult = rand($str,  $micro);
        return $finalresult;
    }

?>