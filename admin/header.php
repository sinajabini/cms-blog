<?php include '../init.php';
if (isset($_GET['logout']))
    loggedOut();
?>
<!doctype html>
<html lang="fa-IR" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>پنل مدیریت</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.rtl.min.css" rel="stylesheet" >
    <link href="../css/dashboard.rtl.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <meta name="theme-color" content="#7952b3">
<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="./index.php" align="center">منو</a>

    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" aria-expanded="false"><?= selectSingleUser($_SESSION['user']['id'])->name ?></a>
            <ul class="dropdown-menu">
                <a style="width: auto" class="nav-link" target="_blank" href="../index.php">مشاهده سایت</a>
                <a style="width: auto" class="nav-link" href="?logout">خروج</a>
            </ul>
        </li>
    </ul>
</header>
