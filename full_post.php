<?php include("assets/navbar/navbar.php");?>
<?php
?>
<!-- Fetch data from rental_items table -->
<?php

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $stmt = $pdo->prepare("SELECT * FROM rental_items WHERE post_id = :post_id");
    $stmt->bindParam(':post_id', $post_id);
    $stmt->execute();
    $rental_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Rest of your code to display rental item details
}


?>
<div style="display: flex; flex-wrap: wrap; justify-content: space-between; margin: 10px;">
<!-- Display rental items in an HTML table -->
<!-- <div class="card" style="width: 18rem; margin: 10px;"> -->
<!-- Display rental items in an HTML table -->

    <?php foreach ($rental_items as $item) : ?>
       
      <div style="col-md-4">
    <img src="<?php echo 'uploads/' . $item['picture']; ?>" class="card-img-top" alt="...">
</div>
<div class="card-body" style="flex: 2;">
    <h2 class="card-title"><?php echo $item['item_name']; ?></h2>
    <p class="card-price">RS. <?php echo number_format($item['daily_price'], 2); ?>/DAY</p>
    <p class="card-text"><?php echo $item['description']; ?></p>
    <p class="card-text">District: <?php echo $item['district']; ?></p>
    <p class="card-text">Address: <?php echo $item['address']; ?></p>
    <p class="card-text">Contact No: <?php echo $item['contact_no']; ?></p>
    <p class="card-text">Category: <?php echo $item['category']; ?></p>
    <div>
    <h5>Select Rental Period</h5>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <!-- Hidden fields to store order data -->
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
        <input type="hidden" name="post_id" value="<?php echo $item['post_id']; ?>">
        <input type="hidden" name="daily_price" value="<?php echo $item['daily_price']; ?>">
        
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>
        <br>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>
        <br>
        <!-- Hidden fields to store date difference and total cost -->
        <input type="hidden" name="date_difference" id="date_difference_input">
        <input type="hidden" name="total_cost" id="total_cost_input">

        <!-- Display the date difference and total cost -->
        <p>Date Difference: <span id="date_difference"></span> days</p>
        <p>Total Cost: RS. <span id="total_cost"></span></p>
    </div>
        <input class="btn btn-primary" type="submit"  id="submitBtn" value="Submit">
    </form>
   
    
</div>

   
</div>

  
</div>

           
        
    <?php endforeach; ?>
<!-- </div> -->
<script>
        // Get references to the date inputs and the display elements
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const dateDifferenceDisplay = document.getElementById('date_difference');
        const totalCostDisplay = document.getElementById('total_cost');
        const dateDifferenceInput = document.getElementById('date_difference_input');
        const totalCostInput = document.getElementById('total_cost_input');

        // Set the minimum start date to tomorrow
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        const tomorrowStr = tomorrow.toISOString().split('T')[0];
        startDateInput.min = tomorrowStr;

        // Function to calculate the date difference and total cost
        function calculateDateDifferenceAndTotalCost() {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            dateDifferenceDisplay.textContent = diffDays;
            dateDifferenceInput.value = diffDays; // Set the value of the hidden input field
            const dailyPrice = <?php echo $item['daily_price']; ?>;
            const totalCost = diffDays * dailyPrice;
            totalCostDisplay.textContent = totalCost.toFixed(2);
            totalCostInput.value = totalCost.toFixed(2); // Set the value of the hidden input field
        }

        // Event listener to calculate the date difference and total cost whenever the end date changes
        endDateInput.addEventListener('change', calculateDateDifferenceAndTotalCost);
</script>



    </div>

    <?php

                          if ($_SERVER["REQUEST_METHOD"] === "POST") {
                        
                          $post_id = $_POST['post_id'];
                          $start_date = $_POST['start_date'];
                          $end_date = $_POST['end_date'];
                          $total_price = $_POST['total_cost'];
                          $order_date = date('Y-m-d'); // Get the current date

                          $date_count = $_POST['date_difference'];

                          // Prepare the SQL insert statement using PDO prepared statements to prevent SQL injection
                          $stmt = $pdo->prepare("INSERT INTO `order` (user_id, post_id, start_date, end_date, total_price, order_date, date_count)
                                                VALUES (:user_id, :post_id, :start_date, :end_date, :total_price, :order_date, :date_count)");

                          // Bind the parameters
                          $stmt->bindParam(':user_id', $user_id);
                          $stmt->bindParam(':post_id', $post_id);
                          $stmt->bindParam(':start_date', $start_date);
                          $stmt->bindParam(':end_date', $end_date);
                          $stmt->bindParam(':total_price', $total_price);
                          $stmt->bindParam(':order_date', $order_date);
                          // Replace $rating with the actual rating value
                          $stmt->bindParam(':date_count', $date_count);


                          
                          try {
                            // Execute the SQL insert statement to save the order data
                            $stmt->execute();
                            $popup_message = "order added successfully"; 
                            
                    
                           
                        } catch (PDOException $e) {
                            $popup_message = "Error: " . $e->getMessage();
                        }
                    }
                    ?>
                         

<!-- JavaScript code for displaying the pop-up message and redirecting -->
<?php if (!empty($popup_message)) { ?>
        <script>
            alert("<?php echo $popup_message; ?>");
            window.location.href = "find_item.php"; // Replace "index.php" with your desired redirect URL
        </script>
    <?php } ?>
