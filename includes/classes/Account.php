<?php
class Account{

    private $account;
	private $con;
    public $id;
    public $account_number;
    public $balance;
    public $transaction_pin;
    public $user_id;

	public function __construct($con, $user_id){
		$this->con = $con;
		$account_details_query = mysqli_query($con, "SELECT * FROM account WHERE user_id ='$user_id'");
		$this->account = mysqli_fetch_array($account_details_query);
        $this->id = $this->account['id'];
        $this->account_number = $this->account['account_number'];
        $this->balance = $this->account['balance'];
        $this->transaction_pin = $this->account['transaction_pin'];
        $this->user_id = $this->account['user_id'];
	}

    public function update_balance($new_balance, $user_id){
        $sql = "UPDATE account SET balance = '$new_balance' WHERE user_id = '$user_id'";
        $query = mysqli_query($this->con, $sql);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    
}



?>