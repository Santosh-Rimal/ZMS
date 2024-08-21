<?php 

include('partials-frontend/menu.php'); 

if (isset($_POST['submit'])) 
{
    $search = mysqli_real_escape_string($conn, $_POST['search']);
} 
else 
{
    header("Location: " . SITEURL);
    exit();
}
?>

<section class="animal-search-results text-center">
    <div class="container">
        <h3 class="text-center">About "<?php echo htmlspecialchars($search); ?>"</h3>
        <br/>
        <br/>
        <?php
        // Using a prepared statement to avoid SQL injection
        $sql = "SELECT * FROM tbl_animals WHERE name = ?";
        $stmt = mysqli_prepare($conn, $sql);

       
        mysqli_stmt_bind_param($stmt, "s", $search);

       
        mysqli_stmt_execute($stmt);

       
        $res = mysqli_stmt_get_result($stmt);

       
        $count = mysqli_num_rows($res);

        if ($count > 0) 
        {
          
            while ($row = mysqli_fetch_assoc($res))
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

                <div class="explore-animals">
                    <div class="explore-animals-img">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Image not Available</div>";
                        } else {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/animal/<?php echo htmlspecialchars($image_name); ?>" alt="<?php echo htmlspecialchars($name); ?>" class=" img-curve">
                            <?php
                        }
                        ?>
                    </div>
                    <div class="">
                        <h3><?php echo htmlspecialchars($name); ?></h3>
                        <h4><?php echo htmlspecialchars($species); ?></h4>
                        <h4>Breed: <?php echo htmlspecialchars($breed); ?></h4>
                        <h4>Category: <?php echo htmlspecialchars($category); ?></h4>
                        <h4>Health Status: <?php echo htmlspecialchars($health_status); ?></h4>
                        <h4>Date of Birth: <?php echo htmlspecialchars($date_of_birth); ?></h4>
                        <h4>Arrival Date: <?php echo htmlspecialchars($arrival_date); ?></h4>
                        <h4>Gender: <?php echo htmlspecialchars($gender); ?></h4>
                        <h4>Diet: <?php echo htmlspecialchars($diet); ?></h4>
                        <h4>Cage Number: <?php echo htmlspecialchars($cage_number); ?></h4>
                        <br>
                    </div>
                </div>

                <?php
            }
        }
         else
          {
            echo "<div class='error'>No animals found matching your search criteria.</div>";
        }

        mysqli_stmt_close($stmt);
        ?>
        <div class="clearfix"></div>
    </div>
</section>

<?php include('partials-frontend/footer.php'); ?>
