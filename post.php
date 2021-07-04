<?php require_once 'init.php';
if (isset($_GET['logout'])){
    loggedOut();
    header("Location:index.php");
}
?>
<?php
$option = option();
foreach ($option as $value) {
?>

<!doctype html>
<html lang="fa-IR" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $value->title; ?></title>
    <?php } ?> <?php
    if (isset($_GET['id'])) {
        $showSinglePost = showSinglePost($_GET['id']);
    }
    if ($showSinglePost) {
        foreach ($showSinglePost as $value) { ?>

    <meta name="description" content="<?= $value->tag ?>">
    <meta name="author" content="<?= $value->author ?>">
    <link rel="stylesheet" href="./css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="./css/style.css">
        <?php }
    }
    ?>
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


<?php
if (isset($_GET['id'])) {
    $showSinglePost = showSinglePost($_GET['id']);
}
if ($showSinglePost) {
foreach ($showSinglePost as $value) {
?>

        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-8" style="border: 1px solid rgba(0,0,0,.125);background-color: #fff;">


                    <header class="mx-3 mb-3 mt-3">
            <h1 class="fw-bolder mb-3" ><?php echo $value->title ?></h1>
                    <div class="text-muted fst-italic mb-3">تاریخ انتشار:<?= convertDateToFarsi($value->created_at); ?></div>
                    <a class="badge bg-secondary text-decoration-none link-light">کلمات کلیدی: <?php echo $value->tag ?></a>
                    </header>
                    <figure class="mb-4">
                <img class="img-fluid rounded" style="border: dot-dash 2px" src="./images/<?php echo $value->image ?>" width="900px" height="400px" alt="">
                    </figure>
                    <section class="mb-5">
                        <p class="fs-6 mb-4"> <?php echo $value->text ?> </p>
                    </section>

                <?php }
            } else {
                echo '<p class="alert alert-info">مطلبی وجود ندارد</p>';
            } ?>

                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <?php if (!isLoggedIn()): ?>
                                    <p align="center" class="alert alert-info">برای ثبت نظر وارد پنل کاربری شوید</p>
                                <?php endif; ?>

                                <?php if (isLoggedIn()): ?>
                                <?php sendComment(); ?>
                                <form class="mb-4" action="" method="POST">

                                    <input hidden="hidden" type="text" name="user_id" required="required" class="form-control w-100" value="<?= $_SESSION['user']['id'] ?>">
                                    <input hidden="hidden" type="text" name="post_id" required="required" class="form-control w-100" value="<?php echo $value->id ?>">
                                    <textarea required="required" name="body" class="form-control"
                                              style="height: 150px;resize: none;padding: 12px"
                                              placeholder="نظر خود را بنویسد"></textarea>
                                    <input type="submit" name="insertComment" class="btn btn-success" value="ارسال نظر">
                                    <input type="reset" class="btn btn-error" value="انصراف">
                                </form>


                        <?php endif; ?>


                            <?php
                            $showQuestion = showQuesion($_GET['id']);
                            if ($showQuestion) {
                            foreach ($showQuestion as $value) {
                            ?>
                                <div class="d-flex mb-4"  >
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="./images/avatar.jpg" width="50" alt="..."></div>
                                    <div class="ms-3">
                                        <div class="fw-bold"><?= $value['name'] ?><br> <?= convertDateToFarsi($value['created_at']); ?></div>
                                        <p><?php echo strip_tags($value['body']) ?></p>

                                        <?php
                                        $showCommentReply = showCommentReply($value['id']);
                                        if($showCommentReply){
                                            foreach ($showCommentReply as $item) {
                                                ?>
                                                <div class="d-flex mt-4" >
                                                    <div class="flex-shrink-0"><img class="rounded-circle" src="./images/avatar.jpg" width="50" alt="..."></div>
                                                    <div class="ms-3">
                                                        <div class="fw-bold" ><?= $item['name'] ?> <br><?= convertDateToFarsi($item['created_at']); ?></div>
                                                        <p><?php echo $item['body'] ?></p>
                                                    </div>
                                                </div>

                                            <?php }
                                        } ?>
                                    </div>
                                </div>
                <?php }
                } else {
                    echo '<p class="alert alert-info">نظری برای این پست ثبت نشده است</p>';
                } ?>
                            </div>
                </div>
                </div>
                    </section>



            <div class="col-lg-4">

                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">Web Design</a></li>
                                    <li><a href="#!">HTML</a></li>
                                    <li><a href="#!">Freebies</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">JavaScript</a></li>
                                    <li><a href="#!">CSS</a></li>
                                    <li><a href="#!">Tutorials</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">Web Design</a></li>
                                    <li><a href="#!">HTML</a></li>
                                    <li><a href="#!">Freebies</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">JavaScript</a></li>
                                    <li><a href="#!">CSS</a></li>
                                    <li><a href="#!">Tutorials</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        </div>

<?php include 'footer.php' ?>