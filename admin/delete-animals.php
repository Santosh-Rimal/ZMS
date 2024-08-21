<?php

include('../config/constants.php');


if(isset($_GET['id']) && isset($_GET['image_name'])) {
  
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if($image_name != "") {
        
        $path = "../images/animal/" . $image_name;
        
        $remove = unlink($path);

        
        if($remove == false) {
            
            $_SESSION['remove'] = "<div class='error'>Failed to remove animal image.</div>";
         
            header('location:' . SITEURL . 'admin/manage-animals.php');
           
            exit();
        }
    }

 
    $sql = "DELETE FROM tbl_animals WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    
    if($res == true) {
        
        $_SESSION['delete'] = "<div class='success'>Animal deleted successfully.</div>";
    } else {
       
        $_SESSION['delete'] = "<div class='error'>Failed to delete animal. Try again later.</div>";
    }


    header('location:' . SITEURL . 'admin/manage-animals.php');
} else {
    
    header('location:' . SITEURL . 'admin/manage-animals.php');
}
?>
