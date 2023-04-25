<?php 
if(isset($_GET['trans_id'])){
//Verify endpoint 
$trans_id = htmlspecialchars($_GET['trans_id']);
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
    "Authorization: Bearer FLWSECK-69a8ba3b64e26e713be210d81c1bd119-X",
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

var_dump($run);
} else {
    die("we could not find an id to that transfer");
}
?>