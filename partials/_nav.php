<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $loggedin = true;
} else {
  $loggedin = false;
}

echo"
<!-- navbar starts here  -->
<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
    <div class='container-fluid'>
      <a class='navbar-brand' href='#'>sahil.dev</a>
      <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
      </button>
      <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
          <li class='nav-item'>
            <a class='nav-link active ' aria-current='page' href='index.php'> <i class='fas fa-home'> Home</i></a>
          </li>";
          if (!$loggedin)
                {   echo"
                          <li class='nav-item'>
                            <a class='nav-link ' aria-current='page' href='signup.php'><i class='fas fa-user-plus'> Register</i></a>
                          </li>
                          <li class='nav-item'>
                            <a class='nav-link ' aria-current='page' href='signin.php'><i class='fas fa-sign-in-alt'> Sign-in</i></a>
                          </li>
                        ";    
              } 
          if ($loggedin) 
              {
                echo"
                        <li class='nav-item'>
                          <a class='nav-link ' aria-current='page' href='logout.php'><i class='fas fa-sign-out-alt'> Logout</i>  </a>
        
                        </li>
                        <li class='nav-item'>
                          <a class='nav-link ' aria-current='page' href='qazaCalc.php'> Qaza Calc</i>  </a>
        
                        </li>
                        <li class='nav-item'>
                          <a class='nav-link ' aria-current='page' href='counter.php'> Qaza Counter</i>  </a>
        
                        </li>
                    ";
              }
              
      echo"
        </ul>
       
      </div>
    </div>
  </nav> ";


?>