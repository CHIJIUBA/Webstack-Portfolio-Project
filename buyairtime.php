<?php include('includes/header.php'); ?>
      <div class="content">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title text-center text-primary">Buy Airtime</h5>
              </div>
              <div class="card-body">
                <form id="form" method="post">
                  <h4 class="text-center text-danger" id="error"></h4>
                  <div class="row">
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" name="amount" placeholder="Enter Amount" id="amount">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" name="remark" placeholder="Enter Phone Number" id="phoneno">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Transaction Pin</label>
                        <input type="password" name="pin" class="form-control" placeholder="Enter transaction pin" id="pin">
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
        $('#airtime').attr('class','active');
        document.getElementById('title').innerHTML = "VIOPAY: BuyAirtime";

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
        var phoneno = $('#phoneno').val();
        var pin = $('#pin').val();


         $.ajax({
        url: 'includes/processes/processbuyairtime.php',
        type: 'post',
        data: {'amount':amount, 'phoneno':phoneno, 'pin':pin},
        beforeSend: function(){
          $('#submit').attr('disabled','true');
        },
        success: function(response){

          $('#submit').removeAttr('disabled');

          if(response == 'Successful'){

            //show notification
            showNotification('top','right','success','Success <b>Cert Verify</b> - Form submitted Successfully, You will be redirected Shortly.','nc-icon nc-check-2');

            //redirect user to payment page
            function redirectUser(){
              window.location.assign('includes/processes/processbuyairtime.php');
            }
            setTimeout(redirectUser, 2000);

            // //clear the inputs
            $('#amount').val("");
            $('#phoneno').val("");
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