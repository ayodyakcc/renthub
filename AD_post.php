<?php include("assets/navbar/navbarA.php");?>
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
$stmt = $pdo->query("SELECT post_id, item_name, description, daily_price, district, picture, address, contact_no, category FROM rental_items");
$rental_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
    <div class="input-group" style="display: flex; flex-wrap: wrap; justify-content: center; margin: 10px;">
        <input type="search" class="form-control rounded" id="searchInput" placeholder="Search with post ID" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-outline-primary ml-2" id="searchButton">Search</button>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>My posts</h4>
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
                                <td class="card-title"><?php echo $item['post_id']; ?></td>
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
<script>
// Function to search for items
function searchItems(searchTerm) {
    $('.table tbody tr').each(function() {
        const postID = $(this).find('.card-title').text();
        if (postID.includes(searchTerm)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

// Search for items when search button is clicked
$('#searchButton').click(function() {
    const searchTerm = $('#searchInput').val();
    searchItems(searchTerm);
});
</script>

</body>
</html>
