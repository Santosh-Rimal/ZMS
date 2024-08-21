<?php
 include('partials-frontend/menu.php');

if (isset($_POST['submit'])) {
// <--------------------Password hash algorithm------------------------------------------->
function custom_hash($password, $salt) {
    $hashed = hash('sha256', $salt . $password);
    for ($i = 0; $i < 1000; $i++) {
        $hashed = hash('sha256', $hashed);
    }
    return $hashed;
}


// <----------------------password hash algorithm---------------------------------------------->
     $email = mysqli_real_escape_string($conn, $_POST['email']);
     $password = mysqli_real_escape_string($conn, $_POST['password']);
  

    $select_users = mysqli_query($conn, "SELECT * FROM tbl_visitors WHERE email = '$email'") or die('Query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $row = mysqli_fetch_assoc($select_users);
        $fetchpassword = $row['password'];
        $salt = $row['salt'];
   

$enteredpassword = custom_hash($password, $salt);

   $password1 = mysqli_real_escape_string($conn,strrev(sha1(convert_uuencode(bin2hex(chunk_split($enteredpassword,1,"a"))))));
// echo $pass."<br>";
$password2 = (base64_encode(hash_hmac('sha256',$password1,'Aakriti', true)));

        if ($fetchpassword===$password2) {
            // Password is correct
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];

            
                header('location: index.php');
        } else {
            $message[] = 'Incorrect email or password!';
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
<body>
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
   
<div class="form-container">

   <form action="" class="login" method="post">
      <h3 class="form-title">login now</h3>
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="submit" name="submit" value="login now" class="button">
      <p>don't have an account? <a class="register-link" href="register.php">register now</a></p>
   </form>
  
</div>
<script src="../js/script.js"></script>
</body>
</html>
