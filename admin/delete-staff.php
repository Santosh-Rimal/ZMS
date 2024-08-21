<?php
// Include the configuration file to connect to the database
include('../config/constants.php');

// Check if the ID is set in the URL
if(isset($_GET['id'])) {
    // Get the ID of the staff to be deleted
    $id = $_GET['id'];

    // Create SQL query to delete the staff
    $sql = "DELETE FROM tbl_staff WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully
    if($res == TRUE) {
        // Staff deleted successfully
        $_SESSION['delete'] = "<div class='success'>Staff Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-staff.php');
    } else {
        // Failed to delete staff
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Staff. Try Again Later.</div>";
        header('location:'.SITEURL.'admin/manage-staff.php');
    }
} else {
    // Redirect to Manage Staff page if no ID is provided
    header('location:'.SITEURL.'admin/manage-staff.php');
}
?>
