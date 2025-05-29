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

// Check connection
if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set the number of products per page
$productsPerPage = 8;

// Get the search query (if exists)
$searchQuery = isset($_POST['searchQuery']) ? $_POST['searchQuery'] : '';

// Determine the current page number (ensure it's an integer)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure page number is at least 1

// Calculate the offset for the SQL query
$offset = ($page - 1) * $productsPerPage;

// Build the SQL query
if ($searchQuery) {
    // If a search query exists, prioritize those products first
    $sql = "SELECT * FROM products WHERE name LIKE '%$searchQuery%' ORDER BY id DESC LIMIT $productsPerPage OFFSET $offset";
} else {
    // If no search query, fetch the regular products
    $sql = "SELECT * FROM products ORDER BY id DESC LIMIT $productsPerPage OFFSET $offset";
}

$result = mysqli_query($data, $sql);

// Check if the query was successful
if (!$result) {
    die("Error fetching products: " . mysqli_error($data));
}

// Query to count the total number of products
$totalProductsQuery = "SELECT COUNT(*) AS total FROM products";
$totalProductsResult = mysqli_query($data, $totalProductsQuery);

// Check if the count query was successful
if (!$totalProductsResult) {
    die("Error counting products: " . mysqli_error($data));
}

$totalProductsRow = mysqli_fetch_assoc($totalProductsResult);
$totalProducts = $totalProductsRow['total'];

// Calculate the total number of pages
$totalPages = ceil($totalProducts / $productsPerPage);
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
    background:  url('img/productpage.gif');
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
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    background: #fff;
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
    margin-bottom: 20px;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-img-container {
    position: relative;
    background: #f8f9fa;
    padding: 0;
    text-align: center;
    height: 250px;
    width: 100%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
    background: #fff;
}

.product-card:hover .product-img {
    transform: scale(1.05);
}

.product-card-body {
    padding: 20px;
    background: white;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.product-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
    text-align: center;
    line-height: 1.4;
    height: 3.2em;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.btn-read-more {
    background: #1A76D1;
    color: #fff;
    border: none;
    border-radius: 25px;
    padding: 8px 20px;
    font-weight: 500;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    text-decoration: none;
    width: 100%;
}

.btn-read-more:hover {
    background: #1565C0;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(26, 118, 209, 0.2);
}

/* Add styles for active product */
.active-product {
    border: 2px solid #1A76D1;
    box-shadow: 0 0 15px rgba(26, 118, 209, 0.15);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .product-img-container {
        height: 200px;
    }
}

@media (max-width: 576px) {
    .product-img-container {
        height: 180px;
    }
}

.wishlist-icon {
    position: absolute;
    top: 15px;
    right: 15px;
    color: #e53935;
    font-size: 20px;
    z-index: 2;
    background: rgba(255, 255, 255, 0.9);
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.wishlist-icon:hover {
    background: #e53935;
    color: white;
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
                                    <a href="about.html" class="nav-link  px-3" style="font-size: 18px; font-weight: 400; color: #333;">About Us</a>
                                </li>
                                <li class="nav-item">
                                                <a href="product.php" class="nav-link  active   px-3" style="font-size: 18px; font-weight: 400; color: #333;">Products</a>
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
                    <li class="breadcrumb-item " style="color: white; font-weight: bold;  font-size: 20px;">Product</li>
                </ol>
            </div>
        </div>
        
        <!-- Header End -->


         <!-- Service Start -->
         <!-- Fruits Shop Start -->
         <!-- <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Categories</h4>
                                    <ul class="list-unstyled fruite-categorie">
                                        <li>
                                            <a href="#" class="category-link" data-category="diagnostic">
                                                <i class="fas fa-microscope"></i>Category 1
                                                <span>(8)</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="category-link" data-category="surgical">
                                                <i class="fas fa-microscope"></i>Category 2
                                                <span>(8)</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="category-link" data-category="mobility">
                                                <i class="fas fa-microscope"></i>Category 3
                                                <span>(8)</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="category-link" data-category="laboratory">
                                                <i class="fas fa-microscope"></i>Category 4
                                                <span>(8)</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center" id="product-list">
                           
                            <div class="col-md-6 col-lg-4 col-xl-4 product-item diagnostic">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="https://cdn.shopify.com/s/files/1/0452/4209/products/OlympusCX23Microscope_grande.jpg?v=1619729611" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                        <h4>Microscope1</h4>
                                        <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-4 product-item diagnostic">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="https://cdn.shopify.com/s/files/1/0452/4209/products/OlympusCX23Microscope_grande.jpg?v=1619729611" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                        <h4>Microscope2</h4>
                                        <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-4 product-item diagnostic">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="https://cdn.shopify.com/s/files/1/0452/4209/products/OlympusCX23Microscope_grande.jpg?v=1619729611" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                        <h4>Microscope3</h4>
                                        <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-4 product-item diagnostic">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="https://cdn.shopify.com/s/files/1/0452/4209/products/OlympusCX23Microscope_grande.jpg?v=1619729611" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                        <h4>Microscope4</h4>
                                        <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-4 product-item diagnostic">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="https://cdn.shopify.com/s/files/1/0452/4209/products/OlympusCX23Microscope_grande.jpg?v=1619729611" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                        <h4>Microscope5</h4>
                                        <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-4 product-item diagnostic">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="https://cdn.shopify.com/s/files/1/0452/4209/products/OlympusCX23Microscope_grande.jpg?v=1619729611" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                        <h4>Microscope6</h4>
                                        <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-4 product-item diagnostic">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="https://cdn.shopify.com/s/files/1/0452/4209/products/OlympusCX23Microscope_grande.jpg?v=1619729611" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                        <h4>Microscope7</h4>
                                        <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-4 product-item diagnostic">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="https://cdn.shopify.com/s/files/1/0452/4209/products/OlympusCX23Microscope_grande.jpg?v=1619729611" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                        <h4>Microscope8</h4>
                                        <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="col-md-6 col-lg-4 col-xl-4 product-item surgical">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="https://th.bing.com/th/id/OIP.2etoeqJhaElJl50wDxtgZQHaI2?rs=1&pid=ImgDetMain" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                        <h4>Microscope1</h4>
                                        <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-4 product-item surgical">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="https://th.bing.com/th/id/OIP.2etoeqJhaElJl50wDxtgZQHaI2?rs=1&pid=ImgDetMain" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                        <h4>Microscope2</h4>
                                        <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-4 product-item surgical">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="https://th.bing.com/th/id/OIP.2etoeqJhaElJl50wDxtgZQHaI2?rs=1&pid=ImgDetMain" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                        <h4>Microscope3</h4>
                                        <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-4 product-item surgical">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="https://th.bing.com/th/id/OIP.2etoeqJhaElJl50wDxtgZQHaI2?rs=1&pid=ImgDetMain" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                        <h4>Microscope4</h4>
                                        <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-4 product-item surgical">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="https://th.bing.com/th/id/OIP.2etoeqJhaElJl50wDxtgZQHaI2?rs=1&pid=ImgDetMain" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                        <h4>Microscope5</h4>
                                        <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-4 product-item surgical">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="https://th.bing.com/th/id/OIP.2etoeqJhaElJl50wDxtgZQHaI2?rs=1&pid=ImgDetMain" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                        <h4>Microscope6</h4>
                                        <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-4 product-item surgical">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="https://th.bing.com/th/id/OIP.2etoeqJhaElJl50wDxtgZQHaI2?rs=1&pid=ImgDetMain" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                        <h4>Microscope7</h4>
                                        <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-4 product-item surgical">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="https://th.bing.com/th/id/OIP.2etoeqJhaElJl50wDxtgZQHaI2?rs=1&pid=ImgDetMain" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                        <h4>Microscope8</h4>
                                        <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                    </div>
                                </div>
                            </div>
                            
                             <div class="row g-4 justify-content-center" id="product-list">
                               
                                <div class="col-md-6 col-lg-4 col-xl-4 product-item mobility">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <img src="https://cdn.shopify.com/s/files/1/0452/4209/products/OlympusCX23Microscope_grande.jpg?v=1619729611" class="img-fluid w-100 rounded-top" alt="Product Image">
                                        </div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                            <h4>Microscope1</h4>
                                            <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-4 product-item mobility">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <img src="https://cdn.shopify.com/s/files/1/0452/4209/products/OlympusCX23Microscope_grande.jpg?v=1619729611" class="img-fluid w-100 rounded-top" alt="Product Image">
                                        </div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                            <h4>Microscope2</h4>
                                            <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-4 product-item mobility">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <img src="https://cdn.shopify.com/s/files/1/0452/4209/products/OlympusCX23Microscope_grande.jpg?v=1619729611" class="img-fluid w-100 rounded-top" alt="Product Image">
                                        </div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                            <h4>microscope3</h4>
                                            <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                        </div>
                                    </div>
                                </div>
                               
                              
                                 <div class="row g-4 justify-content-center" id="product-list">
                                   
                                    <div class="col-md-6 col-lg-4 col-xl-4 product-item laboratory">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="https://alt-model-images.s3-us-west-2.amazonaws.com/full-version-images/Olympus-CH-2-Series-System-Microscope-Model-CHT.JPG" class="img-fluid w-100 rounded-top" alt="Product Image">
                                            </div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                                <h4>Microscope1</h4>
                                                <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-4 product-item laboratory">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="https://alt-model-images.s3-us-west-2.amazonaws.com/full-version-images/Olympus-CH-2-Series-System-Microscope-Model-CHT.JPG" class="img-fluid w-100 rounded-top" alt="Product Image">
                                            </div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                                <h4>Microscope2</h4>
                                                <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-4 product-item laboratory">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="https://alt-model-images.s3-us-west-2.amazonaws.com/full-version-images/Olympus-CH-2-Series-System-Microscope-Model-CHT.JPG" class="img-fluid w-100 rounded-top" alt="Product Image">
                                            </div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom text-center">
                                                <h4>Microscope2</h4>
                                                <p class="text-white px-3 py-1 rounded" style="background:#1A76D1">Available</p>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="pagination d-flex justify-content-center mt-5">
                            <a href="#" class="pagination-link rounded">&laquo;</a>
                            <a href="#" class="pagination-link active rounded">1</a>
                            <a href="#" class="pagination-link rounded">2</a>
                            <a href="#" class="pagination-link rounded">3</a>
                            <a href="#" class="pagination-link rounded">4</a>
                            <a href="#" class="pagination-link rounded">5</a>
                            <a href="#" class="pagination-link rounded">6</a>
                            <a href="#" class="pagination-link rounded">&raquo;</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div> -->
        
<!-- Fruits Shop End -->



     <!-- Product Page Content -->
<div class="container-fluid service py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h2 class="fw-bold text-primary">Our Products</h2>
        </div>

        <!-- Product Display -->
        <div class="row g-4 justify-content-center">
            <?php while ($info = $result->fetch_assoc()) { ?>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="product-card <?php echo ($searchQuery && stripos($info['name'], $searchQuery) !== false) ? 'active-product' : ''; ?>">
                        <div class="product-img-container">
                            <img src="Admin/uploaded_images/<?php echo htmlspecialchars($info['photo']); ?>"
                                 class="product-img"
                                 alt="<?php echo htmlspecialchars($info['name']); ?>">
                            <span class="wishlist-icon"><i class="fa fa-heart"></i></span>
                        </div>
                        <div class="product-card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="product-title d-flex justify-content-center "><?php echo htmlspecialchars($info['name']); ?></span>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <a class="btn btn-read-more" href="product1.php?id=<?php echo htmlspecialchars($info['id']); ?>">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Pagination Links -->
        <div class="row g-4 justify-content-center mt-5">
            <div class="col-12 text-center">
                <?php if ($totalPages > 1) { ?>
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <!-- Previous Button -->
                            <?php if ($page > 1) { ?>
                                <li class="page-item">
                                    <a class="page-link pagination-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                        <i class="fa fa-chevron-left" style="font-size: 16px;"></i>
                                    </a>
                                </li>
                            <?php } ?>

                            <!-- Page Numbers -->
                            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                    <a class="page-link pagination-link" href="?page=<?php echo $i; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php } ?>

                            <!-- Next Button -->
                            <?php if ($page < $totalPages) { ?>
                                <li class="page-item">
                                    <a class="page-link pagination-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                        <i class="fa fa-chevron-right" style="font-size: 16px;"></i>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<style>

/* Add styles for active product */
.active-product {
    border: 2px solid #007bff; /* Blue border for active product */
    box-shadow: 0 0 10px rgba(0, 123, 255, 0.5); /* Add a light blue glow */
}

.service-item {
    transition: all 0.3s ease;
}

.service-item:hover {
    transform: scale(1.05); /* Zoom effect on hover */
}

/* Optional: Add hover effects for product images */
.service-img img {
    transition: transform 0.3s ease;
}

.service-img:hover img {
    transform: scale(1.1); /* Slight zoom effect on image hover */
}

</style>

      <!--Product category Start -->

      <?php
// Assuming you have already connected to the database
$data = mysqli_connect($host, $user, $password, $db);
$sql = "SELECT * FROM categories LIMIT 4";
$result = mysqli_query($data, $sql);
?>
<!-- Product Category Start -->
<div class="container-fluid service py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h2 class="fw-bold text-primary">Popular Categories</h2>
            <!-- <div class="container py-5">
                <div class="text-center mx-auto pb-5">
                    <h6 class="display-4 mb-4">Exceptional Lab Products</h6>
                    <p style="text-align: justify;" class="mb-0">At LabServ, we offer a range of high-quality lab products designed to meet all your diagnostic needs with precision and reliability. Explore our offerings and discover how we can assist you.</p>
                </div>
            </div> -->
        </div>
        
        <div class="row g-4 justify-content-center">
            <?php while ($info = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="Admin/uploaded_images/<?php echo htmlspecialchars($info['image']); ?>" class="img-fluid rounded-top" alt="<?php echo htmlspecialchars($info['name']); ?>">
                        </div>
                        <div class="service-content p-4">
                            <div class="service-content-inner">
                            <a href="category.php?id=<?php echo $info['id']; ?>" class="d-inline-block h4 mb-4">
                <?php echo htmlspecialchars($info['name']); ?> <!-- Link to subcategory page -->
            </a>
            <a class="btn btn-primary rounded-pill py-2 px-4" 
                                href="category.php?id=<?php echo $info['id']; ?>" 
                                style="display: inline-block; margin: 0 auto;">
                                View More
                                </a>
                                <!-- <p class="mb-4">Comprehensive blood tests to diagnose various health conditions with accuracy and speed.</p> -->
                                <!-- <a class="btn btn-primary rounded-pill py-2 px-4" href="service.html">Read More</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- <div class="row g-4 justify-content-center mt-4">
            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                <a class="btn btn-primary rounded-pill py-3 px-5" href="service.php">Explore More</a>
            </div>
        </div> -->
    </div>
</div>

<!-- product category end -->
        




        <!-- category -->
        <!-- <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <div class="tab-class text-center">
                    <div class="row g-4">
                        <div class="col-12 text-center">
                           
                            <h2 style="color:#1A76D1">Popular Categories</h2>
                        </div>
                        <div class="col-12 text-center">
                            
                            <ul class="nav nav-pills d-inline-flex justify-content-center text-center mb-5">
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#Diagnostic">
                                        <span class="text-dark" style="width: 150px;">Category1</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#Surgical">
                                        <span class="text-dark" style="width: 130px;">Category2</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#Mobility">
                                        <span class="text-dark" style="width: 130px;">Category3</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#Laboratory">
                                        <span class="text-dark" style="width: 130px;">Category4</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="tab-content">
                      
                    
                        <div id="Diagnostic" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                        <a href="product1.html"> 
                                            <div class="fruite-img" style="height: 230px; overflow: hidden;">
                                                <img src="https://cdn.shopify.com/s/files/1/0452/4209/products/kk_44e748d8-6bdc-479f-a6ab-ad8e1f538030_2048x2048.jpg?v=1564152696" 
                                                     class="img-fluid w-100" 
                                                     style="object-fit: cover; height: 100%; border-radius: 8px 8px 0 0;" 
                                                     alt="Biological Microscope">
                                            </div>
                                        </a>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom" 
                                             style="background-color: #fff; border-top: 1px solid #ddd; border-radius: 0 0 8px 8px;">
                                            <h4 style="font-size: 1rem; margin: 0;">New Product 5</h4>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                        <a href="product-page-2.html">
                                            <div class="fruite-img" style="height: 230px; overflow: hidden;">
                                                <img src="https://th.bing.com/th/id/OIP.zXv36ndknEL5D8l7253SngAAAA?w=400&h=300&rs=1&pid=ImgDetMain" 
                                                     class="img-fluid w-100" 
                                                     style="object-fit: cover; height: 100%; border-radius: 8px 8px 0 0;" 
                                                     alt="System Microscope">
                                            </div>
                                        </a>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom" 
                                             style="background-color: #fff; border-top: 1px solid #ddd; border-radius: 0 0 8px 8px;">
                                            <h4 style="font-size: 1rem; margin: 0;">New Product 6</h4>
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                        <a href="product-page-3.html">
                                            <div class="fruite-img" style="height: 230px; overflow: hidden;">
                                                <img src="img/cm.png" 
                                                     class="img-fluid w-100" 
                                                     style="object-fit: cover; height: 100%; border-radius: 8px 8px 0 0;" 
                                                     alt="Clinical Microscope">
                                            </div>
                                        </a>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom" 
                                             style="background-color: #fff; border-top: 1px solid #ddd; border-radius: 0 0 8px 8px;">
                                            <h4 style="font-size: 1rem; margin: 0;">New Product 7</h4>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                        <a href="product-page-4.html"> 
                                            <div class="fruite-img" style="height: 230px; overflow: hidden;">
                                                <img src="https://th.bing.com/th/id/OIP.IfU8PoJMQP1BZ0HlbPF9pgHaHa?rs=1&pid=ImgDetMain" 
                                                     class="img-fluid w-100" 
                                                     style="object-fit: cover; height: 100%; border-radius: 8px 8px 0 0;" 
                                                     alt="Research Microscope">
                                            </div>
                                        </a>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom" 
                                             style="background-color: #fff; border-top: 1px solid #ddd; border-radius: 0 0 8px 8px;">
                                            <h4 style="font-size: 1rem; margin: 0;">New Product 8</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="Surgical" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                      
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                                <a href="product-page-1.html"> 
                                                    <div class="fruite-img" style="height: 230px; overflow: hidden;">
                                                        <img src="https://cdn.shopify.com/s/files/1/0452/4209/products/kk_44e748d8-6bdc-479f-a6ab-ad8e1f538030_2048x2048.jpg?v=1564152696" 
                                                             class="img-fluid w-100 rounded-top" 
                                                             style="object-fit: cover; height: 100%;" 
                                                             alt="Scissors">
                                                    </div>
                                                </a>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom" 
                                                     style="background-color: #fff; border-top: 1px solid #ddd; border-radius: 0 0 8px 8px;">
                                                    <h4>Scissors</h4>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                                <a href="product-page-2.html"> 
                                                    <div class="fruite-img" style="height: 230px; overflow: hidden;">
                                                        <img src="https://th.bing.com/th/id/OIP.zXv36ndknEL5D8l7253SngAAAA?w=400&h=300&rs=1&pid=ImgDetMain" 
                                                             class="img-fluid w-100 rounded-top" 
                                                             style="object-fit: cover; height: 100%;" 
                                                             alt="Forceps">
                                                    </div>
                                                </a>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom" 
                                                     style="background-color: #fff; border-top: 1px solid #ddd; border-radius: 0 0 8px 8px;">
                                                    <h4>Forceps</h4>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                                <a href="product-page-3.html">
                                                    <div class="fruite-img" style="height: 230px; overflow: hidden;">
                                                        <img src="img/cm.png" 
                                                             class="img-fluid w-100 rounded-top" 
                                                             style="object-fit: cover; height: 100%;" 
                                                             alt="Needle holders">
                                                    </div>
                                                </a>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom" 
                                                     style="background-color: #fff; border-top: 1px solid #ddd; border-radius: 0 0 8px 8px;">
                                                    <h4>Needle holders</h4>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                                <a href="product-page-4.html"> 
                                                    <div class="fruite-img" style="height: 230px; overflow: hidden;">
                                                        <img src="https://th.bing.com/th/id/OIP.IfU8PoJMQP1BZ0HlbPF9pgHaHa?rs=1&pid=ImgDetMain" 
                                                             class="img-fluid w-100 rounded-top" 
                                                             style="object-fit: cover; height: 100%;" 
                                                             alt="Retractors">
                                                    </div>
                                                </a>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom" 
                                                     style="background-color: #fff; border-top: 1px solid #ddd; border-radius: 0 0 8px 8px;">
                                                    <h4>Retractors</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="Mobility" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                     
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                                <a href="product-page-1.html"> 
                                                    <div class="fruite-img" style="height: 230px; overflow: hidden;">
                                                        <img src="https://cdn.shopify.com/s/files/1/0452/4209/products/kk_44e748d8-6bdc-479f-a6ab-ad8e1f538030_2048x2048.jpg?v=1564152696" 
                                                             class="img-fluid w-100 rounded-top" 
                                                             style="object-fit: cover; height: 100%;" 
                                                             alt="Mobility Scooter 1">
                                                    </div>
                                                </a>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom" 
                                                     style="background-color: #fff; border-top: 1px solid #ddd; border-radius: 0 0 8px 8px;">
                                                    <h4>Mobility Scooter 1</h4>
                                                </div>
                                            </div>
                                        </div>
                                     
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                                <a href="product-page-2.html"> 
                                                    <div class="fruite-img" style="height: 230px; overflow: hidden;">
                                                        <img src="https://th.bing.com/th/id/OIP.zXv36ndknEL5D8l7253SngAAAA?w=400&h=300&rs=1&pid=ImgDetMain" 
                                                             class="img-fluid w-100 rounded-top" 
                                                             style="object-fit: cover; height: 100%;" 
                                                             alt="Mobility Scooter 2">
                                                    </div>
                                                </a>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom" 
                                                     style="background-color: #fff; border-top: 1px solid #ddd; border-radius: 0 0 8px 8px;">
                                                    <h4>Mobility Scooter 2</h4>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                                <a href="product-page-3.html"> 
                                                    <div class="fruite-img" style="height: 230px; overflow: hidden;">
                                                        <img src="img/cm.png" 
                                                             class="img-fluid w-100 rounded-top" 
                                                             style="object-fit: cover; height: 100%;" 
                                                             alt="Mobility Scooter 3">
                                                    </div>
                                                </a>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom" 
                                                     style="background-color: #fff; border-top: 1px solid #ddd; border-radius: 0 0 8px 8px;">
                                                    <h4>Mobility Scooter 3</h4>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                                <a href="product-page-4.html"> 
                                                    <div class="fruite-img" style="height: 230px; overflow: hidden;">
                                                        <img src="https://th.bing.com/th/id/OIP.IfU8PoJMQP1BZ0HlbPF9pgHaHa?rs=1&pid=ImgDetMain" 
                                                             class="img-fluid w-100 rounded-top" 
                                                             style="object-fit: cover; height: 100%;" 
                                                             alt="Mobility Scooter 4">
                                                    </div>
                                                </a>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom" 
                                                     style="background-color: #fff; border-top: 1px solid #ddd; border-radius: 0 0 8px 8px;">
                                                    <h4>Mobility Scooter 4</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="Laboratory" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                      
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <a href="product-page-1.html"> 
                                                    <div class="fruite-img">
                                                        <img src="https://th.bing.com/th/id/OIP.DvP40IIt02oVxUBW0lnsZQHaHa?rs=1&pid=ImgDetMaing" 
                                                             class="img-fluid w-100 rounded-top" 
                                                             alt="Glassware 1">
                                                    </div>
                                                </a>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Glassware</h4>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <a href="product-page-2.html">
                                                    <div class="fruite-img">
                                                        <img src="https://th.bing.com/th/id/OIP.DvP40IIt02oVxUBW0lnsZQHaHa?rs=1&pid=ImgDetMain" 
                                                             class="img-fluid w-100 rounded-top" 
                                                             alt="Glassware 2">
                                                    </div>
                                                </a>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Glassware</h4>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <a href="product-page-3.html"> 
                                                    <div class="fruite-img">
                                                        <img src="https://th.bing.com/th/id/OIP.DvP40IIt02oVxUBW0lnsZQHaHa?rs=1&pid=ImgDetMain" 
                                                             class="img-fluid w-100 rounded-top" 
                                                             alt="Glassware 3">
                                                    </div>
                                                </a>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Glassware</h4>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <a href="product-page-4.html"> 
                                                    <div class="fruite-img">
                                                        <img src="https://th.bing.com/th/id/OIP.DvP40IIt02oVxUBW0lnsZQHaHa?rs=1&pid=ImgDetMain" 
                                                             class="img-fluid w-100 rounded-top" 
                                                             alt="Glassware 4">
                                                    </div>
                                                </a>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Glassware</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
        </div> -->
        
        <!-- Service End -->


        <!-- Testimonial Start -->
        <!-- <div class="container-fluid testimonial pb-5">
            <div class="container pb-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Testimonial</h4>
                    <h1 class="display-4 mb-4">What Our Customers Are Saying</h1>
                    <p class="mb-0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur adipisci facilis cupiditate recusandae aperiam temporibus corporis itaque quis facere, numquam, ad culpa deserunt sint dolorem autem obcaecati, ipsam mollitia hic.
                    </p>
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.2s">
                    <div class="testimonial-item bg-light rounded">
                        <div class="row g-0">
                            <div class="col-4  col-lg-4 col-xl-3">
                                <div class="h-100">
                                    <img src="img/testimonial-1.jpg" class="img-fluid h-100 rounded" style="object-fit: cover;" alt="">
                                </div>
                            </div>
                            <div class="col-8 col-lg-8 col-xl-9">
                                <div class="d-flex flex-column my-auto text-start p-4">
                                    <h4 class="text-dark mb-0">Client Name</h4>
                                    <p class="mb-3">Profession</p>
                                    <div class="d-flex text-primary mb-3">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim error molestiae aut modi corrupti fugit eaque rem nulla incidunt temporibus quisquam,
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded">
                        <div class="row g-0">
                            <div class="col-4  col-lg-4 col-xl-3">
                                <div class="h-100">
                                    <img src="img/testimonial-2.jpg" class="img-fluid h-100 rounded" style="object-fit: cover;" alt="">
                                </div>
                            </div>
                            <div class="col-8 col-lg-8 col-xl-9">
                                <div class="d-flex flex-column my-auto text-start p-4">
                                    <h4 class="text-dark mb-0">Client Name</h4>
                                    <p class="mb-3">Profession</p>
                                    <div class="d-flex text-primary mb-3">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star text-body"></i>
                                    </div>
                                    <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim error molestiae aut modi corrupti fugit eaque rem nulla incidunt temporibus quisquam,
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded">
                        <div class="row g-0">
                            <div class="col-4  col-lg-4 col-xl-3">
                                <div class="h-100">
                                    <img src="img/testimonial-3.jpg" class="img-fluid h-100 rounded" style="object-fit: cover;" alt="">
                                </div>
                            </div>
                            <div class="col-8 col-lg-8 col-xl-9">
                                <div class="d-flex flex-column my-auto text-start p-4">
                                    <h4 class="text-dark mb-0">Client Name</h4>
                                    <p class="mb-3">Profession</p>
                                    <div class="d-flex text-primary mb-3">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star text-body"></i>
                                        <i class="fas fa-star text-body"></i>
                                    </div>
                                    <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim error molestiae aut modi corrupti fugit eaque rem nulla incidunt temporibus quisquam,
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Testimonial End -->

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
                    <div class="col-12 text-center text-md-between text-white d-flex justify-content-between align-items-center px-md-4">
                        <!-- Left Side: Copyright Information -->
                        <div class="text-white me-3">
                            Designed by 
                            <a href="https://g.co/kgs/nAViT23" style="color: white; text-decoration: none;">Cloud Booking Software Solutions</a>
                        </div>
                        
                        <span class="text-white me-md-3">
                            <a href="#" style="color: white; text-decoration: none;">
                                <i class="fas fa-copyright text-light me-2"></i>2024
                            </a> | LabServ India | All rights reserved
                        </span>
                        
                        <!-- Right Side: Design Credit and Social Media Icons -->
                        <div class="footer-btn d-flex">
                            <a class="btn" href="#" style="
                                width: 40px; 
                                height: 40px; 
                                border-radius: 50%; 
                                display: flex; 
                                align-items: center; 
                                justify-content: center; 
                                background-color: #ffffff; 
                                color: #3b5998; /* Facebook icon color */
                                text-decoration: none; 
                                font-size: 18px; 
                                margin-right: 15px; /* Spacing between buttons */
                            "><i class="fab fa-facebook-f"></i></a>
                            <a class="btn" href="#" style="
                                width: 40px; 
                                height: 40px; 
                                border-radius: 50%; 
                                display: flex; 
                                align-items: center; 
                                justify-content: center; 
                                background-color: #ffffff; 
                                color: #1da1f2; /* Twitter icon color */
                                text-decoration: none; 
                                font-size: 18px; 
                                margin-right: 15px; /* Spacing between buttons */
                            "><i class="fab fa-twitter"></i></a>
                            <a class="btn" href="#" style="
                                width: 40px; 
                                height: 40px; 
                                border-radius: 50%; 
                                display: flex; 
                                align-items: center; 
                                justify-content: center; 
                                background-color: #ffffff; 
                                color: #e1306c; /* Instagram icon color */
                                text-decoration: none; 
                                font-size: 18px; 
                                margin-right: 15px; /* Spacing between buttons */
                            "><i class="fab fa-instagram"></i></a>
                            <a class="btn" href="#" style="
                                width: 40px; 
                                height: 40px; 
                                border-radius: 50%; 
                                display: flex; 
                                align-items: center; 
                                justify-content: center; 
                                background-color: #ffffff; 
                                color: #0077b5; /* LinkedIn icon color */
                                text-decoration: none; 
                                font-size: 18px;
                            "><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Copyright End -->


        <!-- Back to Top -->
       
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
       <!-- JavaScript for Modal Update -->
<script>
    var serviceModal = document.getElementById('serviceModal');
    serviceModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget;
        // Extract info from data-* attributes
        var title = button.getAttribute('data-title');
        var description = button.getAttribute('data-description');
        var pdfLink = button.getAttribute('data-pdf');

        // Update the modal's content
        var modalTitle = serviceModal.querySelector('.modal-title');
        var modalBody = serviceModal.querySelector('#serviceDescription');
        var modalPdfLink = serviceModal.querySelector('#servicePdfLink');

        modalTitle.textContent = title;
        modalBody.textContent = description;
        modalPdfLink.href = pdfLink;
    });
</script>
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
<!-- <script>
document.addEventListener('DOMContentLoaded', function () {
    const categoryLinks = document.querySelectorAll('.category-link');
    const productItems = document.querySelectorAll('.product-item');

    categoryLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const category = this.getAttribute('data-category');

            
            productItems.forEach(item => {
                if (item.classList.contains(category)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });

           
            categoryLinks.forEach(link => link.classList.remove('active'));
            this.classList.add('active');
        });
    });

   
    document.querySelector('.category-link').click();
});

</script>     -->
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