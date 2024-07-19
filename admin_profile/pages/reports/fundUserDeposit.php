<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../images/favicon.ico">

    <title>One Bit Farm - Admin Page </title>
  
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
<?php include '../header2.php';
?>	






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
			  <h3 class="box-title">Fund User</h3>

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
					<table class="table table-bordered no-margin" style="min-width: 300px;">
					  <thead>
						<tr>
						  <th>Name</th>
						  
						  <th>user Id</th>
						  
						  
						</tr>
					  </thead>
					  <tbody>
							  <?php if(count(getUsers($conn))): ?>
								<?php foreach(getUsers($conn) as $user): ?>
									<tr>
										<td>
											<a href="#" class="text-yellow text-capitalize hover-warning">
												<?= $user["fname"] . " " . $user["lname"]; ?>
											</a>
										</td>
									
									
										
											<td>
											<?= $user["id"]; ?>
										</td>
										
										
										
									
									
										
										
											
										</td>
										
										
										
										
										
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="5">
										<div class="d-flex h-25 align-items-center justify-content-center">
											No user found
										</div>
									</td>
								</tr>
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
			  <h3 class="box-title">fund User</h3>

			 
			</div>
			<div class="box-body">
			<form action="https://profitsprotrader.com/profiles/admin_profile/handler/user_handler.php" method="post">
										  
		  
											  <div class="input-group mb-15">
												  <span class="input-group-text bg-transparent"><i class="ti-wallet"></i></span>
												  <input type="text" name="amount" class="form-control ps-15 bg-transparent" placeholder="Amount" required>
		  
											  </div>
		  
											  
		  
											  
		  
											  <div class="input-group mb-15">
												  <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
												  <input type="text" name="user" class="form-control ps-15 bg-transparent" placeholder="user id" required>
		  
											  </div>
											  
											 

											

											
											  
											  <div class="col-12 text-center">
												<input type="submit" class="btn btn-info w-p100 mt-15" name="deposit" value="UPLOAD">
											  </div>
									</form>
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
