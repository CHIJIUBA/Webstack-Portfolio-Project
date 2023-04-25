<?php
require('../config/config.php');


if(isset($_POST['fname'])&&isset($_POST['lname'])&&isset($_POST['email'])&&isset($_POST['phone'])&&isset($_POST['password'])&&isset($_POST['password2'])){
    // get the variables
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    //sanitize the variables
	$fname = ucfirst(strtolower(str_replace(' ', '', strip_tags($fname))));
    $lname = ucfirst(strtolower(str_replace(' ', '', strip_tags($lname))));
    $email = strtolower(str_replace(' ', '', strip_tags($email)));
    $phone = str_replace(' ', '', strip_tags($phone));
    $password = md5($password);
    $password2 = md5($password2);

    //Validating the form
    if(empty($fname)||empty($lname)||empty($email)||empty($password)||empty($password2)||empty($phone)){
        echo "Please Fill All Fields";
        exit;
    }else{
        if(strlen($fname) > 25 || strlen($fname) < 2) {
            echo "Your first name must be between 2 and 25 characters";
            exit;
        }elseif(strlen($lname) > 25 || strlen($lname) < 2){
            echo "Your last name must be between 2 and 25 characters";
            exit;
        }elseif(strlen($password) < 6){
            echo "Your password must be atleast 6 characters";
            exit;
        }elseif($password2 != $password){
            echo "Passwords do not match";
            exit;
        }else{
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $e_check = mysqli_query($con, $sql);
                $num_rows = mysqli_num_rows($e_check);
                if($num_rows > 0) {
                    echo "Email already in use";
                    exit;
                }else{
                    $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$email', '$password', '$phone')");

                    if($query){
                        $acct_number = uniqid();

                        $acct_number = strtoupper($acct_number);
                        
                        $last_id = mysqli_insert_id($con);

                        $query2 = mysqli_query($con, "INSERT INTO account (account_number, user_id) VALUES ('$acct_number', '$last_id')");

                        echo "Registration was successful";
                        exit;
                    }else{
                        echo "there is problem registering this user";
                    }
                }
            }else{
                echo "Invalid email format";
                exit;
            }
        }
    }


}else{
    echo "There is a problem submitting this form";
    exit;
}



?>