<?php
session_start();
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" integrity="sha384-REHJTs1r2ErKBuJB0fCK99gCYsVjwxHrSU0N7I1zl9vZbggVJXRMsv/sLlOAGb4M" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/stylesheet.css">
    <!-- Custom js -->
    
    <script src="./js/barbershop.js?newversin"></script>
    <!-- Foogle Font -->
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



    <script>
        $(document).ready(function() {
            $("#myModal").modal('show');
            
        });
        
        
    </script>

    <?php

    if (isset($_SESSION['id'])) {
        echo '';
    } else {
        echo '<style>
            .product-button{
                visibility: hidden;
            }
            </style>';
    }

    ?>
    <title>BR BarberShop</title>
</head>

<body>
    <nav id="mainNavbar" class="navbar navbar-dark navbar-expand-md py-0 fixed-top">
        <a class="navbar-brand">BR BarberShop</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#links">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end " id="links">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="staff.php" class="nav-link">Staff</a>
                </li>
                <li class="nav-item">
                    <a href="products.php" class="nav-link">Products</a>
                </li>
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['id'])) {
                        echo '<a href="booking.php" class="nav-link">Booking</a>';
                    } else {
                        echo '';
                    }
                    ?>

                </li>

                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['id'])) {
                        echo '';
                    } else {
                        echo '<a href="login.php" class="nav-link">Login</a>';
                    }
                    ?>

                </li>
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['id'])) {
                        echo '';
                    } else {
                        echo '<a href="signUp.php" class="nav-link">Sign Up</a>';
                    }
                    ?>

                </li>
                
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['id'])) {
                        echo '<form action="logout.php" method="POST">
                        <button type="submit" name="logout-submit">Logout</button>
                    </form>';
                    } else {
                        echo '';
                    }
                    ?>

                </li>
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['id'])) {
                        echo '<div class="cart-btn">
                        <span>
                            <i id="btn-cart" class="fas fa-shopping-cart"></i>
            
                        </span>
                        <div class="cart-items">0</div>
                    </div>';
                    } else {
                        echo '';
                    }
                    ?>

                </li>

            </ul>



    </nav>