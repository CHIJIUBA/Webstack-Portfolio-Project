<?php
class User{

    private $user;
    private $con;
    public $account;
    public $transactions;
    public $fname;
    public $lname;
    public $email;
    public $full_name;
    public $phone_number;
    public $id;

	public function __construct($con, $user_id){
		$this->con = $con;
		$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE id ='$user_id'");
		$this->user = mysqli_fetch_array($user_details_query);
        $this->fname = $this->user['fname'];
        $this->lname = $this->user['lname'];
        $this->phone_number = $this->user['phone_number'];
        $this->email = $this->user['email'];
        $this->full_name = $this->user['fname']." ".$this->user['lname'];
        $this->id = $this->user['id'];
        $this->account = new Account($this->con, $this->user['id']);
        $this->transactions = new Transaction($this->con);
	}

    public function get_balance(){
        return $this->account->balance;
    }

    public function get_account_number(){
        return $this->account->account_number;
    }
    public function get_transaction_pin(){
        return $this->account->transaction_pin;
    }

    public function increase_account($amount){

        $old_balance = $this->account->balance;
        $new_balance = $old_balance + $amount;

        return $this->account->update_balance($new_balance, $this->id);

    }
    public function decrease_account($amount){

        if($this->account->balance >= $amount){
            $old_balance = $this->account->balance;
            $new_balance = $old_balance - $amount;

            if($this->account->update_balance($new_balance, $this->id)){
                return true;
            }
        }
        else{
            return false;
        }
        
    }
    public function new_transaction($description, $transaction_id, $transaction_reference, $amount, $transaction_type){
        $account_id = $this->account->id;
        $sql = "INSERT INTO transactions (account_id, user_id, descriptions, transaction_id, transaction_reference, amount, transaction_type) VALUES ('$account_id', '$this->id', '$description', '$transaction_id', '$transaction_reference', $amount, '$transaction_type')";
        $query = mysqli_query($this->con, $sql);
    }

    
}



?>