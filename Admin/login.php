<?php
session_start();

// Set timeout duration (in seconds)
$timeout_duration = 600; // e.g., 600 seconds = 10 minutes

// Check if the last activity timestamp is set
if (isset($_SESSION['last_activity'])) {
    // Calculate the time difference between now and the last activity
    $elapsed_time = time() - $_SESSION['last_activity'];

    // Check if the user has been inactive for too long
    if ($elapsed_time > $timeout_duration) {
        // Session timed out, destroy the session and redirect to login
        session_unset();
        session_destroy();
        header("Location: login.php?timeout=1");
        exit();
    }
}

// Update last activity timestamp
$_SESSION['last_activity'] = time();

include('includes/header.php');
if(isset($_SESSION['auth'])){
    $_SESSION['status']="You are already logged in";
    header('Location: index.php');
}

?>


<div class="section">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 my-5">
        <?php
include('message.php');

?>
            <div class="card my-5">
                <div class="card-header bg-light">
                    <h5>Login Form</h5>
                </div>
                <div class="card-body">
                
                    <form action="logincode.php" method="POST">
                        <div class="form-group">
                            <label for="">Email Id</label>
                            <input type="text" name="email" class="form-control" placeholder="Email Id">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="password">
                        </div>
                        <hr>
                        <div class="form-group">
                           
                            <button type="submit" name="login_btn" class="btn btn-primary btn-block">Login</button>
                        </div>

                         <div class="card-footer text-center">
                        <a href="registercode.php">Don't have an account? Register</a>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



</div>




</div>






<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>