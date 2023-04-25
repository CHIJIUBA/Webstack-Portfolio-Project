<?php
require('../config/config.php');
require('../classes/User.php');
require('../classes/Account.php');
require('../classes/Transaction.php');

$user = new User($con,$_SESSION['user_id']);

if(isset($_POST['pin'])&&isset($_POST['amount'])&&isset($_POST['phoneno'])){

	$pin = trim(htmlspecialchars($_POST['pin']));
	$amount = trim(htmlspecialchars($_POST['amount']));
	$phoneno = trim(htmlspecialchars($_POST['phoneno']));

	if(empty($_POST['amount'])||empty($_POST['phoneno'])||empty($_POST['pin'])){

        exit("No Field should be empty");

    }
    elseif(!is_numeric($amount)){
        exit("The amount has to be numeric");
    }
    elseif($amount < 50){
    	exit("Amount must be greater than or equall to 100");
    }
    elseif($amount > $user->get_balance()){
    	exit("Insufficient fund");
    }
    elseif ($amount < 0) {
    	exit("Invalid Amount");
    }
    elseif(!is_numeric($phoneno) || !(strlen($phoneno) == 11)){
        exit("invalid mobile number, number has to be 11 digit and numeric");
    }
    elseif($pin != $user->get_transaction_pin()){
        exit("Invalid transaction Pin, Please set your transaction pin at the settings page");
    }
    else{
    	$_SESSION['phoneno'] = $phoneno;
    	$_SESSION['amount_rech'] = $amount;
    	echo "Successful";
    	exit();
    }
}
else {
	header("Location: ../../buyairtime.php");
}

if(isset($_SESSION['phoneno'])&&isset($_SESSION['amount_rech'])){
	
	$phoneno = $_SESSION['phoneno'];
	$amount = $_SESSION['amount_rech'];

	unset($_SESSION['phoneno']);
	unset($_SESSION['amount_rech']);

	//integrete the flutterwave airtime api
	$endpoint = "https://api.flutterwave.com/v3/bills";

	$postdata = array(

		"country" => "NG",
		"customer" => $phoneno,
		"amount"  => $amount,
		"recurrence" => "ONCE",
		"type" => "AIRTIME",
		"reference" => uniqid()."1".date("YmdHis")
	);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_URL, $endpoint);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 9000);

	//set the headers from the end point
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer FLWSECK-69a8ba3b64e26e713be210d81c1bd119-X",
        "Content-Type: Application/json",
        "Cache-Control: no-cache"
    ));

    $request = curl_exec($ch);

    $result = json_decode($request);

    var_dump($result);

    //get the message
    $status = $result->status;
    $message = $result->message;
    $id = $result->data->flw_ref;
    $reference = $result->data->reference;


    if($status == 'success'){


    	$description = " bought airtime for ".$phoneno;

    	$user->decrease_account($amount);
        $user->new_transaction($description, $id, $reference, $amount, "Debit-Airtime",);

        $_SESSION['airtime_success'] = $amount;

    	header("Location: http://localhost/projects/flut/dashboard1.php");
    }
    else{

    	// the fail page
    	$_SESSION['airtime_failure'] = "true";
    	header("Location: http://localhost/projects/flut/dashboard1.php");
    }

    //close the cURL session
    curl_close($ch);
}





?>