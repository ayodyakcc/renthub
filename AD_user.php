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

$stmt = $pdo->prepare("SELECT * FROM `user`");
$stmt->execute();
$rental_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container mt-4">
    <div class="input-group" style="display: flex; flex-wrap: wrap; justify-content: center; margin: 10px;">
        <input type="search" class="form-control rounded" id="searchInput" placeholder="Search with user ID" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-outline-primary ml-2" id="searchButton">Search</button>
    </div>

  
    <div class="container mt-4">

       

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h4>User Managemanet
                       
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>id  </th>
                                    <th>user_type</th>
                                    <th>first_name</th>
                                    <th>last_name</th>
                                    <th>email</th>
                                    <th>password</th>
                                    <th>contact_no</th>
                                    <th>address</th>
                                    <th>nic_number</th>
                                    <th>district</th>
                                  
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($rental_items as $item) : ?>
                                            <tr>
                                            <td class="card-title"><?php echo $item['user_id']; ?></td>
                                            <td><?php echo $item['user_type']; ?></td>
                                            <td><?php echo $item['first_name']; ?></td>
                                            <td><?php echo $item['last_name']; ?></td>
                                            <td><?php echo $item['email']; ?></td>
                                            <td><?php echo $item['password']; ?></td>
                                            <td><?php echo $item['contact_no']; ?></td>
                                            <td><?php echo $item['address']; ?></td>
                                            <td><?php echo $item['nic_number']; ?></td>
                                            <td><?php echo $item['district']; ?></td>
                                           
                                                <td>
                                                  
                                                <a href="update_user.php?id=<?=$item['user_id']; ?>" class="btn btn-success btn-sm">update</a>
                            </br>
                                                    <a href="delete_user.php?id=<?=$item['user_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                                    
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