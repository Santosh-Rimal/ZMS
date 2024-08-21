<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Staff</h1>
        <br/>

        <?php
        if(isset($_SESSION['add'])) 
        {
            echo $_SESSION['add']; 
            unset($_SESSION['add']); 
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

        if(isset($_SESSION['user-not-found'])) 
        {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }
        ?>
        <br/>
        <br/>

        <a href="add-staff.php" class="btn-secondary">Add Staff</a>
        <br/><br/>
        
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Position</th>
                <th>Hire Date</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Enclosure ID</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_staff";
            $res = mysqli_query($conn, $sql);
           
            if($res == TRUE) {
                $count = mysqli_num_rows($res);
                $sn = 1;

                if($count > 0) {
                    // We have data in the database
                    while($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $position = $rows['position'];
                        $hire_date = $rows['hire_date'];
                        $contact_number = $rows['contact_number'];
                        $email = $rows['email'];
                        $enclosure_id = $rows['enclosure_id'];
                        ?>
            
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $position; ?></td>
                            <td><?php echo $hire_date; ?></td>
                            <td><?php echo $contact_number; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $enclosure_id; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-staff.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-staff.php?id=<?php echo $id; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>

                        <?php
                    }
                } 
                else
                 {
                    // No data in the database
                    echo "<tr><td colspan='8' class='error'>No Staff Added Yet.</td></tr>";
                }
            }
            ?>

        </table>

        <div class="clearfix"></div>
    </div>
</div>

<?php include('partials/footer.php'); ?>
