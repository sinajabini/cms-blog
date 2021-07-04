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
                $row = selectPost($_GET['delete']);
                $delete = deletePost($_GET['delete']);
                if ($delete) {
                    $image = "../images/" . $row['image'];
                    unlink($image);
                    header('location:./post.php');
                } else {
                    header('location:./post.php');
                }
            }
            if (isset($_GET['success'])) {
                echo '<p class="alert alert-success">حذف با موفقیت انجام شد</p>';
            } elseif (isset($_GET['error'])) {
                echo '<p class="alert alert-danger">حذف با خطا مواجه شد</p>';
            }
            ?>
            <h2>پست ها</h2>
            <div class="table-responsive">

                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>عنوان</th>
                        <th>دسته بندی</th>
                        <th>نویسنده</th>
                        <th>تاریخ</th>
                        <th>تصویر</th>
                        <th>برچسب</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $selectAllPost = selectAllPost();

                    if ($selectAllPost) {
                        foreach ($selectAllPost as $value) {
                            ?>
                            <tr>
                                <td><?php echo $value->id ?></td>
                                <td><a href="../post.php?id=<?= $value->id ?>" _blank ><?= $value->title ?></a></td>
                                <td><?= showCategoryTitle($value->category_id) ?></td>
                                <td><?= $value->author ?></td>
                                <td><?= convertDateToFarsi($value->created_at); ?></td>
                                <td><a href="../images/<?= $value->image ?>" ><img width="110px" height="50px" src="../images/<?= $value->image ?>" alt=""></a></td>
                                <td><?= $value->tag ?></td>
                                <td>
                                    <a class="btn btn-danger" href="./post.php?delete=<?php echo $value->id ?>">حذف</a>
                                    <a class="btn btn-success" href="./editPost.php?edit=<?php echo $value->id ?>">ویرایش</a>
                                </td>
                            </tr>
                        <?php }
                    } else {
                        ?>
                        <td colspan="8" class="alert alert-info">مطلبی وجود ندارد</td>


                    <?php }

                    ?>

                    </tbody>
                </table>

            </div>
            <?php

            for ($i = 1; $i <= $count; $i++) {
                if ($i == $_GET['page']) {
                    echo '<a href="./post.php?page=' . $i . '" class="paginate active">' . $i . '</a>';
                } else {
                    echo '<a href="./post.php?page=' . $i . '" class="paginate">' . $i . '</a>';
                }
            }

            ?>
        </main>
    </div>
</div>


<?php include 'footer.php' ?>
