<?php include('partials-frontend/menu.php'); ?>

<?php

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "SELECT * FROM tbl_animals WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count == 1) {
        
        $row = mysqli_fetch_assoc($res);

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
    } 
    else 
    {
        
        header('location:' . SITEURL);
    }
} 
else
 {
   
    header('location:' . SITEURL);
}
?>

<div class="search-animals">
    
    <div class="explore-animals-img">
        <?php
        if($image_name == "") {
            echo "<div class='error'>Image not Available</div>";
        } else {
            ?>
            <img src="<?php echo SITEURL; ?>images/animal/<?php echo $image_name; ?>" alt="<?php echo $name; ?>" class=" img-curve">

            <h3><?php echo $name;?></h3>
            <h4><?php echo $species;?></h4>

            <?php
        }
        ?>
    </div>

    <div class="details">
         <p><strong>Breed:</strong> <?php echo $breed; ?></p>
        <p><strong>Category:</strong> <?php echo $category; ?></p>
        <p><strong>Species:</strong> <?php echo $species; ?></p>
        <p><strong>Date of Birth:</strong> <?php echo $date_of_birth; ?></p>
        <p><strong>Health Status:</strong> <?php echo $health_status; ?></p>
        <p><strong>Arrival Date:</strong> <?php echo $arrival_date; ?></p>
        <p><strong>Gender:</strong> <?php echo $gender; ?></p>
        <p><strong>Diet:</strong> <?php echo $diet; ?></p>
        <p><strong>Cage Number:</strong> <?php echo $cage_number; ?></p>
    </div>
</div>

<div class="clearfix"></div>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

<?php include('partials-frontend/footer.php'); ?>
