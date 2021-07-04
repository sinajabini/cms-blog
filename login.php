<?php require_once './header.php'; ?>
<?php if (!isLoggedIn()) { ?>
    <link rel="stylesheet" href="css/signin.css">
<main style="background: #fff;" class="form-signin mt-5 mb-5">
    <?php
    if (isset($_GET['login'])) {
        echo '<p class="alert alert-danger">نام کاربری و یا رمز عبور اشتباست</p>';
    }
    ?>
    <?php login(); ?>
    <form action="" method="post">
        <h1 align="center" class="h3 mb-3 fw-normal">ورود</h1>

        <div class="form-floating">
            <input type="username" name="username" class="form-control" >
            <label for="username">نام کاربری</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" >
            <label for="password">رمز عبور</label>
        </div>

        <input class="w-100 btn btn-lg btn-primary" type="submit" name="login" value="ورود">
    </form>

    <br>
    <a class="w-100 btn btn-lg btn-primary" href="./register.php">عضویت</a>
</main>
<?php } else {
    header('location:./index.php');
} ?>

<?php include 'footer.php'?>