<?php

    error_reporting(0);
    session_start();
  

     // Database connection parameters
     $host="localhost";
     $user="root";
     $password="";
     $db="moryacat_labindia";

// Establish database connection
$data = mysqli_connect($host, $user, $password, $db);

        // $data=mysqli_connect($host,$user,$password,$db);
        // $sql="SELECT * FROM products";
        // $result=mysqli_query($data,$sql); 

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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="lib/animate/animate.min.css"/>
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


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
        
        /*product sorted*/
        .fruite-item {
            position: relative;
            overflow: hidden; /* Ensures content does not overflow */
        }
        
        .fruite-img img {
            width: 100%;
            height: auto;
            object-fit: cover; /* Ensures the image covers the container */
        }
        
        .availability-label {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #1A76D1;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9rem;
        }
        
        /*pagination*/
        .pagination {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        
        .pagination-link {
            display: inline-block;
            padding: 10px 15px;
            margin: 0 5px;
            text-decoration: none;
            color: #000;
            border: 1px solid #ddd;
            background-color: #f8f8f8;
            text-align: center;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        
        .pagination-link:hover {
            background-color: #ddd;
            color: #000;
        }
        
        .pagination-link.active {
            background-color: #1A76D1;
            color: #fff;
            border-color: #1A76D1;
        }
        
        /**/
        .category-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .category-item {
            margin-bottom: 1.5rem; /* Increase this value to add more space */
        }
        
        .category-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #333;
            padding: 0.75rem;
            border-radius: 0.25rem;
            transition: background-color 0.3s, color 0.3s;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        
        .category-link:hover {
            background-color: #e9ecef;
            color: #007bff;
        }
        
        .category-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            width: 2.5rem;
            height: 2.5rem;
            margin-right: 1rem;
            background-color: #e2e6ea;
            border-radius: 0.25rem;
            color: #6c757d;
        }
        
        .badge {
            background-color: #007bff;
            color: #fff;
            border-radius: 1.25rem;
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
            margin-left: auto;
        }
        

        /*banner*/
.bg-breadcrumb {
    position: relative;
    overflow: hidden;
    background:  url('img/subcategory.gif');
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

.product-card {
    border: 1.5px solid #1A76D1;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(26, 118, 209, 0.07);
    background: #fff;
    overflow: hidden;
    transition: box-shadow 0.3s;
    position: relative;
    margin-bottom: 20px;
}
.product-card:hover {
    box-shadow: 0 6px 24px rgba(26, 118, 209, 0.15);
}
.product-img-container {
    position: relative;
    background: #f8f9fa;
    padding: 18px 18px 0 18px;
    text-align: center;
}
.product-img {
    max-width: 100%;
    max-height: 180px;
    object-fit: contain;
    border-radius: 8px;
    background: #fff;
}
.wishlist-icon {
    position: absolute;
    top: 10px;
    right: 14px;
    color: #e53935;
    font-size: 22px;
    z-index: 2;
}
.product-card-body {
    padding: 18px 18px 16px 18px;
}
.product-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #222;
}
.btn-read-more {
    background: #1A76D1;
    color: #fff;
    border: none;
    border-radius: 22px;
    padding: 6px 18px;
    font-weight: 500;
    font-size: 1rem;
    transition: background 0.2s, color 0.2s;
    display: flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
}
.btn-read-more:hover {
    background: #1565C0;
    color: #fff;
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
            <!-- Topbar Start -->
            <div class="container-fluid px-0" style="position: relative; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <nav class="navbar navbar-expand-lg navbar-light" style="background: none !important;">
                <div class="container d-flex justify-content-between align-items-center">
                    <!-- Left: Logo + Navbar Links -->
                    <div class="d-flex align-items-center">
                        <a href="index.php" class="navbar-brand me-4">
                            <img src="img/newlogo.jpg" alt="LabServ Logo" class="img-fluid" style="max-height: 60px;">
                        </a>
                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <ul class="navbar-nav mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a href="index.php" class="nav-link  px-3" style="font-size: 18px; font-weight: 400; ;">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="about.html" class="nav-link px-3" style="font-size: 18px; font-weight: 400; color: #333;">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="product.php" class="nav-link  active px-3" style="font-size: 18px; font-weight: 400; color: #333;">Products</a>
                                </li>
                                <li class="nav-item">
                                    <a href="contact.php" class="nav-link px-3" style="font-size: 18px; font-weight: 400; color: #333;">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Right: Country Dropdown + Search Bar -->
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
                            <input type="text" class="form-control" name="searchQuery" placeholder="Search..." value="" style="border-radius: 8px 0 0 8px; border: 1px solid #e0e0e0;">
                            <button class="btn btn-primary ms-0" style="border-radius: 0 8px 8px 0; padding: 8px 15px; color: #000; border: 1px solid #e0e0e0; background-color: #1A76D1;">
                                <i class="fas fa-search"></i>
                               </button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Topbar End -->

        <!-- Custom CSS for Navbar -->
        <style>
            .navbar,
            .navbar * {
                background: none !important;
                background-color: transparent !important;
                box-shadow: none !important;
            }
            .navbar {
                padding: 0.5rem 1rem;
            }
            .navbar-brand {
                padding: 0;
            }
            .nav-link {
                position: relative;
                transition: color 0.3s ease;
                padding: 0.5rem 1rem !important;
            }
            .nav-link:hover {
                color: #1A76D1 !important;
            }
            .nav-link.active {
                color: #1A76D1 !important;
            }
            .nav-link.active::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 30px;
                height: 2px;
                background-color: #1A76D1;
            }
            @media (max-width: 991px) {
                .navbar-collapse {
                    background-color: white !important;
                    padding: 1rem;
                    margin-top: 1rem;
                    border-radius: 8px;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                }
                .navbar-nav {
                    margin-bottom: 1rem;
                }
                .nav-link {
                    padding: 0.5rem 0;
                }
                .nav-link.active::after {
                    display: none;
                }
            }
            .dropdown-menu {
                border: none;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                border-radius: 8px;
                padding: 0.5rem;
            }
            .dropdown-item {
                padding: 0.5rem 1rem;
                border-radius: 4px;
                transition: background-color 0.3s ease;
            }
            .dropdown-item:hover {
                background-color: #f8f9fa;
            }
            .form-control {
                border-radius: 8px;
                padding: 0.5rem 1rem;
                border: 1px solid #e0e0e0;
            }
            .btn-primary {
                background-color: #1A76D1;
                border: none;
                transition: background-color 0.3s ease;
            }
            .btn-primary:hover {
                background-color: #1565C0;
            }
        </style>


        <!-- Navbar & Hero Start -->
      
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
                    <li class="breadcrumb-item " style="color: white; font-weight: bold;  font-size: 20px;">Category</li>
                </ol>
            </div>
        </div>
        
        <!-- Header End -->
        <?php
// Database connection
$data = mysqli_connect($host, $user, $password, $db);
if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all categories
$categories_query = "SELECT * FROM categories";
$categories_result = mysqli_query($data, $categories_query);

// Get the category ID from the URL (if any)
$category_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Define how many products to display per page
$products_per_page = 8;

// Get current page from URL, default to 1
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page < 1) $current_page = 1;

// Calculate the offset for the query
$offset = ($current_page - 1) * $products_per_page;

// Fetch all products with category_id and photo for mapping, with pagination
$products_query = "SELECT 
                        p.id AS product_id, 
                        p.name AS product_name, 
                        c.name AS category_name, 
                        p.category_id,
                        p.photo 
                    FROM products p
                    JOIN categories c ON p.category_id = c.id
                    WHERE p.category_id = $category_id
                    LIMIT $products_per_page OFFSET $offset";
$products_result = mysqli_query($data, $products_query);

// Get total number of products in the selected category for pagination
$total_products_query = "SELECT COUNT(*) AS total FROM products WHERE category_id = $category_id";
$total_products_result = mysqli_query($data, $total_products_query);
$total_products_row = mysqli_fetch_assoc($total_products_result);
$total_products = $total_products_row['total'];

// Calculate total pages
$total_pages = ceil($total_products / $products_per_page);
?>

<!-- HTML Structure -->
<div class="container-fluid service py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <?php 
            // If category is selected, show the category name, otherwise show a general message
            if ($category_id) {
                $category_name = "";
                $categories_result = mysqli_query($data, "SELECT name FROM categories WHERE id = $category_id");
                if ($category_row = mysqli_fetch_assoc($categories_result)) {
                    $category_name = $category_row['name'];
                }
                echo "<h2 class='fw-bold text-primary'>Category: " . htmlspecialchars($category_name) . "</h2>";
            } else {
                echo "<h2 class='fw-bold text-primary'>Please select a category</h2>";
            }
            ?>
        </div>

        <!-- Products Display -->
        <div class="row g-4 justify-content-center" id="product-container">
            <?php
            // If category ID is set and valid, display only that category's products
            if (
                $category_id && mysqli_num_rows($products_result) > 0
            ) {
                while ($product = mysqli_fetch_assoc($products_result)) {
            ?>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="product-card">
                        <div class="product-img-container">
                            <img src="Admin/uploaded_images/<?php echo htmlspecialchars($product['photo']); ?>"
                                class="product-img"
                                alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                            <span class="wishlist-icon"><i class="fa fa-heart"></i></span>
                        </div>
                        <div class="product-card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="product-title d-flex justify-content-center "><?php echo htmlspecialchars($product['product_name']); ?></span>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <a class="btn btn-read-more" href="product1.php?id=<?php echo htmlspecialchars($product['product_id']); ?>">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            } else {
                // If no products in the selected category or invalid category, show a message
                echo "<p class='text-center'>No products available in this category.</p>";
            }
            ?>
        </div>

        <!-- Pagination -->
        <div class="row justify-content-center mt-4">
            <div class="col-auto">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <!-- Previous Page Link -->
                        <?php if ($current_page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?id=<?php echo $category_id; ?>&page=<?php echo $current_page - 1; ?>">Previous</a>
                            </li>
                        <?php endif; ?>

                        <!-- Page Numbers -->
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php echo ($i === $current_page) ? 'active' : ''; ?>">
                                <a class="page-link" href="?id=<?php echo $category_id; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <!-- Next Page Link -->
                        <?php if ($current_page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?id=<?php echo $category_id; ?>&page=<?php echo $current_page + 1; ?>">Next</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid get-in-touch bg-primary text-white" style="padding-top: 1rem; padding-bottom: 1rem; margin-bottom: 1rem;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8 text-center text-md-start mb-3 mb-md-0">
                <h5 class="mb-4 mb-md-0" style="color: white;">Empowering science, research and innovation for global well-being</h5>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <a class="btn btn-light btn-lg" href="contact.php">GET IN TOUCH</a>
            </div>
        </div>
    </div>
</div>

<?php
// Close the database connection
mysqli_close($data);
?>



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
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- Custom JS to initialize Owl Carousel -->
<script>
$(document).ready(function(){
$(".owl-carousel").owlCarousel({
items: 4, // Number of items to display at a time
loop: true, // Loop through items
margin: 20, // Space between items
nav: true, // Show navigation arrows
dots: false, // Hide dots
autoplay: true, // Enable automatic scrolling
autoplayTimeout: 2000, // Time between auto scrolls (in milliseconds)
autoplayHoverPause: true, // Pause on hover
responsive: {
    0: {
        items: 1 // Items to show on screens < 600px
    },
    600: {
        items: 2 // Items to show on screens ≥ 600px
    },
    1000: {
        items: 4 // Items to show on screens ≥ 1000px
    }
}
});
});
</script>
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
<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.min.js"></script>

</body>

</html>