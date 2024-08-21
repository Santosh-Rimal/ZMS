<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br/>

       <?php
        if(isset($_SESSION['add']))
    {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }

    if(isset($_SESSION['upload']))
    {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }
    ?>
    <br/>
    <br/>
     

         <form action = ""method ="post" enctype="multipart/form-data">
            <table class ="table-30">
            <tr>
            <th>Field</th>
            <th>Input</th>
            </tr>
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="category title" class="box">
                    </td>
               </tr>

               <tr>
                    <td>Upload Image</td>
                    <td>
                        <input type="file" name="image"  class="">
                    </td>
               </tr>

               <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" class="">Yes
                        <input type="radio" name="featured" value="No" class="">No
                    </td>
               </tr>

               <tr>
                    <td>Active</td>
                    <td>
                    <input type="radio" name="active" value="Yes" class="">Yes
                    <input type="radio" name="active" value="No" class="">No
                    </td>
               </tr>
                
               <tr>
               <td colspan="2" style="text-align: center;">
                    <input type="submit" name="submit" value="Add category" class="btn-secondary">
                </td>
           </tr>
</table>
</form>

<?php

            if(isset($_POST['submit']))
            {
             //get value from category form
            $title= $_POST['title'];

            //for radio input
            if(isset($_POST['featured']))
            {
                $featured=$_POST['featured'];
            }
            else{
                $featured="No";
            }


            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else{
                $active="No";
            }

            //image selected or not
            if(isset($_FILES['image']['name']))
            {
                $image_name= $_FILES['image']['name'];

                //upload image only if img is selected
                if($image_name!="")
                {
                    
                
                //Auto rename of image
                $ext = end(explode('.',$image_name));
                $image_name ="Animal-category".rand(000,999).'.'.$ext;


                $source_path= $_FILES['image']['tmp_name'];

                $destination_path= "../images/category/".$image_name;

                $upload= move_uploaded_file($source_path, $destination_path);
                
                if($upload==false)
                {
                    $_SESSION['upload']="Failed to upload image";

                    header('location:'.SITEURL.'admin/add-category.php');

                    die();
                }
            }
            }
            else
            {
                $image_name="";
            }

            //create sql query to insert category
            $sql= "INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";
             
             //execute sql query and save in database
            $res= mysqli_query($conn, $sql);

            if($res==true)
            {
                $_SESSION['add']="Category added successfully";

                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
             $_SESSION['add']="Failed to add category";

                header('location:'.SITEURL.'admin/manage-category.php');
            }
            
            }
            ?>
</div>
</div>
<?php include('partials/footer.php'); ?>