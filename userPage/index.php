<?php
 

  require_once("header.php");

?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          <?php include"./modal.php";?>
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box " style="background-color:#EEFBA3">
              <div class="inner">
                <h3>$<?= $totalDeposit ?? 0 ?></h3>

                <p>Total Deposit</p>
              </div>
              <div class="icon">
                <i class="ion ion-money"></i>
              </div>
              <a href="#" class="small-box-footer text-dark">Package: <?= $package ?? 'NULL' ?></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box " style="background-color:#EEFBA3">
              <div class="inner">
                <h3>$<?= $totalWithdrawal ?? 0 ?></h3>

                <p>Total Withdrawal</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer text-dark">ROI : <?= $rio ?? 0 ?></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box " style="background-color:#EEFBA3">
              <div class="inner">
              <h3>$<?= $profit ?? 0 ?></h3>

                <p>Profit</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer text-dark">ROI : <?= $rio ?? 0 ?></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box " style="background-color:#EEFBA3">
              <div class="inner">
                <h3>$<?= $balance ?? 0 ?></h3>

                <p>Balance</p>
              </div>
              <div class="icon">
                <i class="ion ion-bar-chart"></i>
              </div>
              <a href="#" class="small-box-footer text-dark">Profit + Transaction<sub>Net</sub></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">

        <section class="col-lg-12 connectedSortable">
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Transaction Request Form
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active mt-2" href="#revenue-chart" data-toggle="tab">Deposit</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mt-2" href="#sales-chart" data-toggle="tab">Withdrawal</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; min-height: 300px;">
                       <div class="row">
                        <div class="col-12">
                          <form action="./scripts/funct.php" method="post" class="form">
                            
                                <div class="form-group">

                                    <label for="amount" class="form-label">Amount</label>
                                    <input id="amount" class="form-control" type="text" name="amount">
                                </div>

                                <div class="form-group">

                                      <label for="coin" class="form-label">Coin</label>

                                      <select class="form-control" name="coin" id="coin">
                                      <option> Select Coin</option>
                                      <option value="btc">BTC</option>
                                      <option value ="usdt">USDT</option>
                                      <option value ="eth">ETH</option>
                                      </select>

                                </div>

                                <div class="form-group">
                                  <!--<label for="trnxNet">Transfer Network</label>-->

                                  <input id="trnxNet" class="form-control" type="text" name="TransferNetwork" value="default" hidden>

                                </div>
                               

                                <div class="form-group">
                            
                                  <input id="my-input" class="btn btn-sm bg-primary" value="Submit" class="form-control" type="Submit" name="deposit">
                                </div>
                          </form>
                        </div>
                       </div>
                      
                   </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; min-height: 300px;">
                  <div class="row">
                    <div class="col-12">
                    <form action="./scripts/funct.php" method="post">
                          <div class="form-group">
                            <label  class="form-label" for="amount">Amount</label>
                            <input id="amount" class="form-control" type="text" name="amount">
                          </div>
                          <div class="form-group">
                            <label  class="form-label" for="coin">Prefered Coin</label>
                            <select class="form-control" name="coin" id="coin">
                            <option> Select Coin</option>
                            <option value="btc">BTC</option>
                            <option value ="usdt">USDT</option>
                            <option value ="eth">ETH</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <!--<label  class="form-label" for="trnxNet">Transfer Network</label>-->
                            <input id="trnxNet" class="form-control" type="text" name="TransferNetwork" value="defualt" hidden>
                          </div>
                          <div class="form-group">
                            <label class="form-label" for="transID">Prefered Wallet Address </label>
                            <input id="transID" class="form-control" type="text" name="walletId">
                          </div>
                          <div class="form-group">
                            <input id="my-input" class="btn btn-sm bg-primary" value="Confirm" class="form-control" type="Submit" name="withdraw">
                          </div>
										</form>
                    </div>
                  </div>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>

        
        
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  How To Deposit
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link bg-success active mt-2" href="#revenue-chart2" data-toggle="tab">Instruction</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mt-2" href="#sales-chart2" data-toggle="tab">Deposit Accounts</a>
                    </li>
                  </ul>
                </div>
              </div> -->
              <!-- <div class="card-body">
                <div class="tab-content p-0">
                  
                  <div class="chart tab-pane active row" id="revenue-chart2"
                       style="position: relative; height: 300px;">
                       <div class="col-12 d-flex justify-content-cente">
                       <ol>
                       <h1>Deposit Steps</h1>
                        <li>Scan the designated QR-Code on the Deposit Accounts Tab </li>
                        <li>Transfer Funds to the Wallet Address</li>
                        <li>Navigate to Transaction request form</li>
                        <li>Select Deposit Tab</li>
                        <li>Fill the Form and Submit</li>
                        <li>Done, Your Account will be funded after payment confirmation</li>
                       </ol>

                       </div>
                      
                      
                   </div>
                  <div class="chart tab-pane" id="sales-chart2" style="position: relative; min-height: 300px;">
                    <div class="row">
                          <div class="col-md-12 col-lg-4 card">
                            <h4 style="color:black; font-weight:bolder">BTC </h4>
                            <img src="../admin_profile/utils/uploads/btc.jpg" class="img-thumbnail" alt="BTC" style="width:200px;">
                          
                            <div class="form-group">
                                <label class="form-label">Copy Address</label>
                                <input type="text" class="form-control" value="bc1qwl5wjw4lxcpdrlcggqegj0wwq67vqgqczftghy" disabled  title="Double Tap to copy the address">
                            </div>
                          </div>  
                                        
                          <div class="col-md-12 col-lg-4 ">
                              <h4 style="color:black; font-weight:bolder">USDT </h4>
                            <img src="../admin_profile/utils/uploads/usdt.jpg" class="card-img-top" alt="USDT" style="width:200px;">
                            
                            <div class="form-group">
                            <label class="form-label">Copy Address</label>
                            <input type="text" class="form-control" value="TE6t5Mzt9cWbETc9WcGeVChTs1PpgvUM7t" disabled  title="Double Tap to copy the address">
                            </div>
                          </div>

                        <div class="col-md-12 col-lg-4 " id="deposit">
                              <h4 style="color:black; font-weight:bolder">ETH </h4>
                          <img src="../admin_profile/utils/uploads/eth.jpg" class="card-img-top" alt="ETH" style="width:200px;">
                          <div class="form-group">
                            <label class="form-label">Copy Address</label>
                            <input type="text" class="form-control" value="0xd0f5b5E55C376acACaedD04486dB8AFc6Ba1977A" disabled  title="Double Tap to copy the address">
                            </div>
                      </div>	
											
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
            <!-- /.card -->

         

          
        </section>
          
         
         
        </div>
        
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
 require_once  ('./footer.php');
 ?>