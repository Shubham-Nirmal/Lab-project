<?php
session_start();
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1> -->
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
       <!--registeration-->
      <form action="code.php" method="POST">
      <div class="modal-body">
       
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                </div>
                <!-- <div class="form-group mb-3">
                    <label for="phone">Phone Number</label>
                    <input type="tel" name="phone" class="form-control" id="phone" placeholder="Phone Number">
                </div> -->
                <div class="form-group mb-3">
                    <label for="email">Email ID</label>
                    <!-- <span class="email_error text-danger ml-2"></span> -->
                    <input type="email" name="email" class="form-control email_id" id="email" placeholder="Email">
                </div>
                <div class="row">
                 <div class="col-md-6">
                 <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                 </div>
                 <div class="col-md-6">
                 <div class="form-group mb-3">
                    <label for="password">Confirm Password</label>
                    <input type="password" name="confirmpassword" class="form-control" id="password" placeholder="confirm Password">
                </div>

                 </div>

                </div>
               
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="addUser" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>





    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Registered User</li>
            </ol>
          </div>
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  
</div>
  <!-- /.content-header -->

<section class="content">
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <div class="row" style="margin-top: 0;">
              <div class="col-12">
                <?php
                  if(isset($_SESSION['status']))
                  {
                    echo "<h4>".$_SESSION['status']."</h4>";
                    unset($_SESSION['status']);
                  }

                ?>
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">Registered User</h3>
                         
                        
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                          <table class="table table-hover text-nowrap">
                              <thead>
                                  <tr>
                                      <th>Id</th>
                                      <th>Name</th>
                                      <!-- <th>Phone number</th> -->
                                      <th>Email</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>

                              <?php
                                    $query = "SELECT * FROM users"; // Corrected the variable name
                                    $query_run = mysqli_query($db, $query); // Used the correct variable name

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) { // Changed $roe to $row
                                    ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td> <!-- Changed $roe to $row -->
                                            <td><?php echo $row['name']; ?></td> 
                                             <!-- Changed $roe to $row -->
                                            <td><?php echo $row['email']; ?></td> <!-- Changed $roe to $row -->
                                           
                                            <td>
                                                <a href="registerd-edit.php?user_id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                               

                                                <!-- <form action="code.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this User?');">
                                      <button type="submit" name="reg_delete_btn" class="btn btn-danger btn-sm">Delete</button>
                                         </form> -->
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    } else {
                                    ?>
                                        <tr>
                                            <td colspan="6">No Record Found</td>
                                        </tr>
                                    <?php
                                    }
                                ?>

                                  
                                  
                                  <!-- Additional rows as needed -->
                              </tbody>
                          </table>
                      </div>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
              </div>
          </div>

        </div>
    </div>
</div>
</div>
</section>

<?php include('includes/script.php'); ?>
<script>

$(document).ready(function () {
  let debounceTimer;

  $('.email_id').on('keyup', function () {
    clearTimeout(debounceTimer);
    var email = $(this).val();

    debounceTimer = setTimeout(function () {
      $.ajax({
        type: "POST",
        url: "code.php",
        data: {
          'check_Emailbtn': 1,
          'email': email
        },
        success: function (response) {
          $('.email_error').text(response);
        }
      });
    }, 300); // Adjust the delay as needed (in milliseconds)
  });
});



</script>



<?php include('includes/footer.php'); ?>