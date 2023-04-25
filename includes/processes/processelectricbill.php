<?php
require('../config/config.php');
require('../classes/User.php');
require('../classes/Account.php');
require('../classes/Transaction.php');

$user = new User($con,$_SESSION['user_id']);

if(isset($_POST['pin'])&&isset($_POST['company'])&&isset($_POST['meterno'])){
	$company = ""; $meterno = ""; $pin = "";
	$company = htmlspecialchars($_POST['company']);
	$meterno = htmlspecialchars($_POST['meterno']);
	$pin = htmlspecialchars($_POST['pin']);

	if(empty($meterno) || empty($company) || empty($pin)){
        exit("all fields are required !");
	}
    elseif($pin != $user->get_transaction_pin()){
        exit("Invalid transaction Pin, Please set your transaction pin at the settings page");
    }
    else{
    	$_SESSION['company'] = $company;
    	$_SESSION['meterno'] = $meterno;
    	echo "Successful";
    	exit();
    }
} 




if(isset($_SESSION['company'])&&isset($_SESSION['meterno'])){

    $customer = $_SESSION['meterno'];

    $endpoint = "https://api.flutterwave.com/v3/bill-items/UB163/validate?code=BIL115&customer=$customer";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
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
    $result = json_decode($request);

    $status = $result->status;
    $message = $result->message;

    if($status == "success"){
        $meterno = $result->data->customer;
        $full_name = $result->data->name;
        $min_amount = $result->data->minimum;
        $max_amount = $result->data->maximum;

        $_SESSION['fullname'] = $full_name;
        $_SESSION['min'] = $min_amount;
        $_SESSION['max'] = $max_amount;
        $_SESSION['meterno'] = $meterno;

        header("Location: http://localhost/projects/flut/verifyelectricpay.php");
    }

}
?>
      