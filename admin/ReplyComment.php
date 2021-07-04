<?php include 'header.php'; ?>
<?php
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

            <h2>پاسخ دادن</h2>
            <div class="table-responsive">

                <?php
                $row = selectComment($_GET['id']);
                $replyComment = sendReplyComment($row['id'], $row['post_id']);
                if ($replyComment) {
                    echo '<p align="center" class="alert alert-info">برای ثبت نظر وارد پنل کاربری شوید</p>';
                    header('Refresh: 2; URL=comment.php');
                }
                ?>
                <br>
                <form action="" method="post">
                    <input disabled type="text" value="<?php echo $row['id'] ?>" class="input-group">
                    <input disabled type="text" value="<?php echo showPostForComment($row['post_id']) ?>"
                           class="input-group">
                    <textarea disabled class="input-group"
                              style="height: 150px;padding: 12px;"><?php echo $row['body'] ?></textarea>
                    <br>
                    <input hidden="hidden" type="text" name="user_id" value="<?= selectSingleUser($_SESSION['user']['id'])->id ?>" class="input-group">
                    <textarea name="body" class="input-group" style="height: 170px;padding: 12px;"></textarea>
                    <br>
                    <input type="submit" class="btn btn-success" name="sendReplyComment" value="ارسال پاسخ">
                    <input type="reset" class="btn btn-error" value="انصراف">
                </form>
                <br>
            </div>
        </main>
    </div>
</div>

<?php require_once 'footer.php' ?>

