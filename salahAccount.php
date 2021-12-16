<?php
session_start();
if ((!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)  ){
    header("location: signin.php");
    exit;
}


$showerrorDate = false;
$alert = false;
$showerror = false;
$update = false ;
$delete = false ;
require "partials/_dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST['snoEdit'])) 
  {     
    //   $date = $_POST['date'];
      $sno = $_POST['snoEdit'];
      $fazr = $_POST["fazr"];
        $zuhr = $_POST["zohr"];
        $asr = $_POST["asr"];
        $magrib = $_POST["magrib"];
        $isha = $_POST["isha"];
      $sql = "UPDATE `namaz` SET `fazr` = '$fazr', `zuhr` = '$zuhr', `asr` = '$asr', `magrib` = '$magrib', `isha` = '$isha' WHERE `namaz`.`srno.` = '$sno'";
      $result = mysqli_query($conn, $sql);
      $update = true ;
  }
  elseif (isset($_POST['snoDelete'])) 
    {
        $sno = $_POST['snoDelete'];
        $sql = " DELETE FROM `namaz` WHERE `namaz`.`srno.` = '$sno'";
        $result = mysqli_query($conn, $sql);
        $delete = true ;
    }
   else
    {   $username = $_SESSION['username'];
        $date = $_POST["date"];
        $fazr = $_POST["fazr"];
        $zuhr = $_POST["zohr"];
        $asr = $_POST["asr"];
        $magrib = $_POST["magrib"];
        $isha = $_POST["isha"];
        
        $sql = "SELECT * FROM `namaz` WHERE `date`='$date' AND `name`='$username'";
        $result = mysqli_query($conn, $sql);
        $numRow = mysqli_num_rows($result);
        if ($numRow == 1)
         {
          // $showerrorDate = true;
          $sql = "UPDATE `namaz` SET `fazr` = '$fazr', `zuhr` = '$zuhr', `asr` = '$asr', `magrib` = '$magrib', `isha` = '$isha' WHERE `namaz`.`name` = '$username' AND `namaz`.`date` = '$date' ";
          $result = mysqli_query($conn, $sql);
          $update = true ;
        }
         else {
           # code...
         
        $sql = "INSERT INTO `namaz` (`name`, `date`, `fazr`, `zuhr`, `asr`, `magrib`, `isha`) VALUES ('$username', '$date', '$fazr', '$zuhr', '$asr', '$magrib', '$isha')";
        
        $result = mysqli_query($conn, $sql);

        if ($result)
            {
              $alert = true;
            }
        else 
          {
            $showerror = true;
          }
        }
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

    <title>Take Notes</title>
</head>

<body>
    <!-- edit modal starts here  -->
    <!-- Modal -->
    <div id="myModal1" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit this Note</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="qazaCalc.php" method="post">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="mb-3">
            <!-- <label >Date</label><br>
            <input type="date" id="date" name="date"><br><br> -->
            <label for="fazr">Did you perform Fazr today?</label><br>
            <input type="radio" id="fazryes" name="fazr" value="Yes">
            <label >Yes</label><br>
            <input type="radio" id="fazrno" name="fazr" value="No">
            <label >No</label><br>

            <label for="zohr">Did you perform Zohr today?</label><br>
            <input type="radio" id="zohryes" name="zohr" value="Yes">
            <label >Yes</label><br>
            <input type="radio" id="zohrno" name="zohr" value="No">
            <label >No</label><br>

            <label for="asr">Did you perform Asr today?</label><br>
            <input type="radio" id="asryes" name="asr" value="Yes">
            <label >Yes</label><br>
            <input type="radio" id="asrno" name="asr" value="No">
            <label >No</label><br>

            <label for="magrib">Did you perform Magrib today?</label><br>
            <input type="radio" id="magribyes" name="magrib" value="Yes">
            <label >Yes</label><br>
            <input type="radio" id="magribno" name="magrib" value="No">
            <label >No</label><br>

            <label for="isha">Did you perform Isha today?</label><br>
            <input type="radio" id="ishayes" name="isha" value="Yes">
            <label >Yes</label><br>
            <input type="radio" id="ishano" name="isha" value="No">
            <label >No</label><br>



</div>
            <!-- <button type="submit" class="btn btn-primary">Add Note</button> -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

    <!-- edit modal ends here  -->


    <!-- Delete modal starts here  -->
    <!-- Modal -->
    <div id="Delete_vala_Modal1" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete this note ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="qazaCalc.php" method="post">
                        <input type="hidden" name="snoDelete" id="snoDelete">


                        <!-- <button type="submit" class="btn btn-primary">Add Note</button> -->

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- delete modal ends here  -->

    <?php
  require "partials/_nav.php";
  ?>

    <?php
  if ($alert) {
    # code...

    echo "
    <div class='alert alert-success alert-dismissible fade show' role='success'>
  <strong>Success</strong> your Note added successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
    ";
  }
  if ($delete) {
    # code...

    echo "
    <div class='alert alert-success alert-dismissible fade show' role='success'>
  <strong>Success</strong> your Note has been deleted successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
    ";
  }
  if ($update) {
    # code...

    echo "
    <div class='alert alert-success alert-dismissible fade show' role='success'>
  <strong>Success</strong> your note has been updated successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
    ";
  }
  if ($showerror) {
    # code...

    echo "
    <div class='alert alert-danger alert-dismissible fade show' role='success'>
  <strong>Oops</strong> Something went wrong .
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
    ";
  }
  if ($showerrorDate) {
    # code...

    echo "
    <div class='alert alert-danger alert-dismissible fade show' role='success'>
  <strong>Oops</strong> You cannot enter data twice in day, Try updating the existing entry.
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

    <div class="container my-4">
        <form action="qazaCalc.php" method="post">
            <div class="mb-3">
            <label >Date</label><br>
            <input type="date" id="date" name="date" required ><br><br>
            <label for="fazr">Did you perform Fazr today?</label><br>
            <input type="radio" id="fazryes" name="fazr" value="Yes" required>
            <label >Yes</label><br>
            <input type="radio" id="fazrno" name="fazr" value="No" required>
            <label >No</label><br>

            <div class="mb-3">
            <label for="zohr">Did you perform Zohr today?</label><br>
            <input type="radio" id="zohryes" name="zohr" value="Yes" required>
            <label >Yes</label><br>
            <input type="radio" id="zohrno" name="zohr" value="No" required>
            <label >No</label><br>

            <div class="mb-3">
            <label for="asr">Did you perform Asr today?</label><br>
            <input type="radio" id="asryes" name="asr" value="Yes" required>
            <label >Yes</label><br>
            <input type="radio" id="asrno" name="asr" value="No" required>
            <label >No</label><br>

            <div class="mb-3">
            <label for="magrib">Did you perform Magrib today?</label><br>
            <input type="radio" id="magribyes" name="magrib" value="Yes" required>
            <label >Yes</label><br>
            <input type="radio" id="magribno" name="magrib" value="No" required>
            <label >No</label><br>

            <div class="mb-3">
            <label for="isha">Did you perform Isha today?</label><br>
            <input type="radio" id="ishayes" name="isha" value="Yes" required>
            <label >Yes</label><br>
            <input type="radio" id="ishano" name="isha" value="No" required>
            <label >No</label><br>
              
            <button type="submit" class="btn btn-primary">submit</button>
        </form>

    </div>
    <div class="container my-4 ">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <!-- <th scope="col">Srno.</th> -->
                    <th scope="col">Date</th>
                    <th scope="col">Fazr</th>
                    <th scope="col">Zohr</th>
                    <th scope="col">Asr</th>
                    <th scope="col">Magrib</th>
                    <th scope="col">Isha</th>
                    <!-- <th scope="col">Date & Time</th> -->
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM `namaz` WHERE name = '$username' ";
        $result = mysqli_query($conn, $sql);
        $srno = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo "
                                  <tr>
                                      <th scope='row'>"  . $row['date'] . "</th>
                                      <td>" . $row['fazr'] . "</td>
                                      <td>" . $row['zuhr'] . "</td>
                                      <td>" . $row['asr'] . "</td>
                                      <td>" . $row['magrib'] . "</td>
                                      <td>" . $row['isha'] . "</td>
                                      <td>
                                        <button class='btn-sm btn-primary edit1' id=" . $row['srno.'] . ">Edit</button>
                                        <button class='delete1 btn-sm btn-danger' id= d". $row['srno.'].">Delete</button></td>
                                  </tr>   
                              ";
          $srno += 1;
        }
        ?>
            </tbody>
        </table>
    </div>
    <hr>


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


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
<script>
    edits = document.getElementsByClassName('edit1');
    Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit"); 
            // tr = e.target.parentNode.parentNode;
           
            
            snoEdit.value = e.target.id
            console.log(e.target.id)

            $('#myModal1').modal('toggle') // jab user Edit button pe click karega tab myModal Id se jo bhi modal hai vo open hoyega


        })
    })
</script>
<script>
    deletes = document.getElementsByClassName('delete1');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            sno = e.target.id.substr(1,);
            // console.log(sno);
            snoDelete.value = sno;
            console.log(snoDelete);
            $('#Delete_vala_Modal1').modal('toggle')

        })
    })
</script>



</html>