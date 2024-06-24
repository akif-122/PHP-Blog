<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    if (isset($_GET["cid"])) {
                        $cid = $_GET["cid"];

                        $limit = 3;
                        if (isset($_GET['page'])) {
                            $page = $_GET["page"];
                        } else {
                            $page = 1;
                        }

                        $offset = ($page - 1) * $limit;

                        $sql = "SELECT * FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post.category = '$cid' LIMIT $offset, $limit ";

                        $result = mysqli_query($conn, $sql) or die("Query failed");

                        $num = mysqli_num_rows($result);




                        $sql2 = "SELECT * FROM category WHERE category_id = '$cid'";
                        $result2= mysqli_query($conn, $sql2);

                        $row2 = mysqli_fetch_assoc($result2);

                        ?>
                        <h2 class="page-heading"><?php echo $row2["category_name"] ?></h2>

                        <?php
                        if ($num > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                                ?>
                                <div class="post-content">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a class="post-img" href="single.php?id=<?php echo $row["post_id"] ?>"><img src="admin/upload/<?php echo $row["post_img"]; ?>" alt="" /></a>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="inner-content clearfix">
                                                <h3><a href='single.php?id=<?php echo $row["post_id"] ?>'><?php echo $row["title"] ?></a>
                                                </h3>
                                                <div class="post-information">
                                                    <span>
                                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                                        <a><?php echo $row["category_name"] ?></a>
                                                    </span>
                                                    <span>
                                                        <i class="fa fa-user" aria-hidden="true"></i>
                                                        <a href='author.php?id=<?php echo $row["user_id"] ?>'><?php echo $row["username"] ?></a>
                                                    </span>
                                                    <span>
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                        <?php echo $row["post_date"] ?>
                                                    </span>
                                                </div>
                                                <p class="description">
                                                    <?php echo $row["description"] ?>
                                                </p>
                                                <a class='read-more pull-right' href='single.php?id=<?php echo $row["post_id"] ?>'>read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php }
                        } ?>


                        <ul class='pagination'>
                            <?php
                            $sql1 = "SELECT * FROM post WHERE category = '$cid'";
                            $result1 = mysqli_query($conn, $sql1);
                            $total_record = mysqli_num_rows($result1);

                            if ($total_record > 0) {
                                $totalPages = ceil($total_record / $limit);
                                for ($i = 1; $i <= $totalPages; $i++) {

                                    if($i == $page){
                                        $active = "active";
                                    }else{
                                        $active = "";
                                    }

                                    ?>
                                    <li class="<?php echo $active; ?>"><a href="category.php?cid=<?php echo $cid; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php
                                }

                            }
                            ?>

                        </ul>
                    <?php } ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>