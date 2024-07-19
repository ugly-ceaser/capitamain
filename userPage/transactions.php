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
            <h1>Transactions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item active">Transaction Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pending Deposits</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="min-width: 10px">Date</th>
                      
                      <th>Coin</th>
                      <th>Amount</th>
                 
                    </tr>
                  </thead>
                  <tbody>
                  <?php


                        $data =get_transactions_by_type_status($email, $conn, "transactions", "deposit","pending");
                        if ($data) {
                          foreach ($data as $transact) { ?>

                    <tr>
                      <td><?= $transact['trxDate'] ?></td>
                     
                      <td><?= $transact['coin'] ?></td>
                      <td>
                      <?= $transact['Amount'] ?>
                      </td>
                      
                    </tr>
                   
											<?php
											}
										} else { ?>
										
                    <td colspan="3" style="text-align:center;"><h1>No Records Found</h1></td>
										<?php } ?>

									</tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->

            
            <!-- /.card -->
          </div>


          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pending Withdrawal</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="min-width: 10px">Date</th>
                     
                      <th>Coin</th>
                      <th>Amount</th>
                 
                    </tr>
                  </thead>
                  <tbody>
                  <?php


                        $data =get_transactions_by_type_status($email, $conn, "transactions", "withdraw","pending");
                        if ($data) {
                          foreach ($data as $transact) { ?>

                    <tr>
                      <td><?= $transact['trxDate'] ?></td>
                     
                      <td><?= $transact['coin'] ?></td>
                      <td>
                      <?= $transact['Amount'] ?>
                      </td>
                      
                    </tr>
                   
											<?php
											}
										} else { ?>
										
                    <td colspan="3" style="text-align:center;"><h1>No Records Found</h1></td>
										<?php } ?>

									</tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->

            
            <!-- /.card -->
          </div>
     
        </div>
        
      
       
       
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Transactions</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Date</th>
                 
                      <th>Amount</th>
                      <th>Coin</th>
                      <th>Transaction</th>
                      <th>Status</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php


                          $data =get_all_transactions($email, $conn, "transactions") ;
                          if ($data) {
                            foreach ($data as $transact) { ?>

                          <tr>
                          <td><?= $transact['trxDate'] ?></td>
                        
                          <td>
                          <?= $transact['Amount'] ?>
                          </td>
                          <td><?= $transact['coin'] ?></td>
                          <td><?= $transact['trxType'] ?></td>
                          <td><?= $transact['trxStatus'] ?></td>

                          

                          </tr>

                          <?php
                          }
                          } else { ?>

                          <td colspan="3" style="text-align:center;"><h1>No Records Found</h1></td>
                          <?php } ?>

                          </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        
      
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
 require_once  ('./footer.php');
 ?>rl