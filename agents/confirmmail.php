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
    <meta name="twitter:image" content="./img/1.png" />
    <link rel="shortcut" href="./img/1.png" />
    <link rel="apple-touch-icon" href="./img/1.png" />
    <link rel="stylesheet" href="./style/fontAwesome/css/fontawesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="shortcut icon" href="./img/image.jpg" type="image/x-icon">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"
        defer></script>
    <script src="./js/app.js" defer></script>
    <title>My Portfolio</title>
    <style>
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
    include_once(__DIR__ . '/../GlobalEnv.php');
    include_once(__DIR__ . '/../SQLEnv.php');
    $tools = new GlobalEnv();
    $sql = new SQLEnv();
    $usrId = $tools->decode($_GET['usr']);
    //$usrId = $tools->code($usrId);

    ?>

    <div class="container-fluid d-flex flex-column justify-content-center" style="min-height: 100vh;">

        <main class="d-flex flex-column justify-content-center align-items-center flex-grow-1">
            <?php
            $query = "UPDATE users SET verified = 1, activated = 1 WHERE (id = ?) AND (verified IS NULL AND activated IS NULL)";
            $values = [$usrId];

            if ($sql::SQL_ENV == 'sqlite') {
                $pdo = $sql->sqlitePDO_Connect();
            } elseif ($sql::SQL_ENV == 'mysql') {
                $pdo = $sql->mysqlPDO_Connect();
            }

            $stmt = $pdo->prepare($query);
            $stmt->execute($values);
            if ($stmt) {
                echo "<h4>Now your Registeration is Activated</h4>";
                echo "<h5><a style='text-decoration:none;' href='http://" . $_SERVER['SERVER_NAME'] . "/login'>Go to login page</a></h5>";
            }
            ?>
        </main>

    </div>
</body>

</html>