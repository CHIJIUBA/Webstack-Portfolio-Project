<?php include('includes/header.php'); ?>
      <div class="content">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title text-center text-primary">Electric Bill</h5>
              </div>
              <div class="card-body">
                <form id="form">
                  <div class="row">
                    <div class="col-md-6 px-1">
                      <div class="form-group">
                        <label>Company Name</label>
                        <select class="form-control" name="company" id="company">
                          <option>Choose Electric Company</option>
                          <option value="UB163">Enugu Electric Distribution Company</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 px-1">
                      <div class="form-group">
                        <label>Meter Number</label>
                        <input type="text" class="form-control" name="meterno" placeholder="Meter Number" id="meterno">
                      </div>
                    </div>
                    <div class="col-md-12 px-1">
                      <div class="form-group">
                        <label>Transaction Pin</label>
                        <input type="password" class="form-control" name="pin" placeholder="Enter Transaction Pin" id="pin">
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
	$('#electricbill').attr('class','active');
</script>
<script type="text/javascript">
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

        var company = $('#company').val();
        var meterno = $('#meterno').val();
        var pin = $('#pin').val();


         $.ajax({
        url: 'includes/processes/processelectricbill.php',
        type: 'post',
        data: {'company':company, 'meterno':meterno, 'pin':pin},
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
              window.location.assign('includes/processes/processelectricbill.php');
            }
            setTimeout(redirectUser, 1000);

            // //clear the inputs
            $('#company').val("");
            $('#meterno').val("");
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
      