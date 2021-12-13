<?php
    include "connect.php";
    if(isset($_POST["query"])){
    $output='';
    $query="SELECT * FROM PRODUCT WHERE PRODUCTNAME LIKE '%".$_POST["query"]."%'";
    $parse=oci_parse($connection,$query);
    $result=oci_execute($parse);
    $output='<ul style="display:inline-block;" class="list-unstylied">';
    $rows=oci_fetch_array($parse,OCI_ASSOC);
    //Taking the row who matches the given username and password
    $count=oci_num_rows($parse);

    if($count>0){
    while($row=oci_fetch_assoc($parse)){
        
        $output .= '<li>'.$row['PRODUCTNAME']."<hr style=color:black;width:100%;>".'</li>';
        

    }
}
else{
        $output .='<li> List not found </li>';
}
    $output .='</ul>';
    echo $output;
}
?>