<?php include 'header.php';
if (!isLoggedIn())
    header('location:../login.php');
if (!isAdmin())
    header('location:../index.php');
?>
<div class="container-fluid">
    <div class="row">
        <?php include 'sidebar.php'?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <br>
            <h2>افزودن دسته</h2>

            <?php addCategory(); ?>
                <form action="" method="post">
                    <input type="text" class="input-group" name="title" placeholder="نام دسته بندی">
                    <br>
                    <input type="submit" class="btn btn-success" name="insertCategory" value="درج دسته بندی">
                    <input type="reset" class="btn btn-error" value="انصراف">
                </form>
                <?php
                if (isset($_GET['success'])) {
                    echo '<p class="alert alert-success">حذف با موفقیت انجام شد</p>';
                } elseif (isset($_GET['error'])) {
                    echo '<p class="alert alert-danger">حذف با  خطا مواجه شد</p>';
                }
                ?>
        </main>
    </div>
</div>

<?php require_once 'footer.php' ?>

