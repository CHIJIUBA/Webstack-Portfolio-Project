<?php include('includes/header.php'); ?>
<?php
if(isset($_SESSION['viopayamount'])&&isset($_SESSION['description'])&&isset($_SESSION['reciever_id'])){

$amount = $_SESSION['viopayamount'];
$description = $_SESSION['description'];
$reciever_id = $_SESSION['reciever_id'];

$reciever = new User($con, $reciever_id);

unset($_SESSION['viopayamount']);
unset($_SESSION['description']);
unset($_SESSION['reciever_id']);
}else{
  exit();
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
                  <h4 class="text-center text-warning">Your are about to tranfer <?php echo $amount; ?> Naira to <?php echo $reciever->full_name; ?> VioPay Account. Enter your Transaction Pin to verify this payment</h4>
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <input type="password" name="pin" class="form-control" placeholder="Enter your transaction pin" id="pin">
                        <input type="hidden" value="<?php echo $amount; ?>" id="amount">
                        <input type="hidden" value="<?php echo $description; ?>" id="description">
                        <input type="hidden" value="<?php echo $reciever_id; ?>" id="recieverid">
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
        $('#viopaytransfer').attr('class','active');
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

        var amount = $('#amount').val();
        var description = $('#description').val();
        var recieverid = $('#recieverid').val();
        var pin = $('#pin').val();


         $.ajax({
        url: 'includes/processes/processviopaytransfer.php',
        type: 'post',
        data: {'amount':amount, 'description':description, 'recieverid':recieverid, 'pin':pin},
        beforeSend: function(){
          $('#submit').attr('disabled','true');
        },
        success: function(response){

          $('#submit').removeAttr('disabled');

          if(response == 'Successful'){

            //show notification
            showNotification('top','right','success','Success <b>VioPay</b> - Tranfer was Successfull, Thanks for using VioPay.','nc-icon nc-check-2');

            //redirect user to payment page
            function redirectUser(){
              window.location.assign('dashboard1.php');
            }
            setTimeout(redirectUser, 2000);

            // //clear the inputs
            $('#amount').val("");
            $('#description').val("");
            $('#pin').val("");
            $('#recieverid').val("");
          }
          else{
            showNotification('top','right','danger','Error <b>VioPay</b> -  '+response+'','nc-icon nc-simple-remove');
          }
        }
       });
        
       });
      //end of the ajax call
      </script>