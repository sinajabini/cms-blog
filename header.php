<?php require_once 'init.php';
if (isset($_GET['logout']))
    loggedOut();
?>
<?php
$option = option();
foreach ($option as $value) {
?>

<!doctype html>
<html lang="fa-IR" dir="rtl" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $value->title; ?></title>
    <meta name="description" content="<?= $value->description; ?>">
    <link rel="stylesheet" href="./css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="./css/dashboard.rtl.css">
    <link rel="stylesheet" href="./css/style.css">

</head>

<body style="background-color: #ebeff2;" >
<div class="container">
    <header>
        <div class="row flex-nowrap justify-content-between align-items-center">

            <div class="col-2 text-center">
                <a class="blog-header-logo text-dark" href="./index.php"><img src="./images/logo.png" width="200px"></a>
            </div>

            <div class="col-8 d-flex justify-content-end">

                <ul class="nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                            <?php if (!isLoggedIn()): ?>
                                <a href="./login.php">حساب کاربری</a>
                            <?php endif; ?>
                            <?php if (isLoggedIn()): ?>
                                <?= $_SESSION['user']['name']??'' ?>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if (isAdmin()): ?>
                                <a style="width: auto" class="nav-link" href="./admin">پنل مدیریت</a>
                            <?php endif; ?>
                            <a style="width: auto" class="nav-link" href="?logout">خروج</a>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </header>
    <?php selectAllCategory(); ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link mx-3" aria-current="page" href="./index.php">خانه</a>
                    </li>

                    <li class="nav-item dropdown mx-3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            دسته بندی
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $showCategory = selectAllCategory();
                            foreach ($showCategory as $value) { ?>
                                <?php
                            echo "<a class='dropdown-item' href='category.php?id={$value->id}'>{$value->title}</a>";

                            }
                            ?>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link mx-3" aria-current="page" href="">تماس باما</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link mx-3" aria-current="page" href="">درباره ما</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

</div>
<?php } ?>
