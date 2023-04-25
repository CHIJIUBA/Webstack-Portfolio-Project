<?php include('includes/header.php'); ?>
<?php
if(isset($_SESSION['fullname'])&&isset($_SESSION['min'])&&isset($_SESSION['max'])&&isset($_SESSION['meterno'])){
    $full_name = $_SESSION['fullname'];
    $min_amount = $_SESSION['min'];
    $max_amount = $_SESSION['max'];
    $meterno = $_SESSION['meterno'];

    unset($_SESSION['fullname']);
    unset($_SESSION['min']);
    unset($_SESSION['max']);
    unset($_SESSION['meterno']);
}

?>
      <div class="content">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title text-center text-primary">Verify EEDC Payment</h5>
              </div>
              <div class="card-body">
                <form id="form" action="#" method="post">
                  <h4 class="text-center text-warning">Meter Name: <?php echo $full_name; ?></h4>
                  <h4 class="text-center text-warning">Meter Number: <?php echo $meterno; ?></h4>
                  <h4 class="text-center text-warning">Min Amount: <?php echo $min_amount; ?></h4>
                  <h4 class="text-center text-warning">Max Amount: <?php echo $max_amount; ?></h4>
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <input type="password" name="pin" class="form-control" placeholder="Enter your transaction pin" id="pin">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-success btn-round" id="submit">Proceed</button>
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
        $('#electricbill').attr('class','active');
        document.getElementById('title').innerHTML = "VIOPAY: Electric Bill";

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

         $.ajax({
        url: 'includes/processes/processviopaytransfer.php',
        type: 'post',
        data: {'amount':amount},
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