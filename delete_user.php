<?php include("assets/navbar/navbar.php");?>
<?php
// Assuming you have already established a PDO connection to your database ($pdo)

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Prepare the SQL statement to delete the user
    $stmt = $pdo->prepare("DELETE FROM user WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);

    try {
        $stmt->execute();
        $popup1_message = "User deleted successfully!";
    } catch (PDOException $e) {
        $popup1_message = "Error: " . $e->getMessage();
    }
}

?>

<!-- HTML code to display the pop-up message -->
<?php if (!empty($popup1_message)) { ?>
    <script>
        alert("<?php echo $popup1_message; ?>");
        window.location.href = "AD_user.php"; // Replace "AD_user.php" with your desired redirect URL after user deletion
    </script>
<?php } ?>
