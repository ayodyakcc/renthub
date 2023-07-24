<?php include("assets/navbar/navbar.php");?>
<?php include 'boostrap.html'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommendation</title>
    <style>
        /* Set the width of the search bar container to 20% */
        .search-container {
            width: 50%;
        }
    </style>
</head>
<body>
<div class="input-group" style="display: flex; flex-wrap: wrap; justify-content: space-between; margin: 10px;">
<div class="container">
<div class="input-group" style="display: flex; flex-wrap: wrap; justify-content: center; margin: 10px;">
        
            <input type="search" class="form-control rounded" id="searchInput" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <button type="button" class="btn btn-outline-primary ml-2" id="searchButton">Search</button>
            </div>
        </div>
</div>
<div style="display: flex; flex-wrap: wrap; justify-content: space-between; margin: 20px;">
  <!-- Fetch data from rental_items table -->
  <?php
  $stmt = $pdo->query("SELECT post_id, picture, item_name, daily_price, district,category FROM rental_items");
  $rental_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>

  <!-- Display cards using fetched data -->
  <div class="card-deck">
    <div>
    <h4>Select Category:</h4>
      <br>
      <div class="form-check">
        <input class="form-check-input category-filter" type="radio" name="category" value="All" id="flexRadioDefault0" checked>
        <label class="form-check-label" for="flexRadioDefault0">All</label>
      </div>
      <br>
      <div class="form-check">
        <input class="form-check-input category-filter" type="radio" name="category" value="Vehicles" id="flexRadioDefault1">
        <label class="form-check-label" for="flexRadioDefault1">Vehicles</label>
      </div>
      <br>
      <div class="form-check">
        <input class="form-check-input category-filter" type="radio" name="category" value="Electronics" id="flexRadioDefault2">
        <label class="form-check-label" for="flexRadioDefault2">Electronics</label>
      </div>
      <br>
      <div class="form-check">
        <input class="form-check-input category-filter" type="radio" name="category" value="Home and Garden" id="flexRadioDefault3">
        <label class="form-check-label" for="flexRadioDefault3">Home and Garden</label>
      </div>
      <br>
      <div class="form-check">
        <input class="form-check-input category-filter" type="radio" name="category" value="Others" id="flexRadioDefault4">
        <label class="form-check-label" for="flexRadioDefault4">Others</label>
      </div>
      <br>
      <div>
      <button type="button" class="btn btn-primary" id="filterButton">Filter</button>
    </div>
    </div>

  <!-- ... (your HTML code) ... -->

<?php foreach ($rental_items as $item) : ?>
  <div class="card filter-item" style="width: 18rem; margin: 10px;">
    <img src="<?php echo 'uploads/' . $item['picture']; ?>" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><?php echo $item['item_name']; ?></h5>
      <p class="card-price">RS. <?php echo number_format($item['daily_price'], 2); ?>/DAY</p>
      <p class="card-category" style="display: none;"><?php echo $item['category']; ?></p> <!-- Added category information -->
      <p class="card-district" style="display: none;"><?php echo $item['district']; ?></p> <!-- Added district information -->
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a href="full_post.php?post_id=<?php echo $item['post_id']; ?>" class="btn btn-primary me-md-2">Rent This</a>
    </div>
  </div>
<?php endforeach; ?>

<!-- ... (rest of your HTML code) ... -->

  </div>
</div>

<script>
  // Function to filter items based on the selected category
  function filterItemsByCategory(category) {
    $('.filter-item').each(function() {
      const itemCategory = $(this).find('.card-category').text().trim();
      if (category === 'All' || itemCategory === category) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  }

  // Filter items based on the selected category when the filter button is clicked
  $('#filterButton').click(function() {
    const selectedCategory = $('input[name="category"]:checked').val();
    filterItemsByCategory(selectedCategory);
  });

  // Function to search for items
  function searchItems(searchTerm) {
    $('.card').each(function() {
      const itemName = $(this).find('.card-title').text().toLowerCase();
      if (itemName.includes(searchTerm.toLowerCase())) {
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
