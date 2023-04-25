<?php
require('../config/config.php');
require('../classes/User.php');
require('../classes/Account.php');
require('../classes/Transaction.php');

$user = new User($con,$_SESSION['user_id']);

if(isset($_POST['pin'])&&isset($_POST['amount'])&&isset($_POST['acctnum'])&&isset($_POST['bank'])){
	$bank = ""; $acctnum = ""; $amount = ""; $pin = "";
	$bank = htmlspecialchars($_POST['bank']);
	$acctnum = htmlspecialchars($_POST['acctnum']);
	$amount = htmlspecialchars($_POST['amount']);
	$pin = htmlspecialchars($_POST['pin']);

	if(empty($bank) || empty($acctnum) || empty($amount) || empty($pin)){
        exit("all fields are required !");
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
    elseif(!is_numeric($acctnum) || !(strlen($acctnum) == 10)){
        exit("invalid account number, number has to be 10 digit and numeric");
    }
    elseif($pin != $user->get_transaction_pin()){
        exit("Invalid transaction Pin, Please set your transaction pin at the settings page");
    }
    else{
    	$_SESSION['account_number'] = $acctnum;
    	$_SESSION['amount_trans'] = $amount;
        $_SESSION['bank_trans'] = $bank;
    	echo "Successful";
    	exit();
    }
} 


if(isset($_SESSION['account_number'])&&isset($_SESSION['amount_trans'])&&isset($_SESSION['bank_trans'])){

   
        $bank = $_SESSION['bank_trans'];
        $acctnum = $_SESSION['account_number'];
        $amount = $_SESSION['amount_trans'];

        //integrete the flutterwave airtime api
        $endpoint = "https://api.flutterwave.com/v3/transfers";

        $postdata = array(

            "account_bank" => $bank,
            "account_number" => $acctnum,
            "amount" => $amount,
            "narration" => "Bank Transfer Process",
            "currency" => "NGN",
            "reference" => uniqid()."1".date("YmdHis"),
            "callback_url" => "http://localhost/projects/flut/includes/processes/test.php",
            "debit_currency" => "NGN"
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
            "Authorization: Bearer FLWSECK_TEST-0b61a1c8eb47bc13fe2859784edf1417-X",
            //"Authorization: Bearer FLWSECK-69a8ba3b64e26e713be210d81c1bd119-X",
            "Content-Type: Application/json",
            "Cache-Control: no-cache"
        ));

        $request = curl_exec($ch);

        $result = json_decode($request);

        $error1 = curl_error($ch);

        if($error1){
            die("Curl Returned some errors ".$error1);
        }
        
        $status = $result->status;
        $trans_id = $result->data->id;
        $account_number = $result->data->account_number;
        $full_name = $result->data->full_name;
        $amount = $result->data->amount;
        $bank_name = $result->data->bank_name;

        //set all the sessions
        $_SESSION['account_number'] = $account_number; 
    	$_SESSION['amount_trans'] = $amount;
        $_SESSION['bank_trans'] = $bank_name;
        $_SESSION['full_name'] = $full_name;
        $_SESSION['transfer_id'] = $trans_id; 

        // print_r($result);

        if($status == "success"){
            header("Location: http://localhost/projects/flut/confirm_banktransfer.php");
        }else{
            //the transaction failed
            header("Location: http://localhost/projects/flut/transfer.php");
        }

}


?>