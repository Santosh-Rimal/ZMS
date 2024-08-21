<?php include('partials/menu.php'); ?>
<div class="main-content">
<div class="wrapper">
</br>
   <?php
     if(isset($_SESSION['upload']))
    {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }

    if(isset($_SESSION['add']))
    {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    ?>

<form action="" method="post" enctype="multipart/form-data">
    <table class="table-30">
        <tr>
            <th>Field</th>
            <th>Input</th>
        </tr>
        <tr>
            <td>Name</td>
            <td><input type="text" name="name" class="box"></td>
        </tr>
        <tr>
            <td>Image</td>
            <td><input type="file" name="image" accept="image/*"></td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
                <select name="category" class="box">
                    <option value="bird">Bird</option>
                    <option value="animal">Animal</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Species</td>
            <td><input type="text" name="species" class="box"></td>
        </tr>
        <tr>
            <td>Breed</td>
            <td><input type="text" name="breed" class="box"></td>
        </tr>
        <tr>
            <td>Date of Birth</td>
            <td><input type="date" name="date_of_birth" class="box"></td>
        </tr>
        <tr>
            <td>Health Status</td>
            <td>
                <select name="health_status" class="box">
                    <option value="healthy">Healthy</option>
                    <option value="sick">Sick</option>
                    <option value="under_treatment">Under Treatment</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Arrival Date</td>
            <td><input type="date" name="arrival_date" class="box"></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>
                <select name="gender" class="box">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Diet</td>
            <td><input type="text" name="diet" class="box"></td>
        </tr>
        <tr>
            <td>Cage Number</td>
            <td><input type="text" name="cage_number" class="box"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" name="submit" value="Add Animals" class="btn-secondary">
            </td>
        </tr>
    </table>
</form>

<?php
if(isset($_POST['submit']))
{
    // Get form data
    $name = $_POST['name'];
    $category = $_POST['category'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $date_of_birth = $_POST['date_of_birth'];
    $health_status = $_POST['health_status'];
    $arrival_date = $_POST['arrival_date'];
    $gender = $_POST['gender'];
    $diet = $_POST['diet'];
    $cage_number = $_POST['cage_number'];

    // Handle image upload
    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "")
    {
        $image_name = $_FILES['image']['name'];

        // Get the extension of the image (jpg, png, etc.)
        $ext = end(explode('.', $image_name));

        // Rename the image
        $image_name = "Animal-Name-".rand(0000,9999).".".$ext;

        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/animal/".$image_name;

        // Finally upload the image
        $upload = move_uploaded_file($source_path, $destination_path);

        if($upload == false)
        {
            $_SESSION['upload'] = "Failed to upload image";
            header('location:'.SITEURL.'admin/add-animals.php');
            die();
        }
    }
    else
    {
        $image_name = "";
    }

    // Create SQL query to insert data into database
    $sql = "INSERT INTO tbl_animals SET
        name='$name',
        image_name='$image_name',
        category='$category',
        species='$species',
        breed='$breed',
        date_of_birth='$date_of_birth',
        health_status='$health_status',
        arrival_date='$arrival_date',
        gender='$gender',
        diet='$diet',
        cage_number='$cage_number'";

    // Execute query
    $res = mysqli_query($conn, $sql);

    // Check whether data is inserted or not and display appropriate message
    if($res == true)
    {
        $_SESSION['add'] = "Animals details added successfully";
        header('location:'.SITEURL.'admin/manage-animals.php');
    }
    else
    {
        $_SESSION['add'] = "Failed to add Animals";
        header('location:'.SITEURL.'admin/manage-animals.php');
    }
}
?>
</div>
</div>

<?php include('partials/footer.php'); ?>
