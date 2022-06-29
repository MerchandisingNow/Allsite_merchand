<?php

$_user  = 'root';
$_pass = '';

try{
    $_con = new PDO('mysql:host=localhost; dbname=vente_produits',$_user,$_pass);
    echo 'Connection established !';
}
catch(PDOException $_PDOe){
    echo 'Connection failed :'.$_PDOe->getMessage();
}
?>

