<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Medical Record</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <br><br>
        <form action ="<?php echo $_SERVER['PHP_SELF'];?>" method ="post">
            <table class ="table-30">
                <tr>
                    <th>Field</th>
                    <th>Input</th>
                </tr>
                <tr>
                    <td>Animal ID</td>
                    <td>
                        <input type="text" name="animal_id" placeholder="Enter Animal ID" class="box" required>
                    </td>
                </tr>

                <tr>
                    <td>Check-up Date</td>
                    <td>
                        <input type="date" name="check_up_date" class="box" required>
                    </td>
                </tr>

                <tr>
                    <td>Veterinarian</td>
                    <td>
                        <input type="text" name="veterinarian" placeholder="Enter Veterinarian Name" class="box" required>
                    </td>
                </tr>

                <tr>
                    <td>Diagnosis</td>
                    <td>
                        <textarea name="diagnosis" placeholder="Enter Diagnosis" class="box" required></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Treatment</td>
                    <td>
                        <textarea name="treatment" placeholder="Enter Treatment" class="box" required></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="submit" value="Add Medical Record" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php include('partials/footer.php'); ?>

        <?php
        if(isset($_POST['submit'])) {
            $animal_id = $_POST['animal_id'];
            $check_up_date = $_POST['check_up_date'];
            $veterinarian = $_POST['veterinarian'];
            $diagnosis = $_POST['diagnosis'];
            $treatment = $_POST['treatment'];

            $sql = "INSERT INTO tbl_medicalrecords SET
                animal_id='$animal_id',
                check_up_date='$check_up_date',
                veterinarian='$veterinarian',
                diagnosis='$diagnosis',
                treatment='$treatment'
            ";

            $res = mysqli_query($conn, $sql);

            if($res == TRUE) {
                $_SESSION['add'] = "<div class='success'>Medical Record Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-medicalrecords.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to Add Medical Record.</div>";
                header('location:'.SITEURL.'admin/add-medicalrecords.php');
            }
        }
        ?>
