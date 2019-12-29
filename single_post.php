<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body>
    <?php include_once('header.php'); ?>

    <main role="main" class="container">


        <div class="row">

            <div class="col-sm-8 blog-main">

                <div class="blog-post">
                    <a href="single_post.php">
                        <div class="posts-wp">

                            <?php
                            include('sqlconnection.php');
                            if (isset($_GET['id'])) {
                                $post_id = $_GET['id'];
                            }
                            if (isset($_GET['post_id']))
                                $post_id = $_GET['post_id'];

                            $sql = "SELECT id, title, body, author, created_at FROM posts WHERE id = $post_id";

                            $statement = $connection->prepare($sql);
                            $statement->execute(); //execute-uje upit
                            $statement->setFetchMode(PDO::FETCH_ASSOC); //pretvara rez u asoc 
                            $posts = $statement->fetchAll(); //cuva rez u var comments
                            //var_dump($posts);
                            ?>


                            <?php
                            foreach ($posts as $post) {
                            ?>

                                <div class="posts-wp">

                                    <a href="single_post.php?id=<?php echo $post['id']; ?>">
                                        <h3> <?php echo $post['title']; ?> </h3>
                                    </a>
                                    <p><?php echo ($post["body"]) ?> </p>
                                    <div> <strong>Created at: </strong> <?php echo ($post['created_at']) ?> <strong>Author: </strong> <?php echo ($post['author']) ?>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                </div>
                <form action='delete_post.php' method='POST'>
                    <input type="hidden" name="post_id" value="delete_post.php?id=<?php $_GET['id'] ?>">
                    <input type='button' class="btn btn-primary" onclick="confirmDelete()" value='Delete this post'> </imput>
                </form>
                <br><br> <!-- brisanje posta -->

            </div>
            <!--/.blog-post -->

            <?php include('sidebar.php'); ?>
        </div><!-- /.blog-main -->


        </div><!-- /.row -->

        <?php include('sqlconnection.php'); ?>

        <div>

            <?php
            if (isset($_GET['id'])) {
                $post_id = $_GET['id'];
            }

            $sql = "SELECT text, author FROM comments WHERE post_id = $post_id";
            $statement = $connection->prepare($sql);
            $statement->execute(); //execute-uje upit
            $statement->setFetchMode(PDO::FETCH_ASSOC); //pretvara rez u asoc 
            $comments = $statement->fetchAll(); //cuva rez u var comments
            ?>


            <br>

            <?php include('create_comment.php') ?>

            <button class="btn btn-default" id="hideBtn" onclick="toggle();">Hide comments</button>
            <br>

            <?php
            foreach ($comments as $comment) {
            ?>

                <div class="commentsDb">

                    <ul>
                        <li> <strong>Comment: </strong> <?php echo ($comment['text']); ?></li> <br>
                        <br>
                        <li> <strong>Author: </strong><?php echo ($comment["author"]) ?> </li> <br>
                        <br>
                        <form action="delete_comment.php?id=<?php $_GET['id'] ?>" method="POST">
                        </form>

                        <button type="submit" class="btn btn-default" onsubmit="deleteComment()">Delete comment</button></form> <br>
                    </ul>
                    <hr>
                </div>

            <?php
            }
            ?>
        </div>
        <!--commentsDiv-->
        </div>



    </main><!-- /.container -->
    <?php include_once('footer.php'); ?>

    <!-- <script src="main.js"></script> -->

    <script>
        var clicked = false;

        function toggle() {
            if (!clicked) {
                clicked = true;
                hideBtn.innerHTML = 'Show comments';
                [].forEach.call(document.querySelectorAll('.commentsDb'), function(el) {
                    el.style.display = 'none';
                });
            } else {
                clicked = false;
                hideBtn.innerHTML = 'Hide comments';
                [].forEach.call(document.querySelectorAll('.commentsDb'), function(el) {
                    el.style.display = 'block';
                });
            }
        }

        function confirmDelete() {
            prompt("Do you really want to delete this post? (Input: 'yes' or 'no')");

            var y = 'yes';
            if (y == true) {
                // "Sorry, but I can\'t. It's a nice post - why would you want to delete it anyway?";
                // header("location:index.php");
            }
        }
    </script>
</body>

</html>