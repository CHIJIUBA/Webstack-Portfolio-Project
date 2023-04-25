<?php include('includes/header.php'); ?>
      <div class="content">
        <div class="row">
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="assets1/img/cover2.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="assets1/img/mike.jpg" alt="...">
                    <h5 class="title"><?php echo $user->full_name ?></h5>
                  </a>
                </div>
                <center><button class="btn btn-primary">Change Picture</button></center>
              </div>
            </div>

            
          </div>
          <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Profile</h5>
              </div>
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" disabled="" value="<?php echo $user->fname?>">
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Last</label>
                        <input type="text" class="form-control" disabled="" value="<?php echo $user->lname?>">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Account Balance</label>
                        <input type="text" class="form-control" disabled="" value="&#8358; <?php echo $user->get_balance(); ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Account Number</label>
                        <input type="text" class="form-control" disabled="" value="<?php echo $user->get_account_number(); ?>">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" disabled="" value="<?php echo $user->phone_number?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" disabled="" value="<?php echo $user->email?>">
                      </div>
                    </div>
                  </div>
                  <!-- <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">Update Profile</button>
                    </div>
                  </div> -->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include('includes/footer.php'); ?>
      <script type="text/javascript">
        $('#profile').attr('class','active');
      </script>