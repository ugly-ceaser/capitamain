<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../images/favicon.ico">

    <title>Crypto Admin - Dashboard  Read Mail </title>
  
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

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Read Mail
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Mailbox</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-lg-3 col-12">
		  <div class="box box-body h-p100">
			  <a href="compose.html" class="btn btn-success btn-block btn-shadow margin-bottom p-15">Compose</a>

        <div class="box no-shadow">
				<div class="box-body no-padding mailbox-nav">
				  <ul class="nav nav-pills flex-column">
					<li class="nav-item"><a class="nav-link " href="inbox.php"><i class="ion ion-ios-email-outline"></i> Inbox
					  <span class="label label-success pull-right">12</span></a></li>
					<li class="nav-item"><a class="nav-link active " href="sent.php"><i class="ion ion-paper-airplane"></i> Sent</a></li>
					
					<li class="nav-item"><a class="nav-link" href="starred.php"><i class="ion ion-star"></i>  Starred <span class="label label-warning pull-right">14</span></a>
					</li>
					<li class="nav-item"><a class="nav-link" href="trash.php"><i class="ion ion-trash-a"></i> Trash</a></li>
				  </ul>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /. box -->
			  
			
		  </div>
          <!-- /.box -->
        </div>        
        <!-- /.col -->
		<div class="col-lg-9 col-12">			
		  
			<div class="box box-solid bg-dark">
			  <div class="box-header no-border">
				<h3 class="box-title">Read Mail</h3>
				<div class="box-controls pull-right align-items-baseline">	
				  <div class="btn-group">
					<button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
					<button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
				  </div>					  			
			    </div>
			  </div>

			  <div class="box-body bg-dark">
				  <div class="mailbox-read-info py-0">
					<h3>Your message title goes here</h3>
				  </div>
				  <div class="mailbox-read-info clearfix">
					<div class="left-float margin-r-5"><a href="#"><img src="../../../images/1.jpg" alt="user" width="40" class="rounded-circle"></a></div>
					<h5 class="no-margin"> Brandon<br>
						 <small>From: Brandon@domain.com</small>
					  <span class="mailbox-read-time pull-right">22 JUL. 2018 08:03 PM</span></h5>
				  </div>
				  <!-- /.mailbox-read-info -->
				  <div class="mailbox-controls with-border clearfix">                
					<div class="left-float">
					  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
					  <i class="fa fa-print"></i></button>
					</div>
					<div class="right-float">
					<div class="btn-group">
					  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
						<i class="fa fa-trash-o"></i></button>
					  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
						<i class="fa fa-reply"></i></button>
					  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
						<i class="fa fa-share"></i></button>
					</div>
					</div>
					<!-- /.btn-group -->

				  </div>
				  <!-- /.mailbox-controls -->
				  <div class="mailbox-read-message">
					<p>Dear USer,</p>

					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>

					<p>enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar.</p>

					<p>Thanks,<br>Jane</p>
				  </div>
				  <!-- /.mailbox-read-message -->
				  <div class="p-15 bt-1">
				  	
					<h5><i class="fa fa-paperclip m-r-10 m-b-10"></i> Attachments <span>(3)</span></h5>
					  <ul class="mailbox-attachments clearfix">
						<li>
						  <div class="mailbox-attachment-info">
							<a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Mag.pdf</a>
								<span class="mailbox-attachment-size">
								  5,215 KB
								  <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
								</span>
						  </div>
						</li>
						<li>
						  <div class="mailbox-attachment-info">
							<a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Documents.docx</a>
								<span class="mailbox-attachment-size">
								  2,145 KB
								  <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
								</span>
						  </div>
						</li>
						<li>
						  <div class="mailbox-attachment-info">
							<a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> Image.png</a>
								<span class="mailbox-attachment-size">
								  2.67 MB
								  <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
								</span>
						  </div>
						</li>
					  </ul>
				  </div>
			  </div>	
				<div class="box-footer bg-dark">
				  <div class="pull-right">
					<button type="button" class="btn btn-success"><i class="fa fa-reply"></i> Reply</button>
					<button type="button" class="btn btn-info"><i class="fa fa-share"></i> Forward</button>
				  </div>
				  <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
				  <button type="button" class="btn btn-warning"><i class="fa fa-print"></i> Print</button>
				</div>
				<!-- /.box-footer -->
				
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
   
   
  
  <!-- Control Sidebar -->
 
  
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
	
	<!-- Crypto_Admin App -->
	<script src="../../js/template.js"></script>
	
	<!-- Crypto_Admin for demo purposes -->
	<script src="../../js/demo.js"></script>


</body>
</html>
