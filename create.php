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

                <form class="form" method="POST" action="">
                    Author: <input type="text" name="author" placeholder="Your name"> <br> <br>
                    Title: <input type="text" name="title" placeholder="Post title"> <br> <br>
                    New post: <br>
                    <textarea name="body" rows="10" cols="70" placeholder="Post content"></textarea> <br>
                    <br> <br>
                    <button type="submit" class="btn btn-default">Submit</button> <br>
                    <br> <br>
                </form>


                <?php

                include('sqlconnection.php');

                $error = " ";
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $author = $_POST['author'];
                    $title = $_POST['title'];
                    $body = $_POST['body'];

                    if (empty($_POST['author']) || empty($_POST['title']) || empty($_POST['body'])) {
                        echo $error = "<strong>*All fields are required</strong>";
                    } else {
                        //var_dump($title);
                        $sql = "INSERT INTO posts (title, body, author) VALUES ('$title', '$body', '$author')";
                        $statement = $connection->prepare($sql);
                        $statement->execute();
                        header("Location: http://localhost/root/blog_konacna/index.php");
                    }
                }

                ?>
            </div><!-- /.blog-main -->
            <?php include_once('sidebar.php'); ?>

        </div><!-- /.row -->

    </main><!-- /.container -->
    <?php include_once('footer.php'); ?>
</body>


</html>