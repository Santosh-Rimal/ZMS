<?php

include ('../config/constants.php');

$id= $_GET['id'];

$sql = "DELETE FROM tbl_user WHERE id=$id";

$res = mysqli_query($conn, $sql);

if($res==true)
{

    // echo "User Deleted";
    $_SESSION['delete']= "User deleted successfully";

    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    // echo "failed to delete User";
    $_SESSION['delete']="Failed to delete user .Try again later";

    header('location:'.SITEURL.'admin/manage-admin.php');
}
?>