<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">

                <?php
                include "./config.php";
                $limit = 2;
                if (isset($_GET["page"])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }

                $offset = ($page - 1) * $limit;
                $_SESSION["role"];
                $userId = $_SESSION['user_id'];
                if ($_SESSION["role"] == '1') {

                    $sql = "SELECT * FROM post
                 LEFT JOIN category ON post.category = category.category_id
                 LEFT JOIN  user ON post.author = user.user_id LIMIT {$offset}, {$limit}";

                } else {
                    $sql = "SELECT * FROM post
                 LEFT JOIN category ON post.category = category.category_id
                 LEFT JOIN  user ON post.author = user.user_id WHERE post.author = '$userId'  LIMIT {$offset}, {$limit}";
                }

                $result = mysqli_query($conn, $sql);

                $num = mysqli_num_rows($result);

                if ($num > 0) {



                    ?>

                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Author</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {

                                ?>
                                <tr>
                                    <td class='id'><?php echo $row["post_id"]; ?></td>
                                    <td><?php echo $row["title"]; ?></td>
                                    <td><?php echo $row["category_name"]; ?></td>
                                    <td><?php echo $row["post_date"]; ?></td>
                                    <td><?php echo $row["username"]; ?></td>
                                    <td class='edit'><a href='update-post.php?id=<?php echo $row["post_id"] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-post.php?id=<?php echo $row["post_id"] ?>&catId=<?php echo $row["category"] ?>' ><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <ul class='pagination admin-pagination'>
                        <?php
                        if ($_SESSION["role"] == "1") {
                            $sql1 = "SELECT * FROM post";
                        } else {
                            $sql1 = "SELECT * FROM post WHERE author = '$userId'";
                        }
                        $result1 = mysqli_query($conn, $sql1);
                        $num = mysqli_num_rows($result1);

                        $totalPages = ceil(($num / $limit));

                        if ($page > 1) {
                            ?>
                            <li><a href="post.php?page=<?php echo $page - 1; ?>">Prev</a></li>

                            <?php
                        }

                        for ($i = 1; $i <= $totalPages; $i++) {
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = "";
                            }

                            ?>
                            <li class="<?php echo $active ?>"><a href="post.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                            <?php
                        }


                        if ($page < $totalPages) { ?>

                            <li><a href="post.php?page=<?php echo $page + 1; ?>">Next</a></li>
                            <?php
                        }

                        ?>
                    </ul>

                    <?php


                } else {
                    echo "<h2>Post Not Found</h2>";
                }
                ?>

            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>