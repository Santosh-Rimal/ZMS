<?php include('partials-frontend/menu.php'); ?>
<section class="explore-animals">
<div class="container">
        <h3 class="text-center">Explore Animals</h3>
       
        <?php
        // Query to select all animals from the database
        $sql2 = "SELECT * FROM tbl_animals LIMIT 4 ";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);

        // Check if there are any animals in the database
        if ($count2 > 0) {
            while ($row = mysqli_fetch_assoc($res2)) {
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

                <div class="explore-animals-box">
                 <div class="explore-animals-img">

                 <?php
                 
                 if($image_name=="")
                 {
                    echo "<div class='error'>Image not Available .<?div>";
                 }

                 else
                 {
                     ?>
                       <img src="<?php echo SITEURL; ?>images/animal/<?php echo $image_name; ?>" alt="<?php echo $name; ?>" class="img-responsive img-curve">
                     <?php
                 }
                 ?>
                
              </div>
                 <div class="description">
                <h3><?php echo $name;?></h3>
                <h4><?php echo $species;?></h4>
                <br>
                <a href="<?php echo SITEURL; ?>view.php?id=<?php echo $id; ?>" class="btn btn-primary btn-details">View Details</a>
               </div>
            </div>
                <?php
            }

        }
        else
        {
           echo "<div class='error'>Animal not found inside zoo.</div>";
        }
        ?>  
        
        
        <div class="clearfix"></div>

        <br/>
        <br/>
    
    <p class="text-center">
        <a href="#">See all Animals</a>
    </p>

    </div>
    </section>


<?php include('partials-frontend/footer.php'); ?>
