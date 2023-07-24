<?php include("assets/navbar/navbar.php");?>
<?php

// Include the database connection file (db.php)
require_once 'db.php';

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Check if the user is logged in and has the authority to delete the post
    if (isset($_SESSION['id'])) {
        // Prepare the SQL statement to delete the post
        $stmt = $pdo->prepare("DELETE FROM `rental_items` WHERE post_id = :post_id ");
        $stmt->bindParam(':post_id', $post_id);

        try {
            $stmt->execute();
            $popup1_message = "Post deleted successfully!";
        } catch (PDOException $e) {
            $popup1_message = "Error: " . $e->getMessage();
        }
    } else {
        // Redirect to the login page or show an error message
        // You should implement appropriate login and error handling here
        header('Location: index.php');
        exit();
    }
}

?>

<?php if (!empty($popup1_message)) { ?>
    <script>
        alert("<?php echo $popup1_message; ?>");
        window.history.back();
    </script>
<?php } ?>
