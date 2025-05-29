<?php
session_start();
include('includes/header.php');
include('config/dbcon.php');
include('includes/topbar.php');
include('includes/sidebar.php');

// Fetch blog details using the blog ID
if (isset($_GET['id'])) {
    $blog_id = mysqli_real_escape_string($db, $_GET['id']);
    $query = "SELECT * FROM blogs WHERE id='$blog_id' LIMIT 1"; 
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $blog = mysqli_fetch_array($query_run);
    } else {
        $_SESSION['message'] = "No Blog Found";
        header('Location: blog.php');
        exit(0);
    }
} else {
    $_SESSION['message'] = "Invalid Access";
    header('Location: blog.php');
    exit(0);
}
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
                                Edit Blog
                                <a href="blog.php" class="btn btn-danger float-right">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="blog_id" value="<?php echo htmlspecialchars($blog['id']); ?>">

                                <div class="form-group">
                                    <label for="heading">Blog Heading:</label>
                                    <input type="text" id="heading" name="heading" value="<?php echo htmlspecialchars($blog['heading']); ?>" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="paragraph">Blog Content:</label>
                                    <textarea name="paragraph" id="paragraph" class="form-control" rows="6" required><?php echo htmlspecialchars($blog['paragraph']); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="writer_name">Writer's Name:</label>
                                    <input type="text" id="writer_name" name="writer_name" value="<?php echo htmlspecialchars($blog['writer_name']); ?>" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="date">Date:</label>
                                    <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($blog['date']); ?>" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="image">Blog Image:</label>
                                    <input type="file" id="image" name="image" accept="image/*">
                                    <?php if ($blog['image']): ?>
                                        <p>Current Image: <img src="<?php echo htmlspecialchars($blog['image']); ?>" alt="Blog Image" width="100"></p>
                                    <?php endif; ?>
                                </div>
                                <!-- Additional Images Section -->
                                <div class="form-group">
                                    <label for="additional_images">Additional Images:</label>
                                    <input type="file" id="additional_images" name="additional_images[]" accept="image/*" multiple>
                                    <?php
                                    // Check if additional images exist and display them
                                    if ($blog['additional_images']) {
                                        $additional_images = json_decode($blog['additional_images'], true);
                                        if (is_array($additional_images)) {
                                            echo '<p>Current Additional Images:</p>';
                                            echo '<div class="row">';
                                            foreach ($additional_images as $img) {
                                                echo '<div class="col-md-4"><img src="' . htmlspecialchars($img) . '" alt="Additional Image" width="100" class="mb-2"></div>';
                                            }
                                            echo '</div>';
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="blog_update" class="btn btn-primary">Update</button>
                                </div>
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
