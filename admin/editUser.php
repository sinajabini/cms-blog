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
                <h2>ویرایش کاربر</h2>
                <?php
                $showUser = selectSingleUser($_GET['edit']);
                if (isset($_POST['updateUser'])){
                    updateUser($showUser->id);
                    $message = '<p class="alert alert-success">ویرایش با موفقیت انجام شد</p>';
                    header("Location:user.php");
                }
                ?>
                <?php if (isset($message)) echo $message; ?>

                <form action="" method="post">
                    نام
                    <input type="text" class="input-group" value="<?= $showUser->username; ?>" name="username"
                           placeholder="نام دسته بندی">
                    مقام

                    <select name="role"  class="input-group" >
                        <option style="display: none;"><?= $showUser->role; ?></option>
                            <option value="user" >user</option>
                            <option value="admin" >admin</option>
                    </select>
                    نام نمایشی
                    <input type="text" class="input-group" value="<?= $showUser->name; ?>" name="name"
                           placeholder="نام دسته بندی">
                    ایدی عددی
                    <input class="input-group" name="id" value="<?php if (isset($showUser)) echo $showUser->id; ?>" placeholder="">

                    ویرایش رمزعبور
                    <input type="text" class="input-group" name="password" placeholder="">

                    <br>
                    <input type="submit" class="btn btn-success" name="updateUser" value="ویرایش">
                    <input type="reset" class="btn btn-error" value="انصراف">
                </form>

                <br><br>
            </main>
        </div>
    </div>


<?php require_once 'footer.php' ?>