<?php include ('partials/menu.php');?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update User</h1>
        <br/>
        <br/>

        <?php

        $id=$_GET['id'];

        $sql="SELECT * FROM tbl_user WHERE id=$id";

        $res=mysqli_query($conn,$sql);

        if($res==true)
        {

            $count= mysqli_num_rows($res);

            if($count==1)
            {
                $row=mysqli_fetch_assoc($res);

                $full_name= $row['full_name'];
                $username= $row['username'];
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        ?>

        <br/>
        <br/>


        <form action ="" method ="POST">

        <table class="table-30">
            <tr>
                <td>Full Name:</td>
                <td>
                    <input type="text" name="full_name" class="box" value="<?php echo $full_name; ?>">
                </td>
            </tr>

            <tr>
                <td>UserName:</td>
                <td>
                    <input type="text" name="username" class="box" value="<?php echo $username; ?>">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                <input type="text" name="id" value="<?php echo $id; ?>">
                    <input type ="submit" name="submit" value="Update User" class="btn-secondary">
                </td>
            </tr>

        </table>
      </form>
    </div>
</div>

<?php


if(isset($_POST['submit']))
{

   $id =$_POST['id'];
   $full_name=$_POST['full_name'];
   $username=$_POST['username'];
    
    

    //sql query to update table
    $sql="UPDATE tbl_user SET
    full_name ='$full_name',
    username ='$username'
    WHERE id='$id'
    ";

    $res= mysqli_query($conn, $sql);
    
//     $res= mysqli_query($conn, $sql) or die(mysqli_error());
//    die();
    
    if ($res==TRUE)
    {

        $_SESSION['update'] = "User Update successfully";

        header ('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{

        $_SESSION['update']= "Failed to update user";

        header ('location:'.SITEURL.'admin/manage-admin.php');
    }
}
?>

<?php include ('partials/footer.php');?>
