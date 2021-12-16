<?php
session_start();
if ((!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)  ){
    header("location: signin.php");
    exit;
}


$alert = false;
$showerror = false;
$update = false;

require "partials/_dbconnect.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") 
    {
        $name = $_SESSION['name'];
        $fazr = $_POST['fazr'];
        $zuhr = $_POST['zuhr'];
        $asr = $_POST['asr'];
        $magrib = $_POST['magrib'];
        $isha = $_POST['isha'];
        $sql = "INSERT INTO `qaza` (`name`, `fazr`, `zuhr`, `asr`, `magrib`, `isha`) VALUES ('$name', '$fazr', '$zuhr', '$asr', '$magrib', '$isha')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location: counter.php");
                    exit;
            # code...
        }
    }


?>






<!doctype html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/5ee8b4ab96.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="font-awesome.min.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Qaza Counter</title>
</head>

<body>
    <?php
  require "partials/_nav.php";
  
    if ($update) {
    # code...

    echo "
    <div class='alert alert-success alert-dismissible fade show' role='success'>
  <strong>Success</strong> your note has been updated successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
    ";
  }
?>
    <div class="alert alert-light" role="alert">
        Welcome : <b>
            <?php echo $_SESSION["name"] ?>
        </b>
        <p> <a aria-current='page' href='logout.php'><i class='fas fa-sign-out-alt'>Logout</i></a></p>
    </div>

    <div class="qazaRegistrationForm container">
        <form action="qazaRegistration.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Enter how many fazr qaza do you have?</label>
                <input type="text" class="form-control" name="fazr" placeholder="enter total qaza" required id="fazr" aria-describedby="emailHelp">
            </div>
           
            <div class="mb-3">
                <label for="name" class="form-label">Enter how many zuhr qaza do you have?</label>
                <input type="text" class="form-control" name="zuhr" placeholder="enter total qaza" required id="zuhr" aria-describedby="emailHelp">              
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Enter how many asr qaza do you have?</label>
                <input type="text" class="form-control" name="asr" placeholder="enter total qaza" required id="asr" aria-describedby="emailHelp">             
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Enter how many magrib qaza do you have?</label>
                <input type="text" class="form-control" name="magrib" placeholder="enter total qaza" required id="magrib" aria-describedby="emailHelp">               
            </div>        
            <div class="mb-3">
                <label for="name" class="form-label">Enter how many isha qaza do you have?</label>
                <input type="text" class="form-control" name="isha" placeholder="enter total qaza" required id="isha" aria-describedby="emailHelp">              
            </div>
            <button type="submit" class="btn btn-primary"> Save </button>
            
        </form> 
        <br>
        <br><br>
        
    </div>






        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
            crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
</body>
</html>