<?php require_once 'header.php' ?>
<?php
if (!isLoggedIn())
header('location:../login.php');
if (!isAdmin())
header('location:../index.php');
?>
<div class="container-fluid">
    <div class="row">
        <?php require_once 'sidebar.php' ?>
        <br>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <h2>ویرایش دسته بندی</h2>
            <?php
            $showCategory = selectSingleCategory($_GET['edit']);
            if (isset($_POST['updateCategory'])){
                updateCategory($showCategory->id);
                $message = '<p class="alert alert-success">ویرایش با موفقیت انجام شد</p>';
                header("Location:category.php");
            }
            ?>
            <?php if (isset($message)) echo $message; ?>

            <form action="" method="post">
                نام دسته بندی
            <input type="text" class="input-group" value="<?= $showCategory->title; ?>" name="title"
                   placeholder="نام دسته بندی">
                ایدی عددی
            <input class="input-group" name="id" value="<?php if (isset($showCategory)) echo $showCategory->id;; ?>" placeholder="">
            <br>
            <input type="submit" class="btn btn-success" name="updateCategory" value="ویرایش دسته بندی">
            <input type="reset" class="btn btn-error" value="انصراف">
        </form>

        <br><br>
        </main>
    </div>
</div>


<?php require_once 'footer.php' ?>