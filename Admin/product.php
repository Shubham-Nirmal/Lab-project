<?php
session_start();
include('includes/header.php');
include('config/dbcon.php');
include('includes/topbar.php');
include('includes/sidebar.php');

// Set the number of products per page
$productsPerPage = 10;

// Get the search query from URL or form submission
$searchQuery = isset($_GET['search_query']) ? mysqli_real_escape_string($db, $_GET['search_query']) : '';

// Determine the current page number from URL
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure page number is at least 1

// Calculate the offset for SQL query
$offset = ($page - 1) * $productsPerPage;

// Build the base query with search filter if provided
$baseQuery = "SELECT p.id, p.name, p.photo, p.description, p.specification, p.pdf, c.name AS category_name 
              FROM products p 
              LEFT JOIN categories c ON p.category_id = c.id";

$countQuery = "SELECT COUNT(*) AS total FROM products p 
               LEFT JOIN categories c ON p.category_id = c.id";

// Ensure to specify the table alias (p for products) in the WHERE clause
if (!empty($searchQuery)) {
    $baseQuery .= " WHERE p.name LIKE '%$searchQuery%'";  // Use p.name to avoid ambiguity
    $countQuery .= " WHERE p.name LIKE '%$searchQuery%'";  // Use p.name to avoid ambiguity
}

// Count the total number of products (with or without search filter)
$totalProductsResult = mysqli_query($db, $countQuery);
$totalProductsRow = mysqli_fetch_assoc($totalProductsResult);
$totalProducts = $totalProductsRow['total'];

// Calculate the total number of pages
$totalPages = ceil($totalProducts / $productsPerPage);

// Fetch products for the current page (with or without search filter)
$query = $baseQuery . " LIMIT $productsPerPage OFFSET $offset";
$query_run = mysqli_query($db, $query);
?>

<!-- Modal -->
<div class="modal fade" id="ProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="code.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="product-name">Product Name:</label>
            <input type="text" name="name" id="product-name" class="form-control" required>
          </div>
          <div class="form-group">
  <label for="category_id">Category:</label>
  <select name="category_id" id="category_id" class="form-control" required>
    <option value="">Select Category</option>
    <?php
    // Fetch categories from the database
    $categoryQuery = "SELECT id, name FROM categories";
    $categoryResult = mysqli_query($db, $categoryQuery);

    if (mysqli_num_rows($categoryResult) > 0) {
      // Output categories in dropdown
      while ($category = mysqli_fetch_assoc($categoryResult)) {
        echo "<option value='" . htmlspecialchars($category['id']) . "'>" . htmlspecialchars($category['name']) . "</option>";
      }
    } else {
      // Option when no categories are available
      echo "<option value=''>No Categories Available</option>";
    }
    ?>
  </select>
</div>

          <div class="form-group">
            <label for="photo">Product Image:</label>
            <input type="file" name="photo" id="photo" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="description">Product Description:</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter product description here"></textarea>
          </div>

          <div class="form-group">
            <label for="specification">Product Specification:</label>
            <textarea name="specification" id="specification" class="form-control" rows="4" placeholder="Enter product specification here"></textarea>
          </div>

          <div class="form-group">
            <label for="pdf">Upload PDF (optional):</label>
            <input type="file" name="pdf" id="pdf" class="form-control" accept=".pdf">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="product_save" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content mt-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php include('message.php'); ?>

          <div class="card">
            <div class="card-header">
              <h4>
                Manage Products
                <a href="#" data-bs-toggle="modal" data-bs-target="#ProductModal" class="btn btn-primary float-end">Add</a>
              </h4>
            </div>
            <div class="card-body table-responsive p-0">
              <form action="" method="GET" class="d-flex mb-3">
                <input type="text" name="search_query" class="form-control" placeholder="Search product..." value="<?php echo htmlspecialchars($searchQuery); ?>" aria-label="Search">
                <button type="submit" class="btn btn-primary ms-2">Search</button>
              </form>

              <table class="table table-hover text-nowrap">
              <thead>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Photo</th>
    <th>Description</th>
    <th>Specification</th>
    <th>PDF</th>
    <th>Category</th>
    <th>Actions</th>
  </tr>
</thead>
<tbody>
  <?php
  if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $row) {
  ?>
    <tr>
      <td><?php echo htmlspecialchars($row['id']); ?></td>
      <td><?php echo htmlspecialchars($row['name']); ?></td>
      <td><img src="uploaded_images/<?php echo htmlspecialchars($row['photo']); ?>" alt="Product Image" style="width: 100px; height: auto;"></td>
      <td style="white-space: normal; max-width: 200px;"><?php echo htmlspecialchars($row['description']); ?></td>
      <td style="white-space: normal; max-width: 200px;"><?php echo htmlspecialchars($row['specification']); ?></td>
      <td>
        <?php if (!empty($row['pdf'])): ?>
          <a href="uploaded_pdfs/<?php echo htmlspecialchars($row['pdf']); ?>" target="_blank">View PDF</a>
        <?php else: ?>
          No PDF
        <?php endif; ?>
      </td>
      <td><?php echo htmlspecialchars($row['category_name']) ?: 'Uncategorized'; ?></td>
      <td>
        <a href="product-edit.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
        <form action="code.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
          <input type="hidden" name="pro_delete_id" value="<?php echo htmlspecialchars($row['id']); ?>">
          <button type="submit" name="pro_delete_btn" class="btn btn-danger btn-sm">Delete</button>
        </form>
      </td>
    </tr>
  <?php
    }
  } else {
  ?>
    <tr>
      <td colspan="8">No Record Found</td>
    </tr>
  <?php
  }
  ?>
</tbody>

              </table>
            </div>

            <!-- Pagination Links -->
            <div class="card-footer">
              <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                  <?php if ($page > 1): ?>
                    <li class="page-item">
                      <a class="page-link" href="?page=<?php echo $page - 1; ?>&search_query=<?php echo urlencode($searchQuery); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Previous</span>
                      </a>
                    </li>
                  <?php endif; ?>

                  <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                      <a class="page-link" href="?page=<?php echo $i; ?>&search_query=<?php echo urlencode($searchQuery); ?>"><?php echo $i; ?></a>
                    </li>
                  <?php endfor; ?>

                  <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                      <a class="page-link" href="?page=<?php echo $page + 1; ?>&search_query=<?php echo urlencode($searchQuery); ?>" aria-label="Next">
                        <span aria-hidden="true">Next &raquo;</span>
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </nav>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>
