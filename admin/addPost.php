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
            <h2>پست جدید</h2>
            <div class="table-responsive">
                <?php addPost();  ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" class="input-group" required="required" name="title" placeholder="عنوان مطلب"><br>
                    دسته بندی:
                    <select name="category_id" class="input-group" required="required">
                        <?php
                        $selectAllCategory = selectAllCategory();
                        foreach ($selectAllCategory as $valueCategory) {
                            echo "<option value='" . $valueCategory->id . "'>{$valueCategory->title}</option>";
                        }
                        ?>
                    </select>
                    <select style="display: none;" name="author" class="textbox" required="required">
                        <option><?= $_SESSION['user']['name'] ?></option>
                    </select><br>
                    <div class=input-group>
                        <input type="file" name="image" class="input-group" >
                    </div>
                    <br>
                    <textarea name="text" required="required" class="input-group" style="height: 230px;padding: 15px;"
                              placeholder="توضیحات مطلب"></textarea>
                    <br>
                    <input type="text" name="tag" required="required" class="input-group" placeholder="برچسب ها">
                    <br>
                    <input type="submit" class="btn btn-success" name="insertPost" value="درج مطلب">
                    <input type="reset" class="btn btn-error" value="انصراف">
                </form>
            </div>
        </main>
    </div>
</div>


<?php include 'footer.php' ?>
