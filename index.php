<?php include('partials-frontend/menu.php'); ?>

<section class="animal-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL;?>animal-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for animals">
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>

    <div>
        <h5>A zoo, short for zoological garden or zoological park, is a facility where animals are housed and cared 
            for in enclosures, often designed to mimic their natural habitats. Zoos serve multiple purposes, including
             conservation, education, research, and recreation.</h5>
</div>       
</section>


<section class="categories">
    <div class="container">
        <h3 class="text-center">Welcome to Zoo Planet</h3>

        <?php
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count > 0) {
            while($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                ?>

                <a href="#">
                    <div class="box-3 float-container">
                        <?php
                        if($image_name == "") {
                            echo "<div class='error'>Image not Available</div>";
                        } else {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                        <h3 class="float-text"><?php echo $title; ?></h3>
                    </div>
                </a>
                <?php
            }
        } else {
            echo "<div class='error'>Category not Added.</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>

<section class="explore-animals">
    <div class="container">
        <h3 class="text-center">Explore Animals</h3>

        <?php

        $sql2= "SELECT * FROM tbl_animals LIMIT 4";

        $res2= mysqli_query($conn, $sql2);

        $count2= mysqli_num_rows($res2);

        if ($count2>0)
        {

            while($row=mysqli_fetch_assoc($res2))
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
                <a href="<?php echo SITEURL; ?>view.php?id=<?php echo $id; ?>" class=" btn btn-primary btn-details">View Details</a>
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
    </div>
    <p class="text-center">
        <a href="#">See all Animals</a>
    </p>
</section>

<?php include('partials-frontend/footer.php'); ?>
