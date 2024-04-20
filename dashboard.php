<?php
    include 'includes/connect.php';
    include 'includes/header.php';
    $uid = $_SESSION['uid'];
    $username = $_SESSION['username'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $email = $_SESSION['email'];
    if(!$uid){
        header("Location: index.php");
    }
    echo "Welcome $firstname $lastname!";
 ?>
<DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form method = "post">
            <label for = "title">Title of Post</label><br>
            <textarea name = "title"></textarea><br>
            <label for = "content">Content</label><br>
            <textarea name = "content"></textarea><br>
            <input type = "submit" name = "submitPost">
            <hr>
        </form>
        <?php 
            if(isset($_POST['submitPost'])){ //submit post
                if(empty($_POST['title']) || empty($_POST['content'])){
                    echo '<script>alert("Missing fields")</script>';
                } else{
                    $title = $_POST['title'];
                    $content = $_POST['content'];
                    $post_statement = "INSERT INTO `tblpost` (`title`, `content`) VALUES ('$title', '$content')";
                    $post_query = mysqli_query($conn,$post_statement);
                    $post_id = mysqli_insert_id($conn);
                    $userpost_statement = "INSERT INTO `tbluserpost` (`uid`, `post_id`) VALUES ('$uid', '$post_id')";
                    $userpost_query = mysqli_query($conn,$userpost_statement);
                    if(!$userpost_query){
                        echo '<script>alert("Something went wrong!")</script>';
                    } else{
                        echo '<script>alert("Successfully posted!")</script>';
                    }
                }
            }
            if(isset($_POST['deletePost'])){ //delete post
                if($uid == $_POST['uid']){
                    $post_id = $_POST['post_id'];
                    $delete_statement = "DELETE FROM tblpost WHERE `post_id` = $post_id";
                    $delete_query = mysqli_query($conn,$delete_statement);
                    if($delete_query){
                        echo "<script>alert('Post successfully deleted!')</script>";
                    }
                } else{
                    echo "<script>alert('You cannot delete this post!')</script>";
                }
            }
            if(isset($_POST['updatePost'])){
                if($uid == $_POST['uid']){
                    $title = $_POST['editTitle'];
                    $content = $_POST['editContent'];
                    $post_id = $_POST['post_id'];
                    $update_statement = "UPDATE `tblpost` SET `title` ='$title', `content` = '$content' WHERE `post_id` = '$post_id'";
                    $update_query = mysqli_query($conn,$update_statement);
                    if($update_query){
                        echo "<script>alert('Post successfully updated!')</script>";
                    }
                } else{
                    echo "<script>alert('You cannot edit this post!')</script>";
                }
            }
        ?>
         <?php
            $get_all_posts_query = "SELECT up.*, u.username, p.* FROM tbluserpost up
                                    INNER JOIN tbluser u ON up.uid = u.uid
                                    INNER JOIN tblpost p ON up.post_id = p.post_id";
            $result = mysqli_query($conn, $get_all_posts_query);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "<div class='post'><form method='post'>".
                    "<input type='hidden' name='post_id' value='" . $row['post_id'] . "'>"."
                    <input type='hidden' name='uid' value='" . $row['uid'] . "'>".
                    "<input type='submit' class = 'delete' name='deletePost' value='x'>".
                    "</form>";
                    echo "<form method='post'>".
                    "<input type='hidden' name='post_id' value='" . $row['post_id'] . "'>"."
                    <input type='hidden' name='uid' value='" . $row['uid'] . "'>".
                    "<label for = 'editTitle'>Title of Post</label><br>".
                    "<textarea name = 'editTitle'></textarea><br>".
                    "<label for = 'editContent'>Content</label><br>". 
                    "<textarea name = 'editContent'></textarea><br>".
                    "<input type='submit' class = 'update' name='updatePost' value='Edit'>".
                    "</form>";
                    echo "Userpost ID: " . $row['userpost_id'] . "<br>".
                    "User ID: " . $row['uid'] . "<br>" .
                    "Post ID: " . $row['post_id'] . "<br>" .
                    "Name: " . $row['username'] . "<br>" .
                    "Time: " . $row['time_created'] . "<br>" .
                    "Title: " . $row['title'] . "<br>" .
                    $row['content'] . "<br>" .
                    "<hr>" . "</div>";
                }
            }
        ?>
    </body>
    <footer>
		<?php
        	include 'includes/footerBoth.php';
        ?>
    </footer>
</html>