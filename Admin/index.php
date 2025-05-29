<?php
// Start session if it's not already started
if (session_status() == PHP_SESSION_NONE) {     
    session_start(); 
}

// Check if the user is authenticated
if (!isset($_SESSION['auth'])) {
    // Redirect to login page with a status message
    $_SESSION['status'] = "Please log in to access the dashboard";
    header("Location: login.php");
    exit(0);
}
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');




?>

<?php
$dbHost = 'localhost';
$dbName = 'moryacat_labindia';
$dbUsername = 'moryacat_labindia';
$dbPassword = 'Labindia@7896';
$db = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName); 

//check connection
if(!$db) // Use $db instead of $con
{
    header("Location: ../errors/db.php");
    die();
}
else{
    //echo "database connected!";
}
$category_count = $db->query("SELECT COUNT(*) AS count FROM categories")->fetch_assoc()['count'];
$subcategory_count = $db->query("SELECT COUNT(*) AS count FROM subcategories")->fetch_assoc()['count'];
$product_count = $db->query("SELECT COUNT(*) AS count FROM products")->fetch_assoc()['count'];
$blog_count =$db->query("SELECT COUNT(*) AS count FROM blogs")->fetch_assoc()['count'];
$user_count = $db->query("SELECT COUNT(*) AS count FROM users")->fetch_assoc()['count'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">
    <i class="fas fa-tachometer-alt"></i> Dashboard v1
</li>

            </ol>
          </div>
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                      <div class="inner">
                      <h3><?php echo $category_count; ?></h3>
                          <p>category</p>
                      </div>
                      <div class="icon">
                      <i class="ion ion-pricetag"></i>
                      </div>
                      <a href="category.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                      <div class="inner">
                      <h3><?php echo $subcategory_count; ?></h3>
                          <p> Category Product</p>
                      </div>
                      <div class="icon">
                      <i class="ion ion-pricetag"></i>
                      </div>
                      <a href="subcategory.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                      <div class="inner">
                      <h3><?php echo $product_count; ?></h3>
                          <p>Total Products</p>
                      </div>
                      <div class="icon">
                      <i class="ion ion-cube"></i>
                      </div>
                      <a href="product.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                      <div class="inner">
                      <h3><?php echo $blog_count; ?></h3>
                          <p>Total Blogs</p>
                      </div>
                      <div class="icon">
                      <i class="ion ion-document-text"></i>
                      </div>
                      <a href="blog.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <!-- ./col -->
          </div>
          <!-- /.row -->
          </div>
          </section>
</div>



<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>