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

$stmt = $pdo->prepare("SELECT * FROM `order`");
$stmt->execute();
$rental_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container mt-4">
    <div class="input-group" style="display: flex; flex-wrap: wrap; justify-content: center; margin: 10px;">
        <input type="search" class="form-control rounded" id="searchInput" placeholder="Search with Oder ID" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-outline-primary ml-2" id="searchButton">Search</button>
    </div>

  
    <div class="container mt-4">

       

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h4>Oder Managemanet
                       
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>order_id  </th>
                                    <th>product_id</th>
                                    <th>product_Name</th>
                                    <th>start_date</th>
                                    <th>end_date</th>
                                    <th>total_price</th>
                                    <th>order_date</th>
                                    <th>payment</th>
                                    <th>date_count</th>
                                  
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($rental_items as $item) : ?>
                                            <tr>
                                            <td class="card-title"><?php echo $item['order_id']; ?></td>
                                            <td><?php echo $item['post_id']; ?></td>
                                            <td> <?php $item_name = getItemNameByPostId($pdo, $item['post_id']);  echo $item_name; ?></td>
                                            <td><?php echo $item['start_date']; ?></td>
                                            <td><?php echo $item['end_date']; ?></td>
                                            <td><?php echo $item['total_price']; ?></td>
                                            <td><?php echo $item['order_date']; ?></td>
                                            <td><?php echo $item['payment']; ?></td>
                                            <td><?php echo $item['date_count']; ?></td>
                                           
                                                <td>
                                                  
                                                    
                                                    <a href="delete_oder.php?id=<?=$item['order_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                                    
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                                                                                    <?php
                                                        // Function to get item_name by post_id
                                                        function getItemNameByPostId($pdo, $post_id) {
                                                            $sql = "SELECT item_name FROM rental_items WHERE post_id = :post_id";
                                                            $stmt = $pdo->prepare($sql);
                                                            $stmt->bindParam(':post_id', $post_id);
                                                            $stmt->execute();
                                                            $item_name = $stmt->fetchColumn();
                                                            return $item_name;
                                                        }

                                                        // Assuming you have already established a PDO connection to your database ($pdo)
                                                        // ... Other code ...

                                                        ?>
                                
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
        const parsedPostID = parseInt(postID, 10); // Convert postID to a number

        // Check if the searchTerm can be parsed as a number
        const parsedSearchTerm = parseInt(searchTerm, 10);

        if (!isNaN(parsedPostID) && !isNaN(parsedSearchTerm) && parsedPostID === parsedSearchTerm) {
            $(this).show();
        } else if (postID.includes(searchTerm)) {
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