<?php
$login = false;
$showerror = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require "partials/_dbconnect.php";
    $username = $_POST['username'];
    $password1 = $_POST['password'];

   

        $sql = "select * from `signup`  where username = '$username' AND password = '$password1' ";
        $result = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);
        $user_detail = mysqli_fetch_assoc($result);
            
        if ($num == 1) {
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user_detail['username'];
            $_SESSION['name'] = $user_detail['name'];
            header("location: index.php");


        }
     else {
        $showerror = "Invalid Credentials";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <script src="index.js"></script>
    <script src="typed.js"></script> -->
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/5ee8b4ab96.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="font-awesome.min.css"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <title>Sign-in</title>
</head>

<body>
    <!-- navbar starts here -->
  <?php 
    require "partials/_nav.php"
  ?>
    <!-- navbar ends here  -->
    <?php

if ($login) {
     echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Success!</strong> You have successfully Logged-in.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if ($showerror) {
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>oops!</strong> '.$showerror.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}



?>
    <!-- signin.php section starts here  -->
    <div class="container my-4">
    
    <div class="user-login my-4">
        <h1> User Log-in</h1>
        <form action = "signin.php" method = "POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="username" class="form-control" name="username" id="username" placeholder="eg. XYZ" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            
            <button type="submit" class="btn btn-danger">Login</button>
        </form>

         <br><p><b>New User ?</b></p><a href="signup.php" class="btn btn-primary" role="button">Register</a>
    </div>
    </div>
    
    

 
  


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->

</body>


</html>