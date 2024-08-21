<?php
include('partials/menu.php');

// Check if ID is set in the URL
if(isset($_GET['id'])) {
    // Get the ID from URL
    $id = $_GET['id'];

    // SQL query to delete record
    $sql = "DELETE FROM tbl_medicalrecords WHERE record_id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    if($res == TRUE) {
        // Record deleted successfully
        $_SESSION['delete'] = "<div class='success'>Medical Record Deleted Successfully.</div>";
    } else {
        // Failed to delete record
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Medical Record.</div>";
    }

    // Redirect to manage medical records page
    header('location:'.SITEURL.'admin/manage-medicalrecords.php');
} else {
    // ID not set in the URL
    $_SESSION['no-id'] = "<div class='error'>ID Not Set.</div>";
    header('location:'.SITEURL.'admin/manage-medicalrecords.php');
}
?>
