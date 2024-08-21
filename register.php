<?php
include('partials-frontend/menu.php'); 
// <--------------------Password hash algorithm------------------------------------------->
function custom_hash($password, $salt) {
    $hashed = hash('sha256', $salt . $password);
    for ($i = 0; $i < 1000; $i++) {
        $hashed = hash('sha256', $hashed);
    }
    return $hashed;
}
// <----------------------password hash algorithm---------------------------------------------->
if(isset($_POST['submit'])){
  $salt = bin2hex(random_bytes(16));
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn,$_POST['password']);
   $hashed_password1 = custom_hash($pass, $salt);

   $pass1 = mysqli_real_escape_string($conn,strrev(sha1(convert_uuencode(bin2hex(chunk_split($hashed_password1,1,"a"))))));
// echo $pass."<br>";
$newpassword1 = (base64_encode(hash_hmac('sha256',$pass1,'Aakriti', true)));
   $cpass = mysqli_real_escape_string($conn,$_POST['cpassword'],);
   $hashed_password2 = custom_hash($cpass, $salt);
   $pass2 = mysqli_real_escape_string($conn,strrev(sha1(convert_uuencode(bin2hex(chunk_split($hashed_password2,1,"a"))))));
// echo $pass."<br>";
$newpassword2 = (base64_encode(hash_hmac('sha256',$pass2,'Aakriti', true)));
   // echo $newpass ."<br>";
   // echo $newcpass ."<br>";
   // die();
   $select_users = mysqli_query($conn, "SELECT * FROM tbl_visitors WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      echo'user already exist!';
   }else{
      if($newpassword1 !== $newpassword2){
         echo'confirm password not matched!';
      }else{
       
         mysqli_query($conn, "INSERT INTO `tbl_visitors`(name, email, password,salt) VALUES('$name', '$email', '$newpassword1','$salt')") or die('query failed');
         // die('registered successfully!');
         header('location:login.php');
      }
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
<body>

<div class="form-container">

   <form action="" method="post" class= "login"id="myForm">
      <h3 class="form-title">register now</h3>
      <input type="text" name="name" placeholder="enter your name" required class="box">
      <span id="name" class="error-message"></span>
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <span id="email" class="error-message"></span>
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <span id="password" class="error-message"></span>
      <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
      <span id="cpassword" class="error-message"></span>
      <input type="submit" name="submit" value="register now" class="button">
      <p>already have an account? <a class="login-link" href="login.php">login now</a></p>
   </form>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

      var form = document.getElementById("myForm");

      // Validate email
      var emailInput = document.querySelector("input[name='email']");
      emailInput.addEventListener("input", function() {
        var emailRegex = /^[a-zA-Z0-9]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/;
        if (emailRegex.test(emailInput.value)) {
          emailInput.style.borderColor = "green";
          document.getElementById('email').innerHTML="";
        } else {
          emailInput.style.borderColor = "red";
          document.getElementById('email').innerHTML="Email is not valid";
        }
      });

      // Validate name
      var nameInput = document.querySelector("input[name='name']");
      nameInput.addEventListener("input", function() {
        if (nameInput.value.trim() !== "" && nameInput.value.match(/[a-zA-Z]/)) {
          nameInput.style.borderColor = "green";
          document.getElementById('name').innerHTML="";
        } else {
          nameInput.style.borderColor = "red";
          document.getElementById('name').innerHTML="Name should not be empty";
        }
      });

      var password = document.querySelector("input[name='password']");
      password.addEventListener("input", function() {
        if (password.value.length>=8) {
          password.style.borderColor = "green";
          document.getElementById('password').innerHTML="";
        } else {
          password.style.borderColor = "red";
          document.getElementById('password').innerHTML="Password should contain at least 8 characters";
        }
      });

      var cpassword = document.querySelector("input[name='cpassword']");
      cpassword.addEventListener("input", function() {
        if (cpassword.value.length>=8) {
          cpassword.style.borderColor = "green";
          document.getElementById('cpassword').innerHTML="";
        } else {
          cpassword.style.borderColor = "red";
          document.getElementById('cpassword').innerHTML="Password should contain at least 8 characters";
        }
      });

      // Form submission event
      form.addEventListener("submit", function(e) {
        if (
          emailInput.style.borderColor === "red" ||
          password.style.borderColor === "red" ||
          cpassword.style.borderColor === "red"
        ) {
          e.preventDefault();  // Stop the form from submitting
          alert("Please correct the highlighted fields before submitting.");
        }
      });

    });
</script>
</body>
</html>
