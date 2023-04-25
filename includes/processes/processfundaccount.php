<?php
require('../config/config.php');
require('../classes/User.php');
require('../classes/Account.php');
require('../classes/Transaction.php');

$user = new User($con,$_SESSION['user_id']);

if(isset($_POST['amount'])&&isset($_POST['remark'])&&isset($_POST['pin'])){

    $amount = $_POST['amount'];
    $remark = $_POST['remark'];
    $pin = $_POST['pin'];

    if(empty($_POST['amount'])||empty($_POST['remark'])||empty($_POST['pin'])){

        exit("No Field should be empty");

    }
    elseif(!is_numeric($amount)){
        exit("The amount has to be numeric");
    }
    elseif($pin != $user->get_transaction_pin()){
        exit("Invalid transaction Pin, Please set your transaction pin at the settings page");
    }
    else{
        echo "Successful";
        exit();
    }
}
else {
    header("Location: ../../fundaccount1.php");
}



if(isset($_GET['amount'])&&isset($_GET['remark'])){

    $amount = $_GET['amount'];
    $remark = $_GET['remark'];
        
        //integrate rave payment
	    $endpoint = "https://api.flutterwave.com/v3/payments";


        //required data
        $postdata = array(

            "tx_ref"   => uniqid()."1".date("YmdHis"),
            "currency" => "NGN",
            "amount"   => $amount,

            "customer" =>array(
                "name"  => $user->full_name,
                "email" => $user->email,
                "phone_number" => $user->phone_number
            ),

            "customizations" =>array(
                "tile"  => "Funding Viopay account",
                "description" => $remark
            ),

            "meta" =>array(
                "reason"  => $remark,
                "address" => "2b, UNN Road Nsukka"
            ),

            "redirect_url" => "http://localhost/projects/flut/includes/processes/verifyfundaccount.php"
        );

        //Init cURL handler
        $ch = curl_init();

        //Turn of the ssl checking
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //set the endpoint
        curl_setopt($ch, CURLOPT_URL, $endpoint);

        //Turn on the cURL post method
        curl_setopt($ch, CURLOPT_POST, 1);

        //Encode the post field
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));

        //Make it return data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //Set the waiting timeout
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 9000);
        curl_setopt($ch, CURLOPT_TIMEOUT, 9000);

        //set the headers from endpoint
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer FLWSECK-69a8ba3b64e26e713be210d81c1bd119-X",
            "Content-Type: Application/json",
            "Cache-Control: no-cache"
        ));

        //Execute the cURL session
        $request = curl_exec($ch);

        $result = json_decode($request);

        //var_dump($result);

        //redirect to the payment page
        header("Location: ".$result->data->link);

        //close the cURL session
        curl_close($ch);
    }

?>