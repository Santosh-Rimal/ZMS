<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Medical Record</h1>
        <br><br>

        <?php
        // Check if ID is set in the URL
        if(isset($_GET['id'])) {
            $id = $_GET['id']; // Fetch ID from URL

            // Fetch existing data from the database
            $sql = "SELECT * FROM tbl_medicalrecords WHERE record_id=$id"; // Use 'record_id' in the query

            $res = mysqli_query($conn, $sql);

            if($res == TRUE) {
                $count = mysqli_num_rows($res);
                if($count == 1) {
                    // Record found
                    $row = mysqli_fetch_assoc($res);
                    $animal_id = $row['animal_id'];
                    $check_up_date = $row['check_up_date'];
                    $veterinarian = $row['veterinarian'];
                    $diagnosis = $row['diagnosis'];
                    $treatment = $row['treatment'];
                } else {
                    // Record not found
                    $_SESSION['no-record-found'] = "<div class='error'>Record Not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-medicalrecords.php');
                }
            }
        } else {
            // ID not set in the URL
            $_SESSION['no-id'] = "<div class='error'>ID Not Set.</div>";
            header('location:'.SITEURL.'admin/manage-medicalrecords.php');
        }
        ?>

        <?php
        if(isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <br><br>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table class="table-30">
                <tr>
                    <td>Animal ID</td>
                    <td>
                        <input type="text" name="animal_id" value="<?php echo $animal_id; ?>" class="box" required>
                    </td>
                </tr>

                <tr>
                    <td>Check-up Date</td>
                    <td>
                        <input type="date" name="check_up_date" value="<?php echo $check_up_date; ?>" class="box" required>
                    </td>
                </tr>

                <tr>
                    <td>Veterinarian</td>
                    <td>
                        <input type="text" name="veterinarian" value="<?php echo $veterinarian; ?>" class="box" required>
                    </td>
                </tr>

                <tr>
                    <td>Diagnosis</td>
                    <td>
                        <textarea name="diagnosis" class="box" required><?php echo $diagnosis; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Treatment</td>
                    <td>
                        <textarea name="treatment" class="box" required><?php echo $treatment; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Hidden input for record_id -->
                        <input type="submit" name="submit" value="Update Medical Record" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
if(isset($_POST['submit'])) {
    $id = $_POST['id']; // Fetch record_id from the hidden input
    $animal_id = $_POST['animal_id'];
    $check_up_date = $_POST['check_up_date'];
    $veterinarian = $_POST['veterinarian'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];

    $sql = "UPDATE tbl_medicalrecords SET
        animal_id='$animal_id',
        check_up_date='$check_up_date',
        veterinarian='$veterinarian',
        diagnosis='$diagnosis',
        treatment='$treatment'
        WHERE record_id=$id"; // Use 'record_id' in the WHERE clause

    $res = mysqli_query($conn, $sql);

    if($res == TRUE) {
        $_SESSION['update'] = "<div class='success'>Medical Record Updated Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-medicalrecords.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to Update Medical Record.</div>";
        header('location:'.SITEURL.'admin/update-medicalrecord.php?id='.$id);
    }
}
?>
