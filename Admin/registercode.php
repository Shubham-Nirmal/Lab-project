<?php
session_start();
include('includes/header.php');
include('config/dbcon.php'); // Make sure to include your database connection file

if (isset($_POST['register_btn'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($db, $_POST['confirm_password']);

    // Validate the inputs
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['status'] = "All fields are required";
        header("Location: registercode.php");
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['status'] = "Passwords do not match";
        header("Location: registercode.php");
        exit();
    }

    // Check if email already exists
    $email_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $email_check_result = mysqli_query($db, $email_check_query);

    if (mysqli_num_rows($email_check_result) > 0) {
        $_SESSION['status'] = "Email already exists";
        header("Location: registercode.php");
        exit();
    }

    // Hash the password
   // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into users table
    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $_SESSION['status'] = "Registration successful. Please log in.";
        header("Location: login.php");
    } else {
        $_SESSION['status'] = "Registration failed. Please try again.";
        header("Location: registercode.php");
    }
    exit();
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 my-5">
            <?php include('message.php'); ?>
            <div class="card my-5">
                <div class="card-header bg-light">
                    <h5>Register</h5>
                </div>
                <div class="card-body">
                    <form action="registercode.php" method="POST">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter a password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm your password" required>
                        </div>
                        <button type="submit" name="register_btn" class="btn btn-primary btn-block">Register</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="login.php">Already have an account? Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
