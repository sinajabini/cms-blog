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

            <?php
            if (isset($_GET['delete'])) {
                $deleteComment = deleteComment($_GET['delete']);
                if ($deleteComment) {
                    header('location:comment.php?success=ok');
                } else {
                    header('location:comment.php?error=ok');
                }
            }
            ?>

                <?php
                if (isset($_GET['success'])) {
                    echo '<p class="alert alert-success">حذف با موفقیت انجام شد</p>';
                } elseif (isset($_GET['error'])) {
                    echo '<p class="alert alert-error">حذف با  خطا مواجه شد</p>';
                }
                ?>
            <h2>پست ها</h2>
            <div class="table-responsive">

                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>برای</th>
                        <th>فرد نظردهنده</th>
                        <th>متن نظر</th>
                        <th>تاریخ</th>
                        <th>وضعیت</th>
                        <th>پاسخ دادن</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $selectAllComment = selectAllComment();
                    if ($selectAllComment) {
                        foreach ($selectAllComment as $value) {
                            ?>
                            <tr>
                                <td><?php echo $value['id'] ?></td>
                                <td><?php echo showPostForComment($value['post_id']); ?></td>
                                <td><?php echo $value['name'] ?></td>
                                <td><?php echo $value['body'] ?></td>
                                <td><?php echo convertDateToFarsi($value['created_at']); ?></td>
                                <?php
                                if (isset($_GET['confirm'])) {
                                    commentConfirm($_GET['confirm']);
                                    header('location:comment.php');
                                } elseif (isset($_GET['reject'])) {
                                    commentReject($_GET['reject']);
                                    header('location:comment.php');
                                }
                                ?>
                                <td>
                                    <?php
                                    if ($value['status'] == 0) {
                                        ?>
                                        <a class="btn btn-success" href="comment.php?confirm=<?php echo $value['id'] ?>">تایید
                                            نظر</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a class="btn btn-danger" style="width: 75px;"
                                           href="comment.php?reject=<?php echo $value['id'] ?>">رد نظر</a>
                                    <?php }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (!$value['comment_reply']) {
                                        ?>
                                        <a class="btn btn-primary" href="ReplyComment.php?id=<?php echo $value['id'] ?>">پاسخ دادن</a>
                                    <?php } else {
                                        echo 'این پاسخ است';
                                    }
                                    ?>
                                </td>

                                <td>
                                    <a class="btn btn-danger" href="comment.php?delete=<?php echo $value['id'] ?>">حذف</a>
                                    <a class="btn btn-success" href="EditComment.php?edit=<?php echo $value['id'] ?>">ویرایش</a>
                                </td>
                            </tr>
                        <?php }
                    } else {
                        ?>
                        <td colspan="9" class="alert alert-info">نظری وجود ندارد</td>

                    <?php } ?>

                    </tbody>

                </table>
            </div>
            <?php

            for ($i = 1; $i <= $count; $i++) {
                if ($i == $_GET['page']) {
                    echo '<a href="./comment.php?page=' . $i . '" class="paginate active">' . $i . '</a>';
                } else {
                    echo '<a href="./comment.php?page=' . $i . '" class="paginate">' . $i . '</a>';
                }
            }

            ?>
        </main>
    </div>
</div>


<?php include 'footer.php' ?>
