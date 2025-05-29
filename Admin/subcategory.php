<?php
session_start();
include('includes/header.php'); 
include('config/dbcon.php');
include('includes/topbar.php');
include('includes/sidebar.php');

// Pagination variables
$limit = 10;  // Number of subcategories per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Search functionality
$search_query = '';
$search_condition = '';
if (isset($_GET['search'])) {
    $search_query = mysqli_real_escape_string($db, $_GET['search']);
    $search_condition = "WHERE s.name LIKE '%$search_query%' OR c.name LIKE '%$search_query%'";
}

// Query to get all subcategories with category names and pagination
$query = "SELECT s.id AS subcategory_id, s.name AS subcategory_name, c.name AS category_name, s.image 
          FROM subcategories s 
          JOIN categories c ON s.category_id = c.id $search_condition 
          LIMIT $limit OFFSET $offset";
$query_run = mysqli_query($db, $query);

// Query to count total records for pagination
$count_query = "SELECT COUNT(s.id) AS total FROM subcategories s JOIN categories c ON s.category_id = c.id $search_condition";
$count_result = mysqli_query($db, $count_query);
$total_records = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_records / $limit);
?>

<!-- Modal for Adding Subcategory -->
<div class="modal fade" id="SubcategoryModal" tabindex="-1" aria-labelledby="subcategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="subcategoryModalLabel">Add Subcategory</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="subcategory_name">Subcategory Name:</label>
            <input type="text" id="subcategory_name" name="subcategory_name" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="subcategory_image">Subcategory Image:</label>
            <input type="file" name="subcategory_image" id="subcategory_image" class="form-control" accept="image/*" required>
          </div>
          <div class="form-group">
            <label for="category_id">Select Category:</label>
            <select name="category_id" id="category_id" class="form-control" required>
              <option value="">-- Select Category --</option>
              <?php
              // Fetch categories for the dropdown
              $category_query = "SELECT * FROM categories";
              $category_result = mysqli_query($db, $category_query);
              while ($category = mysqli_fetch_assoc($category_result)) {
                echo "<option value='" . htmlspecialchars($category['id']) . "'>" . htmlspecialchars($category['name']) . "</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="subcategory_save" class="btn btn-primary">Save</button>
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

          <div class="card mt-4">
            <div class="card-header">
              <h4>
                Manage Subcategories
                <a href="#" data-bs-toggle="modal" data-bs-target="#SubcategoryModal" class="btn btn-primary float-end">Add Subcategory</a>
              </h4>
            </div>
            <div class="card-body table-responsive p-0">
              <!-- Search Form -->
              <form method="GET" action="">
                <div class="input-group mb-3">
                  <input type="text" name="search" class="form-control" placeholder="Search subcategories..." value="<?php echo htmlspecialchars($search_query); ?>">
                  <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
              </form>
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Subcategory Name</th>
                    <th>Category Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $row) {
                  ?>
                    <tr>
                      <td><?php echo htmlspecialchars($row['subcategory_name']); ?></td>
                      <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                      <td>
                        <img src="uploaded_images/<?php echo htmlspecialchars($row['image']); ?>" alt="Subcategory Image" style="width: 100px; height: auto;">
                      </td>
                      <td>
                        <a href="subcategory_edit.php?id=<?php echo $row['subcategory_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="code.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this subcategory?');">
                          <input type="hidden" name="subcat_delete_id" value="<?php echo $row['subcategory_id']; ?>">
                          <button type="submit" name="subcat_delete_btn" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                      </td>
                    </tr>
                  <?php
                    }
                  } else {
                  ?>
                    <tr>
                      <td colspan="4">No Record Found</td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <div class="card-footer">
              <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                  <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=1&search=<?php echo htmlspecialchars($search_query); ?>" aria-label="First">
                      <span aria-hidden="true">&laquo;&laquo;</span>
                    </a>
                  </li>
                  <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo htmlspecialchars($search_query); ?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo htmlspecialchars($search_query); ?>"><?php echo $i; ?></a></li>
                  <?php } ?>
                  <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo htmlspecialchars($search_query); ?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                  <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $total_pages; ?>&search=<?php echo htmlspecialchars($search_query); ?>" aria-label="Last">
                      <span aria-hidden="true">&raquo;&raquo;</span>
                    </a>
                  </li>
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
