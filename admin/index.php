<?php include ('partials/menu.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Zoo Management System</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assuming you have a CSS file linked -->
</head>
<body>
    <div class="admin-dashboard">
        <div class="sidebar">
            <h1>Admin Dashboard</h1>
            <ul>
                <li><a href="#" data-content="total-animals">Manage Animals</a>
                    <ul class="sub-menu">
                        <li><a href="#" data-content="total-animals">Total Numbers of Animals Inside Zoo</a></li>
                        <li><a href="#" data-content="animals-added">Total Numbers of Animals Added Today</a></li>
                    </ul>
                </li>
                </li>
                <li><a href="manage-staff.php">Manage Staff</a></li>
                <li><a href="#">Tickets</a>
                    <ul class="sub-menu">
                        <li><a href="#">Normal Tickets</a>
                            <ul class="sub-sub-menu">
                                <li><a href="normal-ticket.php">Normal Adult</a></li>
                                <li><a href="child-ticket.php">Child</a></li>
                                <li><a href="child-ticket.php">Student</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Foreigners Tickets</a>
                            <ul class="sub-sub-menu">
                                <li><a href="foreigner-adult-ticket.php">Foreigner Adult</a></li>
                                <li><a href="foreigner-child-ticket.php">Foreigner Child</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="manage-reports.php">Manage Reports</a></li>
                <li><a href="settings.php">Settings</a></li>
            </ul>
        </div>

        <div class="content">
            <div class="wrapper">
            <div class="dashboard-content" id="content-area">
                    <!-- <div class="col-8">
                        Main Dashboard Content Here -->
                        <!-- <h2>Welcome to the Zoo Management System</h2> -->
                        <!-- Additional dashboard links and content can go here -->
                    <!-- </div> --> 

                    <div class="col-4">
                        
                        <h2>Total Animals Inside Zoo</h2>
                        
                        <?php
                        // Query to count total animals inside the zoo
                        $sql = "SELECT COUNT(*) as total_animals FROM tbl_animals";
                        $res = mysqli_query($conn, $sql);

                        // Check if query executed successfully
                        if ($res) {
                            $row = mysqli_fetch_assoc($res);
                            $total_animals = $row['total_animals'];
                            echo "<p>$total_animals</p>";
                        } else {
                            echo "<h2>Error: " . mysqli_error($conn) . "</h2>";
                        }
                        ?>
                    </div>

                    <div class="col-4">
                        <h2>Total Animals Added Today</h2>

                        <?php
                        // Database connection

                        // Get today's date
                        $today_date = date('Y-m-d');

                        // Query to count today's added animals
                        $sql = "SELECT COUNT(*) as today_animals FROM tbl_animals WHERE DATE(arrival_date) = '$today_date'";
                        $res = mysqli_query($conn, $sql);

                        // Check if query executed successfully
                        if ($res) {
                            $row = mysqli_fetch_assoc($res);
                            $today_animals = $row['today_animals'];
                            echo "<p>$today_animals</p>";
                        } else {
                            echo "<h2>Error: " . mysqli_error($conn) . "</h2>";
                        }
                        ?>
                    </div>

                    <div class="col-4">
                        <h2>Total Normal Adult Visitors</h2>

                        <?php
                        // Query to count total normal adult visitors
                        $sql = "SELECT COUNT(*) as total_normal_adult FROM tbl_tickets WHERE ticket_type = 'Normal Adult'";
                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            $row = mysqli_fetch_assoc($res);
                            $total_normal_adult = $row['total_normal_adult'];
                            echo "<p>$total_normal_adult</p>";
                        } else {
                            echo "<h2>Error: " . mysqli_error($conn) . "</h2>";
                        }
                        ?>
                    </div>
                   

                    <!-- Total Child Visitors -->
                    <div class="col-4">
                        <h2>Total Child Visitors</h2>

                        <?php
                        // Query to count total child visitors
                        $sql = "SELECT COUNT(*) as total_child FROM tbl_tickets WHERE ticket_type = 'Child'";
                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            $row = mysqli_fetch_assoc($res);
                            $total_child = $row['total_child'];
                            echo "<p>$total_child</p>";
                        } else {
                            echo "<h2>Error: " . mysqli_error($conn) . "</h2>";
                        }
                        ?>
                    </div>

                    <!-- Total Student Visitors -->
                    <div class="col-4">
                        <h2>Total Student Visitors</h2>

                        <?php
                        // Query to count total student visitors
                        $sql = "SELECT COUNT(*) as total_student FROM tbl_tickets WHERE ticket_type = 'Student'";
                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            $row = mysqli_fetch_assoc($res);
                            $total_student = $row['total_student'];
                            echo "<p>$total_student</p>";
                        } else {
                            echo "<h2>Error: " . mysqli_error($conn) . "</h2>";
                        }
                        ?>
                    </div>

                    <!-- Total Foreigner Adult Visitors -->
                    <div class="col-4">
                        <h2>Total Foreigner Adult Visitors</h2>

                        <?php
                        // Query to count total foreigner adult visitors
                        $sql = "SELECT COUNT(*) as total_foreigner_adult FROM tbl_tickets WHERE ticket_type = 'Foreigner Adult'";
                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            $row = mysqli_fetch_assoc($res);
                            $total_foreigner_adult = $row['total_foreigner_adult'];
                            echo "<p>$total_foreigner_adult</p>";
                        } else {
                            echo "<h2>Error: " . mysqli_error($conn) . "</h2>";
                        }
                        ?>
                    </div>

                    <!-- Total Foreigner Child Visitors -->
                    <div class="col-4">
                        <h2>Total Foreigner Child Visitors</h2>

                        <?php
                        // Query to count total foreigner child visitors
                        $sql = "SELECT COUNT(*) as total_foreigner_child FROM tbl_tickets WHERE ticket_type = 'Foreigner Child'";
                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            $row = mysqli_fetch_assoc($res);
                            $total_foreigner_child = $row['total_foreigner_child'];
                            echo "<p>$total_foreigner_child</p>";
                        } else {
                            echo "<h2>Error: " . mysqli_error($conn) . "</h2>";
                        }
                        ?>
                    </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.sidebar a[data-content]');

            links.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const content = this.getAttribute('data-content');
                    loadContent(content);
                });
            });

            function loadContent(content) {
                const contentArea = document.getElementById('content-area');
                let url = '';

                switch (content) {
                    case 'total-animals':
                        url = 'total-animals.php';
                        break;
                    case 'animals-added':
                        url = 'totalanimalsadded.php';
                        break;
                    case 'normal-adult':
                        url = 'normal-ticket.php';
                        break;
                    case 'child-ticket':
                        url = 'child-ticket.php';
                        break;
                    case 'student-ticket':
                        url = 'student-ticket.php';
                        break;
                    case 'foreigner-adult':
                        url = 'foreigner-adult-ticket.php';
                        break;
                    case 'foreigner-child':
                        url = 'foreigner-child-ticket.php';
                        break;
                    case 'normal-tickets':
                        url = 'normal-tickets.php';
                        break;
                    case 'foreigners-tickets':
                        url = 'foreigners-tickets.php';
                        break;
                    default:
                        contentArea.innerHTML = '<h2>Page Not Found</h2>';
                        return;
                }

                fetch(url)
                    .then(response => response.text())
                    .then(data => {
                        contentArea.innerHTML = data;
                    })
                    .catch(error => {
                        console.error('Error loading content:', error);
                        contentArea.innerHTML = '<h2>Error loading content</h2>';
                    });
            }
        });
    </script>
</body>
</html>
