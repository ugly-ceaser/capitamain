<?php



if (isset($_GET['amount'])) {
    require("header.php");
    $amount = $_GET['amount'];
    $trId =   $_GET['trId'];
} else {
    header('Location: ./index.php'); // Correct the location header
    exit(); // Ensure the script stops executing after the redirect
}

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
       
        <div class="row">
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
             
              <div class="card-body">
                <div class="tab p-0">
                  <div class="chart tab-pane" id="sales-chart2" style="position: relative; min-height: 300px;">
                    <div class="row">
                    <div class="col-12 ">
                            <h3 style=" font-weight:bolder" class="text-danger mb-3 mt-2"> <small class="text-info">Transfer </small> $<?= $amount?> <small class="text-info"> To your prefered address below to fund your accoount</small></h3>
                    
                      </div>
                          <div class="col-md-12 col-lg-4 card">
                            <h4 style="color:black; font-weight:bolder">BTC </h4>
                            <img src="../admin_profile/utils/uploads/<?= $btcImg?>" class="img-thumbnail" alt="BTC" style="width:200px;">
                          
                            <div class="form-group">
                                <label class="form-label">Copy Address</label>
                                <input type="text" class="form-control" value="<?= $btcAddress?>" disabled  title="Double Tap to copy the address">
                            </div>
                          </div>  
                                        
                          <div class="col-md-12 col-lg-4 ">
                              <h4 style="color:black; font-weight:bolder">USDT </h4>
                            <img src="../admin_profile/utils/uploads/<?= $usdtImg?>" class="card-img-top" alt="USDT" style="width:200px;">
                            
                            <div class="form-group">
                            <label class="form-label">Copy Address</label>
                            <input type="text" class="form-control" value="<?= $usdtAddress?>" disabled  title="Double Tap to copy the address">
                            </div>
                          </div>

                        <div class="col-md-12 col-lg-4 " id="deposit">
                              <h4 style="color:black; font-weight:bolder">ETH </h4>
                          <img src="../admin_profile/utils/uploads/<?= $ethImg?>" class="card-img-top" alt="ETH" style="width:200px;">
                          <div class="form-group">
                            <label class="form-label">Copy Address</label>
                            <input type="text" class="form-control" value="<?= $btcAddress?>" disabled  title="Double Tap to copy the address">
                            </div>
                      </div>


                      <div class="col-12 ">
                         <h6 style=" font-weight:bolder" class="text-success mb-2 mt-2"> Fill  Out the Form Bellow  After Your Transfer To Complete Deposit Process </h6>
                         <form id="TDrequestForm" method="post" class="form">
                            <div class="form-group">
                                <label class="form-label">Transactions ID</label>
                                <input type="text" class="form-control" value="" name="newTrId" required>
                                <input type="text" class="form-control" value="<?= $trId?>" name="oldTrId" hidden>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="form-control" value="Request for Deposit Approval" name="tranID">
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
          
         
         
        </div>
        
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
 require_once  ('./footer.php');
 ?>