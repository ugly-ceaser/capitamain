<?php
session_start();

include("./handler/conn.php");
include("../userPage/scripts/funct.php");



include("./utils/index.php");

if(!isset($_SESSION["Admin"])) header("Location: ./index.php");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Admin Dashboard</title>
    
    <style>
        .alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    font-size: 16px;
}

.alert-info {
    background-color: #d9edf7;
    color: #31708f;
    border: 1px solid #bce8f1;
}

.alert-success {
    background-color: #dff0d8;
    color: #3c763d;
    border: 1px solid #d6e9c6;
}

.alert-danger {
    background-color: #f2dede;
    color: #a94442;
    border: 1px solid #ebccd1;
}

    </style>
</head>

<body>
    <section class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="#" data-toggle="modal" data-target="#AdminDetails">Admin
                        Details</a>
                    <a class="nav-item nav-link" href="#" data-toggle="modal" data-target="#AdminAccount">Admin
                        Account</a>

                        <a class="nav-item nav-link" href="./logout.php">Log out</a>

                </div>
            </div>
        </nav>

        <div class="container-fluid">
             <!-- Display feedback messages -->
        <?php
        if (isset($_GET['msg'])) {
            echo '<div class="alert alert-info">' . htmlspecialchars($_GET['msg']) . '</div>';
        }
        if (isset($_GET['suc'])) {
            echo '<div class="alert alert-success">' . htmlspecialchars($_GET['suc']) . '</div>';
        }
        if (isset($_GET['err'])) {
            echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['err']) . '</div>';
        }
        ?>
        
            <div class="row">
                <div class="col-12">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" style="height:18vh; background-color:rgb(64, 64, 192);">
                                <div style="height:100%; width:100%;"
                                    class="d-flex justify-content-center align-items-center">
                                    <h4>Registered Users <span class="badge badge-secondary">
                                            <?=  count(getUsers($conn)); ?>
                                        </span></h4>
                                </div>
                            </div>
                            <div class="carousel-item" style="height:18vh; background-color:rgb(40, 212, 24);">
                                <div style="height:100%; width:100%;"
                                    class="d-flex justify-content-center align-items-center">
                                    <h6>Approved Deposits <span class="badge badge-success">
                                            <?= "$" .calculateTotalAmount($conn,"deposit", "approved"); ?>
                                        </span></h6>
                                </div>
                            </div>

                            <div class="carousel-item" style="height:18vh; background-color:rgb(246, 9, 9);">
                                <div style="height:100%; width:100%;"
                                    class="d-flex justify-content-center align-items-center">
                                    <h6>Pending Deposits <span class="badge badge-secondary">
                                            <?= "$" .calculateTotalAmount($conn, "deposit", "pending"); ?>
                                        </span></h6>
                                </div>
                            </div>
                            <div class="carousel-item" style="height:18vh;background-color:rgb(135, 200, 50);">
                                <div style="height:100%; width:100%;"
                                    class="d-flex justify-content-center align-items-center">
                                    <h6>Approved Withdrawals <span class="badge badge-success">
                                            <?= "$" . calculateTotalAmount($conn,"withdraw", "approved"); ?>
                                        </span></h6>
                                </div>
                            </div>

                            <div class="carousel-item" style="height:18vh;background-color:rgb(250, 7, 7);">
                                <div style="height:100%; width:100%;"
                                    class="d-flex justify-content-center align-items-center">
                                    <h6>Pending Withdrawals <span class="badge badge-secondary">
                                            <?= "$". calculateTotalAmount($conn,"withdraw", "pending"); ?>
                                        </span></h6>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div>
				<!-- Approved transactions -->

                <div class="col-12 mt-3">
                    <div class="alert alert-primary d-flex justify-content-center align-items-center role=" alert">
                        Settled Transactions
                    </div>
                    <div class="row">
                        <div style="max-height:50vh; overflow:scroll;" class="col-md-12 col-lg-6 col-sm-12">
                            <div class="alert alert-primary d-flex justify-content-center align-items-center  col-md-12 col-lg-12 col-sm-12"
                                role="alert">
                                Deposits
                            </div>

                            <table class="table table-hover ">
                                <thead>
                                    <tr>

                                        <th scope="col">FullName</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                							$query = "SELECT * FROM `transactions` WHERE trxType = 'deposit' AND trxStatus = 'approved'";
                							$result = $conn->prepare($query);
                							$result->execute();
                
                							if($result->rowCount()) {
                								foreach($result->fetchAll() as $txr):
                									?>
                                    <tr>

                                        <th scope="row">
                                            <?=  $txr['name'] ?>
                                        </th>
                                        <td>
                                            <?=  $txr['Amount'] ?>
                                            
                                        </td>
                                        
                                        <td>
                                            <?=  $txr['trxStatus'] ?>
                                        </td>
                                        <td>
                                            <?= date("D, m Y",strtotime(  $txr['trxDate'] ))?>
                                        </td>
                                    </tr>
                                    <?php
                								endforeach;
                							}
                
                							else {
                								?>

                                    <tr>
                                        <td style="text-align: center; font-size: 1.5rem; color: #777;" colspan="5">No
                                            Transactions Found</td>
                                    </tr>

                                    <?php
                							}
                
                						?>


                                </tbody>
                            </table>
                        </div>
						<div style="max-height:50vh; overflow:scroll;" class="col-md-12 col-lg-6 col-sm-12">
                            <div class="alert alert-primary d-flex justify-content-center align-items-center  col-md-12 col-lg-12 col-sm-12"
                                role="alert">
                                Withdrawals
                            </div>

                            <table class="table table-hover ">
                                <thead>
                                    <tr>

                                        <th scope="col">FullName</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                								$query = "SELECT * FROM `transactions` WHERE trxType = 'withdraw' AND trxStatus = 'approved'";
                							$result = $conn->prepare($query);
                							$result->execute();
                
                							if($result->rowCount()) {
                								foreach($result->fetchAll() as $txr):
                									?>
                                    <tr>

                                         <th scope="row">
                                            <?=  $txr['name'] ?>
                                        </th>
                                        <td>
                                            <?=  $txr['Amount'] ?>
                                            
                                        </td>
                                        
                                        <td>
                                            <?=  $txr['trxStatus'] ?>
                                        </td>
                                        <td>
                                            <?= date("D, m Y",strtotime(  $txr['trxDate'] ))?>
                                        </td>
                                    </tr>
                                    <?php
                								endforeach;
                							}
                
                							else {
                								?>

                                    <tr>
                                        <td style="text-align: center; font-size: 1.5rem; color: #777;" colspan="5">No
                                            Transactions Found</td>
                                    </tr>

                                    <?php
                							}
                
                						?>


                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

				<!-- Pending Transactions -->

				<div class="col-12 mt-3">
                    <div class="alert alert-danger d-flex justify-content-center align-items-center role=" alert">
                       Pending Transactions
                    </div>
                    <div class="row">
                        <div style="max-height:50vh; overflow:scroll;" class="col-md-12 col-lg-6 col-sm-12">
                            <div class="alert alert-primary d-flex justify-content-center align-items-center  col-md-12 col-lg-12 col-sm-12"
                                role="alert">
                                Depsits
                            </div>

                            <table style="max-width:100vh; overflow:hidden;" class="table table-hover ">
                                <thead>
                                    <tr>

                                        <th scope="col">FullName</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Date</th>
										<th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                							$query = "SELECT * FROM `transactions` WHERE trxType = 'deposit' AND trxStatus = 'pending'";
                							$result = $conn->prepare($query);
                							$result->execute();
                
                							if($result->rowCount()) {
                								foreach($result->fetchAll() as $txr):
                									?>
                                    <tr>

                                         <th scope="row">
                                            <?=  $txr['name'] ?>
                                        </th>
                                        <td>
                                            <?=  $txr['Amount'] ?>
                                            
                                        </td>
                                        
                                        <td>
                                            <?=  $txr['trxStatus'] ?>
                                        </td>
                                        <td>
                                            <?= date("D, m Y",strtotime(  $txr['trxDate'] ))?>
                                        </td>
										<td class="d-flex justify-content-around align-items-center">
                                            <form action="./utils/index.php" method="post">

                                                <input type="text" name="user" value="<?=  $txr['email'] ?>"
                                                    hidden>

                                                <input type="text" name="transact_id" value="<?=  $txr['transaction_id'] ?>" hidden>

                                                <input type="submit" name="DepositApproved" value="Approve"
                                                    class="bg-success btn-light">

                                            </form>
                                            <form action="./utils/index.php" method="post">

                                                <input type="text" name="user" value="<?=  $txr['email'] ?>"
                                                    hidden>

                                                <input type="text" name="transact_id" value="<?=  $txr['transaction_id'] ?>" hidden>

                                                <input type="submit" name="DepositDeclined" value="Decline"
                                                    class="bg-danger btn-light">

                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                								endforeach;
                							}
                
                							else {
                								?>

                                    <tr>
                                        <td style="text-align: center; font-size: 1.5rem; color: #777;" colspan="5">No
                                            Transactions Found</td>
                                    </tr>

                                    <?php
                							}
                
                						?>


                                </tbody>
                            </table>
                        </div>
						<div style="max-height:50vh; overflow:scroll;" class="col-md-12 col-lg-6 col-sm-12">
                            <div class="alert alert-primary d-flex justify-content-center align-items-center  col-md-12 col-lg-12 col-sm-12"
                                role="alert">
                                Withdrawals
                            </div>

                            <table style="max-width:100vh; overflow:hidden;" class="table table-hover ">
                                <thead>
                                    <tr>

                                        <th scope="col">FullName</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Date</th>
										<th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                							$query = "SELECT * FROM `transactions` WHERE trxType = 'withdraw' AND trxStatus = 'pending'";
                							$result = $conn->prepare($query);
                							$result->execute();
                
                							if($result->rowCount()) {
                								foreach($result->fetchAll() as $txr):
                									?>
                                    <tr>

                                        <th scope="row">
                                            <?=  $txr['name'] ?>
                                        </th>
                                        <td>
                                            <?=  $txr['Amount'] ?>
                                        </td>
                                        <td>
                                            <?= date("D, m Y",strtotime(   $txr['trxDate'] ))?>
                                        </td>
										<td class="d-flex justify-content-around align-items-center">
                                            <form action="./utils/index.php" method="post">

                                                <input type="text" name="user" value="<?=  $txr['email'] ?>"
                                                    hidden>

                                                <input type="text" name="transact_id" value="<?=  $txr['transaction_id'] ?>" hidden>

                                                <input type="submit" name="WithdrawalApproved" value="Approve"
                                                    class="bg-success btn-light">

                                            </form>
                                            <form action="./utils/index.php" method="post">

                                                <input type="text" name="user" value="<?=  $txr['email'] ?>"
                                                    hidden>

                                                <input type="text" name="transact_id" value="<?=  $txr['transaction_id'] ?>" hidden>

                                                <input type="submit" name="WithdrawalDeclined" value=" Decline"
                                                    class="bg-danger btn-light">

                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                								endforeach;
                							}
                
                							else {
                								?>

                                    <tr>
                                        <td style="text-align: center; font-size: 1.5rem; color: #777;" colspan="5">No
                                            Transactions Found</td>
                                    </tr>

                                    <?php
                							}
                
                						?>


                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>




            </div>
        </div>
        

<div class="container-fluid row">
            <div class="col-sm-12 col-md-12 col-lg-12 alert alert-primary d-flex justify-content-center align-items-center role=" alert">
                Users
            </div>
            <table style="max-height:50vh; overflow:scroll" class="table table-hover col-sm-12 col-md-8 col-lg-12 ">
                    <thead>
                        <tr>
                            <th scope="col">FullName</th>
                            <th>package</th>
                            <th scope="col">invested Amount</th>
                            <th scope="col">Profit</th>
                            <th>bonus</th>
                            <th scope="col">Balance</th>                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count(getUsers($conn))): ?>
                        <?php foreach(getUsers($conn) as $user): ?>
                        <tr>
                            <th scope="row">
                                <?= $user["fname"]  ?>
                            </th>
                            <td>
                                <?= $user["package"]; ?>
                            </td>                        
                            <td>
                                <?= $user["investedAmount"]; ?>
                            </td>
                            <td>
                                <?= $user["profit"]; ?>
                            </td>
                            <td>
                                <?= $user["bonus"]; ?>
                            </td>
                            <td>
                                <?= $user["balance"]; ?>
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


    </section>

<div class="alert alert-primary d-flex justify-content-center align-items-center  col-md-12 col-lg-12 col-sm-12"role="alert">       
    <h1>Admin Roles </h1>
</div>

<div  class="container mb-5 mt-3">
    <div class="row">
        <!-- add deposit -->
        <div class="col-sm-12 col-md-6 d-flex justify-center p-5 m-2 col-lg-5 bg-success" style="flex-flow:column nowrap">
            <h1 class="text-light">add user deposit</h1>
            <form action="./handler/user_handler.php" method="post">
                <div class="form-group">
                <label class="form-label" for="cars">Select user:</label>
            <select class="form-control" id="cars"  name="userId" >
                <option value="">Select User</option>
                <?php if(count(getUsers($conn))): ?>
                <?php foreach(getUsers($conn) as $user): ?>
            <option value="<?= $user["email"]; ?>" ><?= $user["fname"]  ?></option>
            <?php endforeach; ?>
                <?php endif; ?>
            </select>

                </div>
        
            
            <div class="form-group">
            <label class="form-label" for="fname">Amount:</label><br>
            <input class="form-control" type="text" id="fname" name="amount">

            </div>
            
            
            
            
        
            <button class=" btn btn-sm bg-primary text-light"  name="depositUser" >Deposit</button>
            
            
            </form> 
        </div>
            <!-- add profit -->
        <div class="col-sm-12 col-md-6 d-flex justify-center p-5 m-2 col-lg-5 bg-primary" style="flex-flow:column nowrap">
            <h1>add user profit</h1>
                <form action="./handler/user_handler.php" method="post" style="width:100%">
                
                <div class="form-group">
                <label class="form-label "for="cars">Select user:</label>
                <select class="form-control" id="cars"  name="userId" >
                    <option value="">Select User</option>
                    <?php if(count(getUsers($conn))): ?>
                    <?php foreach(getUsers($conn) as $user): ?>
                <option value="<?= $user["email"]; ?>" ><?= $user["fname"]  ?></option>
                <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                </div>
                
            
            
                <div class="form-group">
                <label class="form-label" for="fname">Amount:</label>
                <input class="form-control" type="text" id="fname" name="amount">

                </div>
                
                
                
                
            
                <button class="btn btn-sm text-light bg-success"  name="add_profit" >Add profit</button>
                
                
                </form>
        </div>


    
           <!-- minus profit  -->
        <div class="col-sm-12 col-md-6 d-flex justify-center p-5 m-2 col-lg-5 bg-secondary" style="flex-flow:column nowrap">
                <h1 class="text-danger">minu user profit</h1>
                <form action="./handler/user_handler.php" method="post">
                    <div class="form-group">
                    <label class="form-label" for="cars">Select user:</label>
                <select class="form-control" id="cars"  name="userId" >
                    <option value="">Select User</option>
                    <?php if(count(getUsers($conn))): ?>
                    <?php foreach(getUsers($conn) as $user): ?>
                <option value="<?= $user["email"]; ?>" ><?= $user["fname"]  ?></option>
                <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                    </div>
            
                
                <div class="form-group">
                <label class="form-label" for="fname">Amount:</label><br>
                <input class="form-control" type="text" id="fname" name="amount">

                </div>
                
                
                
                
            
                <button class=" btn btn-sm bg-danger text-light"  name="minus_profit" >Minus profit</button>
                
                
                </form> 
        </div>
            
            
         <!-- update package    -->
        <div class="col-sm-12 col-md-6 d-flex justify-center p-5 m-2 col-lg-5 bg-light" style="flex-flow:column nowrap">
                <h1 class="text-danger">update user package</h1>
                <form action="./handler/user_handler.php" method="post">
                    <div class="form-group">
                    <label class="form-label" for="cars">Select user:</label>
                <select class="form-control" id="cars"  name="userId" >
                    <option value="">Select User</option>
                    <?php if(count(getUsers($conn))): ?>
                    <?php foreach(getUsers($conn) as $user): ?>
                <option value="<?= $user["email"]; ?>" ><?= $user["fname"]  ?></option>
                <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                    </div>
            
                
                <div class="form-group">
                <label class="form-label" for="fname">Package: </label><br>
              <select class="form-control" id="cars"  name="package" >
                    <option value="">Select package</option>
                      <option value="basic">Basic</option>
                        <option value="standard">Standard</option>
                          <option value="pro">Pro</option>
                            <option value="advance">Advance</option>
                              
                    
                
                </select>

                </div>
                
                
                
                
            
                <button class=" btn btn-sm bg-danger text-light"  name="updatePackage" >change package</button>
                
                
                </form> 
        </div>  
            
      




        <div class="modal fade" id="AdminDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Admin Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-inline" action="./utils/index.php" method="post">
                        <div class="form-group mb-2">
                            <label for="staticEmail2" class="sr-only">Username</label>
                            <input type="text" name="username" class="form-control" id="staticEmail2"
                                value="email@example.com">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only">Password</label>
                            <input type="password" name="password" class="form-control" id="inputPassword2"
                                placeholder="Password">
                        </div>
                        <button type="submit" name="detailUpdate" class="btn btn-primary mb-2">Update </button>
                    </form>
                </div>

            </div>
        </div>


        <div class="modal fade" id="AdminAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Admin Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body col-12">
                        <form action="./utils/index.php" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="WALLET NAME"
                                        name="walletName">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" placeholder="wallet Address"
                                        name="walletAddress">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Barcode</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="inputPassword3" placeholder="Wallet Barcode"
                                        name="barcode">
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Coin</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="coin" id="gridRadios1"
                                                value="usdt">
                                            <label class="form-check-label" for="gridRadios1">
                                                Usdt Address
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="coin" id="gridRadios2"
                                                value="eth">
                                            <label class="form-check-label" for="gridRadios2">
                                                Etherum Address
                                            </label>
                                        </div>
                                        <div class="form-check disabled">
                                            <input class="form-check-input" type="radio" name="coin" id="gridRadios3"
                                                value="btc">
                                            <label class="form-check-label" for="gridRadios3">
                                                Btc Address
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" name="accountUpdate" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</div>    


<section class="container-fluid">

<div class="container-fluid row">
            <div class="col-sm-12 col-md-12 col-lg-12 alert alert-primary d-flex justify-content-center align-items-center role=" alert">
                Users
            </div>
            <table style="max-height:50vh; overflow:scroll" class="table table-hover col-sm-12 col-md-8 col-lg-12 ">
                    <thead>
                        <tr>
                            <th scope="col">FullName</th>
                            <th>username</th>
                            <th scope="col">password</th>
                                                     
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count(getUsers($conn))): ?>
                        <?php foreach(getUsers($conn) as $user): ?>
                        <tr>
                            <th scope="row">
                                <?= $user["fname"]  ?>
                            </th>
                            <td>
                                <?= $user["username"]; ?>
                            </td>                        
                            <td>
                          <?= $user["password"]; ?>
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






</section>







    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>