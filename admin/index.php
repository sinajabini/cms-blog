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

<?php header('location:./post.php'); ?>

            </div>
        </main>
    </div>
</div>


<?php include 'footer.php' ?>
