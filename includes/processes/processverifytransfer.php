<?php 
require('../config/config.php');
require('../classes/User.php');
require('../classes/Account.php');
require('../classes/Transaction.php');

$user = new User($con,$_SESSION['user_id']);

if(isset($_POST['trans_id'])){
//Verify endpoint 
$trans_id = htmlspecialchars($_POST['trans_id']);
$url = "https://api.flutterwave.com/v3/transfers/".$trans_id;

//Create cURL session
$curl = curl_init($url);


//Turn off the SSl checker
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//Decide the request that you want
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

//Set the API headers 
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer FLWSECK_TEST-0b61a1c8eb47bc13fe2859784edf1417-X",
    // "Authorization: Bearer FLWSECK-69a8ba3b64e26e713be210d81c1bd119-X",
    "Content-Type: Application/json"
]);

//Run cURl

$run = curl_exec($curl);

$error = curl_error($curl);

if($error){
    die("curl returned some errors ".$error);
}

$result = json_decode($run);
curl_close($curl);

$status = $result->status;
$reference = uniqid()."1".date("YmdHis");

if($status == "success"){

    $user->decrease_account($result->data->amount);
    $user->new_transaction("Sent money to bank account", $trans_id, $reference, $result->data->amount, "Bank Trans");


    echo "Successfull";
}else{
    echo "Transaction failed ";
}
} 
else {
    echo "we could not find an id to that transfer";
}
?>