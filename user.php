<?php include("assets/navbar/navbar.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommendation</title>
</head>
<body>
<div  style="display: flex; flex-wrap: wrap; justify-content: space-between; margin: 10px;">

<!-- Fetch data from rental_items table -->
<?php
 $user_district = $_SESSION['district'];  

// Prepare and bind the user_district parameter to prevent SQL injection
$stmt = $pdo->prepare("SELECT post_id, picture, item_name, daily_price, district FROM rental_items WHERE district = :user_district");
$stmt->bindParam(':user_district', $user_district);
$stmt->execute();

$rental_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!-- Display cards using fetched data -->
<div class="card-deck">
  <?php foreach ($rental_items as $item) : ?>
    <div class="card" style="width: 18rem; margin: 10px;">
      <img src="<?php echo 'uploads/' . $item['picture']; ?>" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?php echo $item['item_name']; ?></h5>
        <p class="card-price">RS. <?php echo number_format($item['daily_price'], 2); ?>/DAY</p>
        <p class="card-price"> <?php echo $item['district']; ?></p>
      </div>
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a href="full_post.php?post_id=<?php echo $item['post_id']; ?>" class="btn btn-primary me-md-2">Rent This</a>
      </div>
    </div>
  <?php endforeach; ?>
</div>

</div>



</div>





</body>
</html>