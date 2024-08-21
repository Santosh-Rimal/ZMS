<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br/><br/>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="POST">
            <table class="table-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password" class="box1">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password" class="box1">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" class="box1">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

if (isset($_POST['submit'])) {
    // Get form data
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);  

    // Check if the current password is correct
    $sql = "SELECT * FROM tbl_user WHERE id='$id' AND password='$current_password'";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            // Check if new password and confirm password match
            if ($new_password == $confirm_password) {
                // Update the password
                $sql2 = "UPDATE tbl_user SET password='$new_password' WHERE id='$id'";
                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == true) {
                    $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully.</div>";
                } else {
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to change password.</div>";
                }
            } else {
                $_SESSION['pwd-not-match'] = "<div class='error'>Passwords did not match.</div>";
            }
        } else {
            $_SESSION['user-not-found'] = "<div class='error'>User not found.</div>";
        }
    }

    // Redirect to the manage admin page with a session message
    header('location:'.SITEURL.'admin/manage-admin.php');
}

?>

<?php include('partials/footer.php'); ?>
