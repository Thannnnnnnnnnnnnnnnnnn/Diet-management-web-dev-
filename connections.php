<?php

$connections = mysqli_connect ("localhost:3307","root", "" , "diet_management");
if(mysqli_connect_errno()){

    echo "Failed to Connect to mysqli:". mysqli_connect_error();
    
}else{

    echo " ";
}



