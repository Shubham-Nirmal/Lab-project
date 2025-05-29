<?php
session_start();
include('includes/header.php');
include('config/dbcon.php');
include('includes/topbar.php');
include('includes/sidebar.php');

// Set the number of categories per page
$categoriesPerPage = 5;

// Determine the current page number from URL
$categoryPage = isset($_GET['category_page']) ? (int)$_GET['category_page'] : 1;
$categoryPage = max($categoryPage, 1); // Ensure page number is at least 1

// Calculate the offset for SQL query
$categoryOffset = ($categoryPage - 1) * $categoriesPerPage;

// Base query for categories
$categoryBaseQuery = "SELECT id, name, image FROM categories";
$totalCategoriesQuery = "SELECT COUNT(*) AS total FROM categories";

// Count the total number of categories
$totalCategoriesResult = mysqli_query($db, $totalCategoriesQuery);
$totalCategoriesRow = mysqli_fetch_assoc($totalCategoriesResult);
$totalCategories = $totalCategoriesRow['total'];

// Calculate the total number of pages
$totalCategoryPages = ceil($totalCategories / $categoriesPerPage);

// Fetch categories for the current page
$categoryQuery = $categoryBaseQuery . " LIMIT $categoriesPerPage OFFSET $categoryOffset";
$categoryQueryRun = mysqli_query($db, $categoryQuery);
?>

<!-- Modal -->
<div class="modal fade" id="CategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="category-name">Category Name:</label>
            <input type="text" name="category_name" id="category-name" class="form-control" required>
          </div>
          <div class="form-group mb-3">
            <label for="category-image">Category Image:</label>
            <input type="file" name="category_image" id="category-image" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="category_save" class="btn btn-primary">Save</button>
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
                Manage Categories
                <a href="#" data-bs-toggle="modal" data-bs-target="#CategoryModal" class="btn btn-primary float-end">Add</a>
              </h4>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (mysqli_num_rows($categoryQueryRun) > 0) {
                    foreach ($categoryQueryRun as $row) {
                  ?>
                    <tr>
                      <td><?php echo htmlspecialchars($row['name']); ?></td>
                      <td>
                        <?php
                        $imagePath = 'uploaded_images/' . $row['image'];
                        if (file_exists($imagePath)) {
                        ?>
                          <img src="<?php echo $imagePath; ?>" alt="Category Image" style="width: 100px; height: auto;">
                        <?php } else { ?>
                          <span>No Image</span>
                        <?php } ?>
                      </td>
                      <td>
                        <a href="category-edit.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="code.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                          <input type="hidden" name="cat_delete_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                          <button type="submit" name="cat_delete_btn" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                      </td>
                    </tr>
                  <?php
                    }
                  } else {
                  ?>
                    <tr>
                      <td colspan="3">No Record Found</td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- Pagination Links for Categories -->
            <div class="card-footer">
              <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                  <?php if ($categoryPage > 1): ?>
                    <li class="page-item">
                      <a class="page-link" href="?category_page=<?php echo $categoryPage - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Previous</span>
                      </a>
                    </li>
                  <?php endif; ?>

                  <?php for ($i = 1; $i <= $totalCategoryPages; $i++): ?>
                    <li class="page-item <?php if ($i == $categoryPage) echo 'active'; ?>">
                      <a class="page-link" href="?category_page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                  <?php endfor; ?>

                  <?php if ($categoryPage < $totalCategoryPages): ?>
                    <li class="page-item">
                      <a class="page-link" href="?category_page=<?php echo $categoryPage + 1; ?>" aria-label="Next">
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
