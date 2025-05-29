<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
         
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit User</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content d-flex align-items-center" style="min-height: 80vh;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">

            <div class="card-header">
              <h3 class="card-title">Edit User</h3>
              <a href="registered.php" class="btn btn-danger btn-sm float-right">BACK</a>
            </div>

            <div class="card-body">
              <form action="code.php" method="POST">
                <?php
                if (isset($_GET['user_id'])) {
                  $user_id = mysqli_real_escape_string($db, $_GET['user_id']);
                  $query = "SELECT * FROM users WHERE ID='$user_id' LIMIT 1";
                  $query_run = mysqli_query($db, $query);

                  if ($query_run && mysqli_num_rows($query_run) > 0) {
                    $row = mysqli_fetch_assoc($query_run);
                ?>
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">

                <div class="form-group mb-3">
                  <label for="name">Name</label>
                  <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" class="form-control" id="name" placeholder="Name">
                </div>

                <div class="form-group mb-3">
                  <label for="email">Email ID</label>
                  <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" class="form-control" id="email" placeholder="Email">
                </div>

                <div class="form-group mb-3">
                  <label for="password">Password</label>
                  <div class="input-group">
                    <input type="password" name="password" value="<?php echo htmlspecialchars($row['password']); ?>" class="form-control" id="password" placeholder="Password">
                    <div class="input-group-append">
                      <span class="input-group-text" onclick="togglePasswordVisibility()">
                        <i class="fas fa-eye" id="togglePasswordIcon"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="modal-footer d-flex justify-content-center">
                  <button type="submit" name="update_user_btn" class="btn btn-primary">Update User</button>
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

<!-- Include Font Awesome for the eye icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script>
function togglePasswordVisibility() {
  var passwordField = document.getElementById("password");
  var toggleIcon = document.getElementById("togglePasswordIcon");
  if (passwordField.type === "password") {
    passwordField.type = "text";
    toggleIcon.classList.remove("fa-eye");
    toggleIcon.classList.add("fa-eye-slash");
  } else {
    passwordField.type = "password";
    toggleIcon.classList.remove("fa-eye-slash");
    toggleIcon.classList.add("fa-eye");
  }
}
</script>




<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>