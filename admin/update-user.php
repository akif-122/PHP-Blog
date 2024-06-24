<?php include "header.php"; 
    include "./config.php";


    if(isset($_POST["submit"])){
        $id = mysqli_real_escape_string($conn, $_POST["user_id"]);
        $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
        $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $role = mysqli_real_escape_string($conn, $_POST["role"]);


        $sql1 = "UPDATE user SET first_name = '$fname', last_name='$lname', username='$username', role='$role' WHERE user_id = '$id' ";
        $result = mysqli_query($conn, $sql1) or die("Update query failed");

        if($result){
            header("Location: users.php");
        }
        
        
    }
    
    
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>

            <?php
            $user_id = $_GET["id"];
            $sql = "SELECT * FROM user WHERE user_id = '$user_id' ";
            $result = mysqli_query($conn, $sql) or die("Getting user query failed");

            while ($row = mysqli_fetch_assoc($result)) {

                ?>

                <div class="col-md-offset-4 col-md-4">
                    <!-- Form Start -->
                    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                        <div class="form-group">
                            <input type="hidden" name="user_id" class="form-control" value="<?php echo $row["user_id"]; ?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="fname" class="form-control" value="<?php echo $row["first_name"]; ?>" placeholder="" >
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lname" class="form-control" value="<?php echo $row["last_name"]; ?>" placeholder="" >
                        </div>
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $row["username"]; ?>" placeholder="" >
                        </div>
                        <div class="form-group">
                            <label>User Role</label>
                            <select class="form-control" name="role" value="<?php echo $row['role']; ?>">

                                <?php
                                    $selected = null;
                                    
                                    if($row['role'] == 1){
                                        $selected = "selected";
                                        echo "<option  value='0'>normal User</option>";
                                        echo "<option {$selected} value='1'>Admin</option>";
                                    }else{
                                        echo "<option {$selected} value='0'>normal User</option>";
                                        echo "<option  value='1'>Admin</option>";
                                    }

                                ?>
                                
                                
                            </select>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Update"  />
                    </form>
                    <!-- /Form -->
                </div>

            <?php } ?>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>