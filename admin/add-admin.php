<?php 
include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add User</h1>
        <br/>
        <br/>

        <?php
        if(isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table class="table-30">
                <tr>
                    <th>Field</th>
                    <th>Input</th>
                </tr>
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter full Name" class="box" required>
                    </td>
                </tr>
                <tr>
                    <td>UserName</td>
                    <td>
                        <input type="text" name="username" placeholder="Enter User Name" class="box" required>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter password" class="box" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add User" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            
            $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

           
            $sql = "INSERT INTO tbl_user (full_name, username, password) VALUES ('$full_name', '$username', '$password')";

           
            $res = mysqli_query($conn, $sql);

            if ($res) {
                $_SESSION['add'] = "User added successfully";
                header('location:' . SITEURL . 'admin/manage-admin.php');
                exit(); 
            } 
            else 
            {
                $_SESSION['add'] = "Failed to add user data";
                header('location:' . SITEURL . 'admin/add-admin.php');
                exit(); 
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
