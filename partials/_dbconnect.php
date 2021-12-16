<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "id16693513_notes";

$conn = mysqli_connect($servername,$username,$password,$database);
if (!$conn) {
    echo"Connection to the database failed due to". mysqli_connect_error();
    # code...
}

?>