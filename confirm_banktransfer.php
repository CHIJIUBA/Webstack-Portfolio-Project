<?php include('includes/header.php'); ?>
<?php
if(isset($_SESSION['account_number'])&&isset($_SESSION['amount_trans'])&&isset($_SESSION['bank_trans'])&&isset($_SESSION['full_name'])&&isset($_SESSION['transfer_id'])){

  $account_number = $_SESSION['account_number']; 
  $amount = $_SESSION['amount_trans'];
  $bank_name = $_SESSION['bank_trans'];
  $full_name = $_SESSION['full_name'];
  $trans_id = $_SESSION['transfer_id']; 

  unset($_SESSION['account_number']);
  unset($_SESSION['amount_trans']);
  unset($_SESSION['bank_trans']);
  unset($_SESSION['full_name']);
  unset($_SESSION['transfer_id']);

  }else{
    header("Location: dashboard1.php");
  }
?>
      <div class="content">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title text-center text-primary">Verify Payment</h5>
              </div>
              <div class="card-body">
                <form id="form" action="#" method="post">
                  <h4 class="text-center text-warning">Your are about to tranfer <?php echo $amount; ?> Naira to <?php echo $full_name." Account number:".$account_number." Bank name:".$bank_name; ?>. Enter your Transaction Pin to verify this payment</h4>
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <input type="password" name="pin" class="form-control" placeholder="Enter your transaction pin" id="pin">
                        <input type="hidden" value="<?php echo $trans_id; ?>" id="trans_id">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-success btn-round" id="submit">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include('includes/footer.php'); ?>
      <script type="text/javascript">
        $('#banktransfer').attr('class','active');
        document.getElementById('title').innerHTML = "VIOPAY: Tranfer";

        //for the notification fuction
        function showNotification(from, align, colour, messages, iconic) {
        color = colour;

          $.notify({
            icon: iconic,
            message: messages

          }, {
            type: color,
            timer: 8000,
            placement: {
              from: from,
              align: align
            }
          });
        } 
      //end of the showNotification fucntion

      //Ajax Call
      $('#form').submit(function(e){
        e.preventDefault();

        var trans_id = $('#trans_id').val();
        var pin = $('#pin').val();


         $.ajax({
        url: 'includes/processes/processverifytransfer.php',
        type: 'post',
        data: {'trans_id':trans_id},
        beforeSend: function(){
          $('#submit').attr('disabled','true');
        },
        success: function(response){

          $('#submit').removeAttr('disabled');

          if(response == 'Successfull'){

            //show notification
            showNotification('top','right','success','Success <b>VioPay</b> - Tranfer was Successfull, Thanks for using VioPay.','nc-icon nc-check-2');

            //redirect user to payment page
            function redirectUser(){
              window.location.assign('dashboard1.php');
            }
            setTimeout(redirectUser, 2500);

            // //clear the inputs
            $('#trans_id').val("");
            $('#pin').val("");
          }
          else{
            showNotification('top','right','danger','Error <b>VioPay</b> -  '+response+'','nc-icon nc-simple-remove');
          }
        }
       });
        
       });
      //end of the ajax call
      </script>