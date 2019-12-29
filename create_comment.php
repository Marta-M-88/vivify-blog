<?php
ob_start();
?>

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
    <main role="main" class="container">


        <div class="row">
            <div class="form-group col-md-6">

                <form class="form-group" method="POST">
                    Name: <input type="text" name="name" placeholder="Enter your name"> <br> <br>
                    Comment: <br>
                    <textarea name="comment" rows="10" cols="40" placeholder="Enter your comment"></textarea> <br>
                    <br> <br>
                    <button type="submit" class="btn btn-default">Submit</button> <br>
                    <br> <br>
                </form>

            </div>



            <?php
            include('sqlconnection.php');
            $error = '<button class="alert alert-danger" role="alert"> All feilds are required </button>';


            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST["name"];
                $comment = $_POST["comment"];

                if (!empty($_POST["name"]) && !empty($_POST["comment"])) {
                    $post_id = $_GET['id'];

                    $sql = "insert into comments (author, text, post_id) values('$name', '$comment', '$post_id')";
                    $statement = $connection->prepare($sql);
                    $statement->execute();

                    header("Location: http://localhost/root/blog_konacna/single_post.php?id=$post_id");
                    ob_end_flush();
                } else {
                    echo $error;
                }
            }


            if (isset($_GET['id'])) {
                $post_id = $_GET['id'];
            }

            ?>
        </div><!-- /.blog-main -->


        </div><!-- /.row -->
    </main><!-- /.container -->

</body>


</html>


<?php



?>