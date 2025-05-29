<?php
// Database connection
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "labindia"; // Replace with your database name

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetching the blog details based on the ID from URL
$blog_id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // Get blog ID from URL

$sql = "SELECT * FROM blogs WHERE id = $blog_id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $blog = mysqli_fetch_assoc($result);
} else {
    echo "Blog not found.";
    exit;
}

// Fetch recent blogs (limit to 5)
$recent_sql = "SELECT id, image, heading FROM blogs ORDER BY date DESC LIMIT 5";
$recent_result = mysqli_query($conn, $recent_sql);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>LabServ India</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="lib/animate/animate.min.css"/>
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <style>
           /*chat*/
/* Container for floating buttons */
.contact-container {
    position: fixed;
    bottom: 20px;
    right: 20px; /* Positioned on the right side */
    display: flex;
    flex-direction: column;
    align-items: flex-end; /* Align items to the end (right) */
}

/* Chatbox Button */
.chatbox-btn {
    border-radius: 50%;
    width: 60px;
    height: 60px;
    background-color: #015fc9; /* WhatsApp green */
    color: white;
    border: none;
    font-size: 24px; /* Larger icon */
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Contact Options */
.contact-options {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    margin-top: 10px;
}

/* Contact Option Buttons */
.contact-option {
    border-radius: 50%;
    width: 60px;
    height: 60px;
    background-color: #25D366; /* WhatsApp green */
    color: white;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    cursor: pointer;
    transition: background-color 0.3s;
}

/* Hover Effect */
.contact-option:hover, .chatbox-btn:hover {
    background-color: #001f3f; /* Darker green for hover */
}

/* Hide contact options by default */
.d-none {
    display: none;
}

/*why choose us*/
.feature-box {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-box:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.feature-box img {
    max-width: 100px; /* Adjust size as needed */
}


/*banner*/
.bg-breadcrumb {
    position: relative;
    overflow: hidden;
    background:  url('img/product1.gif');
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    width: 1260px; /* Set width to 1260px */
    height: 360px; /* Set height to 360px */
    padding: 60px 0;
    transition: 0.5s;
}

.bg-breadcrumb .breadcrumb {
    position: relative;
}

.bg-breadcrumb .breadcrumb .breadcrumb-item a {
    color: var(--bs-white);
}
/* Responsive Banner */
@media (max-width: 768px) {
    .bg-breadcrumb {
        width: 100%; /* Full width on smaller screens */
        height: 200px; /* Adjust height automatically */
        padding: 30px 0; /* Reduce padding for better fit */
        background-size: cover; /* Ensure the background scales properly */
        background-position: center; /* Center the background image */
    }

    .bg-breadcrumb .breadcrumb {
        text-align: center; /* Center align breadcrumb text */
    }

    .bg-breadcrumb .breadcrumb .breadcrumb-item a {
        font-size: 14px; /* Adjust font size for smaller screens */
    }
}



.footer-item a:hover {
    color: #1A76D1 !important;
}
        
    
   /* bottom to top button & chat us Button border*/
.back-to-top:hover {
    border: 2px solid white !important; 
}
  
.chatbox-btn:hover {
    border: 2px solid white; 
  
}
.contact-option:hover {
    border: 2px solid white;
}     
        
   /* for bold navbar */
.nav-link {
    font-weight: bold;
}
     
                </style>
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Topbar Start -->
        <div class="container-fluid px-0" style="position: relative; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <nav class="navbar navbar-expand-lg navbar-light" style="background: none !important;">
                <div class="container">
                    <!-- Logo -->
                    <a href="index.php" class="navbar-brand">
                        <img src="img/newlogo.jpg" alt="LabServ Logo" class="img-fluid" style="max-height: 60px;">
                    </a>
                    <!-- Navbar Toggler (Mobile) -->
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars"></span>
                    </button>
                    <!-- Full Navbar Content -->
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <!-- Navbar Links -->
                        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a href="index.php" class="nav-link px-3" style="font-size: 16px; font-weight: 500; color: #1A76D1;">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="about.html" class="nav-link px-3" style="font-size: 16px; font-weight: 500; color: #333;">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="product.php" class="nav-link px-3" style="font-size: 16px; font-weight: 500; color: #333;">Products</a>
                            </li>
                            <li class="nav-item">
                                <a href="contact.php" class="nav-link px-3" style="font-size: 16px; font-weight: 500; color: #333;">Contact Us</a>
                            </li>
                        </ul>
                        <!-- Right Section -->
                        <div class="d-flex align-items-center gap-3">
                            <!-- Country Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle d-flex align-items-center p-2" type="button" id="countryDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                    <img src="https://upload.wikimedia.org/wikipedia/en/b/b9/Flag_of_Australia.svg" alt="Australia Flag" width="25" height="18">
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="countryDropdown" style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                    <li>
                                        <a href="https://www.india.gov.in" target="_blank" class="dropdown-item d-flex align-items-center py-2" style="color: #333;">
                                            <img src="https://upload.wikimedia.org/wikipedia/en/4/41/Flag_of_India.svg" alt="India Flag" width="20" height="15" class="me-2"> India
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.australia.gov.au" target="_blank" class="dropdown-item d-flex align-items-center py-2" style="color: #333;">
                                            <img src="https://upload.wikimedia.org/wikipedia/en/b/b9/Flag_of_Australia.svg" alt="Australia Flag" width="20" height="15" class="me-2"> Australia
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Search Bar -->
                            <form method="POST" action="product.php" class="d-flex align-items-center" style="max-width: 250px;">
                                <input type="text" class="form-control" name="searchQuery" placeholder="Search..." value="<?php echo isset($_POST['searchQuery']) ? htmlspecialchars($_POST['searchQuery']) : ''; ?>" style="border-radius: 8px 0 0 8px; border: 1px solid #e0e0e0;">
                                <button class="btn btn-primary ms-0" style="border-radius: 0 8px 8px 0; padding: 8px 15px; color: #000; border: 1px solid #e0e0e0; background-color: #1A76D1;">
                            <i class="fas fa-search"></i>
                           </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Topbar End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light" style="text-align: center;">
                    <a href="#" class="navbar-brand p-0">
                        <img src="img/logo.jpg" alt="LabServ Logo" width="70" height="150">
                    </a>
                    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarCollapse" style="justify-content: center;">
                        <div class="navbar-nav" style="font-size: 18px; display: flex; align-items: center;">
                            <a href="index.php" class="nav-item nav-link " style="margin: 0 15px;">Home</a>
                            <a href="about.html" class="nav-item nav-link" style="margin: 0 15px;">About Us</a>
                            <a href="product.php" class="nav-item nav-link" style="margin: 0 15px;">Products</a>
                            <a href="blog.php" class="nav-item nav-link active" style="margin: 0 15px;">Blog & Events</a>
                            <a href="contact.php" class="nav-item nav-link" style="margin: 0 15px;">Contact Us</a>
                        </div>
                        <div class="nav-btn px-3">
                            <button class="btn-search btn btn-primary btn-md-square rounded-circle flex-shrink-0" data-bs-toggle="modal" data-bs-target="#searchModal" style="font-size: 24px;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        
        <!-- Navbar & Hero End -->

        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center bg-primary">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="btn bg-light border nput-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->


        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb position-relative" > 
            <div class="container position-absolute" style="bottom: 20px; padding-left: 70px;">
                <ol class="breadcrumb mb-0 wow fadeInDown" data-wow-delay="0.3s" style=" font-weight: bold;">
                    <li class="breadcrumb-item"><a href="index.php" style=" font-weight: bold;  font-size: 20px;">Home</a></li>
                    <li class="breadcrumb-item " style="color: white; font-weight: bold;  font-size: 20px;">Blog & Events</li>
                </ol>
            </div>
        </div>
        
        <!-- Header End -->

<!-- Blog Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Blog Detail Start -->
                <div class="mb-5">
                    <img class="img-fluid w-100 rounded mb-5" src="Admin/<?php echo $blog['image']; ?>" alt="">
                    <h3 class="mb-4"><?php echo $blog['heading']; ?></h3>
                    <!-- Display Additional Images in Rows -->
    <div class="row">
        <?php
        // Decode the additional images JSON data
        $additional_images = json_decode($blog['additional_images']);
        if ($additional_images) {
            // Loop through the images and display 3 images per row
            foreach ($additional_images as $index => $image_path) {
                if ($index % 3 === 0 && $index !== 0) {
                    echo '</div><div class="row">'; // Start a new row after every 3 images
                }
                ?>
                <div class="col-md-4 mb-3">
                    <img src="Admin/<?php echo htmlspecialchars($image_path); ?>" alt="Additional Image" class="img-fluid rounded" style="width: 100%; height: auto;">
                </div>
                <?php
            }
        }
        ?>
    </div>
                    <p style="text-align: justify;"><?php echo $blog['paragraph']; ?></p>
                </div>
                <!-- Blog Detail End -->
            </div>

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Search Form Start -->
                <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                    <div class="input-group">
                        <input type="text" class="form-control p-3" placeholder="Keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <!-- Search Form End -->

                <!-- Recent Post Start -->
                <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                        <h3 class="mb-0">Recent Post</h3>
                    </div>
                    <?php while ($recent_blog = mysqli_fetch_assoc($recent_result)): ?>
                        <div class="d-flex rounded overflow-hidden mb-3">
    <img class="img-fluid" src="Admin/<?php echo $recent_blog['image']; ?>" style="width: 100px; height: 100px; object-fit: cover;" alt="">
    <a href="blogdetail.php?id=<?php echo $recent_blog['id']; ?>" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0" style="text-decoration: none;">
        <span id="headingText"><?php echo $recent_blog['heading']; ?></span>
    </a>
</div>
<style>
    #headingText {
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Number of lines to show */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

                    
                    <?php endwhile; ?>
                </div>
                <!-- Recent Post End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
</div>
<!-- Blog End -->

<div class="container-fluid get-in-touch bg-primary text-white" style="padding-top: 1rem; padding-bottom: 1rem; margin-bottom: 1rem;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Side: Sentence -->
            <div class="col-md-8 text-center text-md-start mb-3 mb-md-0">
                <h5 class="mb-4 mb-md-0" style="color: white;">Empowering science, research and innovation for global well- being</h5>
            </div>
            <!-- Right Side: Button -->
            <div class="col-md-4 text-center text-md-end">
                <a class="btn btn-light btn-lg" href="contact.php">GET IN TOUCH</a>
            </div>
        </div>
    </div>
</div>

        <!-- Floating Chatbox Button -->
<div class="contact-container">
    <button id="chatBoxBtn" class="chatbox-btn" 
    data-bs-toggle="tooltip" 
    data-bs-placement="top" 
    title="Chat with us!">
<i class="fa-regular fa-message"></i>
</button>

    <!-- Hidden Contact Options -->
    <div id="contactOptions" class="contact-options d-none">
        <a href="tel:+918806973003" class="contact-option btn btn-success">
            <i class="fa fa-phone"></i> <!-- Call icon -->
        </a>
        
        <a href="https://wa.me/918806973003" class="contact-option btn btn-success">
            <i class="fab fa-whatsapp"></i>
        </a>
        
    </div>
</div>

<!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s" style="background-color: #1A76D1; color: #FFF;">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Gallery Section -->
            <div class="col-md-4 col-lg-3">
                <div class="footer-item">
                    <h4 class="mb-4" style="color: #FFF;">Gallery</h4>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="footer-gallery rounded" style="overflow: hidden; height: 200px; position: relative;">
                                <div class="scrolling-gallery-images" style="display: flex; animation: scroll 15s linear infinite;">
                                    <a href="product.php" class="gallery-item">
                                        <img src="https://th.bing.com/th/id/OIP.w-L-ZFRwAQwcwKfquSREcQHaGM?rs=1&pid=ImgDetMain" class="gallery-img" alt="Product 1">
                                    </a>
                                    <a href="product.php" class="gallery-item">
                                        <img src="https://th.bing.com/th/id/OIP.w-L-ZFRwAQwcwKfquSREcQHaGM?rs=1&pid=ImgDetMain" class="gallery-img" alt="Product 2">
                                    </a>
                                    <a href="product.php" class="gallery-item">
                                        <img src="https://th.bing.com/th/id/OIP.w-L-ZFRwAQwcwKfquSREcQHaGM?rs=1&pid=ImgDetMain" class="gallery-img" alt="Product 3">
                                    </a>
                                    <a href="product.php" class="gallery-item">
                                        <img src="https://th.bing.com/th/id/OIP.w-L-ZFRwAQwcwKfquSREcQHaGM?rs=1&pid=ImgDetMain" class="gallery-img" alt="Product 1">
                                    </a>
                                    <a href="product.php" class="gallery-item">
                                        <img src="https://th.bing.com/th/id/OIP.w-L-ZFRwAQwcwKfquSREcQHaGM?rs=1&pid=ImgDetMain" class="gallery-img" alt="Product 2">
                                    </a>
                                    <a href="product.php" class="gallery-item">
                                        <img src="https://th.bing.com/th/id/OIP.w-L-ZFRwAQwcwKfquSREcQHaGM?rs=1&pid=ImgDetMain" class="gallery-img" alt="Product 3">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- LabServ Section -->
            <div class="col-md-4 col-lg-4">
                <div class="footer-item">
                    <a href="index.php" class="p-0">
                        <h4 class="mb-4" style="color: #FFF;">LabServ India</h4>
                    </a>
                    <p class="mb-4" style="line-height: 1.8; color: #FFF;">
                        LabServ India is recognised for delivering top-quality laboratory instruments. We offer a diverse range of essential equipments including microscopes, autoclaves, incubators & more tailored to meet the needs of our clients.
                    </p>
                </div>
            </div>
            <!-- Useful Links Section -->
            <div class="col-md-1 col-lg-2">
                <div class="footer-item">
                    <h4 class="mb-4" style="color: #FFF;">Useful Links</h4>
                    <div class="d-flex flex-column gap-2">
                        <a href="index.php" class="text-decoration-none hover-primary" style="color: #FFF;"><i class="fas fa-angle-right me-2"></i>Home</a>
                        <a href="about.html" class="text-decoration-none hover-primary" style="color: #FFF;"><i class="fas fa-angle-right me-2"></i>About Us</a>
                        <a href="product.php" class="text-decoration-none hover-primary" style="color: #FFF;"><i class="fas fa-angle-right me-2"></i>Products</a>
                        <a href="contact.php" class="text-decoration-none hover-primary" style="color: #FFF;"><i class="fas fa-angle-right me-2"></i>Contact Us</a>
                        <a href="FAQ.html" class="text-decoration-none hover-primary" style="color: #FFF;"><i class="fas fa-angle-right me-2"></i>FAQs</a>
                    </div>
                </div>
            </div>
            <!-- Contact Us Section -->
            <div class="col-md-4 col-lg-3">
                <div class="footer-item">
                    <h4 class="mb-4" style="color: #FFF;">Contact Us</h4>
                    <div class="d-flex mb-3">
                        <i class="fa fa-map-marker-alt me-3" style="font-size: 14px; line-height: 1.5; color: #FFF;"></i>
                        <div>
                            <span style="line-height: 1.6; color: #FFF;">
                                Reg. off: 18, The Nest Society<br>
                                Vidhate Colony, D.P. Road<br>
                                Aundh, Pune, Maharashtra
                            </span>
                        </div>
                    </div>
                    <div class="d-flex mb-3 align-items-center">
                        <i class="fa fa-phone me-3" style="font-size: 14px; color: #FFF;"></i>
                        <a href="tel:+918806973003" class="text-decoration-none hover-primary" style="color: #FFF;">
                            <span style="line-height: 1.6;">+91 8806973003</span>
                        </a>
                    </div>
                    <div class="d-flex mb-3 align-items-center">
                        <i class="fa fa-envelope me-3" style="font-size: 14px; color: #FFF;"></i>
                        <a href="mailto:labservindia@gmail.com" class="text-decoration-none hover-primary" style="color: #FFF;">
                            <span style="line-height: 1.6;">labservindia@gmail.com</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright py-4" style="background-color: #155a9c; color: #FFF;">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-12 text-center text-md-between d-flex justify-content-between align-items-center px-md-4" style="color: #FFF;">
                <div class="me-3" style="color: #FFF;">
                    Designed by 
                    <a href="https://g.co/kgs/nAViT23" class="text-decoration-none hover-primary" style="color: #FFF;">Cloud Booking Software Solutions</a>
                </div>
                <span class="me-md-3" style="color: #FFF;">
                    <a href="#" class="text-decoration-none hover-primary" style="color: #FFF;">
                        <i class="fas fa-copyright me-2"></i>2024
                    </a> | LabServ India | All rights reserved
                </span>
                <div class="footer-btn d-flex">
                    <a class="btn btn-social" href="#" style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: rgba(255,255,255,0.1); color: #FFF; text-decoration: none; font-size: 18px; margin-right: 15px; transition: all 0.3s ease;"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-social" href="#" style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: rgba(255,255,255,0.1); color: #FFF; text-decoration: none; font-size: 18px; margin-right: 15px; transition: all 0.3s ease;"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-social" href="#" style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: rgba(255,255,255,0.1); color: #FFF; text-decoration: none; font-size: 18px; margin-right: 15px; transition: all 0.3s ease;"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-social" href="#" style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: rgba(255,255,255,0.1); color: #FFF; text-decoration: none; font-size: 18px; transition: all 0.3s ease;"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->



        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top" style="
        position: fixed; 
        bottom: 20px; 
        left: 20px; 
        z-index: 999; /* Ensures the button is on top of other content */
        text-align: center; /* Centers the icon within the button */
    ">
        <i class="fa fa-arrow-up"></i>
    </a>

<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>


<!-- Template Javascript -->
<script src="js/main.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var chatBoxBtn = document.getElementById('chatBoxBtn');
        var contactOptions = document.getElementById('contactOptions');
    
        chatBoxBtn.addEventListener('click', function() {
            if (contactOptions.classList.contains('d-none')) {
                contactOptions.classList.remove('d-none');
            } else {
                contactOptions.classList.add('d-none');
            }
        });
    });
    
    
    
</script>
  <!-- for tooltip -->
         <!-- Bootstrap Bundle JS (includes Popper.js) -->
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
         <!-- Initialize Tooltip -->
         <script>
             document.addEventListener('DOMContentLoaded', function () {
                 var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                 var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                     return new bootstrap.Tooltip(tooltipTriggerEl)
                 })
             })
         </script>
</body>

</html>