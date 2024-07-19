


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../images/favicon.ico">

    <title>Auto Trade - Members Profile</title>
  
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
        Compose
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Compose</li>

		



      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-lg-3 col-12">
		  <div class="box box-body h-p100">
			  <a href="../../index.php" class="btn btn-success btn-block btn-shadow margin-bottom p-15">Back</a>

			  
			  <!-- /. box -->
			 
			
		  </div>
          <!-- /.box -->
        </div> 
        <!-- /.col -->
        <div class="col-lg-9 col-12">			
		  
			<div class="box box-solid bg-dark">
			  <div class="box-header no-border">
				<h3 class="box-title">Compose New Message</h3>
			  </div>
				<form action="../../../utils/index.php" method="post">
						<div class="box-body bg-dark">
							<div class="form-group">
								<input class="form-control" name="senderId" value="admin"  hidden>
							</div>

							<div class="box-body bg-dark">
							<div class="form-group">
								<input class="form-control" name="messageStatus" value="sent"  hidden>
							</div>

							<div class="form-group">
							<select name="recieverId" id="select" class="form-control ps-15 bg-transparent" required>
												<option  value="">Select Reciever</option>	
												<?php
															$query = "SELECT * FROM `verifiedUser`";
															$result = $conn->prepare($query);
															$result->execute();

															if($result->rowCount()) {
																foreach($result->fetchAll() as $username):
																	?>
																	<option value = "<?= $username['id'] ?> "><?= $username['username'] ?> </option>
																			
																		
																
																	<?php
																endforeach;
															}

															else {
																?>

																
																		<option style="text-align: center; font-size: 1.5rem; color: #777;" colspan="5">No user Found</option>
																	

																<?php
															}

														?>
																			
									</select>

							</div>
							<div class="form-group">
								<input class="form-control" name="subject"  placeholder="Subject:">
							</div>
							<div class="form-group">
									<textarea id="compose-textarea" class="form-control h-300" name="message" placeholder="type your message">
									
									</textarea>
							</div>
							
						</div>			  
							<div class="box-footer bg-dark">
							<div class="pull-right">
								
								<button type="submit" class="btn btn-success" name="sendMessage"><i class="fa fa-envelope-o"></i> Send</button>
							</div>
											
							</div>
				</form>
			</div> 
			
          <!-- /. box -->
        </div>        
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
	
	<!-- Crypto_Admin App -->
	<script src="../../js/template.js"></script>
	
	<!-- Crypto_Admin for demo purposes -->
	<script src="../../js/demo.js"></script>
	

</body>
</html>
