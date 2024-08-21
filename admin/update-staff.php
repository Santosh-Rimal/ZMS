<?php 
include('partials/menu.php'); 

// Check if the ID is set
if(isset($_GET['id'])) {
    // Get the ID and retrieve the details
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_staff WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    
    if($res == TRUE) {
        $count = mysqli_num_rows($res);

        if($count == 1) {
            // Get the staff details
            $row = mysqli_fetch_assoc($res);

            $full_name = $row['full_name'];
            $position = $row['position'];
            $hire_date = $row['hire_date'];
            $contact_number = $row['contact_number'];
            $email = $row['email'];
            $enclosure_id = $row['enclosure_id'];
        } else {
            // Redirect to Manage Staff page with message
            $_SESSION['no-staff-found'] = "<div class='error'>Staff Not Found.</div>";
            header('location:'.SITEURL.'admin/manage-staff.php');
        }
    }
} else {
    // Redirect to Manage Staff page
    header('location:'.SITEURL.'admin/manage-staff.php');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Staff</h1>
        <br/><br/>

        <form action="" method="post">
            <table class="table-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>" class="box" required>
                    </td>
                </tr>

                <tr>
                    <td>Position: </td>
                    <td>
                        <input type="text" name="position" value="<?php echo $position; ?>" class="box"  required>
                    </td>
                </tr>

                <tr>
                    <td>Hire Date: </td>
                    <td>
                        <input type="date" name="hire_date" value="<?php echo $hire_date; ?>" class="box"  required>
                    </td>
                </tr>

                <tr>
                    <td>Contact Number: </td>
                    <td>
                        <input type="text" name="contact_number" value="<?php echo $contact_number; ?>" class="box" required>
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email" name="email" value="<?php echo $email; ?>" class="box" required>
                    </td>
                </tr>

                <tr>
                    <td>Enclosure ID: </td>
                    <td>
                        <input type="text" name="enclosure_id" value="<?php echo $enclosure_id; ?>" class="box" required>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Staff" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        if(isset($_POST['submit'])) {
            // Get all the values from the form
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $position = $_POST['position'];
            $hire_date = $_POST['hire_date'];
            $contact_number = $_POST['contact_number'];
            $email = $_POST['email'];
            $enclosure_id = $_POST['enclosure_id'];

            // SQL query to update staff details
            $sql2 = "UPDATE tbl_staff SET 
                full_name = '$full_name',
                position = '$position',
                hire_date = '$hire_date',
                contact_number = '$contact_number',
                email = '$email',
                enclosure_id = '$enclosure_id'
                WHERE id=$id
            ";

            // Execute the query
            $res2 = mysqli_query($conn, $sql2);

            // Check whether the query executed successfully
            if($res2 == TRUE) {
                // Update successful
                $_SESSION['update'] = "<div class='success'>Staff Updated Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-staff.php');
            } else {
                // Failed to update staff
                $_SESSION['update'] = "<div class='error'>Failed to Update Staff.</div>";
                header('location:'.SITEURL.'admin/manage-staff.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
