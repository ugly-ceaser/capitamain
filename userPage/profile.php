<?php
  

  require_once("header.php");

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>

            <?php include('./modal.php'); ?>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                <img src="<?= $profilePic ?? 'dist/img/avatar5.png' ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"></h3>

                

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Total Deposit</b> <a class="float-right">$<?= $totalDeposit ?? 0 ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Total Withdrawal</b> <a class="float-right">$<?= $totalWithdrawal ?? 0 ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Acount Balance</b> <a class="float-right">$<?= $currentBalance ?? 0 ?></a>
                  </li>
                </ul>

                <a href="./scripts/funct.php?invest=terminate"  class="btn btn-primary btn-block"><b>Terminate Current Investment</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav d-flex justify-center-center nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Invest</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Update User Account Details</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Update User Profile Details</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                       <form action="./scripts/funct.php" method="post">
                            <div class="form-group">
                              <label for="amount">Amount</label>
                              <input id="amount" class="form-control" type="text" name="amount">
                            </div>


                            <div class="form-group">
                              <label for="plan">Plan</label>
                              <br>
                              <small class="text-danger">Please Amount should be up to the required minimuin amount for the selected plan </small>
                              <select name="plan" class="form-control" id="">
                                <option>Select Plan</option>

                                <option value="basic">Basic</option>
                                <option value="standard">Standard</option>
                                <option value="pro">Pro</option>
                                <option value="advance">Advance</option>
                                

                              </select>
                            </div>

                            <div class="form-group">
                              
                              <input id="my-input" class="btn btn-sm bg-primary" value="Invest" class="form-control" type="Submit" name="invest">
                            </div>
										</form>
                      </div>
                      <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                            <div class="box">
                              <div class="box-header with-border">
                                <h4 class="box-title">Wallet Details</h4>
                              </div>
                              <!-- /.box-header -->
                              <div class="box-body">
                                <div class="row">
                                  <form method="post" action="./scripts/funct.php">
                                    
                                      <div class="form-group ">
                                        <label class="form-label">Wallet Address</label>
                                        
                                          <input class="form-control" name="wallet" required type="text" placeholder="your wallet address">
                                        
                                      </div>
                                      <div class="form-group ">
                                        <label class="form-label">Coin</label>
                                        
                                          <input class="form-control" name="coin" required type="text" placeholder="Your Coin">
                                        
                                      </div>
                                      <div class="form-group ">
                                        <label class="form-label">Network</label>
                                        
                                          <input class="form-control" type="text" name="network" required placeholder="please the appropriate coin next work">
                                        
                                      </div>

                                      <div class="form-group ">
                                        <label class="form-label"></label>
                                        
                                          <button type="submit" name="walletUpdate" class="btn btn-primary">Submit</button>
                                        
                                      </div>
                                  
                                  </form>
                                      <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                  </div>
                                  <!-- /.box-body -->
                            </div>
                    </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                  <form action="./scripts/funct.php" method="post">

                          <div class="box-header with-border">
                            <h4 class="box-title">Personal details</h4>
                            <?php include"./modal.php";?>
                          </div>
                          <!-- /.box-header -->

                          <div class="form-group">
                            <label class=" form-label">Change UserName</label>
                            <div class="col-sm-10">
                              <input class="form-control" name="username" type="text" placeholder="Enter Your New User Name">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="form-label">Old Password</label>
                            
                              <input class="form-control" name="oldPassword" type="password" placeholder="Enter Your Old Password">
                            
                          </div>

                          <div class="form-group ">
                            <label class=" form-label text-danger">New Password</label>
                            
                              <input class="form-control" name="newPassword" type="password" placeholder="Enter new password if you want to change password">
                          
                          </div>
                        
                        <div class="form-group">
                          <label class="form-label">Phone Number</label>
                          
                            <input class="form-control" name="phone" type="tel" placeholder="123 456 7890">
                          
                        </div>

                          <div class="form-group">
                            <button type="submit" name="UserProfile" class="btn btn-primary">Submit</button>
                          
                          </div>
                    
                  
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 <?php 
 require_once  ('./footer.php');
 ?>