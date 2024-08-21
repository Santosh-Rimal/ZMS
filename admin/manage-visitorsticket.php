<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add visitors Ticket</h1>

        <?php 
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add']; // Display session message
                unset($_SESSION['add']); // Remove session message
            }
        ?>
        <br/>
        <br/>

        <form action="" method="POST">
            <table class="table-30">
                <tr>
                    <td>Visitor ID:</td>
                    <td>
                        <input type="number" name="visitor_id" placeholder="Enter Visitor ID" class="box" required>
                    </td>
                </tr>
                <tr>
                    <td>Purchase Date:</td>
                    <td>
                        <input type="date" name="purchase_date" value="<?php echo date('Y-m-d'); ?>" class="box" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Purchase Time:</td>
                    <td>
                        <?php
                        $nepal_timezone = new DateTimeZone('Asia/Kathmandu');
                        $nepal_time = new DateTime('now', $nepal_timezone);
                        $purchase_time = $nepal_time->format('H:i:s');
                        ?>
                        <input type="time" name="purchase_time" value="<?php echo $purchase_time; ?>" class="box" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Ticket Type:</td>
                    <td>
                         <select name="ticket_type" id="ticket_type" class="box" required onchange="setPrice()">
                           <option value="normal" data-price="300">Normal (₹)</option>
                            <option value="child" data-price="150">Child (₹)</option>
                           <option value="student_card" data-price="250">Student Card (₹)</option>
                           <option value="foreigners_adult" data-price="10">Foreigners Adult ($)</option>
                           <option value="foreigners_child" data-price="7">Foreigners Child ($)</option>
                         </select>
                     </td>

                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" id="price" placeholder="Enter Price" class="box" required readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Ticket" class="btn-secondary">
                    </td>
                    <td>
                        <a href="#">
                            <img src="../images/icon.png" alt="icon" class="logo">
                        </a>
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            // Check if the form is submitted
            if(isset($_POST['submit'])) {
                // Get the form data
                $visitor_id = $_POST['visitor_id'];
                $purchase_date = date('Y-m-d'); // Automatically set today's date
                $purchase_time = $nepal_time->format('H:i:s'); // Nepali current time
                $ticket_type = $_POST['ticket_type'];
                $price = $_POST['price'];

                // SQL query to insert the data into the database
                $sql = "INSERT INTO tbl_tickets SET 
                    visitors_id='$visitor_id',
                    purchase_date='$purchase_date',
                    purchase_time='$purchase_time',
                    ticket_type='$ticket_type',
                    price='$price'";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Check if the data is inserted
                if($res == TRUE) {
                    // Data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Ticket Added Successfully.</div>";
                    echo "<script>alert('Ticket Added Successfully.');</script>";
                } else {
                    // Failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Ticket.</div>";
                    echo "<script>alert('Ticket Added Successfully.');</script>";
                }
            }
            ?>

        <script>
            function setPrice() {
                var ticketType = document.getElementById("ticket_type");
                var selectedOption = ticketType.options[ticketType.selectedIndex];
                var price = selectedOption.getAttribute("data-price");
                document.getElementById("price").value = price;
            }

            // Set the initial price when the page loads
            document.addEventListener("DOMContentLoaded", function() {
                setPrice();
            });
        </script>

    </div>
</div>

<?php include('partials/footer.php'); ?>
