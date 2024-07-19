
<?php
session_start();


include'./conn.php';


include("../../utils/index.php");

if(!isset($_SESSION['Admin'])) header("Location: ../../index.php");


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../images/favicon.ico">

    <title>Crypto Admin - Transactions Page </title>
  
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="../../../assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">
	
	<!-- Bootstrap extend-->
	<link rel="stylesheet" href="../../css/bootstrap-extend.css">

	<!-- Theme style -->
	<link rel="stylesheet" href="../../css/master_style.css">

	<!-- Crypto_Admin skins -->
	<link rel="stylesheet" href="../../css/skins/_all-skins.css">	

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>





  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crypto Summary
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Reports</a></li>
        <li class="breadcrumb-item active">Account Summary</li>
      </ol>
    </section>

    <!-- Main content -->
     <section class="content">
      
		<div class="row">
        <div class="col-12 col-lg-3">
          <div class="box box-body pull-up bg-hexagons-white">
            <div class="media align-items-center p-0">
            <div class="text-center">
              <a href="#"><i class="cc BTC mr-5" title="BTC"></i></a>
            </div>
            <div>
              <h2 class="no-margin">Users</h2>
            </div>
            </div>
            <div class="flexbox align-items-center mt-2">
            <div>
              <p class="no-margin"> <span class="text-gray"></span> <span class="text-info"></span></p>
            </div>
            <div class="text-right">
              <p class="no-margin"><span class="text-success h2">
			  <?=  count(getUsers($conn)); ?>
			  </span></p>
            </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-12">					
        <div class="box box-body pull-up bg-hexagons-white">
          <div class="media align-items-center p-0">
          <div class="text-center">
            <a href="#"><i class="cc LTC mr-5" title="LTC"></i></a>
          </div>
          <div>
            <h2 class="no-margin">Deposits</h2>
          </div>
          </div>
          <div class="flexbox align-items-center mt-2">
          <div>
            <p class="no-margin"><span class="text-gray"></span> <span class="text-info"></span></p>
          </div>
          <div class="text-right">
            <p class="no-margin"><span class="text-danger h2">
				<?= "$" . number_format(getAmount($conn, "deposit","DepositAccount")); ?>
			</span></p>
          </div>
          </div>
        </div>		
        </div>
       <div class="col-lg-3 col-12">			
        <div class="box box-body pull-up bg-hexagons-white">
          <div class="media align-items-center p-0">
          <div class="text-center">
            <a href="#"><i class="cc NEO mr-5" title="NEO"></i></a>
          </div>
          <div>
            <h2 class="no-margin">Withdrawal</h2>
          </div>
          </div>
          <div class="flexbox align-items-center mt-2">
          <div>
            <p class="no-margin"> <span class="text-gray"></span> <span class="text-info"></span></p>
          </div>
          <div class="text-right">
            <p class="no-margin"><span class="text-success h2">
				<?= "$" . number_format(getAmount($conn, "withdraw","withdrawalAccount")); ?>
			</span></p>
          </div>
          </div>
        </div>
       </div>
      
       <div class="col-lg-3 col-12">
        <div class="box box-body pull-up bg-hexagons-white">
          <div class="media align-items-center p-0">
          <div class="text-center">
            <a href="#"><i class="cc DASH mr-5" title="DASH"></i></a>
          </div>
          <div>
            <h2 class="no-margin"> Pending</h2>
          </div>
          </div>
          <div class="flexbox align-items-center mt-2">
          <div>
            <p class="no-margin"> <span class="text-gray"></span> <span class="text-info"></span></p>
          </div>
          <div class="text-right">
            <p class="no-margin"><span class="text-danger h2">
				<?= "$" . number_format(getAmountPending($conn,"DepositAccount")) + number_format(getAmountPending($conn,"withdrawalAccount")); ?>
			</span></p>
          </div>
          </div>
        </div>
       </div>
				
		</div>
			
			
			
	
		
	
		
		
		<div class="row">		
		  
		  
			
		  <div class="col-lg-6 col-6">
			<div class="box">
				<div class="box-header with-border">
				  <h4 class="box-title">Users</h4>
					<ul class="box-controls pull-right">
					  <li><a class="box-btn-close" href="#"></a></li>
					  <li><a class="box-btn-slide" href="#"></a></li>	
					  <li><a class="box-btn-fullscreen" href="#"></a></li>
					</ul>
				</div>
				<div class="box-body">
					<div class="table-responsive">
							<table class="table table-bordered no-margin">
						  <thead>					
							<tr class="bg-pale-dark">
							  <th>User Id</th>  
							  
							  <th>Amount</th>
							  <th>Transaction Type</th>
							  <th>Transaction Status</th>
							  <th>Date</th>
							</tr>
						  </thead>
						  <tbody>
						<?php
							$query = "SELECT * FROM `DepositAccount`";
							$result = $conn->prepare($query);
							$result->execute();

							if($result->rowCount()) {
								foreach($result->fetchAll() as $txr):
									?>
										<tr>
										    <td><?= $txr['id'] ?> </td>
											
											<td><?= "$ ". $txr['amount'] ?> </td>
											<td><?= $txr['trxType'] ?> </td>
											<td><?= $txr['trxStatus'] ?> </td>
											<td><?= date("D, m Y", strtotime($txr['datee'])); ?> </td>
										</tr>
									<?php
								endforeach;
							}

							else {
								?>

									<tr>
										<td style="text-align: center; font-size: 1.5rem; color: #777;" colspan="5">No Transactions Found</td>
									</tr>

								<?php
							}

						?>
						  </tbody>
						</table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->

		  </div> 

		  <div class="col-lg-6 col-6">
			<div class="box">
				<div class="box-header with-border">
				  <h4 class="box-title">Users</h4>
					<ul class="box-controls pull-right">
					  <li><a class="box-btn-close" href="#"></a></li>
					  <li><a class="box-btn-slide" href="#"></a></li>	
					  <li><a class="box-btn-fullscreen" href="#"></a></li>
					</ul>
				</div>
				<div class="box-body">
					<div class="table-responsive">
							<table class="table table-bordered no-margin">
						  <thead>					
							<tr class="bg-pale-dark">
							  <th>User Id</th>  
							  
							  <th>Amount</th>
							  <th>Transaction Type</th>
							  <th>Transaction Status</th>
							  <th>Date</th>
							</tr>
						  </thead>
						  <tbody>
						<?php
							$query = "SELECT * FROM `withdrawalAccount`";
							$result = $conn->prepare($query);
							$result->execute();

							if($result->rowCount()) {
								foreach($result->fetchAll() as $txr):
									?>
										<tr>
										    <td><?= $txr['id'] ?> </td>
											
											<td><?= "$ ". $txr['amount'] ?> </td>
											<td><?= $txr['trxType'] ?> </td>
											<td><?= $txr['trxStatus'] ?> </td>
											<td><?= date("D, m Y", strtotime($txr['datee'])); ?> </td>
										</tr>
									<?php
								endforeach;
							}

							else {
								?>

									<tr>
										<td style="text-align: center; font-size: 1.5rem; color: #777;" colspan="5">No Transactions Found</td>
									</tr>

								<?php
							}

						?>
						  </tbody>
						</table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->

		  </div> 
		 
			
		</div>	
		
		
	</section>
    <section class="content">
	  
	  <div class="row">
		<div class="col-lg-6 col-12">
		  <!-- Default box -->
		  <div class="box box-solid bg-dark">
			<div class="box-header with-border">
			  <h3 class="box-title">Update Accounts</h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
			</div>
			<div class="box-body">
				<div class="table-responsive">
				<form action="../../utils/index.php" method="post" enctype="multipart/form-data">
										  <div class="input-group mb-15">
												  
											  <span class="input-group-text bg-transparent"><i class="ti-coin"></i></span>
												  
												  <select name="wallet_typ" id="select" class="form-control ps-15 bg-transparent" required>
													  <option value="">Select Coin</option>	
													  <option value="USDT">USDT</option>
													  <option value="BTC">BTC</option>
													  <option value="ETH">ETH</option>
											  
												  </select>
										  </div>
		  
											  <div class="input-group mb-15">
												  <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
												  <input type="text" name="Address" class="form-control ps-15 bg-transparent" placeholder="wallt Address" required>
		  
											  </div>
		  
											  
		  
											  <div class="input-group mb-15">
											  <div class="input-group mb-15">
										<span class="input-group-text bg-transparent"><i class="ti-wallet"></i></span>
										<input class="form-control" name="file" type="file" placeholder="Wallet Bar code">
									</div>
											  </div>
		  
											 

											
											  
											  <div class="col-12 text-center">
												<input type="submit" class="btn btn-info w-p100 mt-15" name="adminAcountt" value="Update">
											  </div>
									  </form>
				</div>
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		</div>
		<div class="col-lg-6 col-12">
		  <!-- Default box -->
		  <div class="box box-solid bg-dark">
			<div class="box-header with-border">
			  <h3 class="box-title">Toatl Withdrawal</h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered no-margin">
					<tbody>
						  <tr>
							<td>Amount</td>
							<td>231</td>
						  </tr>
						  <tr>
							<td>Most Withdrawn coin</td>
							<td>15.46 minutes</td>
						  </tr>
						  <tr>
							<td>Highest Single Withdrawal</td>
							<td>1,637.546780000 BTC</td>
						  </tr>
						</tbody>
				    </table>
				</div>
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		  
		</div>
		
		
		
		<div class="col-lg-12 col-12">
		  <!-- Default box -->
		  <div class="box box-solid bg-dark">
			<div class="box-header with-border">
			  <h3 class="box-title">Transaction Summary</h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered no-margin">
						<tbody>
						  <tr>
                            <td>BTC</td>
                            <td>445.24635681 BTC</td>
                            
                          </tr>
                          <tr>
                            <td>USDT</td>
                            <td>320,151</td>
                            
                          </tr>
                          <tr>
                            <td>ETH</td>
                            <td>4,543,040.43456788 BTC</td>
                            
                          </tr>
                          <tr>
                            <td>Total</td>
                            <td>$34,758,121,076.66</td>
                            
                          </tr>
						</tbody>
				    </table>
				</div>
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		  
		</div>  
		  
	  </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
   
  <?php include './footer.php';?>


	<!-- jQuery 3 -->
	<script src="../../../assets/vendor_components/jquery/dist/jquery.min.js"></script>
	
	<!-- popper -->
	<script src="../../../assets/vendor_components/popper/dist/popper.min.js"></script>
	
	<!-- Bootstrap 4.0-->
	<script src="../../../assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>
	
	<!-- SlimScroll -->
	<script src="../../../assets/vendor_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	
	<!-- FastClick -->
	<script src="../../../assets/vendor_components/fastclick/lib/fastclick.js"></script>
	
	<!-- Chart -->
	<script src="../../../assets/vendor_components/chart.js-master/Chart.min.js"></script>
	<script src="../../js/pages/chartjs-int.js"></script>
	
	<!-- Crypto_Admin App -->
	<script src="../../js/template.js"></script>
	
	<!-- Crypto_Admin for demo purposes -->
	<script src="../../js/demo.js"></script>
	

</body>
</html>
