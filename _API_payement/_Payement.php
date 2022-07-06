<?php 
//var_dump(phpinfo());//die;

//require_once './_indexPay.php';

include '_AuthInit.php';

    function back_response($value){
        return $value;
    }

    $new_url = "https://api.faroty.com/index.php/api/requesttopay";

    
    if(isset($_POST['event'])){

        echo `<script>
                    alert('Le payement a échoué ! Désolé, nous travaillons pour résoudre le problème');
                </script>
            `;

        echo readfile("../Home.html");
    }
    
    $client = $_POST['nam'];
    $phone = $_POST['account'];
    $amount = $_POST['amount'];
    $pay_type = $_POST['paymenttype'];
    $callback = "http://localhost/mon_projet_de_stage/_stagePHP/_API_payement/callback.html";

    $name = strtoupper($client);

    $pay_ref = "REFMARCHAND".$name."".$phone;

    $new_curl = curl_init($new_url);
    $new_fields = array(
        'pay_ref'     => $pay_ref, 
        'amount'      => $amount, 
        'name'        => $client, 
        'phone'       => $phone, 
        'ind'         => 237 , 
        'paymenttype' => $pay_type, 
        'callback'    => $callback
    );
    $user_auth = $data['username'];
    $pass_auth =  $data['password'];

    $headers = array(
        "Content-Type: application/json",
        "username: {$user_auth}",
        "password: {$pass_auth}",
    );

    //$header = json_encode($headers);

    $new_send = json_encode($new_fields);

    curl_setopt_array($new_curl,[
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_POSTFIELDS     => $new_send,
        CURLOPT_TIMEOUT        => 10
    ]);

    $new_result = curl_exec($new_curl);

    if($new_result === false)
    {
        echo `<script>
                    alert('Le payement a échoué ! Désolé, nous travaillons pour résoudre le problème');
                </script>
            `;

        echo readfile("../Home.html");

        //var_dump(curl_error($new_curl));
    } else{

        //var_dump(curl_getinfo($new_curl, CURLINFO_HTTP_CODE));
        $new_data = json_decode($new_result, true);
        if($new_data["error_msg"] === "exists_pay_ref")
        {
            include './_VerifyPay.php';
            retry_pay();
        }
        if($new_data['status'] === "SUCCESSFUL"){
            
            echo `<script>
                    alert('Votre payement a été reçu avec sucess\n Référence pour livraison : {$new_result['externalId']}');
                </script>
            `;
            echo readfile("../Home.html");
        }
        //var_dump($new_result);
    }
    curl_close($new_curl);
?>