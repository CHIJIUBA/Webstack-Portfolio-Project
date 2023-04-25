<?php include('includes/header.php'); ?>
      <div class="content">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title text-center text-primary">Bank Transfer</h5>
              </div>
              <div class="card-body">
                <form id="form">
                  <div class="row">
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Bank</label>
                        <select class="form-control" name="bank" id="bank">
                        	<option>Choose Bank</option>
                        	<option value="044">Acces Bank</option>
                        	<option value="011">First Bank</option>
                          <option value="058">Guarantry Trust Bank</option>
                          <option value="232">Sterlin Bank</option>
                          <option value="033">UBA</option>
                          <option value="057">Zenith Bank</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Account Number</label>
                        <input type="text" class="form-control" name="acctnum" placeholder="Account Number" id="acctnum">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" name="amount" placeholder="Enter Amount" id="amount">
                      </div>
                    </div>
                    <div class="col-md-4 px-1"></div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <center><label>Transaction Pin</label></center>
                        <input type="password" name="pin" class="form-control" placeholder="Enter transaction pin" id="pin">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-success btn-round" id="submit" name="submit">Submit</button>
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
</script>
<script type="text/javascript">
        document.getElementById('title').innerHTML = "VIOPAY: Bank Transfer";

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
        var bank = $('#bank').val();
        var acctnum = $('#acctnum').val();
        var pin = $('#pin').val();


         $.ajax({
        url: 'includes/processes/processtransfer.php',
        type: 'post',
        data: {'amount':amount, 'acctnum':acctnum, 'bank':bank, 'pin':pin},
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
              //window.location.assign('includes/processes/processtransfer.php');
              window.location.assign('includes/processes/processtransfer.php');
            }
            setTimeout(redirectUser, 1000);

            // //clear the inputs
            $('#amount').val("");
            $('#acctnum').val("");
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