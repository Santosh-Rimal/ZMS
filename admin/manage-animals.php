<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Animals</h1>
        </br>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['remove']))
         {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['upload']))
        {
           echo $_SESSION['upload'];
           unset($_SESSION['upload']);
       }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <br/>
    </br>
        <a href="<?php echo SITEURL; ?>admin/add-animals.php" class="btn-secondary">Add Animals</a>
        <br/>
        <br/>

        <table class="table-full">
            <tr>
                <th>S.N</th>
                <th>Name</th>
                <th>Image</th>
                <th>Category</th>
                <th>Species</th>
                <th>Breed</th>
                <th>Date of Birth</th>
                <th>Health Status</th>
                <th>Arrival Date</th>
                <th>Gender</th>
                <th>Diet</th>
                <th>Cage Number</th>
                <th>Actions</th>
            </tr>

            <?php
            // Query to get all animals from the database
            $sql = "SELECT * FROM tbl_animals";
            $res = mysqli_query($conn, $sql);

            if($res == true)
            {
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $name = $row['name'];
                        $image_name = $row['image_name'];
                        $category = $row['category'];
                        $species = $row['species'];
                        $breed = $row['breed'];
                        $date_of_birth = $row['date_of_birth'];
                        $health_status = $row['health_status'];
                        $arrival_date = $row['arrival_date'];
                        $gender = $row['gender'];
                        $diet = $row['diet'];
                        $cage_number = $row['cage_number'];
                        ?>

                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $name; ?></td>
                            <td>
                                <?php 
                                if($image_name != "")
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/animal/<?php echo $image_name; ?>" width="100px">
                                    <?php
                                }
                                else
                                {
                                    echo "No Image";
                                }
                                ?>
                            </td>
                            <td><?php echo $category; ?></td>
                            <td><?php echo $species; ?></td>
                            <td><?php echo $breed; ?></td>
                            <td><?php echo $date_of_birth; ?></td>
                            <td><?php echo $health_status; ?></td>
                            <td><?php echo $arrival_date; ?></td>
                            <td><?php echo $gender; ?></td>
                            <td><?php echo $diet; ?></td>
                            <td><?php echo $cage_number; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-animals.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?> &image_name=<?php echo $image_name; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>

                        <?php
                    }
                }
                else
                {
                    echo "<tr><td colspan='13' class='error'>No Animals Added Yet</td></tr>";
                }
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
