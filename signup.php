<?php
$showalert = false;
$showerror = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require "partials/_dbconnect.php";
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password1 = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $existssql = "select * from `signup` where username = '$username' ";
    $result = mysqli_query($conn, $existssql);
    $numexistsrows = mysqli_num_rows($result);
    if ($numexistsrows > 0) {

        $showerror = " Username already exists";
        # code...
    } else {

            if (($password1 == $cpassword)) {

                $sql = "INSERT INTO `signup` (`name`, `username`, `password`, `date & time`) VALUES ('$name','$username', '$password1', CURRENT_TIMESTAMP)";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $showalert = true;
                    header("location: signin.php");
                }
            } else {
                $showerror = "Password do not match";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <script src="index.js"></script>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/5ee8b4ab96.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


    <title>Signup</title>
    <style>
        .signup_container {
            width: 90vw;
            margin: 20px auto;
        }
    </style>
</head>

<body>
    <!-- navbar  -->
    <?php require "partials/_nav.php"; ?>
    <!-- php code for signup page starts here  -->
    <?php

    if ($showalert) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You have successfully registered with us.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }

    if ($showerror) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>oops!</strong> ' . $showerror . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }   ?>







    <!-- signup section starts here  -->
    <div class="signup_container">
        <form action="signup.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Enter Your Name</label>
                <input type="text" class="form-control" name="name" placeholder="enter your full name" required id="name" aria-describedby="emailHelp">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
           
            <div class="mb-3">
                <label for="username" class="form-label"> Enter your Username</label>
                <input type="text" class="form-control" name="username" required id="username" placeholder=" usernameXYZ" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"> Enter Password</label>
                <input type="password" class="form-control" name="password" required id="password">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"> Re-enter Password</label>
                <input type="password" class="form-control" name="cpassword" required id="re_password">
            </div>
            
            <button type="submit" class="btn btn-primary">Register</button>
            
        </form>
        <br><p><b>Already registered ?</b></p><a href="signin.php" class="btn btn-danger" role="button">Login</a>
    </div>













    <!-- SIGNUP SECTION ENDS HERE  -->
  


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