<?php  
    session_start();
    //if(isset($_SESSION["Admin"])) header("location: ./dashboard.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="./css/bootstrap-extend.css">
        <style>
            .container {
                width: 80%;
                margin: 0 auto;
            }

            @media (max-width: 767px) {
                .container {
                    width: 80%;
                    margin: 0 auto;
                }
            }

            .form-group {
                margin: 1.5rem 0;
            }

            .form-control {
                padding: 1rem;
                display: block;
                border: 1px solid #ccc;
                width: 100%;
            }

            form {
                max-width: 400px;
                margin: 0 auto;
            }

            label {
                display: block;
                margin-bottom: .5rem;
                font-size: .85rem;
                text-transform: uppercase;
                font-weight: 500;
                font-family: Arial, Helvetica, sans-serif;
            }

            .btn {
                display: block;
                width: 100%;
                padding: .8rem 1rem;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="w-75">
                <form action="./handler/auth_handler.php" method="post">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" placeholder="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" name="password" placeholder="" class="form-control">
                    </div>
                    <div class="form-group">
                    <input type="submit"  name="login" class="btn btn-info w-p100 mt-15" value ="SIGN IN">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>