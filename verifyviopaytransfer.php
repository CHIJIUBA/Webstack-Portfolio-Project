<!-- the begining of the header -->
<?php include("include/header.php"); ?>
<!-- the ending of the header -->
<?php
if(isset($_SESSION['amount'])&&isset($_SESSION['reciever'])&&isset($_SESSION['reciever'])&&isset($_SESSION['reciever_id'])){
    $amount = $_SESSION['amount'];
    $reciever = $_SESSION['reciever'];
    $remark = $_SESSION['remark'];
    $reciever_id = $_SESSION['reciever_id'];
}

?>
  <div class="wrapper">
    <div class="section">
      <div class="container">
        
        <h3 class="title text-info">VioPay Tranfer</h3>
        <h5 class="description">Dear <?php echo $user->full_name; ?> You are tranfering &#8358;<?php echo $amount?> to <?php echo $reciever; ?>. Enter Your Transaction Pin to Verify</h5>
        <center>
        <form method="POST" action="include/processes/processverifyviopaytransfer.php">
              <div class="form-group">
                <input type="password"  class="form-control col-md-3" name="pin" placeholder="Enter Your Transaction Pin" />
              </div>
            <input type="hidden" name="amount" value="<?php echo $amount; ?>"/>
            <input type="hidden" name="remark" value="<?php echo $remark; ?>"/>
            <input type="hidden" name="reciever_id" value="<?php echo $reciever_id; ?>"/>
            <input type="submit" value="verify" class="btn btn-success btn-round" />
        </form>
        </center>
      </div>
    </div>

<!-- the begining of the footer -->
<?php include("include/footer.php"); ?>
<!-- the ending of the footer -->
<script>
    document.getElementById('title').innerHTML = "VioPay: VioTransfer";
</script>