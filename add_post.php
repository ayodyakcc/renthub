<?php include("assets/navbar/navbar.php");?>

<?php 
// Get data from the form (replace $_POST with actual form field names)

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from the form (replace $_POST with actual form field names)
  
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $daily_price = $_POST['daily_price'];
    $district = $_POST['district'];

    // Generate a unique picture name
    // Assuming you have already established a PDO connection and other necessary code


    $timestamp = time();
    $picture = $item_name . '_' . $user_id . '_' . $timestamp . '.png'; // Example: itemname_123_1628495123.png
    
    $uploads_folder = 'uploads/';
    
    // If handling file uploads, move the uploaded image to the uploads folder
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $temp_name = $_FILES['picture']['tmp_name'];
        $picture_path = $uploads_folder . $picture; // Create the full path to the picture
    
        // Move the uploaded file from the temporary location to the uploads folder
        if (move_uploaded_file($temp_name, $picture_path)) {
            // File moved successfully, now proceed to save the picture name in the database
            $address = $_POST['address'];
            $contact_no = $_POST['contact_no'];
            $category = $_POST['category'];
    
            // Prepare the SQL insert statement using PDO prepared statements to prevent SQL injection
            $stmt = $pdo->prepare("INSERT INTO rental_items (user_id, item_name, description, daily_price, district, picture, address, contact_no, category) VALUES (:user_id, :item_name, :description, :daily_price, :district, :picture, :address, :contact_no, :category)");
    
            // Bind the parameters
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':item_name', $item_name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':daily_price', $daily_price);
            $stmt->bindParam(':district', $district);
            $stmt->bindParam(':picture', $picture); // Use the generated unique picture name
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':contact_no', $contact_no);
            $stmt->bindParam(':category', $category);
            
            try {
                $stmt->execute();
                $popup1_message = "Post added successfully!";
            } catch (PDOException $e) {
                $popup1_message = "Error: " . $e->getMessage();
            }
        } else {
            echo "Error moving the file.";
        }
    } else {
        // Handle file upload error (if any)
        echo "File upload error: " . $_FILES['picture']['error'];
    }
}
    
?>
 <!-- JavaScript code for displaying the pop-up message and redirecting -->
 <?php if (!empty($popup1_message)) { ?>
        <script>
            alert("<?php echo $popup1_message; ?>");
            window.location.href = "user.php"; // Replace "index.php" with your desired redirect URL
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
    <!-- <h1 class="hdin--reg">\Item Registration</h1> -->
    <div class="register" >
      <h2 class="yr">Item Details</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="inputEmail4">Item Name</label>
      <input type="text" class="form-control" placeholder="first name" name="item_name" required>
    </div>

    <div class="form-group col-md-6">
      <label for="Discription">Discription</label>
      <textarea id="Discription" name="description" rows="4" cols="50"></textarea>
    </div>

    <div class="form-group col-md-6">
      <label for="price">daliy price</label>
      <input type="number" class="form-control"placeholder="price" name="daily_price" required>
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

  <div class="form-group">
    <label for="picture">Select a Picture:</label>
   <input type="file"  id="picture"  class="form-control" name="picture" >
  </div>

  <div class="form-group">
    <label for="inputAddress2">Address</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" name="address" required>
  </div>
  <div class="form-group">
    <label for="inputAddress">Contact No</label>
    <input type="text" class="form-control"  placeholder="Phone number" name="contact_no" required>
  </div>

  <div class="form-group col-md-4">
     

    </div>

  <div class="form-row">

    <div class="form-group col-md-6">
    <label for="category">Select a Category:</label>
<select id="category" name="category">
    <option value="">-- Select Category --</option>
    <option value="vehicles">Vehicles</option>
    <option value="electronics">Electronics</option>
    <option value="Home and Garden">Home and Garden</option>
    <option value="others">Others</option>
</select>
  
      </div>
   </div>
  <button type="submit" class="btn btn-primary">Add Post</button>

 

</form>

    
   
    
  </body>
</html>