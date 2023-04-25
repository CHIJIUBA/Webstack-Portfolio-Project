<?php include('includes/header.php');
$account = new Account($con, $_SESSION['user_id']);
?>
      <div class="content">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-globe text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Account Number</p>
                      <p class="card-title" style="font-size: 15px; margin-top: 10px;"><?php echo $user->account->account_number; ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i> Update Now
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Balance</p>
                      <p class="card-title" style="font-size: 16px; margin-top: 10px">&#8358 <?php echo $user->account->balance; ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar-o"></i> Last day
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-vector text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Transactions</p>
                      <p class="card-title" style="font-size: 16px; margin-top: 10px"><?php echo $user->transactions->get_total_transaction($user->id); ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-clock-o"></i> In the last hour
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-favourite-28 text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Followers</p>
                      <p class="card-title">+45K
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i> Update now
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      
      <?php include('includes/footer.php'); ?>
      <script type="text/javascript">  
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
      </script>
      <!-- this is for the fund account notification -->
      <?php
      if(isset($_SESSION['amount'])){
        echo "<script> var amount = {$_SESSION['amount']}</script>";
        ?>
        <script type="text/javascript">
          showNotification('top','right','success','Success <b>VioPay</b> - Your Account has been credited successfully with '+amount+' Naira','nc-icon nc-check-2');
        </script>
       <?php
       unset($_SESSION['amount']);
        }
      ?>
      <!-- this is the end of the fund account notification -->

      <!-- this is for the airtime payment success notification -->
      <?php
      if(isset($_SESSION['airtime_success'])){
        echo "<script> var amount = {$_SESSION['airtime_success']}</script>";
        ?>
        <script type="text/javascript">
          showNotification('top','right','success','Success <b>VioPay</b> - Your recharge was successfull. Your account has been debited with '+amount+' Naira','nc-icon nc-check-2');
        </script>
       <?php
       unset($_SESSION['airtime_success']);
        }
      ?>
      <!-- this is the end of the airtime payment success notification -->

      <!-- this is for the airtime payment fairlure notification -->
      <?php
      if(isset($_SESSION['airtime_failure'])){
        // echo "<script> var amount = {$_SESSION['airtime_success']}</script>";
        ?>
        <script type="text/javascript">
          showNotification('top','right','danger','Error <b>VioPay</b> - Your recharge was not successfull. Please try again later ','nc-icon nc-simple-remove');
        </script>
       <?php
       unset($_SESSION['airtime_failure']);
        }
      ?>
      <!-- this is the end of the airtime payment failure notification -->
      <script type="text/javascript">
        $('#dashboard').attr('class','active');
      </script>
      