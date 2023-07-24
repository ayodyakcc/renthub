
<?php
// Include the database connection file (db.php)
require_once 'db.php';
// Initialize the variable to store the pop-up message
$popup_message = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact_no = $_POST['contact_no'];
    $address = $_POST['address'];
    $nic_number = $_POST['nic_number'];
    $district = $_POST['district'];

      // Default user type
      $user_type = "user";

    // Prepare the SQL insert statement using PDO prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("INSERT INTO user (user_type, first_name, last_name, email, password, contact_no, address, nic_number, district)
                          VALUES (:user_type, :first_name, :last_name, :email, :password, :contact_no, :address, :nic_number, :district)");

    // Bind the parameters
    $stmt->bindParam(':user_type', $user_type);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':contact_no', $contact_no);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':nic_number', $nic_number);
    $stmt->bindParam(':district', $district);

    // Execute the statement
    try {
        $stmt->execute();
        $popup_message = "User added successfully!";
    } catch (PDOException $e) {
      $popup_message = "Error: " . $e->getMessage();
    }
}
?>
 <!-- JavaScript code for displaying the pop-up message and redirecting -->
 <?php if (!empty($popup_message)) { ?>
        <script>
            alert("<?php echo $popup_message; ?>");
            window.location.href = "index.php"; // Replace "index.php" with your desired redirect URL
        </script>
    <?php } ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style/style.css" type="text/css"/>
    <?php include 'boostrap.html' ?>
    <title>User Registration</title>
  </head>
  <body>
    <h1 class="hdin--reg">User Registration</h1>
    <div class="register" >
      <h2 class="yr">Your details</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="inputEmail4">First Name</label>
      <input type="text" class="form-control" placeholder="first name" name="first_name" required>
    </div>

    <div class="form-group col-md-6">
      <label for="inputEmail4">Last Name</label>
      <input type="text" class="form-control"  placeholder="last name" name="last_name" required>
    </div>

    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control"placeholder="Email" name="email" required>
    </div>

    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password" required>
    </div>
  </div>

  <div class="form-group">
    <label for="inputAddress">Contact No</label>
    <input type="text" class="form-control"  placeholder="Phone number" name="contact_no" required>
  </div>

  <div class="form-group">
    <label for="inputAddress2">Address</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" name="address" required>
  </div>

  <div class="form-group col-md-4">
     

    </div>

  <div class="form-row">

    <div class="form-group col-md-6">
      <label for="inputCity">NIC number</label>
      <input type="text" class="form-control" id="inputCity" name="nic_number" required >
  
      </div>
      <div class="form-group col-md-6">
    <label for="district">Select District:</label>
<select id="district" name="district">
    <option value="">-- Select District --</option>
    <option value="Ampara">Ampara</option>
    <option value="Anuradhapura">Anuradhapura</option>
    <option value="Badulla">Badulla</option>
    <option value="Batticaloa">Batticaloa</option>
    <option value="Colombo">Colombo</option>
    <option value="Galle">Galle</option>
    <option value="Gampaha">Gampaha</option>
    <option value="Hambantota">Hambantota</option>
    <option value="Jaffna">Jaffna</option>
    <option value="Kalutara">Kalutara</option>
    <option value="Kandy">Kandy</option>
    <option value="Kegalle">Kegalle</option>
    <option value="Kilinochchi">Kilinochchi</option>
    <option value="Kurunegala">Kurunegala</option>
    <option value="Mannar">Mannar</option>
    <option value="Matale">Matale</option>
    <option value="Matara">Matara</option>
    <option value="Monaragala">Monaragala</option>
    <option value="Mullaitivu">Mullaitivu</option>
    <option value="Nuwara Eliya">Nuwara Eliya</option>
    <option value="Polonnaruwa">Polonnaruwa</option>
    <option value="Puttalam">Puttalam</option>
    <option value="Ratnapura">Ratnapura</option>
    <option value="Trincomalee">Trincomalee</option>
    <option value="Vavuniya">Vavuniya</option>
</select>
    </div>
   </div>
  <button type="submit" class="btn btn-primary">REGISTER</button>

 

</form>

    
   
    
  </body>
</html>




