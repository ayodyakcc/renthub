<?php
session_start(); // Start the session

// Include the database connection file (db.php)
require_once 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the login form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement to fetch user data based on the provided email
    //$sql = "SELECT id, user_type, password FROM user WHERE email = ?";
    $sql = "SELECT user_id, user_type,first_name, last_name,district FROM user WHERE email = ? AND password = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, $password]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // If the user is found and the password is correct
        $_SESSION['user_type'] = $user['user_type'];
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['district'] = $user['district'];


        // Redirect to the appropriate page based on user type
        if ($user['user_type'] === 'user') {
            header('Location: user.php');
        } elseif ($user['user_type'] === 'admin') {
            header('Location: AD_post.php');
        }
        exit();
    } else {
        $error_message = "Invalid login credentials!";
      
    }
}
?>
  <?php if (!empty($error_message)) { ?>
          <script>
              alert("<?php echo $error_message; ?>");
              window.location.href = "index.php"; // Replace "index.php" with your desired redirect URL
          </script>
      <?php } ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'boostrap.html' ?>
     <link rel="stylesheet" href="./style/style.css" type="text/css"/>
    <title>RENT HUB</title>
</head>
<body>
<h2 class="text-center  hdin" >RENT HUB |  Online Renting Platform</h2>
<div class="form">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method ="POST" >
<h3 class="mb-5 text-center login">LOGIN</h3>
  <!-- Email input -->
  <div class="form-outline mb-4">
  <input type="email" id="form2Example1" class="form-control" name="email" required />
    <label class="form-label" for="form2Example1">Email address</label>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
   <input type="password" id="form2Example2" class="form-control" name="password" required/>
    <label class="form-label" for="form2Example2">Password</label>
  </div>

  <!-- 2 column grid layout for inline styling -->
  <div class="row mb-4">
    <div class="col d-flex justify-content-center">
      <!-- Checkbox -->
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
        <label class="form-check-label" for="form2Example31"> Remember me </label>
      </div>
    </div>

    <div class="col">
      <!-- Simple link -->
      <a href="#!">Forgot password?</a>
    </div>
  </div>

  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4">Login</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Not a User? <a href="./userReg.php">Register</a></p>
   
    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-facebook-f"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-google"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-twitter"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-github"></i>
    </button>
  </div>
</form>
</div>

</body>
</html>