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
            $row = selectPost($_GET['edit']);
            if (isset($_GET['edit']) && isset($_POST['id'])) {
                updatePost($row['id']);
            }
            ?>
            <h2>ویرایش پست</h2>

        <form action="" method="post" enctype="multipart/form-data">
            عنوان مطلب<br>
            <input type="text" value="<?php echo $row['title'] ?>" class="input-group" name="title" >
            <br>

            دسته بندی:
            <select name="category_id" value="<?php echo $row['category_id'] ?>" class="input-group" >
                <?php
                $selectAllCategory = selectAllCategory();
                foreach ($selectAllCategory as $valueCategory) : ?>
                    <option value="<?= $valueCategory->id ?>" <?= $valueCategory->id==$row['category_id'] ?'selected':'' ?> ><?= $valueCategory->title ?></option>
                <?php endforeach;?>
            </select><br>
            نویسنده مطلب:  <br>
            <input type="text" value="<?php echo $row['author'] ?>" name="author" class="input-group"  >
            <br>
            تصویر پست:
            <input type="file" name="image" class="input-group" style="border: groove 1px">
                <img width="200px" height="110px" src="../images/<?php echo $row['image'] ?>" alt="">
            <br>
            متن:<br>
            <textarea name="text" class="input-group" style="height: 230px;padding: 15px;" placeholder="توضیحات مطلب"><?php echo $row['text'] ?></textarea>
            <br>
            برچسب ها:<br>
            <input type="text" value="<?php echo $row['tag'] ?>" name="tag" class="input-group" >
            <br>
            <input type="text" name="id" value="<?php echo $row['id'] ?>" class="input-group" >
            <br>
            <input type="submit" class="btn btn-success" name="updatePost" value="ویرایش مطلب">
            <input type="reset" class="btn btn-error" value="انصراف">
        </form>
        <br><br>
        </main>
    </div>
    </div>


    <?php require_once 'footer.php' ?>

