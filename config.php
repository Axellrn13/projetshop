<?php
define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','web4shop');

$conn=mysqli_connect(DB_SERVER,DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conn===false){
    die("ERREUR : impossible de se connecter");
    mysqli_connect();
}else echo "succes ";
?>