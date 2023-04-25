<?php
class Transaction{

    private $transaction;
	private $con;
    public $id;
    public $account_id;
    public $user_id;
    public $descriptions;
    public $transaction_id;
    public $transaction_reference;
    public $amount;
    public $transaction_type;
    public $created_at;
    public $total_transaction;

    public function __construct($con){
        $this->con = $con;
    }

	public function set_single_transaction($id){
		$transaction_details_query = mysqli_query($con, "SELECT * FROM transactions WHERE id ='$id'");
		$this->$transaction = mysqli_fetch_array($transaction_details_query);
        $this->id = $this->$transaction['id'];
        $this->account_id = $this->$transaction['account_id'];
        $this->user_id = $this->$transaction['user_id'];
        $this->descriptions = $this->$transaction['descriptions'];
        $this->transaction_id = $this->$transaction['transaction_id'];
        $this->transaction_reference = $this->$transaction['transaction_reference'];
        $this->amount = $this->$transaction['amount'];
        $this->transaction_type = $this->$transaction['transaction_type'];
        $this->created_at = $this->$transaction['created_at'];
	}

    public function get_total_transaction($id){
        $sql = "SELECT COUNT(user_id) AS count FROM transactions WHERE user_id = '$id' ";
        $query = mysqli_query($this->con, $sql);
        $result = mysqli_fetch_array($query);

        return $result['count'];
    }

    public function new_transaction($account_id, $user_id, $to_user, $description, $transaction_id, $transaction_reference, $amount, $transaction_type, $open){
        $sql = "INSERT INTO transactions (account_id, user_id, to_user, descriptions, transaction_id, transaction_reference, amount, transaction_type, open) VALUES ('$account_id', '$user_id', '$to_user', '$description', '$transaction_id', '$transaction_reference', '$amount', '$transaction_type', '$open' )";
        $query = mysqli_query($this->con, $sql);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    
}



?>