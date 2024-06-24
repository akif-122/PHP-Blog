<?php
include "header.php";
include "./config.php";

if(isset($_SESSION["role"]) && $_SESSION["role"] == 0){
    header("Location: post.php");
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
            </div>
            <div class="col-md-12">
                <?php
                $limit = 2;
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];

                } else {
                    $page = 1;
                }
                $offset = ($page - 1) * $limit;
                $sql = "SELECT * FROM user LIMIT {$offset}, {$limit}";
                $result = mysqli_query($conn, $sql) or die("Getting user query failed");

                if (mysqli_num_rows($result)) {


                    ?>
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Full Name</th>
                            <th>User Name</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>

                            <?php

                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                                <tr>
                                    <td class='id'><?php echo $row['user_id']; ?></td>
                                    <td><?php echo $row["first_name"] . " " . $row["last_name"]; ?></td>
                                    <td><?php echo $row["username"]; ?></td>
                                    <td>
                                        <?php
                                        if ($row["role"] == 1) {
                                            echo "Admin";
                                        } else {
                                            echo "user";
                                        }
                                        ?>
                                    </td>
                                    <td class='edit'><a href='update-user.php?id=<?php echo $row["user_id"]; ?>'><i
                                                class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-user.php?id=<?php echo $row["user_id"]; ?>'><i
                                                class='fa fa-trash-o'></i></a></td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>

                    <?php
                    $sql1 = "SELECT * FROM user";
                    $resul1 = mysqli_query($conn, $sql1);

                    $num = mysqli_num_rows($resul1);

                    if ($num > 0) {
                        $total_record = $num;

                        $totalPages = ceil($total_record / $limit);






                        ?>

                        <ul class='pagination admin-pagination'>
                            <?php
                            if ($page > 1) {

                                ?>
                                <li><a href="users.php?page=<?php echo ($page - 1); ?>">Prev</a></li>

                                <?php
                            }

                            for ($i = 1; $i <= $totalPages; $i++) {

                                if ($page == $i) {
                                    $class = "active";
                                } else {

                                    $class = "";
                                }
                                ?>
                                <li class="<?php echo $class; ?>"><a href="users.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php } ?>

                            <?php
                           
                            if ($totalPages > $page) {


                                ?>
                                <li><a href="users.php?page=<?php echo ($page + 1); ?>">Next</a></li>

                            <?php } ?>

                        </ul>

                        <?php
                    }
                } else {
                    echo "<h2> No User Found </h2>";
                }
                ?>

            </div>
        </div>
    </div>
</div>
<?php include "header.php"; ?>