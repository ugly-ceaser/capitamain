<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../images/favicon.ico">

    <title>OneBit Farm - Transactions Page </title>
  
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
<?php include '../header2.php';?>	




  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transactions page
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Reports</a></li>
        <li class="breadcrumb-item active">Transactions page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	  <div class="row">
		<div class="col-lg-6 col-12">
		  <!-- Default box -->
		  <div class="box box-solid bg-black">
			<div class="box-header with-border">
			  <h3 class="box-title">Pending Deposits</h3>

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
					<table class="table table-bordered no-margin" style="min-width: 900px;">
					  <thead>
						<tr>
						  <th>Name</th>
						  <th>Date</th>
						  <th>Transaction Id</th>
						  <th>Sent</th>
						  <th>Actions</th>
						</tr>
					  </thead>
					  <tbody>
							<?php if(count(pendingTransact($conn, "deposit","DepositAccount"))): ?>
								<?php foreach(pendingTransact($conn, "deposit","DepositAccount") as $transact): ?>
									<tr>
										<td>
											<a href="#" class="text-yellow hover-warning">
												<?= getUser($conn, $transact["id"])["fname"]; ?>
											</a>
										</td>
										<td>
											<?= date("D, m Y", strtotime($transact["datee"])); ?>
										</td>
										<td>
											<?= $transact["trxId"]; ?>
										</td>
										<td>
											<?= "$" . number_format($transact["amount"]); ?>
										</td>
										<td>
											<div class="d-flex align-items-center">
												<?php if($transact["trxStatus"] === "pending"): ?>
													<a href="../../handler/user_handler.php?approve=<?= $transact['trxId']; ?>" class="btn btn-sm btn-primary">
														Approve
													</a>
												<?php else: ?>
													<button disabled class="btn btn-sm">Approve</button>
												<?php endif; ?>

												<a href="../../handler/user_handler.php?decline=<?= $transact['trxId']; ?>" class="btn btn-sm btn-danger ml-10">
													Decline
												</a>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<td colspan="6">
									<div class="h-25 text-center d-flex text-muted justify-content-center">
										No pending deposit transaction founds
									</div>
								</td>
							<?php endif; ?>
					  </tbody>
					</table>
				</div>
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		</div>
		
		<div class="col-lg-6 col-12">
		  <!-- Default box -->
		  <div class="box box-solid bg-black">
			<div class="box-header with-border">
			  <h3 class="box-title">Pending Withdrawal</h3>

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
					<table class="table table-bordered no-margin" style="min-width: 900px;">
					  <thead>
						<tr>
						  <th>Name</th>
						  <th>Date</th>
						  <th>Transaction Id</th>
						  <th>Sent</th>
						  <th>Actions</th>
						</tr>
					  </thead>
					  <tbody>
							<?php if(count(pendingTransact($conn, "withdraw","withdrawalAccount"))): ?>
								<?php foreach(pendingTransact($conn, "withdraw","withdrawalAccount") as $transact): ?>
									<tr>
										<td>
											<a href="#" class="text-yellow hover-warning">
												<?= getUser($conn, $transact["id"])["fname"] ?>
											</a>
										</td>
										<td>
											<?= date("D, m Y", strtotime($transact["datee"])); ?>
										</td>
										<td>
											<?= $transact["trxId"]; ?>
										</td>
										<td>
											<?= "$" . number_format($transact["amount"]); ?>
										</td>
										<td>
											<div class="d-flex align-items-center">
												<?php if($transact["trxStatus"] === "pending"): ?>
													<a href="../../handler/user_handler.php?approve=<?= $transact['trxId']; ?>" class="btn btn-sm btn-primary">
														Approve
													</a>
												<?php else: ?>
													<button disabled class="btn btn-sm">Approve</button>
												<?php endif; ?>

												<a href="../../handler/user_handler.php?decline=<?= $transact['trxId']; ?>" class="btn btn-sm btn-danger ml-10">
													Decline
												</a>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<td colspan="6">
									<div class="h-25 text-center d-flex text-muted justify-content-center">
										No pending deposit transaction founds
									</div>
								</td>
							<?php endif; ?>
					  </tbody>
					</table>
				</div>
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		</div>
		
		<div class="col-12">
			<!-- Default box -->
			  <!-- <div class="box box-solid bg-black">
				<div class="box-header with-border">
				  <h3 class="box-title">Latest Transactions</h3>

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
						  <thead>					
							<tr>
							  <th>Transaction Hash</th>
							  <th>BTC</th>
							  <th>Time</th>
							  <th>Miner Preference</th>
							  <th>Status</th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <td>
								<a href="#" class="text-yellow hover-warning">
								  9d2c7b06bfa0
								</a>
								...
							  </td>
							  <td>1.2126281 BTC</td>
							  <td>
								<time class="timeago" datetime="2018-02-01T13:38:01Z" title="2018-02-01 13:38 GMT">2 minutes ago</time>
							  </td>
							  <td>medium</td>
							  <td><span class="label label-success">Confirmed</span></td>
							</tr>
							<tr>
							  <td>
								<a href="#" class="text-yellow hover-warning">
								  5de67415bfc6
								</a>
								...
							  </td>
							  <td>0.20522881 BTC</td>
							  <td>
								<time class="timeago" datetime="2018-02-01T13:38:01Z" title="2018-02-01 13:38 GMT">2 minutes ago</time>
							  </td>
							  <td>high</td>
							  <td><span class="label label-warning">Unconfirmed</span></td>
							</tr>
							<tr>
							  <td>
								<a href="#" class="text-yellow hover-warning">
								  733de15b3cec
								</a>
								...
							  </td>
							  <td>2.02622033 BTC</td>
							  <td>
								<time class="timeago" datetime="2018-02-01T13:38:01Z" title="2018-02-01 13:38 GMT">2 minutes ago</time>
							  </td>
							  <td>high</td>
							  <td><span class="label label-success">Confirmed</span></td>
							</tr>
							<tr>
							  <td>
								<a href="#" class="text-yellow hover-warning">
								  6793bcfa4f7f
								</a>
								...
							  </td>
							  <td>2.43220578 BTC</td>
							  <td>
								<time class="timeago" datetime="2018-02-01T13:38:00Z" title="2018-02-01 13:38 GMT">2 minutes ago</time>
							  </td>
							  <td>high</td>
							  <td><span class="label label-danger">Canceled</span></td>
							</tr>
							<tr>
							  <td>
								<a href="#" class="text-yellow hover-warning">
								  2c66087936b5
								</a>
								...
							  </td>
							  <td>14.01099978 BTC</td>
							  <td>
								<time class="timeago" datetime="2018-02-01T13:38:00Z" title="2018-02-01 13:38 GMT">2 minutes ago</time>
							  </td>
							  <td>high</td>
							  <td><span class="label label-danger">Canceled</span></td>
							</tr>
							<tr>
							  <td>
								<a href="#" class="text-yellow hover-warning">
								  51935e53c294
								</a>
								...
							  </td>
							  <td>0.3024534 BTC</td>
							  <td>
								<time class="timeago" datetime="2018-02-01T13:38:00Z" title="2018-02-01 13:38 GMT">2 minutes ago</time>
							  </td>
							  <td>high</td>
							  <td><span class="label label-warning">Unconfirmed</span></td>
							</tr>
							<tr>
							  <td>
								<a href="#" class="text-yellow hover-warning">
								  a3976b73cf5e
								</a>
								...
							  </td>
							  <td>0.20518486 BTC</td>
							  <td>
								<time class="timeago" datetime="2018-02-01T13:37:59Z" title="2018-02-01 13:37 GMT">2 minutes ago</time>
							  </td>
							  <td>medium</td>
							  <td><span class="label label-success">Confirmed</span></td>
							</tr>
							<tr>
							  <td>
								<a href="#" class="text-yellow hover-warning">
								  g011cb48c078
								</a>
								...
							  </td>
							  <td>2.08039395 BTC</td>
							  <td>
								<time class="timeago" datetime="2018-02-01T13:37:59Z" title="2018-02-01 13:37 GMT">2 minutes ago</time>
							  </td>
							  <td>high</td>
							  <td><span class="label label-success">Confirmed</span></td>
							</tr>
							<tr>
							  <td>
								<a href="#" class="text-yellow hover-warning">
								  c6b59368635c
								</a>
								...
							  </td>
							  <td>42.99698306 BTC</td>
							  <td>
								<time class="timeago" datetime="2018-02-01T13:37:58Z" title="2018-02-01 13:37 GMT">2 minutes ago</time>
							  </td>
							  <td>high</td>
							  <td><span class="label label-success">Confirmed</span></td>
							</tr>
							<tr>
							  <td>
								<a href="#" class="text-yellow hover-warning">
								  a261fc1d717d
								</a>
								...
							  </td>
							  <td>1.0281818 BTC</td>
							  <td>
								<time class="timeago" datetime="2018-02-01T13:37:58Z" title="2018-02-01 13:37 GMT">2 minutes ago</time>
							  </td>
							  <td>high</td>
							  <td><span class="label label-danger">Canceled</span></td>
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
<!-- ./wrapper -->


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
