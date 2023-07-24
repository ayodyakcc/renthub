<?php include 'boostrap.html'?>
<?php session_start(); // Start the session

// Include the database connection file (db.php)
require_once 'db.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">RENTHUB</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="AD_post.php">post Management <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="AD_oder.php">Oder Management</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="AD_user.php">user Managemanet</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="AD_re.php">Report</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li> -->
      
      <li class="nav-item">
        <a class="nav-link disabled" href="#"></a>
      </li>
    </ul>
    <span class="navbar-text">
    <?php echo "Welcome, " . $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?>
    <!-- Your page content -->
<!-- Display the logout button -->
<!-- Your page content -->
<!-- Display the logout button -->
            <button onclick="logout()" class="btn btn-outline-secondary">Logout</button>

            <script>
            function logout() {
                // Redirect the user to logout.php when the button is clicked
                window.location.href = 'index.php';
            }
            </script>

 

    </span>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
  </div>
</nav>
    
</body>
</html>