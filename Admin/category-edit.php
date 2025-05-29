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
                                Edit Category
                                <a href="category.php" class="btn btn-danger float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
    <?php
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($db, $_GET['id']);
        $query = "SELECT * FROM categories WHERE id='$id' LIMIT 1";
        $query_run = mysqli_query($db, $query);

        if ($query_run && mysqli_num_rows($query_run) > 0) {
            $row = mysqli_fetch_assoc($query_run);
    ?>
    <!-- Form starts here -->
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="current_image" value="<?php echo $row['image']; ?>">

        <div class="form-group mb-3">
            <label for="category_name">Category Name</label>
            <input type="text" name="category_name" value="<?php echo $row['name']; ?>" class="form-control" id="category_name" placeholder="Category Name" required>
        </div>

        <div class="form-group mb-3">
            <label for="category_image">Category Image</label>
            <input type="file" name="category_image" id="category_image" class="form-control">
            <?php if (!empty($row['image'])): ?>
                <!-- Display the current image -->
                <img src="uploaded_images/<?php echo $row['image']; ?>" alt="Category Image" style="width: 100px; height: auto; margin-top: 10px;">
            <?php endif; ?>
        </div>

        <div class="modal-footer">
            <a href="category.php" class="btn btn-secondary" style="margin-right: 15px; padding: 10px 20px;">Back</a>
            <button type="submit" name="category_update" class="btn btn-primary" style="padding: 10px 20px;">Edit</button>
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
