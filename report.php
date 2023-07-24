<?php include("assets/navbar/navbar.php"); ?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Report Order</title>
</head>
<body>
    <?php
    // Get Order ID and Post ID from the URL parameters
    if (isset($_GET["order_id"]) && isset($_GET["product_id"])) {
        $orderId = $_GET["order_id"];
        $productId = $_GET["product_id"];
    } else {
        // Redirect to index.php if Order ID and Post ID are not provided
        header("Location: index.php");
        exit;
    }
    ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Report Order</h4>
                    </div>
                    <div class="card-body">
                        <form id="reportForm">
                            <div class="form-group">
                                <label for="orderIdInput">Order ID</label>
                                <input type="text" class="form-control" id="orderIdInput" name="order_id" readonly value="<?php echo $orderId; ?>">
                            </div>
                            <div class="form-group">
                                <label for="productIdInput">Post ID</label>
                                <input type="text" class="form-control" id="productIdInput" name="product_id" readonly value="<?php echo $productId; ?>">
                            </div>
                            <div class="form-group">
                                <label for="reportDescription">Report Description</label>
                                <textarea class="form-control" id="reportDescription" name="description" required></textarea>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="submitReport()">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
</body>
</html>
