<?php
require('../config/config.php');
require('../classes/User.php');
require('../classes/Account.php');
require('../classes/Transaction.php');

$user = new User($con,$_SESSION['user_id']);

if(isset($_POST['amount'])&&isset($_POST['description'])&&isset($_POST['acct_num'])){

    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $account_number = $_POST['acct_num'];

    if(empty($_POST['amount'])||empty($_POST['description'])||empty($_POST['acct_num'])){

        exit("No Field should be empty");
        $amount = stripslashes($amount);
        $description = stripslashes($description);
        $account_number = stripslashes($account_number);

    }
    elseif(!is_numeric($amount)){
        exit("The amount has to be numeric");
    }
    else{
        $sql = "SELECT * FROM account WHERE account_number = '$account_number'";
        $query = mysqli_query($con, $sql);

        if(mysqli_num_rows($query) > 0){

            $row = mysqli_fetch_array($query);

            $_SESSION['viopayamount'] = $amount;
            $_SESSION['description'] = $description;
            $_SESSION['reciever_id'] = $row['id'];

            echo "Successful";
            exit();

        }else{
            exit("we can't find user with the account number please check the number and try again");
        }
    }
}

if(isset($_POST['amount'])&&isset($_POST['description'])&&isset($_POST['recieverid'])&&isset($_POST['pin'])){
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $recieverid = $_POST['recieverid'];
    $pin = $_POST['pin'];

    if(empty($_POST['pin'])){

        exit("Transaction Pin should not be empty");
        $amount = stripslashes($amount);
        $description = stripslashes($description);
        $recieverid = stripslashes($recieverid);
        $pin = stripslashes($pin);

    }elseif($pin != $user->get_transaction_pin()){
        exit("Invalid transaction Pin, Please set your transaction pin at the settings page");
    }else{

        //get the reciever details
        $reciever = new User($con, $recieverid);

        //check if balance is equal to or greater than amount
        if($user->get_balance() >= $amount){

            $trans_id = uniqid()."1".date("YmdHis");

            //decrease the user account
            $user->decrease_account($amount);

            //increase the reciever account
            $reciever->increase_account($amount);

            //insert credit alert to reciever
            $reciever->new_transaction($description, $trans_id, "viopay_tranfer", $amount, "Credit");

            //insert debit allert to user
            $user->new_transaction($description, $trans_id, "viopay_tranfer", $amount, "Debit");

            echo "Successful";
            //set location
            //header("Location: http://192.168.43.193/projects/flut/dashboard.php");
        }else{

            echo "Insufficient Funds";
            exit();
        }
        
    }
}

?>