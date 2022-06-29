<?php

    //require_once '_indexPay.php';

    $username = 'kemogne.albert';
    $password = 'keG;wIeDOf0';
    $api_id = 4124005838;

    $fields = array(
        'username' => $username, 
        'password' => $password,
        'api_id' => $api_id
    );

    $url = "https://api.faroty.com/index.php/api/apiauth";

    $curl = curl_init($url);


    $send = json_encode($fields);

    curl_setopt_array($curl,[
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $send,
        CURLOPT_TIMEOUT        => 3
    ]);

    $result = curl_exec($curl);

    if($result === false)
    {
        //var_dump(curl_error($curl));
    } else{

        //var_dump(curl_getinfo($curl, CURLINFO_HTTP_CODE));
        $data = json_decode($result, true);
        //var_dump($result);
    }
    curl_close($curl);
?>