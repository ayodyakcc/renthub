
<?php include("assets/navbar/navbar.php");?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title></title>
</head>
<body>
<?php
// Assuming you have already established a PDO connection to your database ($pdo)

// Get the user ID from the session


// Prepare the SQL statement with a WHERE clause to filter rental items by the user ID
$stmt = $pdo->prepare("SELECT * FROM `order` WHERE user_id = :user_id");

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
                        <h4>My Orders
                           
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
                                    <th>user Agreement</th>
                                    <th>date_count</th>
                                  
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($rental_items as $item) : ?>
                                            <tr>
                                            <td><?php echo $item['order_id']; ?></td>
                                            <td><?php echo $item['post_id']; ?></td>
                                            <td> <?php $item_name = getItemNameByPostId($pdo, $item['post_id']);  echo $item_name; ?></td>
                                            <td><?php echo $item['start_date']; ?></td>
                                            <td><?php echo $item['end_date']; ?></td>
                                            <td><?php echo $item['total_price']; ?></td>
                                            <td><?php echo $item['order_date']; ?></td>
                                            <td><?php echo $item['payment']; ?><button type="button" class="btn btn-success btn-sm">Pay</button></td>
                                            <td><button type="button" class="btn btn-info btn-sm" onclick="downloadAgreement()">Get Agreement</button>
</td>
                                            <td><?php echo $item['date_count']; ?></td>
                                           
                                                <td>
                                                  
                                                
                                                    <a href="delete_post.php?id=<?=$item['order_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                                    <a href="report.php?order_id=<?= $item['order_id']; ?>&post_id_id=<?= $item['post_id']; ?>" class="btn btn-primary btn-sm">Report</a>
                                                    
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
                         <!-- ... other HTML code ... -->
                         <script>
function downloadAgreement() {
    // Provide the URL to the generated PDF on the server
    var pdfUrl = "ABC.pdf"; // Replace with the actual URL of the generated PDF

    // Create a temporary link element to trigger the download
    var a = document.createElement("a");
    a.href = pdfUrl;
    a.download = "Rent_Hub_User_Agreement.pdf"; // Replace with the desired file name
    a.click();
}
</script>



                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>