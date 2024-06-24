<?php include 'header.php';
include ("admin/config.php");
?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php
                $search_query = $_GET["search"];
                ?>
                <!-- post-container -->
                <div class="post-container">
                    <h2 class="page-heading">Search : <?php echo $search_query; ?></h2>

                    <?php
                    $sql = "SELECT * FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author =  user.user_id WHERE post.title LIKE '%{$search_query}%'";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {


                            ?>


                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo $row["post_id"] ?>"><img src="admin/upload/<?php echo $row["post_img"] ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $row["post_id"] ?>'><?php echo $row["title"] ?></a>
                                            </h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cid=<?php echo $row["category_id"] ?>'><?php echo $row["category_name"] ?></a>
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
                                            <?php echo substr($row["description"], 0, 70) ?>...
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $row["post_id"]  ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                        <ul class='pagination'>
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                        </ul>
                    <?php } else {
                        echo "No record Found";
                    } ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>