<?php include 'header.php' ?>
<main>
    <div class="album py-5">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php
                $selectAllPost = selectAllPost();
                if ($selectAllPost) {
                foreach ($selectAllPost as $value) {
                ?>
                <div class="col">
                    <div class="card shadow-sm bg-light" style="border-radius: 20px;" >
                        <img src="./images/<?php echo $value->image ?>" style="border-top-left-radius: 20px;border-top-right-radius: 20px;" width="100%" height="200" alt="">
                        <div class="card-body"  >
                            <a href="post.php?id=<?php echo $value->id ?>"><?php echo $value->title ?></a>
                            <p class="card-text">
                                <?php
                                echo readMore($value->text);
                                ?>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="container">
                                    <div class="row" align="center">
                                        <div class="col-4">
                                            <div>👨‍💼 <?php echo $value->author ?></div>
                                        </div>
                                        <div class="col-4">
                                            <div><?= convertDateToFarsi($value->created_at); ?></div>
                                        </div>
                                        <div class="col-4">
                                            <a href="post.php?id=<?php echo $value->id ?>">ادامه مطلب</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <?php }
        } else {
            echo '<p class="w-100 alert alert-info">مطلبی وجود ندارد</p>';
        } ?>

        </div>
            <div align="center" class="col-12 mt-5" >
                <?php
                for ($i = 1; $i <= $count; $i++) {
                    if ($i == $_GET['page']) {
                        echo '';
                    } else {
                        echo '<a href="./index.php?page=' . $i . '" class="paginate">' . $i . '</a>';
                    }
                }

                ?>
            </div>

        </div>

</main>

<?php include 'footer.php' ?>
