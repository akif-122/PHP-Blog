<?php include 'header.php';
include ("admin/config.php");
?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->




                <div class="post-container">
                    <?php
                    $userId = $_GET['id'];

                    $sql1 = "SELECT * FROM user WHERE user_id = '$userId' ";
                    $result1 = mysqli_query($conn, $sql1);
                    $row1 = mysqli_fetch_assoc($result1);
                    ?>
                    <h2 class="page-heading"><?php echo $row1["username"] ?></h2>

                    <?php
                    $limit = 2;
                    if (isset($_GET["page"])) {
                        $page = $_GET["page"];
                    } else {
                        $page = 1;
                    }

                    $offset = ($page - 1) * $limit;

                    $sql = "SELECT * FROM post LEFT JOIN user ON post.author = user.user_id LEFT JOIN category ON post.category = category.category_id WHERE user_id = '$userId'  LIMIT $offset, $limit ";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {


                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>

                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo $row["post_id"] ?>"><img
                                                src="admin/upload/<?php echo $row["post_img"] ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a
                                                    href='single.php?id=<?php echo $row["post_id"] ?>'><?php echo $row["title"] ?></a>
                                            </h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a
                                                        href='category.php?cid=<?php echo $row["category_id"] ?>'><?php echo $row["category_name"] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a><?php echo $row["username"] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row["post_date"] ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($row["description"], 0, 70) ?>...
                                            </p>
                                            <a class='read-more pull-right'
                                                href='single.php?id=<?php echo $row["post_id"] ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>


                        <ul class='pagination'>
                            <?php
                            $sql2 = "SELECT * FROM post WHERE author = '$userId'";
                            $result2 = mysqli_query($conn, $sql2);
                            $total_record = mysqli_num_rows($result2);

                            if ($total_record > 0) {
                                $totalPages = ceil($total_record / $limit);

                                $row2 = mysqli_fetch_assoc($result2);

                                if ($page > 1) {
                                    ?>
                                    <li class="<?php echo $active; ?>"><a
                                            href="author.php?id=<?php echo $row2["author"]; ?>&page=<?php echo $page - 1; ?>">Prev</a>
                                    </li>
                                    <?php
                                }


                                for ($i = 1; $i <= $totalPages; $i++) {

                                    if ($i == $page) {
                                        $active = "active";
                                    } else {
                                        $active = "";
                                    }
                                    ?>
                                    <li class="<?php echo $active; ?>"><a
                                            href="author.php?id=<?php echo $row2["author"]; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                    <?php
                                }
                                if ($page < $totalPages) {
                                    ?>
                                    <li class="<?php echo $active; ?>"><a
                                            href="author.php?id=<?php echo $row2["author"]; ?>&page=<?php echo $page + 1; ?>">Next</a>
                                    </li>
                                    <?php
                                }

                            }
                            ?>
                        </ul>
                    <?php } else {
                        echo "<h2>No Record Found</h2>";
                    } ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>