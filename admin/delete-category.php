<?php
    // Include constants.php for SITEURL and database connection
    include('../config/constants.php');

    // Check if the id and image_name are set in the URL
    if(isset($_GET['id']) AND isset($_GET['image_name']))
     {
        // Get the ID and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file if it is available
        if($image_name != "")
         {
            // Image path
            $path = "../images/category/".$image_name;

            // Remove the image file
            $remove = unlink($path);

            // If failed to remove image then add an error message and stop the process
            if($remove == false) {
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                // Redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
        }

        // Delete data from database
          $sql = "DELETE FROM tbl_category WHERE id=$id";
          $res = mysqli_query($conn, $sql);

        // Check if the data is deleted from the database
        if($res == true)
         {
            
            $_SESSION['delete'] = "Category deleted successfully.";
            header('location:'.SITEURL.'admin/manage-category.php');
        } 
        else
         {
            
            $_SESSION['delete'] = "<Failed to delete category.";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    } 
    else
     {
        // Redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>
