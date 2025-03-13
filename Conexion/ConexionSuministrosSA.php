<?php

function connection(){
    $servername = "localhost";
    $username = "root";
    $password = "lore";
    $database = "SuministrosSA";

    $connect=mysqli_connect($servername, $username, $password);

    mysqli_select_db($connect, $database);

    return $connect;

    echo "Estoy conectado";

}


?>