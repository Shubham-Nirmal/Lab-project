<?php
session_start();
include('includes/header.php');
include('config/dbcon.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<!-- Modal for Adding Subproduct -->
<div class="modal fade" id="SubproductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Subproduct</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="code.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <!-- <div class="form-group">
            <label for="subproduct-name">Subproduct Name:</label>
            <input type="text" name="subproduct_name" id="subproduct-name" class="form-control" required>
          </div> -->

          <div class="form-group">
            <label for="product-id">Select Product:</label>
            <select name="product_id" id="product-id" class="form-control" required>
              <?php
              $product_query = "SELECT id, name FROM products";
              $product_query_run = mysqli_query($db, $product_query);
              if (mysqli_num_rows($product_query_run) > 0) {
                // Loop through all products
                while ($prod = mysqli_fetch_assoc($product_query_run)) {
                  echo '<option value="' . htmlspecialchars($prod['id']) . '">' . htmlspecialchars($prod['id']) . ' - ' . htmlspecialchars($prod['name']) . '</option>';
                }
              } else {
                echo '<option value="">No Products Available</option>';
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label for="subproduct-pdf">Subproduct PDF:</label>
            <input type="file" name="subproduct_pdf" id="subproduct-pdf" class="form-control">
          </div>

          <div class="form-group">
            <label for="subproduct-specification">Subproduct Specification:</label>
            <textarea name="subproduct_specification" id="subproduct-specification" class="form-control" rows="4" placeholder="Enter subproduct specification"></textarea>
          </div>

          <div class="form-group">
            <label for="subproduct-details">Subproduct Details:</label>
            <textarea name="subproduct_details" id="subproduct-details" class="form-control" rows="4" placeholder="Enter subproduct details"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="subproduct_save" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>



<div class="content-wrapper">
  <section class="content mt-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php include('message.php'); ?>

          <div class="card">
            <div class="card-header">
              <h4>
                Manage Subproducts
                <a href="#" data-bs-toggle="modal" data-bs-target="#SubproductModal" class="btn btn-primary float-end">Add</a>
              </h4>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Subproduct Name</th>
                    <th>Product</th>
                    <th>PDF</th>
                    <th>Specification</th>
                    <th>Details</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT subproduct.subproduct_id, subproduct.subproduct_name, subproduct.subproduct_pdf_url, subproduct.subproduct_specification, subproduct.subproduct_details, products.name AS product_name 
                            FROM subproduct 
                            JOIN products ON subproduct.product_id = products.id";
                  $query_run = mysqli_query($db, $query);

                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $row) {
                  ?>
                    <tr>
                      <td><?php echo htmlspecialchars($row['subproduct_id']); ?></td>
                      <td><?php echo htmlspecialchars($row['subproduct_name']); ?></td>
                      <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                      <td>
                        <?php if (!empty($row['subproduct_pdf_url'])) { ?>
                          <a href="uploaded_files/<?php echo htmlspecialchars($row['subproduct_pdf_url']); ?>" target="_blank">View PDF</a>
                        <?php } else { ?>
                          No PDF
                        <?php } ?>
                      </td>
                      <td><?php echo htmlspecialchars($row['subproduct_specification']); ?></td>
                      <td><?php echo htmlspecialchars($row['subproduct_details']); ?></td>
                      <td>
                        <a href="subproduct-edit.php?id=<?php echo htmlspecialchars($row['subproduct_id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="code.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this subproduct?');">
                          <input type="hidden" name="subproduct_delete_id" value="<?php echo htmlspecialchars($row['subproduct_id']); ?>">
                          <button type="submit" name="subproduct_delete_btn" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                      </td>
                    </tr>
                  <?php
                    }
                  } else {
                  ?>
                    <tr>
                      <td colspan="7">No Record Found</td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>
