<?php include("assets/navbar/navbar.php");?>
<?php include 'boostrap.html'?>
<?php
// Assuming you have already established a PDO connection to your database ($pdo)
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM rental_items WHERE post_id = :post_id");
    $stmt->bindParam(':post_id', $post_id);
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
    <!-- <h1 class="hdin--reg">\Item Registration</h1> -->
    <div class="register" >
      <h2 class="yr">Item Details</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $post_id; ?>" method="post" enctype="multipart/form-data">
  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="inputEmail4">Item Name</label>
      <input type="text" class="form-control" placeholder="item name" name="item_name" required required value="<?php echo $rental_item['item_name']; ?>">
    </div>

    <div class="form-group col-md-6">
      <label for="Discription">Discription</label>
      <textarea id="Discription" name="description" rows="4" cols="50"><?php echo $rental_item['description']; ?></textarea>
    </div>

    <div class="form-group col-md-6">
      <label for="price">daliy price</label>
      <input type="number" class="form-control"placeholder="price" name="daily_price" required  required value="<?php echo $rental_item['daily_price']; ?>">
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


  <div class="form-group">
    <label for="inputAddress2">Address</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" name="address" requiredrequired value="<?php echo $rental_item['address']; ?>">
  </div>
  <div class="form-group">
    <label for="inputAddress">Contact No</label>
    <input type="text" class="form-control"  placeholder="Phone number" name="contact_no" required required value="<?php echo $rental_item['contact_no']; ?>">
  </div>

  <div class="form-group col-md-4">
     

    </div>

  <div class="form-row">

    <div class="form-group col-md-6">
    <label for="category">Select a Category:</label>
<select id="category" name="category">
    <option value="<?php echo $rental_item['category']; ?>"><?php echo $rental_item['category']; ?></option>
    <option value="vehicles">Vehicles</option>
    <option value="electronics">Electronics</option>
    <option value="Home and Garden">Home and Garden</option>
    <option value="others">Others</option>
</select>
  
      </div>
   </div>
  <button type="submit" class="btn btn-primary">update post</button>

 

</form>

    
   
    
  </body>
</html>


<?php
// Include the database connection file (db.php)
require_once 'db.php';

// Initialize the variable to store the rental item data
$rental_item = array();

// Check if a post_id is provided in the URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Prepare the SQL statement to fetch the rental item with the given post_id
    $stmt = $pdo->prepare("SELECT * FROM rental_items WHERE post_id = :post_id");
    $stmt->bindParam(':post_id', $post_id);

    try {
        $stmt->execute();
        // Fetch the rental item data as an associative array
        $rental_item = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from the form (replace $_POST with actual form field names)
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $daily_price = $_POST['daily_price'];
    $district = $_POST['district'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];
    $category = $_POST['category'];

    // Prepare the SQL update statement using PDO prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("UPDATE rental_items SET item_name = :item_name, description = :description, daily_price = :daily_price, district = :district, address = :address, contact_no = :contact_no, category = :category WHERE post_id = :post_id");

    // Bind the parameters
    $stmt->bindParam(':item_name', $item_name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':daily_price', $daily_price);
    $stmt->bindParam(':district', $district);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':contact_no', $contact_no);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':post_id', $post_id);

    try {
        $stmt->execute();
        $popup1_message = "Post updated successfully!";
    } catch (PDOException $e) {
        $popup1_message = "Error: " . $e->getMessage();
    }
}
?>
 <!-- JavaScript code for displaying the pop-up message and redirecting -->
 <?php if (!empty($popup1_message)) { ?>
    <script>
        alert("<?php echo $popup1_message; ?>");
        window.history.back();
    </script>
<?php } ?>