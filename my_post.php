<?php include("assets/navbar/navbar.php");?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student CRUD</title>
</head>
<body>
<?php
// Assuming you have already established a PDO connection to your database ($pdo)

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Prepare the SQL statement with a WHERE clause to filter rental items by the user ID
$stmt = $pdo->prepare("SELECT post_id, item_name, description, daily_price, district, picture, address, contact_no, category FROM rental_items WHERE user_id = :user_id");

// Bind the user ID parameter to the prepared statement
$stmt->bindParam(':user_id', $user_id);

// Execute the query
$stmt->execute();

// Fetch all rental items that belong to the current user
$rental_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

  
    <div class="container mt-4">

       

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h4>My posts
                            <a href="add_post.php" class="btn btn-primary float-end">Add post</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>post_id </th>
                                    <th>item_name</th>
                                    <th>description</th>
                                    <th>daily_price</th>
                                    <th>district</th>
                                    <th>picture</th>
                                    <th>address</th>
                                    <th>contact_no</th>
                                    <th>category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($rental_items as $item) : ?>
                                            <tr>
                                            <td><?php echo $item['post_id']; ?></td>
                                            <td><?php echo $item['item_name']; ?></td>
                                            <td><?php echo $item['description']; ?></td>
                                            <td><?php echo $item['daily_price']; ?></td>
                                            <td><?php echo $item['district']; ?></td>
                                            <td><img src="<?php echo 'uploads/' . $item['picture']; ?>" class="card-img-top" alt="..."></td>
                                            <td><?php echo $item['address']; ?></td>
                                            <td><?php echo $item['contact_no']; ?></td>
                                            <td><?php echo $item['category']; ?></td>
                                                <td>
                                                  
                                                    <a href="update.php?id=<?=$item['post_id']; ?>" class="btn btn-success btn-sm">update</a>
                                                    <a href="delete_post.php?id=<?=$item['post_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                                    <a href="myoder.php?id=<?=$item['post_id']; ?>" class="btn btn-warning btn-sm">Renting Orders</a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>