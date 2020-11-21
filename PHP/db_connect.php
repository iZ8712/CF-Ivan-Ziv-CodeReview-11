<?php 

error_reporting( ~E_DEPRECATED & ~E_NOTICE );

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "cr11_ivan_ziv_petadoption";

$conn =  mysqli_connect($localhost, $username, $password, $dbname);


if(!$conn) {
    echo "ERROR!";

}

?>