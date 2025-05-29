<?php
  // Get the current page filename
  $current_page = basename($_SERVER['PHP_SELF']);
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="padding-top: 10px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <!-- Dashboard -->
          <li class="nav-item">
          <a href="index.php" class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
    <i class="nav-icon fas fa-tachometer-alt"></i> <!-- Dashboard Icon -->
    <p>Dashboard</p>
</a>

          </li>
          
          <!-- Category -->
          <li class="nav-item">
            <a href="category.php" class="nav-link <?php echo ($current_page == 'category.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-tags"></i>
              <p>Category</p>
            </a>
          </li>

          <!-- Sub Category -->
          <!-- <li class="nav-item">
            <a href="subcategory.php" class="nav-link <?php echo ($current_page == 'subcategory.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-tags"></i>
              <p>Sub Category</p>
            </a>
          </li> -->

          <!-- Product -->
          <li class="nav-item">
            <a href="product.php" class="nav-link <?php echo ($current_page == 'product.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-box"></i>
              <p>Product</p>
            </a>
          </li>

          <!-- Blog -->
          <!--<li class="nav-item">-->
          <!--  <a href="blog.php" class="nav-link <?php echo ($current_page == 'blog.php') ? 'active' : ''; ?>">-->
          <!--    <i class="nav-icon fas fa-newspaper"></i>-->
          <!--    <p>Blog</p>-->
          <!--  </a>-->
          <!--</li>-->

          <!-- Register User -->
          <li class="nav-item">
            <a href="registered.php" class="nav-link <?php echo ($current_page == 'registered.php') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>Register User</p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
