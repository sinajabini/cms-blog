<?php include 'header.php' ?>
    <link rel="stylesheet" href="css/signin.css">
    <main style="background: #fff;" class="form-signin mt-5 mb-5">
        <?php
        if (isset($_GET['register'])) {
            echo '<p class="alert alert-danger">تمامی بخش هارا کامل نمایید</p>';
        }
        ?>

        <?php register(); ?>
        <form method="post">
            <h1 align="center" class="h3 mb-3 fw-normal">عضویت</h1>

            <div class="form-floating">
                <input type="name" name="name" class="form-control" >
                <label for="name">نام نمایشی</label>
            </div>
            <div class="form-floating">
                <input type="username" name="username" class="form-control" >
                <label for="username">نام کاربری</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" >
                <label for="password">رمز عبور</label>
            </div>

            <input class="w-100 btn btn-lg btn-primary" type="submit" name="register" value="عضویت">

        </form>
        <br>
        <a class="w-100 btn btn-lg btn-primary" href="./login.php">ورود</a>
    </main>


<?php include 'footer.php'?>