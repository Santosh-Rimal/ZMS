<?php
ob_start(); // Start output buffering
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Animal</h1>
        </br>

        <?php
        // Check whether the id is set or not
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Query to get the details of the selected animal
            $sql = "SELECT * FROM tbl_animals WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    // Get the details
                    $row = mysqli_fetch_assoc($res);

                    $name = $row['name'];
                    $current_image = $row['image_name'];
                    $category = $row['category'];
                    $species = $row['species'];
                    $breed = $row['breed'];
                    $date_of_birth = $row['date_of_birth'];
                    $health_status = $row['health_status'];
                    $arrival_date = $row['arrival_date'];
                    $gender = $row['gender'];
                    $diet = $row['diet'];
                    $cage_number = $row['cage_number'];
                } else {
                    // Redirect to Manage Animals with session message
                    $_SESSION['no-animal-found'] = "Animal not found";
                    header('location:' . SITEURL . 'admin/manage-animals.php');
                    exit(); // Ensure no further script is executed
                }
            }
        } else {
            // Redirect to Manage Animals
            header('location:' . SITEURL . 'admin/manage-animals.php');
            exit(); // Ensure no further script is executed
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
                    <td><input type="text" name="name" value="<?php echo $name; ?>" class="box"></td>
                </tr>
                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/animal/<?php echo $current_image; ?>" width="100px">
                            <?php
                        } else {
                            echo "No Image";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image</td>
                    <td><input type="file" name="image" accept="image/*"></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category" class="box">
                            <option <?php if ($category == "bird") echo "selected"; ?> value="bird">Bird</option>
                            <option <?php if ($category == "animal") echo "selected"; ?> value="animal">Animal</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Species</td>
                    <td><input type="text" name="species" value="<?php echo $species; ?>" class="box"></td>
                </tr>
                <tr>
                    <td>Breed</td>
                    <td><input type="text" name="breed" value="<?php echo $breed; ?>" class="box"></td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td><input type="date" name="date_of_birth" value="<?php echo $date_of_birth; ?>" class="box"></td>
                </tr>
                <tr>
                    <td>Health Status</td>
                    <td>
                        <select name="health_status" class="box">
                            <option <?php if ($health_status == "healthy") echo "selected"; ?> value="healthy">Healthy</option>
                            <option <?php if ($health_status == "sick") echo "selected"; ?> value="sick">Sick</option>
                            <option <?php if ($health_status == "under_treatment") echo "selected"; ?> value="under_treatment">Under Treatment</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Arrival Date</td>
                    <td><input type="date" name="arrival_date" value="<?php echo $arrival_date; ?>" class="box"></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <select name="gender" class="box">
                            <option <?php if ($gender == "male") echo "selected"; ?> value="male">Male</option>
                            <option <?php if ($gender == "female") echo "selected"; ?> value="female">Female</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Diet</td>
                    <td><input type="text" name="diet" value="<?php echo $diet; ?>" class="box"></td>
                </tr>
                <tr>
                    <td>Cage Number</td>
                    <td><input type="text" name="cage_number" value="<?php echo $cage_number; ?>" class="box"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Animal" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Get all the details from the form
            $id = $_POST['id'];
            $name = $_POST['name'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $species = $_POST['species'];
            $breed = $_POST['breed'];
            $date_of_birth = $_POST['date_of_birth'];
            $health_status = $_POST['health_status'];
            $arrival_date = $_POST['arrival_date'];
            $gender = $_POST['gender'];
            $diet = $_POST['diet'];
            $cage_number = $_POST['cage_number'];

            // Updating new image if selected
            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {
                    // Auto rename the image
                    $ext = end(explode('.', $image_name));
                    $image_name = "Animal-Name-" . rand(0000, 9999) . "." . $ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/animal/" . $image_name;

                    // Upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    if ($upload == false) {
                        $_SESSION['upload'] = "Failed to upload image";
                        header('location:' . SITEURL . 'admin/manage-animals.php');
                        exit();
                    }

                    // Remove the current image if available
                    if ($current_image != "") {
                        $remove_path = "../images/animal/" . $current_image;
                        $remove = unlink($remove_path);

                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "Failed to remove current image";
                            header('location:' . SITEURL . 'admin/manage-animals.php');
                            exit();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            // Create SQL query to update animal
            $sql2 = "UPDATE tbl_animals SET
                name = '$name',
                image_name = '$image_name',
                category = '$category',
                species = '$species',
                breed = '$breed',
                date_of_birth = '$date_of_birth',
                health_status = '$health_status',
                arrival_date = '$arrival_date',
                gender = '$gender',
                diet = '$diet',
                cage_number = '$cage_number'
                WHERE id=$id";

            // Execute the query
            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                $_SESSION['update'] = "Animal updated successfully";
                header('location:' . SITEURL . 'admin/manage-animals.php');
            } else {
                $_SESSION['update'] = "Failed to update animal";
                header('location:' . SITEURL . 'admin/manage-animals.php');
            }
            exit();
        }
        ?>
    </div>
</div>

<?php
ob_end_flush(); // Flush the output buffer and turn off output buffering
include('partials/footer.php');
?>
