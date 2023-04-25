<?php
require('../config/config.php');

if(isset($_POST['email'])&&isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $email = strip_tags($email);
    $password = md5($password);

    if(empty($email)||empty($password)){
        echo "Please Fill All Fields";
        exit;
    }else{
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $email_check = mysqli_query($con, $sql);
        if(mysqli_num_rows($email_check) <= 0){
            echo "Your Email is not Registered";
            exit;
        }else{
            $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $login_check = mysqli_query($con, $sql);
            $num_rows = mysqli_num_rows($login_check);
            $row = mysqli_fetch_array($login_check);
            if( $num_rows > 0 ){
                $_SESSION['user_id'] = $row['id'];
                echo "Login Successful";
                exit;
            }else{
                echo "Invalid Login Details";
            }
        }
    }

}else{
    echo "There is a problem submitting this form";
    exit;
}





?>