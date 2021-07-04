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
                $deleteUser = deleteUser($_GET['delete']);
                if ($deleteUser) {
                    header('location: user.php?success=ok');
                } else {
                    header('location: user.php?error=ok');
                }

            }
            addCategory()
            ?>
            <br>

            <h2>دسته ها</h2>
            <div class="table-responsive">

                <table class="table table-striped table-fluid">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>نام کاربری</th>
                        <th>نام نمایشی</th>
                        <th>مقام</th>
                        <th> </th>
                        <th> </th>
                        <th> </th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $selectUser = selectAllUser();
                    if ($selectUser) {
                        foreach ($selectUser as $value) {
                            ?>
                            <tr>
                                <td><?php echo $value->id ?></td>
                                <td><?= $value->username ?></td>
                                <td><?= $value->name ?></td>
                                <td><?= $value->role ?></td>

                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td>
                                    <a class="btn btn-danger" href="user.php?delete=<?= $value->id; ?>">حذف</a>
                                    <a class="btn btn-success" href="editUser.php?edit=<?= $value->id ?>">ویرایش</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <td colspan="8" class="alert alert-info">دسته ای وجود ندارد</td>
                    <?php } ?>

                    </tbody>
                </table>

            </div>
        </main>
    </div>
</div>

<?php require_once 'footer.php' ?>

