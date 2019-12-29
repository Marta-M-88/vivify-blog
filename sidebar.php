<aside class="col-sm-3 ml-sm-auto blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
        <h4>Latest posts</h4>
        <?php
        include('sqlconnection.php');


        $sql = "SELECT title, id FROM posts ORDER BY created_at DESC";
        $statement = $connection->prepare($sql);
        $statement->execute(); //execute-uje upit
        $titles = $statement->fetchAll(); //cuva rez u var 

        //var_dump($titles);

        $i = 0;
        foreach ($titles as $title) {
            if (isset($title['title'])) {
        ?>
                <a href="single_post.php?id=<?php echo $title['id']; ?>">
                    <h5 class="sidebar-title"> <?php echo $title['title']; ?> </h5>
                </a>
        <?php
                if ($i++ == 4) break;
            }
        }
        ?>
    </div>




</aside><!-- /.blog-sidebar -->