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


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['Edit'])) 
    {   
        $name = $_SESSION['name'];
        $Edit = $_POST['Edit'];
        // $time = 
        $sql = "UPDATE `qaza` SET `fazr` = '$Edit', `time` = current_timestamp() WHERE `qaza`.`name` = '$name'  ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true ;
            # code...
        }
    }
}
    $name =  $_SESSION['name'];
    $sql = "SELECT * FROM `qaza` WHERE `name` ='$name' ";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if($num == 0){
       header("location:qazaRegistration.php");
       exit;
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
        
        <link rel="stylesheet" href="counter.css">
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
        Welcome : <b> <?php echo $_SESSION["name"]?>
        </b>
        <p> <a aria-current='page' href='logout.php'><i class='fas fa-sign-out-alt'>Logout</i></a></p>
    </div>



    <div class="container">
        <div id="fazr">
        <div id="counterNum">
            <?php
                
                 if($num == 1){
                     
                     echo $row['fazr'];  
                 }
                
             ?>
        </div>
        <div id="counterArrow" style="">
            <div id="arrowLeft" style=""><button type="button" class="btn btn-success">Decrease
            </button></div>
            <div id="arrowRight" style=""><button type="button" class="btn btn-danger">Increase</button></div>
        </div>
        <div id="save" style="">
            <form action="counter.php" method="post" style="text-align:center;">
                <input type="hidden" name="Edit" id="hiddenElement">
                <!-- <input type="submit" value="Save"> -->
                <button type="submit" class="btn btn-info">Save</button>
            </form>
        </div>
        <!-- <button type="button" class="btn btn-success">Success</button>
            <button type="button" class="btn btn-danger">Danger</button> -->

            <div id="qazaInformation">
                <p><h4>Last Updated after <span id='lastUpdatedAfter'>--</span> </h4><h4 id="lastUpdatedOn"> At 
                <?php   
                if($num == 1){
                     echo $row['time'];  
                    }
                  ?>  
                    </h4>
                
                
                
                </p>
                <p>Total Qaza filled :- <span id='qazaFilled'></span></p>

            </div>

    </div>
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

<script>
    console.log("this is counter page")


    let arrowLeft = document.getElementById("arrowLeft");
    let arrowRight = document.getElementById("arrowRight");
    let counterNum = parseInt(document.getElementById('counterNum').innerText);

    function increment(e) {
        // let counterNum = parseInt(document.getElementById('counterNum').innerText);
        console.log(counterNum)
        counterNum = parseInt(counterNum + 1);
        document.getElementById('counterNum').innerText = counterNum;
        let Edit = document.getElementById('hiddenElement')
        Edit.value = document.getElementById('counterNum').innerText
        console.log(Edit.value)

    }

    function decrement(e) {
        // let counterNum = parseInt(document.getElementById('counterNum').innerText);
        console.log(counterNum)

        counterNum = parseInt(counterNum - 1);
        document.getElementById('counterNum').innerText = counterNum;
        let Edit = document.getElementById('hiddenElement')
        Edit.value = document.getElementById('counterNum').innerText
        console.log(Edit.value)


    }
    arrowLeft.addEventListener('click', decrement);
    arrowRight.addEventListener('click', increment);

</script>
<script>
    let time = document.getElementById('lastUpdatedOn').innerText
    hour = time.slice(14,16)
    minutes = time.slice(17,19)
    console.log(hour);
    console.log(minutes);
    if (minutes >=0 && minutes<6) {
        hour = parseInt(hour)+0.1;
        console.log(hour)
    }
    else if (minutes >=6 && minutes<12) {
        hour = parseInt(hour)+0.2;
        console.log(hour)
    }
    else if (minutes >=12 && minutes< 18) {
        hour = parseInt(hour)+0.3;
        console.log(hour)
    }
    else if (minutes >=18 && minutes< 24) {
        hour = parseInt(hour)+0.4;
        console.log(hour)
    }
    else if (minutes >= 24 && minutes< 30) {
        hour = parseInt(hour)+0.5;
        console.log(hour)
    }
    else if (minutes >=30 && minutes< 36) {
        hour = parseInt(hour)+0.6;
        console.log(hour)
    }
    else if (minutes >=36 && minutes< 42) {
        hour = parseInt(hour)+0.7;
        console.log(hour)
    }
    else if (minutes >=42 && minutes< 48) {
        hour = parseInt(hour)+0.8;
        console.log(hour)
    }
    else {
        hour = parseInt(hour)+0.9;
        console.log(hour)
    }
   


    if (hour >= 6) {
        document.getElementById('lastUpdatedAfter').innerText = 'Fazr';
    }
    if (hour >= 13.6) {
        document.getElementById('lastUpdatedAfter').innerText = 'Zuhr';
    }
    if (hour >= 17.3 ) {
        document.getElementById('lastUpdatedAfter').innerText = 'Asr';
    }
    if (hour >= 18.5  ) {
        document.getElementById('lastUpdatedAfter').innerText = 'Magrib';
    }
    if (hour >= 20.5 ) {
        document.getElementById('lastUpdatedAfter').innerText = 'Isha';
    }

</script>

<script>
    let qazaLeft = parseInt(document.getElementById('counterNum').innerText);
    let qazaFilled = 2000-qazaLeft;
    console.log(qazaFilled)
    console.log(qazaLeft)
    document.getElementById('qazaFilled').innerText = qazaFilled;
</script>
</html>