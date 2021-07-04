<?php include 'header.php' ?>
<main>
    <div class="album py-5">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php
                if (isset($_GET['id'])) {
                    $selectCategoryByPost = selectCategoryByPost($_GET['id']);
                }

                if ($selectCategoryByPost) {
                    foreach ($selectCategoryByPost as $value) {
                        ?>

                        <div class="col">
                    <div class="card shadow-sm" style="background: #e3e3e3;border-radius: 20px;" >
                        <img src="./images/<?php echo $value->image ?>" style="border-top-left-radius: 20px;border-top-right-radius: 20px;" width="100%" height="225" alt="">

                        <div class="card-body">
                            <a href="post.php?id=<?php echo $value->id ?>"><?php echo $value->title ?></a>
                            <p class="card-text">
                                <?php
                                echo readMore($value->text);
                                ?>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">

                                <div class="container">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div> 👨‍💼 نویسنده: <?php echo $value->author ?></div>
                                        </div>
                                        <div class="col-6">
                                            <div>📆 <?= convertDateToFarsi($value->created_at); ?></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <br>
                            <a class="btn btn-success w-100" href="post.php?id=<?php echo $value->id ?>">ادامه مطلب</a>
                        </div>
                    </div>
                </div>

                    <?php }
                } else {
                    echo '<p class="w-100 alert alert-info">مطلبی وجود ندارد</p>';
                } ?>

            <div align="center" class="col-12" >

            </div>
            </div>
        </div>

</main>

<?php include 'footer.php' ?>