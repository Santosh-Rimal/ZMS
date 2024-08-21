<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Staff</h1>
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
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Staff Full Name" class="box">
                    </td>
               </tr>

               <tr>
                    <td>Position</td>
                    <td>
                        <input type="text" name="position" placeholder="Enter Position" class="box">
                    </td>
               </tr>

               <tr>
                    <td>Hire Date:</td>
                    <td>
                        <input type="date" name="hire_date" class="box">
                    </td>
               </tr>

               <tr>
                    <td>Email:</td>
                    <td>
                    <input type="email" name="email" id="email" placeholder="Enter Email Address" class="box" required>
                    </td>
               </tr>

               <tr>
                    <td>Contact Number:</td>
                    <td>
                    <input type="text" name="contact_number" id="contact_number" placeholder="Enter Contact Number" class="box" required>
                    </td>
               </tr>

               <tr>
                    <td>Enclosure ID:</td>
                    <td>
                    <input type="text" name="enclosure_id" id="enclosure_id" placeholder="Enter Enclosure ID" class="box" required>
                    </td>
               </tr>

               <tr>
               <td colspan="2" style="text-align: center;">
                    <input type="submit" name="submit" value="Add Staff" class="btn-secondary">
                </td>
           </tr>
</table>
</form>

<?php include('partials/footer.php'); ?>

<?php
if(isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $position = $_POST['position'];
    $hire_date = $_POST['hire_date'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $enclosure_id = $_POST['enclosure_id'];

    $sql = "INSERT INTO tbl_staff SET
        full_name='$full_name',
        position='$position',
        hire_date='$hire_date',
        email='$email',
        contact_number='$contact_number',
        enclosure_id='$enclosure_id'
    ";

    $res = mysqli_query($conn, $sql);

    if($res == TRUE) {
        $_SESSION['add'] = "<div class='success'>Staff Added Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-staff.php');
    } else {
        $_SESSION['add'] = "<div class='error'>Failed to Add Staff.</div>";
        header('location:'.SITEURL.'admin/add-staff.php');
    }
}
?>
