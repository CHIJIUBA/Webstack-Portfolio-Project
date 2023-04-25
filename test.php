<?php
$endpoint = "https://api.flutterwave.com/v3/bill-items/UB163/validate?code=BIL115&customer=0101175093703";

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_ENCODING, "");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
//curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 9000);

//set the headers from the end point
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer FLWSECK-69a8ba3b64e26e713be210d81c1bd119-X",
    "Content-Type: Application/json",
    "Cache-Control: no-cache"
));

$request = curl_exec($ch);

curl_close($ch);

echo "<pre>".$request."</pre>";

//$result = json_decode($request);

//print_r($result);

?>
      