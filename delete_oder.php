<?php include("assets/navbar/navbar.php");?>
<?php


// Include the database connection file (db.php)
require_once 'db.php';

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    // Check if the user is logged in and has the authority to delete the order
    if (isset($_SESSION['id'])) {
        // Prepare the SQL statement to delete the order
        $stmt = $pdo->prepare("DELETE FROM `order` WHERE order_id = :order_id ");
        $stmt->bindParam(':order_id', $order_id);

        try {
            $stmt->execute();
            $popup1_message = "Order deleted successfully!";
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
        window.history.back();// Replace "AD_oder.php" with your desired redirect URL
    </script>
<?php } ?>


