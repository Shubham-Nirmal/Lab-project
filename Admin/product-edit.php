<?php
session_start();
include('includes/header.php');
include('config/dbcon.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

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
                            Edit Product
                            <a href="product.php" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
    <?php
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($db, $_GET['id']);
        $query = "SELECT * FROM products WHERE id='$id' LIMIT 1";
        $query_run = mysqli_query($db, $query);

        if ($query_run && mysqli_num_rows($query_run) > 0) {
            $row = mysqli_fetch_assoc($query_run);
    ?>
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

    <!-- Product Name -->
    <div class="form-group mb-3">
        <label for="product-name">Product Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" class="form-control" id="product-name" placeholder="Product Name" required>
    </div>

    <!-- Category Selection -->
    <div class="form-group mb-3">
        <label for="category">Category</label>
        <select name="category" id="category" class="form-control" required>
            <option value="">Select Category</option>
            <?php
            // Fetch categories
            $category_query = "SELECT * FROM categories";
            $category_query_run = mysqli_query($db, $category_query);
            if ($category_query_run && mysqli_num_rows($category_query_run) > 0) {
                while ($category_row = mysqli_fetch_assoc($category_query_run)) {
                    // Set selected category
                    $selected = ($category_row['id'] == $row['category_id']) ? 'selected' : '';
                    echo "<option value='{$category_row['id']}' $selected>{$category_row['name']}</option>";
                }
            }
            ?>
        </select>
    </div>

    <!-- Product Image -->
    <div class="form-group mb-3">
        <label for="photo">Product Image</label>
        <input type="file" name="photo" id="photo" class="form-control">
        <?php if (!empty($row['photo'])): ?>
            <img src="uploaded_images/<?php echo htmlspecialchars($row['photo']); ?>" alt="Product Image" style="width: 100px; height: auto; margin-top: 10px;">
        <?php endif; ?>
    </div>

    <!-- Product Description -->
    <div class="form-group mb-3">
        <label for="description">Product Description</label>
        <textarea name="description" class="form-control" id="description" rows="4" placeholder="Enter product description" required><?php echo htmlspecialchars($row['description']); ?></textarea>
    </div>

    <!-- Product Specifications -->
    <div class="form-group mb-3">
        <label for="specification">Product Specifications</label>
        <textarea name="specification" class="form-control" id="specification" rows="4" placeholder="Enter product specifications"><?php echo htmlspecialchars($row['specification']); ?></textarea>
    </div>

    <!-- PDF Upload -->
    <div class="form-group mb-3">
        <label for="pdf">Product PDF</label>
        <input type="file" name="pdf" id="pdf" class="form-control">
        <?php if (!empty($row['pdf'])): ?>
            <a href="uploaded_pdfs/<?php echo htmlspecialchars($row['pdf']); ?>" target="_blank">View current PDF</a>
        <?php endif; ?>
    </div>

    <!-- Buttons -->
    <div class="modal-footer">
        <a href="product.php" class="btn btn-secondary" style="margin-right: 15px; padding: 10px 20px;">Back</a>
        <button type="submit" name="product_update" class="btn btn-primary" style="padding: 10px 20px;">Update</button>
    </div>

    <?php
        } else {
            echo "<h4>No record found</h4>";
        }
    }
    ?>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>
