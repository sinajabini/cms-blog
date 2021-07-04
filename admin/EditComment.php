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
            <?php
            $row = selectComment($_GET['edit']);

            if (isset($_GET['edit']) && isset($_POST['id'])) {
                $updateComment = editComment($_POST['id']);
                if ($updateComment) {
                    $message = '<p class="alert alert-success">ویرایش با موفقیت انجام شد</p>';
                    header("refresh:1, url = comment.php");
                } else {
                    $message = '<p class="alert alert-error">ویرایش با خطا مواجه شد</p>';
                }
            }
            ?>
            <h2>ویرایش نظر</h2>
            <br>
            <?php if (isset($message)) echo $message; ?>

            <form action="" method="post">
                <input type="hidden" value="<?php echo $row['id'] ?>" class="input-group" name="id">
                <input disabled type="text" value="<?php echo $row['name'] ?>" class="input-group">
                <input disabled type="text" value="<?php echo showPostForComment($row['post_id']) ?>"
                       class="input-group">
                <textarea name="body" class="input-group"
                          style="height: 150px;padding: 12px;"><?php echo $row['body'] ?></textarea>
                <br>
                <input type="submit" class="btn btn-success" name="editComment" value="ارسال پاسخ">
                <input type="reset" class="btn btn-error" value="انصراف">
            </form>
            <br><br>
        </main>
    </div>
</div>


<?php require_once 'footer.php' ?>

