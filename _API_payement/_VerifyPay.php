<?php
include_once './_Payement.php';

message();

function retry_pay(){
    include './_Payement.php';
    $pay_ref = $pay_ref."01";
}

function message(){
    echo readfile("../Home.html");
}

?>