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
                            Edit Subcategory
                            <a href="subcategory.php" class="btn btn-danger float-right">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
    <?php
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($db, $_GET['id']);
        $query = "SELECT * FROM subcategories WHERE id='$id' LIMIT 1";
        $query_run = mysqli_query($db, $query);

        if ($query_run && mysqli_num_rows($query_run) > 0) {
            $row = mysqli_fetch_assoc($query_run);
    ?>
    <!-- Form starts here -->
        <input type="hidden" name="subcategory_id" value="<?php echo htmlspecialchars($row['id']); ?>">

        <div class="form-group mb-3">
            <label for="category-id">Select Category</label>
            <select name="category_id" class="form-control" id="category-id" required>
                <option value="">Choose Category</option>
                <?php
                // Fetch categories for the dropdown
                $category_query = "SELECT * FROM categories";
                $category_run = mysqli_query($db, $category_query);

                if (mysqli_num_rows($category_run) > 0) {
                    foreach ($category_run as $category) {
                ?>
                <option value="<?php echo $category['id']; ?>" <?php echo ($row['category_id'] == $category['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category['name']); ?>
                </option>
                <?php
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="subcategory-name">Subcategory Name</label>
            <input type="text" name="subcategory_name" value="<?php echo htmlspecialchars($row['name']); ?>" class="form-control" id="subcategory-name" placeholder="Subcategory Name">
        </div>

        <div class="form-group mb-3">
            <label for="subcategory-image">Subcategory Image</label>
            <input type="file" name="subcategory_image" id="subcategory-image" class="form-control">
            <?php if (!empty($row['image'])): ?>
                <img src="uploaded_images/<?php echo htmlspecialchars($row['image']); ?>" alt="Subcategory Image" style="width: 100px; height: auto; margin-top: 10px;">
            <?php endif; ?>
        </div>

        <div class="modal-footer">
            <a href="subcategory.php" class="btn btn-secondary" style="margin-right: 15px; padding: 10px 20px;">Back</a>
            <button type="submit" name="subcategory_update" class="btn btn-primary" style="padding: 10px 20px;">Update</button>
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
