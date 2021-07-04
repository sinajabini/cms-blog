<?php
// check login panel
function isLoggedIn(){
    return isset($_SESSION['user']);
}

// check admin or user
function isAdmin(){
    return $_SESSION['user']['role']=='admin';
}

// logout panel
function loggedOut(){
    unset($_SESSION['user']);
}
// login form
function login()
{
    global $connection;
    if (isset($_POST['login'])) {
        $sql = "select * from `users` where `username`=? and `password`=?";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(1, $_POST['username']);
        $stmt->bindValue(2, md5($_POST['password']));
        $stmt->execute();
        if ($stmt->rowCount()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user']=$row;
            if ($row['role'] == "admin") {
                header('location:admin');
            } else {
                header('location:index.php');
            }
        } else {
            header('location:login.php?login=error');
        }
    }
}

// reegister form
function register()
{
    global $connection;
    if (isset($_POST['register'])) {
        $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
        $name = !empty($_POST['name']) ? trim($_POST['name']) : null;
        $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
        $role = !empty($_POST['role']) ? trim($_POST['role']) : null;
        $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['num'] > 0) {
            echo "<p>این نام کاربری تکراری می باشد نام دیگری را امتحان کنید</p>";
            die;
        }
        if ($username == null) {
            header('location:register.php?register=error');
            die;
        } elseif ($name == null) {
            header('location:register.php?register=error');
            die;
        } elseif ($password == null) {
            header('location:register.php?register=error');
            die;
        }
        $passwordHash = md5($password);
        $role = "user";
        $sql = "INSERT INTO users (username, name, password, role) VALUES (:username, :name, :password, :role)";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':password', $passwordHash);
        $stmt->bindValue(':role', $role);
        if ($stmt->execute()) {
            echo $username;
            header('location:index.php');
        } else {
            header('location:register.php?register=error');
        }
    }
}


function readMore($value)
{
    return mb_substr($value, 0, 90, 'utf-8') . ' ... ';
}

function showSinglePost($item)
{
    global $connection;
    if (isset($item)) {
        $sql = "select * from `post` where `id`=?";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(1, $item);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}

function addCategory()
{
    global $connection;
    if (isset($_POST['insertCategory'])) {
        $sql = "insert into `category` (`title`) values (:title)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':title', $_POST['title']);
        if ($stmt->execute()) {
            echo '<p class="alert alert-success">دسته اضافه شد</p>';
        } else {
            return false;
        }
    }
}

function selectAllCategory()
{
    global $connection;
    $sql = "select * from `category`";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount()) {
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } else {
        return false;
    }
}

function selectSingleCategory($id)
{
    global $connection;
    if (isset($id)) {
        $sql = "select * from `category` where `id`=? limit 1";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}

function deleteCategory($id)
{
    global $connection;
    if (isset($_GET['delete'])) {
        $sql = "delete from `category`  where `id`=?";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if ($stmt->rowCount()) {
            return $stmt;
        } else {
            return false;
        }
    }
}

function updateCategory($id)
{
    global $connection;
    $sql = "UPDATE `category` set `title`=? WHERE `id`=?";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(1, $_POST['title']);
    $stmt->bindValue(2, $id);
    $stmt->execute();
    if ($stmt->rowCount()) {
        return $stmt;
    } else {
        return false;
    }
}

function showCategoryTitle($value)
{
    global $connection;
    $sql = "select * from `category` where `id`=?";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(1, $value);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($row as $valueCategory) {
        return $valueCategory['title'];
    }
}

function selectCategoryByPost($value)
{
    global $connection;
    if (isset($value)) {
        $sql = "select * from `post` where `category_id`=?";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(1, $value);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}

function convertDateToFarsi($value)
{
    $date = explode('-', $value);
    return gregorian_to_jalali($date[0], $date[1], $date[2], '/');
}

function addPost()
{
    global $connection;
    if (isset($_POST['insertPost'])) {
        $title = $_POST['title'];
        $category_id = $_POST['category_id'];
        $author = $_POST['author'];
        $text = $_POST['text'];
        $tag = $_POST['tag'];
        $created_at = date('y-m-d');
        $file = $_FILES['image']['name'];
        $extension = explode('.', $file); // lara.jpg lara.5.7.jpg
        $fileExt = strtolower(end($extension));
        $image = md5(microtime() . $file);
        $image .= "." . $fileExt;
        $error = $_FILES['image']['error'];
        $tmp_name = $_FILES['image']['tmp_name'];
        switch ($error) {
            case UPLOAD_ERR_OK;
                $valid = true;
                if (!in_array($fileExt, array('png', 'jpg', 'gif', 'jepg'))) {
                    $valid = false;
                    echo '<p class="alert alert-warning">پسوند فایل انتخابی باید png , jpg , gif , jpeg باشد</p>';
                }
                if ($error > 200000) {
                    $valid = false;
                    echo '<p class="alert alert-warning">عکس انتخاب شده بیش از حد بزرگ است</p>';
                }
                if ($valid) {
                    $valid = true;
//                    header("Location:category.php?success=1");
                    echo '<p class="alert alert-success">پست منتشر شد</p>';
                    move_uploaded_file($tmp_name, '../images/' . $image);
                    $sql = 'INSERT INTO `post` (`category_id`,`title`,`author`,`created_at`,`image`,`text`,`tag`)
                    values (:category_id,:title,:author,:created_at,:image,:text,:tag)';
                    $stmt = $connection->prepare($sql);
                    $stmt->bindParam(':category_id', $category_id);
                    $stmt->bindParam(':title', $title);
                    $stmt->bindParam(':author', $author);
                    $stmt->bindParam(':created_at', $created_at);
                    $stmt->bindParam(':image', $image);
                    $stmt->bindParam(':text', $text);
                    $stmt->bindParam(':tag', $tag);
                    $stmt->execute();
                    if ($stmt->rowCount()) {
                        return $stmt;
                    } else {
                        return false;
                    }
                }
                break;
            case UPLOAD_ERR_PARTIAL;
                echo '<p class="alert alert-error">بخشی از عکس اپلود نشده است</p>';
                break;
            case UPLOAD_ERR_NO_TMP_DIR;
                echo '<p class="alert alert-error">عکست کجاست؟</p>';
                break;
            default:
                echo '<p class="alert alert-error">خطا در درج</p>';
                break;
        }

    }
}

function selectAllPost()
{
    global $connection;
    global $count;
    if (!isset($_GET['page'])) {
        $offset = $_GET['page'] = 0;
    } else {
        $offset = ($_GET['page'] + 1) * 3;
    }
    $sql = "select * from `post`";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount() / 6;
    $sql = "select * from `post` limit {$offset},6";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount()) {
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } else {
        return false;
    }
}

function deletePost($id)
{
    global $connection;
    if (isset($_GET['delete'])) {
        $sql = "delete from `post` where `id`=?";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if ($stmt->rowCount()) {
            return $stmt;
        } else {
            return false;
        }
    }
}

function selectPost($id)
{
    global $connection;
    if (isset($id)) {
        $sql = "select * from `post` where `id`=?";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

function updatePost($id)
{
    global $connection;
    if (isset($_POST['updatePost'])) {
        $title = $_POST['title'];
        $category_id = $_POST['category_id'];
        $author = $_POST['author'];
        $text = $_POST['text'];
        $tag = $_POST['tag'];
        $created_at = date('y-m-d');

        if ($_FILES['image']['size']!=0){
            $file = $_FILES['image']['name'];
            $extension = explode('.', $file); // lara.jpg lara.5.7.jpg
            $fileExt = strtolower(end($extension));
            $image = md5(microtime() . $file);
            $image .= "." . $fileExt;
            $error = $_FILES['image']['error'];
            $tmp_name = $_FILES['image']['tmp_name'];
        }else{
            $error =UPLOAD_ERR_OK;
        }
        switch ($error) {
            case UPLOAD_ERR_OK;
                $valid = true;
                if ($_FILES['image']['size']!=0){
                    if (!in_array($fileExt, array('png', 'jpg', 'gif', 'jepg'))) {
                        $valid = false;
                        echo '<p class="alert alert-danger">پسوند فایل انتخابی باید png , jpg , gif , jpeg باشد</p>';
                    }
                    if ($error > 200000) {
                        $valid = false;
                        echo '<p class="alert alert-danger">عکس انتخاب شده بیش از حد بزرگ است</p>';
                    }
                }
                if ($valid) {
                    $valid = true;
                    echo '<p class="alert alert-success">پست با موفقیت ویرایش شد</p><div class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span></div>';
                    header("Location:post.php");
                    move_uploaded_file($tmp_name, '../images/' . $image);
                    $sql = "UPDATE `post` set `category_id`=:category_id,`title`=:title,`author`=:author,`created_at`=:created_at,`image`=:image,`text`=:text,`tag`=:tag where `id`=:id";
                    $stmt = $connection->prepare($sql);
                    $stmt->bindParam(':category_id', $category_id);
                    $stmt->bindParam(':title', $title);
                    $stmt->bindParam(':author', $author);
                    $stmt->bindParam(':created_at', $created_at);
                    if ($_FILES['image']['size']!=0)
                        $stmt->bindParam(':image', $image);
                    $stmt->bindParam(':text', $text);
                    $stmt->bindParam(':tag', $tag);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    if ($stmt->rowCount()) {
                        return $stmt;

                    } else {
                        return false;
                    }
                }
                break;
            case UPLOAD_ERR_PARTIAL;
                echo '<p class="alert alert-danger">بخشی از عکس اپلود نشده است</p>';
                break;
            case UPLOAD_ERR_NO_TMP_DIR;
                echo '<p class="alert alert-danger">عکست کجاست؟</p>';
                break;
            default:
                echo '<p class="alert alert-danger">خطا در درج</p>';
                break;
        }
    }
}

function sendComment()
{
    global $connection;
    if (isset($_POST['insertComment'])) {

        $created_at = date('y-m-d');
        $status = 0;
        $comment_reply = 0;
        $sql = "INSERT INTO `comment` (`user_id`,`body`,`post_id`,`created_at`,`status`,`comment_reply`) values (:user_id,:body,:post_id,:created_at,:status,:comment_reply)";
        $stmt = $connection->prepare($sql);
        $user_id=$_POST['user_id'];
        $body= htmlentities($_POST['body']);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':body',$body );
        $stmt->bindParam(':post_id', $_POST['post_id']);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':comment_reply', $comment_reply);
        if ($stmt->execute()) {
            echo '<p class="alert alert-success">نظر شما ارسال شد پس از تایید منتشر خواهد شد</p>';
        } else {
            return false;
        }
    }
}

function selectAllComment()
{
    global $connection;
    global $count;
    if (!isset($_GET['page'])) {
        $offset = $_GET['page'] = 0;
    } else {
        $offset = ($_GET['page'] + 1) * 5;
    }
    $sql = "select comment.* , users.name from `comment` join `users` on users.id=comment.user_id ";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
//    var_dump( $stmt->fetchAll(PDO::FETCH_ASSOC));
//    $count = $stmt->rowCount() / 10;
//    $sql = "select * from `comment` limit {$offset},10";
//    $stmt = $connection->prepare($sql);
//    $stmt->execute();
//    if ($stmt->rowCount()) {

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
//    } else {
//        return false;
//    }
}

function showPostForComment($value)
{
    global $connection;
    $sql = "select * from `post` where `id`=:id";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $value);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($row as $valuePost) {
        return $valuePost['title'];
    }
}

function commentConfirm($id)
{
    global $connection;
    $sql = "update `comment` set `status`=? where id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(1, 1);
    $stmt->bindValue(2, $id);
    return $stmt->execute();

}

function commentReject($id)
{
    global $connection;
    $sql = "update `comment` set `status`=? where id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(1, 0);
    $stmt->bindValue(2, $id);
    return $stmt->execute();

}

function selectComment($id)
{
    global $connection;
    if (isset($id)) {
        $sql = "select * from `comment` where `id`=?";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

function sendReplyComment($id, $post_id)
{
    global $connection;
    if (isset($_POST['sendReplyComment'])) {
        $created_at = date('y-m-d');
        $status = 1;
        $sql = "INSERT INTO `comment` (`post_id`,`user_id`,`body`,`status`,`created_at`,`comment_reply`)
        values (:post_id,:user_id,:body,:status,:created_at,:comment_reply)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->bindParam(':user_id', $_POST['user_id']);
        $stmt->bindParam(':body', $_POST['body']);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':comment_reply', $id);
        $stmt->execute();
        if ($stmt->rowCount()) {
            return $stmt;
        } else {
            return false;
        }

    }
}

function deleteComment($id)
{
    global $connection;
    $sql = "delete from `comment` where `id`=?";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();
    if ($stmt->rowCount()) {
        return $stmt;
    } else {
        return false;
    }
}

function editComment($id)
{
    global $connection;
    if (isset($_POST['editComment'])) {
        $created_at = date('y-m-d');
        $sql = "update comment.* , users.* set `body`=:body,`created_at`=:created_at where `id`=:id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':body', $_POST['body']);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        if ($stmt->rowCount()) {
            return $stmt;
        } else {
            return false;
        }

    }
}

function showQuesion($post_id)
{
    global $connection;

    $sql = "select comment.* , users.name from `comment` join `users` on users.id=comment.user_id where `status`=?  and `post_id`=? and `comment_reply`=?";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(1, 1);
    $stmt->bindValue(2, $post_id);
    $stmt->bindValue(3, 0);
    $stmt->execute();
    if ($stmt->rowCount()) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}

function showCommentReply($id)
{
    global $connection;
//    $sql = "select comment.* , users.name from `comment` join `users` on users.id=comment.user_id"
    $sql = "select comment.* , users.name from `comment` join `users` on users.id=comment.user_id where `status`=? and `comment_reply`=?";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(1, 1);
    $stmt->bindValue(2, $id);
    $stmt->execute();
    if ($stmt->rowCount()) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}


function option()
{
    global $connection;
    $sql = "select * from `option`";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount()) {
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } else {
        return false;
    }
}


function deleteUser($id)
{
    global $connection;
    if (isset($_GET['delete'])) {
        $sql = "delete from `users`  where `id`=?";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if ($stmt->rowCount()) {
            return $stmt;
        } else {
            return false;
        }
    }
}

function selectUser()
{
    global $connection;
    $sql = "select * from `users`";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount()) {
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } else {
        return false;
    }
}

function updateUser($id)
{
    global $connection;

    if ($_POST['password']==null) $sql = "UPDATE `users` set `username`=:username , `role`=:role ,`name`=:name WHERE `id`=:id";
    else $sql = "UPDATE `users` set `username`=:username , `password`=:password, `role`=:role ,`name`=:name WHERE `id`=:id";
    $stmt = $connection->prepare($sql);
    if ($_POST['password']!=null){
        $newpassword = md5($_POST['password']);
        $stmt->bindValue(':password', $newpassword);
    }
    $stmt->bindValue(':username', $_POST['username']);
    $stmt->bindValue(':role', $_POST['role']);
    $stmt->bindValue(':name', $_POST['name']);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    if ($stmt->rowCount()) {
        return $stmt;
    } else {
        return false;
    }
}

function selectSingleUser($id)
{
    global $connection;
    if (isset($id)) {
        $sql = "select * from `users` where `id`=? limit 1";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}

function selectAllUser()
{
    global $connection;
    $sql = "select * from `users`";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount()) {
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } else {
        return false;
    }
}
