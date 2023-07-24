<?php include("assets/navbar/navbarA.php");?>

<?php
// Assuming you have already established a PDO connection to your database ($pdo)
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM user WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $rental_item = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>


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
      <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $rental_item['user_id']; ?>" method="post">
  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="inputEmail4">First Name</label>
      <input type="text" class="form-control" placeholder="first name" name="first_name" required required value="<?php echo $rental_item['first_name']; ?>">
    </div>

    <div class="form-group col-md-6">
      <label for="inputEmail4">Last Name</label>
      <input type="text" class="form-control"  placeholder="last name" name="last_name" required required value="<?php echo $rental_item['last_name']; ?>">
    </div>

    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control"placeholder="Email" name="email" required required value="<?php echo $rental_item['email']; ?>">
    </div>

    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password" required required value="<?php echo $rental_item['password']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="inputAddress">Contact No</label>
    <input type="text" class="form-control"  placeholder="Phone number" name="contact_no" required required value="<?php echo $rental_item['contact_no']; ?>">
  </div>

  <div class="form-group">
    <label for="inputAddress2">Address</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" name="address" required required value="<?php echo $rental_item['address']; ?>">
  </div>

  <div class="form-group col-md-4">
     

    </div>

  <div class="form-row">

    <div class="form-group col-md-6">
      <label for="inputCity">NIC number</label>
      <input type="text" class="form-control" id="inputCity" name="nic_number" required required value="<?php echo $rental_item['nic_number']; ?>" >
  
      </div>
      <div class="form-group col-md-6">
    <label for="district">Select District:</label>
<select id="district" name="district">
    <option value="<?php echo $rental_item['district']; ?>"><?php echo $rental_item['district']; ?></option>
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
  <button type="submit" class="btn btn-primary">Update</button>

 

</form>

<?php
// Assuming you have already established a PDO connection to your database ($pdo)

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the user ID from the URL parameter
    $user_id = $_GET['id'];

    // Get data from the form (replace $_POST with actual form field names)
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact_no = $_POST['contact_no'];
    $address = $_POST['address'];
    $nic_number = $_POST['nic_number'];
    $district = $_POST['district'];

    // Prepare the SQL update statement using PDO prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("UPDATE user SET first_name = :first_name, last_name = :last_name, email = :email, password = :password, contact_no = :contact_no, address = :address, nic_number = :nic_number, district = :district WHERE user_id = :user_id");

    // Bind the parameters
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':contact_no', $contact_no);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':nic_number', $nic_number);
    $stmt->bindParam(':district', $district);

    try {
        $stmt->execute();
        $popup1_message = "User details updated successfully!";
    } catch (PDOException $e) {
        $popup1_message = "Error: " . $e->getMessage();
    }
}
?>
   
    


<!-- JavaScript code for displaying the pop-up message and redirecting -->
<?php if (!empty($popup1_message)) { ?>
    <script>
        alert("<?php echo $popup1_message; ?>");
        window.location.href = "AD_user.php"; // Replace "AD_user.php" with your desired redirect URL
    </script>
<?php } ?>
  </body>
</html>