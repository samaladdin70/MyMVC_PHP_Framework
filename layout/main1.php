<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="My Portfolio">
    <meta name="keywords" content="My Portfolio">
    <meta name="autor" content="Aladdin programmer and developer علاء الدين مبرمج ومطور">
    <meta property="og:title" content="My Portfolio" />
    <meta property="og:description" content=" My Portfolio" />
    <meta property="og:image" content="./img/1.png" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary-large-image" />
    <meta name="twitter:title" content="My Portfolio" />
    <meta name="twitter:description" content="My Portfolio" />
    <meta name="twitter:image" content="http://localhost/img/1.png" />
    <link rel="shortcut" href="http://localhost/img/1.png" />
    <link rel="apple-touch-icon" href="http://localhost/img/1.png" />
    <link rel="stylesheet" href="http://localhost/style/fontAwesome/css/fontawesome.min.css">
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
    <link rel="stylesheet" href="http://localhost/style/new-google-icons/icons.css">
    <link rel="shortcut icon" href="http://localhost/img/image.jpg" type="image/x-icon">
    <!-- CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="http://localhost/style/bootstrap5/css/bootstrap.min.css">
    <!-- JavaScript Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"
        defer></script> -->
    <!-- <script src="./style/bootstrap5/js/popper.min.js" defer></script> -->
    <script src="http://localhost/style/bootstrap5/js/bootstrap.bundle.min.js" defer></script>
    <script src="./js/app.js" defer></script>
    <title>My Portfolio</title>
    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .scroll-style-page::-webkit-scrollbar {
        width: 20px;
    }

    .scroll-style-page::-webkit-scrollbar-track {
        background: rgba(46, 139, 86, 0.5);
    }

    .scroll-style-page::-webkit-scrollbar-thumb {
        background: black;
    }

    .form-control::placeholder {
        font-size: .85rem;
        opacity: .6;
    }
    </style>
</head>

<body class="scroll-style-page">
    <?php

    use Router\Router;

    $path = Router::getRouteStatic();
    ?>
    <div class="container-fluid d-flex flex-column" style="min-height: 100vh; width:100%;">
        <nav class="navbar w-100 navbar-dark navbar-expand-lg bg-dark  shadow-sm sticky-top">
            <div class="container-fluid">
                <span class="navbar-brand bg-dark text-warning pr-2 rounded p-2"><img oncontextmenu="return false;"
                        src="http://localhost/img/image.jpg" style="width:40px; height:40px; border-radius:50%;">
                    My Portfolio
                </span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link <?php if ($path == '/') echo 'active'; ?>" aria-current="page"
                            href="/">Home</a>
                        <a class="nav-link <?php if ($path == '/about') echo 'active'; ?>" href="/about">About</a>
                        <a class="nav-link <?php if ($path == '/contact') echo 'active'; ?>" href="/contact">Contact</a>
                    </div>
                    <div class="navbar-nav">
                        <a class="nav-link <?php if ($path == '/login') echo 'active'; ?>" aria-current="page"
                            href="/login">Login</a>
                        <a class="nav-link <?php if ($path == '/register') echo 'active'; ?>"
                            href="/register">Register</a>

                    </div>
                </div>
            </div>
        </nav>
        (())

    </div>
    <div title="Great Egypt. تحيا مصر" id=" Great-Egypt" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-custom-class="custom-tooltip" data-bs-title="Great Egypt. تحيا مصر"
        style=" left: -80px; bottom: -60px; transform: rotate(45deg); width: 300px; height: 99px; position: fixed; z-index: 999; box-shadow: 0px 0px 8px 2px black;">
        <div style="height: 33px; width:100%; background-color: red;"></div>
        <div style="height: 33px; width:100%; background-color: white;"></div>
        <div style="height: 33px; width:100%; background-color: black;"></div>
    </div>

</body>

</html>