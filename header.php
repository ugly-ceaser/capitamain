<!DOCTYPE html>
<html lang="en">

<head><meta charset="utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capitamain</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/logo.jpg">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Assets -->
    <link rel="stylesheet" href="assets/Font-awesome/css/all.min.css">
    <link rel="stylesheet" href="assets/aos/aos.css">
    <link rel="stylesheet" href="assets/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Main css file -->
    <link rel="stylesheet" href="css/main.css">

    <style>
        nav{
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            right: 0;
            background: transparent;
            transition: background 0.3s, backdrop-filter 0.3s;
            z-index: 1000;
       
        }

        nav.scrolled {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
        }

        

        .nav-link, .navbar-brand{
            color: #001f1e !important;
            font-weight:bolder;
        }

        .str {
    
            color:rgb(0,31,30) !important;
    }

    body{
        background-color: rgb(0,31,30) !important;

    }

    section.hero{
        background-image:url('./img/hero2.jpg') !important;
        background-size:cover;
        background-position:center;
        background-repeat:no-repeat;
        height: 90vh;
    }


    @media (max-width: 500px) {
        nav {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
        }

    
    }
    </style>
</head>

<body>



    <nav  class="navbar navbar-expand-lg navbar-light text-light fixed-top p-2"   >
        <a class="navbar-brand text-light" style="margin-right:100px;">
            
            Capitamain
        </a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link text-light" href="./index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="./index.php#about" tabindex="-1" aria-disabled="true">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="./index.php#contact" tabindex="-1" aria-disabled="true">Contact Us</a>
                </li>
              
                <li class="nav-item mx-5" style="position:absolute; right:0; ">
                    <a class="nav-link text-light" href="./login.php" tabindex="-1" aria-disabled="true">Login</a>
                </li>

                <li class=" nav-item mx-5" style="position:absolute; right: 70px;">
                    <a class=" nav-link text-light" href="./Register.php" tabindex="-1" aria-disabled="true">Register</a>
                </li>
          
            </ul>

            
            
        </div>
    </nav>