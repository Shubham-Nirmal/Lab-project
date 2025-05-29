<?php
session_start();
include('includes/header.php');
include('config/dbcon.php');
include('includes/topbar.php');
include('includes/sidebar.php');

// Number of blogs per page
$blogs_per_page = 10;

// Get the current page from the URL (default to 1 if not set)
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset (starting point for LIMIT)
$offset = ($current_page - 1) * $blogs_per_page;

// Get total number of blogs for pagination
$query_total = "SELECT COUNT(*) AS total_blogs FROM blogs";
$result_total = mysqli_query($db, $query_total);
$total_blogs = mysqli_fetch_assoc($result_total)['total_blogs'];

// Calculate the total number of pages
$total_pages = ceil($total_blogs / $blogs_per_page);

// Query to fetch blogs for the current page
$query = "SELECT * FROM blogs LIMIT $blogs_per_page OFFSET $offset";
$query_run = mysqli_query($db, $query);

if (!$query_run) {
    die("Query Failed: " . mysqli_error($db));
}
?>

<!-- Modal for adding new blog -->
<div class="modal fade" id="BlogModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Blog</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="image">Blog Image:</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
          </div>
          <!-- Multiple Blog Images -->
          <div class="form-group mb-3">
            <label for="images">Additional Blog Images (Multiple):</label>
            <input type="file" id="images" name="images[]" class="form-control" accept="image/*" multiple>
          </div>
          <!-- <div class="form-group mb-3">
            <label for="additional_images">Additional Blog Images:</label>
            <input type="file" id="additional_images" name="additional_images[]" class="form-control" accept="image/*" multiple>
          </div> -->

          <div class="form-group mb-3">
            <label for="heading">Blog Heading:</label>
            <input type="text" id="heading" name="heading" class="form-control" required>
          </div>

          <div class="form-group mb-3">
            <label for="paragraph">Blog Content:</label>
            <textarea name="paragraph" id="paragraph" class="form-control" rows="6" placeholder="Enter blog content here" required></textarea>
          </div>

          <div class="form-group mb-3">
            <label for="writer_name">Writer's Name:</label>
            <input type="text" id="writer_name" name="writer_name" class="form-control" required>
          </div>

          <div class="form-group mb-3">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="blog_save" class="btn btn-primary">Save</button>
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
                Manage Blogs
                <a href="#" data-bs-toggle="modal" data-bs-target="#BlogModal" class="btn btn-primary float-end">Add Blog</a>
              </h4>
            </div>
            <div class="card-body">
              <div class="table-responsive p-0">
              <table class="table table-hover text-nowrap">
    <thead>
        <tr>
            <th>Image</th>
            <th>Heading</th>
            <th>Content</th>
            <th>Writer</th>  <!-- Added column for Writer -->
            <th>Date</th>     <!-- Added column for Date -->
            <th>Additional Images</th> <!-- New Column for Multiple Images -->
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (mysqli_num_rows($query_run) > 0) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                <tr>
                    <td>
                        <?php if ($row['image']): ?>
                            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Blog Image" style="width: 100px; height: auto;">
                        <?php endif; ?>
                    </td>
                    <td style="white-space: normal; max-width: 1200px;"><?php echo htmlspecialchars($row['heading']); ?></td>
                    <td style="white-space: normal; max-width: 1200px;"><?php echo htmlspecialchars($row['paragraph']); ?>...</td>
                    <td><?php echo htmlspecialchars($row['writer_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>

                    <!-- Display Multiple Images -->
                    <td>
                        <?php
                        // Decode the additional images JSON data
                        $additional_images = json_decode($row['additional_images']);
                        if ($additional_images) {
                            foreach ($additional_images as $image_path) {
                                ?>
                                <img src="<?php echo htmlspecialchars($image_path); ?>" alt="Additional Image" style="width: 100px; height: auto; margin-right: 5px;">
                                <?php
                            }
                        }
                        ?>
                    </td>

                    <td>
                        <div class="d-flex justify-content-start align-items-center">
                            <a href="blog-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm mr-2">Edit</a>
                            <form action="code.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                <input type="hidden" name="blog_delete_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" name="blog_delete_btn" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="7">No Record Found</td> <!-- Updated colspan for new columns -->
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

              </div>

              <!-- Pagination -->
             <!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
  <!-- Previous Button -->
  <?php if ($current_page > 1): ?>
    <a href="?page=<?php echo $current_page - 1; ?>" class="btn btn-outline-primary rounded-3 me-2">
      &laquo; Previous <!-- "Previous" text with << arrow -->
    </a>
  <?php endif; ?>

  <!-- Page 1 Button -->
  <a href="?page=1" class="btn <?php echo ($current_page == 1) ? 'btn-primary' : 'btn-outline-primary'; ?> rounded-3 me-2">1</a>

  <!-- Page 2 Button (if applicable) -->
  <?php if ($total_pages > 1): ?>
    <a href="?page=2" class="btn <?php echo ($current_page == 2) ? 'btn-primary' : 'btn-outline-primary'; ?> rounded-3 me-2">2</a>
  <?php endif; ?>

  <!-- Next Button with >> Arrow -->
  <?php if ($current_page < $total_pages): ?>
    <a href="?page=<?php echo $current_page + 1; ?>" class="btn btn-outline-primary rounded-3 me-2">
      Next &raquo; <!-- "Next" text and the >> arrow -->
    </a>
  <?php endif; ?>
</div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>
