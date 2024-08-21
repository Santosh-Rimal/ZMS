<?php include ('../config/constants.php'); ?>
<html>
   <head>

   <title>Login-zms</title>
   <link rel="stylesheet" href="../css/admin.css">

   <body>

        <div class="login">
            <h1 class="text-center">Login</h1>

            <br/>

           <?php
           if(isset($_SESSION['login']))
           {
             echo $_SESSION['login'];
             unset($_SESSION['login']);
           }

           if(isset($_SESSION['no-login-message']))
           {
             echo $_SESSION['no-login-message'];
             unset($_SESSION['no-login-message']);
           }

           ?>
           <br/>
           <br/>

           <form action="" method="POST" class="text-center">

           UserName: <br/>
           <input type="text" name="username" placeholder="Enter username" class="box"><br/> <br/>

           Password: <br/>
           <input type="password" name="password" placeholder="Enter password" class="box"><br/> <br/>
    
           <input type="submit" name="submit" value="Login" class="btn-primary"><br/> <br/>
    
         <br/>
         <br/>
           </form>
     </div>

   </body>
   </head>
</html>

<?php


    if (isset($_POST['submit']))
    {

        $username= $_POST['username'];
        $password= md5($_POST['password']);

        $sql= "SELECT * FROM tbl_user WHERE username='$username' AND password= '$password'";
        
        //execute query
        $res= mysqli_query($conn, $sql);

        //user exist or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login']= "login successfull";
            $_SESSION['user']= $username;

            header('location:'.SITEURL.'admin/');
        }
        else
        {
            $_SESSION['login']= "username or password didnot match ";

            header('location:'.SITEURL.'admin/login.php');  
        }
    }
?>