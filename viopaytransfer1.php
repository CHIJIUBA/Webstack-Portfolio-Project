<?php include('includes/header.php'); ?>
      <div class="content">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title text-center text-primary">Transfer to a VioPay Account</h5>
              </div>
              <div class="card-body">
                <form id="form" action="#" method="post">
                  <h4 class="text-center text-danger" id="error"></h4>
                  <div class="row">
                    <div class="col-md-12 px-1">
                      <div class="form-group">
                        <label>Recipient Viopay Account Number</label>
                        <input type="text" class="form-control" name="acct_num" placeholder="Enter Reciever viopay account number" id="acct_num">
                      </div>
                    </div>
                    <div class="col-md-12 px-1">
                      <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" name="amount" placeholder="Enter Amount" id="amount">
                      </div>
                    </div>
                    <div class="col-md-12 px-1">
                      <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="pin" class="form-control" placeholder="Enter a description for this payment" id="description">
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
        document.getElementById('title').innerHTML = "VIOPAY: Fundaccount";

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
        var acct_num = $('#acct_num').val();


         $.ajax({
        url: 'includes/processes/processviopaytransfer.php',
        type: 'post',
        data: {'amount':amount, 'description':description, 'acct_num':acct_num},
        beforeSend: function(){
          $('#submit').attr('disabled','true');
        },
        success: function(response){

          $('#submit').removeAttr('disabled');

          if(response == 'Successful'){

            //show notification
            showNotification('top','right','success','Success <b>VioPay</b> - Form submitted Successfully, You will be redirected Shortly.','nc-icon nc-check-2');

            //redirect user to payment page
            function redirectUser(){
              window.location.assign('viopaytransfer2.php');
            }
            setTimeout(redirectUser, 2000);

            // //clear the inputs
            $('#amount').val("");
            $('#remark').val("");
            $('#pin').val("");

            //submit the hidden form
            $('#form1').submit();
          }
          else{
            showNotification('top','right','danger','Error <b>VioPay</b> -  '+response+'','nc-icon nc-simple-remove');
          }
        }
       });
        
       });
      //end of the ajax call
      </script>