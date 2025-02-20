<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">

                <?php
                include ("./config.php");
                $postId = $_GET["id"];
                $sql = "SELECT * FROM post WHERE post_id = '$postId'";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {


                    ?>
                    <!-- Form for show edit-->
                    <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="form-group">
                            <input type="hidden" name="post_id" class="form-control" value="<?php echo $row["post_id"] ?>"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputTile">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputUsername"
                                value="<?php echo $row["title"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> Description</label>
                            <textarea name="description" class="form-control" required
                                rows="5"><?php echo $row["description"] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCategory">Category</label>
                            <select class="form-control" name="category">
                                <?php
                                $sql1 = "SELECT * FROM category";
                                $result1 = mysqli_query($conn, $sql1);
                                while ($row1 = mysqli_fetch_assoc($result1)) {

                                    if($row["category"] == $row1["category_id"]){
                                        $selected = "selected";
                                    }else{
                                        $selected = "";
                                    }

                                    ?>
                                    <option <?php echo $selected ?>  value="<?php echo $row1["category_id"] ?>"><?php echo $row1["category_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Post image</label>
                            <input type="file" name="new-image">
                            <input type="hidden" value="<?php echo $row["post_img"]; ?>" name="old-img" >
                            <img src="upload/<?php echo $row["post_img"] ?>" height="150px">
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                    </form>
                    <!-- Form End -->
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>