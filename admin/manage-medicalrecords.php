<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Medical Records</h1>
        <br><br>

        <?php
        if(isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

              <br/><br/>
              <a href="add-medicalrecords.php" class="btn-secondary">Add Records</a>

        <br><br>
        <table class="tbl-full">
            <tr>
                <th>Record_Id</th>
                <th>Animal ID</th>
                <th>Check-up Date</th>
                <th>Veterinarian</th>
                <th>Diagnosis</th>
                <th>Treatment</th>
                <th>Actions</th>
            </tr>

            <?php
            // Fetch records from the database
            $sql = "SELECT * FROM tbl_medicalrecords";
            $res = mysqli_query($conn, $sql);

            // Count rows
            $count = mysqli_num_rows($res);
            $sn = 1; // Serial Number

            if($count > 0) {
                // Records found
                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['record_id'];
                    $animal_id = $row['animal_id'];
                    $check_up_date = $row['check_up_date'];
                    $veterinarian = $row['veterinarian'];
                    $diagnosis = $row['diagnosis'];
                    $treatment = $row['treatment'];

                    ?>

                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $animal_id; ?></td>
                        <td><?php echo $check_up_date; ?></td>
                        <td><?php echo $veterinarian; ?></td>
                        <td><?php echo $diagnosis; ?></td>
                        <td><?php echo $treatment; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-medicalrecords.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-medicalrecords.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
                        </td>
                    </tr>

                    <?php
                }
            } else {
                // No records found
                echo "<tr><td colspan='7' class='error'>No Medical Records Found.</td></tr>";
            }
            ?>

        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
