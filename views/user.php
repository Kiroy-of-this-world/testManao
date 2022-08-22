<?php
session_start();
?>

<!doctype html>
<html lang=ru>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#319197">

    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../css/auth_reg.css">
    <title>Test Task Manao</title>
</head>
<body>
<div class="wrapper">
    <header>
        <h2>Test Task Manao</h2>
    </header>
    <main class="main">
        <h4>Привет, <?= $_SESSION['logged_in_user_name']; ?>    </h4>
        <form class="form" id="exit-btn">
            <input type="submit" value="Выйти">
        </form>
    </main>
    <footer>
        <p>© Юркевич Кирилл 2022</p>
    </footer>
</div>
<script src="../scripts/user.js"></script>
</body>
</html>
