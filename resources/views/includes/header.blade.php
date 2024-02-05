<?php
    $title_page = 'LAKBAY Reservation System';
?>


<!DOCTYPE html>
<html lang="en" class="h-100"><head>
    <title><?php echo $title_page; ?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">
    <link rel="icon" type="image/png" href="images/logo-nolabel.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Khand:wght@300;400;500;600;700&display=swap');
        body{
            font-family: 'Khand', sans-serif!important;     
        }
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .overlay{
            overflow: hidden;
            position: absolute;
            right: 1rem;
            top: 3rem;
            width: 40px;
        }

        .overlay-text{
            width: 100%;
            position: absolute;
            bottom: 1rem;
        }

        .stat-label{
            font-size: 0.6rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .carousel > .carousel-inner > .carousel-item > img{
            overflow: hidden;
            object-fit: cover;
            object-position: top center;
            border-radius: 0.25rem;
            opacity: 0.2;
            filter: alpha(opacity=40);
            height: 400px;
        }
        .carousel > .carousel-inner > .carousel-item > img:hover{
            opacity: 0.4;
        }

        .small-text{
            font-size: 0.8rem;
            text-transform: uppercase;
            font-weight: 600;
            color: grey;
        }
    </style>
    <link href="css/main.css" rel="stylesheet">
</head>
<body class="d-flex">
    
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <?php if(empty($_SESSION['loggedIn'])): ?>
        <header class="mb-auto">
            <div>
                <!-- <h3 class="float-md-start mb-0">LAKBAY</h3> -->
                <a class="navbar-brand float-md-start mb-0 flex-row d-flex" href="{{url('/index')}}">
                    <img src="images/logo.png" alt="" width="150" height="50" class="d-inline-block align-text-top">
                </a>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link" aria-current="page" href="{{url('/dashboard')}}">Dashboard</a>

                    <a class="nav-link" href="{{url('/reservations')}}">Reservations</a>
                    <a class="nav-link" href="{{url('/events')}}">Events</a>
                    <a class="nav-link" href="{{url('/vehicles')}}">Vehicles</a>
                    <a class="nav-link" href="{{url('/drivers')}}">Drivers</a>

                    <a class="nav-link" href="{{url('/requestors')}}">Requestors</a>
                    <a class="nav-link" href="logout.php">Logout</a>
                </nav>
            </div>
        </header>
        <?php else: ?>
            <header class="mb-auto">
            <div>
                <!-- <h3 class="float-md-start mb-0">LAKBAY</h3> -->
                <a class="navbar-brand float-md-start mb-0 flex-row d-flex" href="{{url('/index')}}">
                    <img src="images/logo.png" alt="" width="150" height="50" class="d-inline-block align-text-top">
                </a>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link" href="login.php">Login</a>
                </nav>

            </div>
        </header>
        <?php endif; ?>
    <main class="container mt-4">