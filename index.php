<?php

        error_reporting(0);
        session_start();
        // session_destroy();

       

        $host="localhost";
        $user="root";
        $password="Shubham@36";
        $db="moryacat_labindia";

        $data=mysqli_connect($host,$user,$password,$db);
        
        // $sql="SELECT * FROM products";
        // $result=mysqli_query($data,$sql); 
        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 8";
        $result = mysqli_query($data, $sql);


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
        <!-- bootstrap link for flag -->
          <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    </head>
<style>
    /*Product Css Start*/
.service-item {
    display: flex;
    flex-direction: column;
    height: 100%;
    background: #fff; 
    border-radius: .375rem; 
    box-shadow: 0 0 15px rgba(0,0,0,0.1); 
}
.service-img {
    overflow: hidden;
}

.service-img img {
    width: 100%;
    height: auto;
    display: block;
}
.service-content {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding: 1.5rem;
}
.service-content-inner {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.service-content .btn-primary {
    align-self: flex-start;
}
  /*Product Css End*/

  /* banner iamge start*/
  /* Universal reset for margins and paddings */
html, body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Remove any padding or margin from parent elements */
.slider-container {
    margin: 0;
    padding: 0;
}

/* Slider styling */
/* Base styles for the slider */
.slider {
    position: relative;
    width: 100%; /* Full width of the container */
    height: 360px; /* Default height */
    overflow: hidden; /* Hide any overflow */
    display: flex;
    align-items: center;
    justify-content: center;
}

.single-slider {
    width: 100%; /* Full width of the slider */
    height: 100%; /* Match the height of the slider */
}

.background-image {
    width: 100%; /* Ensure the image fills the width */
    height: 100%; /* Ensure the image fills the height */
    object-fit: cover; /* Maintain aspect ratio and cover the container */
}

/* Responsive styles for mobile */
@media (max-width: 768px) {
    .slider {
        height: 200px; /* Adjust height for mobile view */
    }
}

@media (max-width: 480px) {
    .slider {
        height: 150px; /* Further reduce height for smaller screens */
    }
}



 /* banner iamge send*/

 
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

/*flag*/
.dropdown-menu {
    margin-top: 10px; /* Adjust the space between button and dropdown menu */
    padding: 10px; /* Optional: Adjust the padding inside the dropdown menu */
}
.dropdown-item img {
    margin-right: 10px; /* Space between flag and text in dropdown items */
}


.footer-item a:hover {
    color:rgb(212, 223, 235) !important;
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
/*.nav-link {
    font-weight: bold;
}*/

.custom-font {
    font-family: 'Segoe UI', Arial, sans-serif;
    font-size: 11nside the navbar make only 2 div logo and Navbar name add in one div and contary and searchbar add other divindex.php
product.php
product1.php
contact.php
FAQ.html
category.phppt;
}

body {
    font-family: 'Segoe UI', Arial, sans-serif;
    font-size: 11pt;
}

</style>
    <body>
        <!-- <div class="modal fade" id="countrySelectionModal" tabindex="-1" aria-labelledby="countrySelectionLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="countrySelectionLabel">Choose Your Country</h5>
            </div>
            <div class="modal-body text-center">
                <div class="row">
                    <div class="col-6">
                        <img src="https://www.happywalagift.com/wp-content/uploads/2015/08/India_flag-2016.jpg" 
                             alt="India Flag" 
                             class="img-fluid mb-2" 
                             style="cursor: pointer; width: 100px; height: auto;" 
                             onclick="redirectTo('india')">
                        <h5>India</h5>
                    </div>
                    <div class="col-6">
                        <img src="https://th.bing.com/th/id/OIP.uIdInAeh1fqvN9kugUopxAHaFW?rs=1&pid=ImgDetMain" 
                             alt="Australia Flag" 
                             class="img-fluid mb-2" 
                             style="cursor: pointer; width: 100px; height: auto;" 
                             onclick="redirectTo('australia')">
                        <h5>Australia</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 -->
        
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
                                    <a href="index.php" class="nav-link active px-3" style="font-size: 18px; font-weight: 500; ;">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="about.html" class="nav-link  px-3" style="font-size: 18px; font-weight: 500; color: #333;">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="product.php" class="nav-link px-3" style="font-size: 18px; font-weight: 500; color: #333;">Products</a>
                                </li>
                                <li class="nav-item">
                                    <a href="contact.php" class="nav-link px-3" style="font-size: 18px; font-weight: 500; color: #333;">Contact Us</a>
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


<!-- Enable Bootstrap Tooltip -->
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>

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


        <!-- Carousel Start -->
        <section class="slider">
            <div class="single-slider">
                <img src="img/homebanner.gif" class="background-image" alt="Background Image">
            </div>
        </section>
        
        
        <!-- Carousel End -->

        <!-- Feature Start -->
        <!-- <div class="container-fluid feature bg-light py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Features</h4>
                    <h1 class="display-4 mb-4">Insurance Provide you a Better Future</h1>
                    <p class="mb-0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur adipisci facilis cupiditate recusandae aperiam temporibus corporis itaque quis facere, numquam, ad culpa deserunt sint dolorem autem obcaecati, ipsam mollitia hic.
                    </p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feature-item p-4 pt-0">
                            <div class="feature-icon p-4 mb-4">
                                <i class="far fa-handshake fa-3x"></i>
                            </div>
                            <h4 class="mb-4">Trusted Company</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea hic laborum odit pariatur...
                            </p>
                            <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Learn More</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="feature-item p-4 pt-0">
                            <div class="feature-icon p-4 mb-4">
                                <i class="fa fa-dollar-sign fa-3x"></i>
                            </div>
                            <h4 class="mb-4">Anytime Money Back</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea hic laborum odit pariatur...
                            </p>
                            <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Learn More</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="feature-item p-4 pt-0">
                            <div class="feature-icon p-4 mb-4">
                                <i class="fa fa-bullseye fa-3x"></i>
                            </div>
                            <h4 class="mb-4">Flexible Plans</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea hic laborum odit pariatur...
                            </p>
                            <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Learn More</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="feature-item p-4 pt-0">
                            <div class="feature-icon p-4 mb-4">
                                <i class="fa fa-headphones fa-3x"></i>
                            </div>
                            <h4 class="mb-4">24/7 Fast Support</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea hic laborum odit pariatur...
                            </p>
                            <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Feature End -->

        
        <!-- About Start -->
        <div class="container-fluid bg-light py-5">
            <div class="container pb-5">
                <!-- Welcome Section -->
                <div class="bg-white p-5 rounded shadow-sm mb-5">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <h2 class="fw-bold text-primary text-center mb-4">Welcome to LabServ India</h2>
                            <p style="text-align: justify; font-size: 16px; line-height: 1.8;">
                                LabServ India is based in Pune, Maharashtra, specializing in providing comprehensive laboratory services and equipment. Established with a commitment to excellence and customer satisfaction, LabServ India serves a wide range of clients including universities, research institutions, medical labs, and individual researchers.
                            </p>
                            <div class="mt-4 text-center">
                                <a class="btn btn-primary rounded-pill py-3 px-5" href="about.html" style="font-size: 19px;">Read More</a>
                            </div>
                        </div>
                       
                    </div>
                </div>

                <!-- Our Dealers Section -->
                <div class="bg-white p-5 rounded shadow-sm">
                    <h2 class="fw-bold text-primary text-center mb-5">Our Dealers</h2>
                    <div class="position-relative">
                        <div id="clientCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                            <div class="carousel-inner">
                                <!-- Slide 1 -->
                                <div class="carousel-item active">
                                    <div class="row g-4 justify-content-center">
                                        <div class="col-6 col-md-3 text-center">
                                            <div class="dealer-card p-3 bg-light rounded shadow-sm">
                                                <img src="https://bloggytalky.com/wp-content/uploads/2017/07/create-a-free-logo-design-logo-designs-design-a-free-logo-design-a-free-logo-alltech-just-free-logo-design.png" class="img-fluid" alt="Dealer 1">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 text-center">
                                            <div class="dealer-card p-3 bg-light rounded shadow-sm">
                                                <img src="https://th.bing.com/th/id/R.5eb1959636a370b661bc91940fe49cee?rik=DiotHJlkKQR6dg&riu=http%3a%2f%2fwww.datwebdigital.com%2fDWD%2fwp-content%2fuploads%2f2012%2f06%2flogo-design.jpg&ehk=fa8lsC0cm1nXH1dOqP%2f9dC1ohF3%2bcobEoqkMOaxrV2I%3d&risl=&pid=ImgRaw&r=0" class="img-fluid" alt="Dealer 2">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 text-center">
                                            <div class="dealer-card p-3 bg-light rounded shadow-sm">
                                                <img src="https://th.bing.com/th/id/OIP.kpAg6_oxwb3kfiYKDeJlVwHaHa?rs=1&pid=ImgDetMain" class="img-fluid" alt="Dealer 3">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 text-center">
                                            <div class="dealer-card p-3 bg-light rounded shadow-sm">
                                                <img src="https://img.freepik.com/free-vector/building-logo-icon-design-template-vector_67715-555.jpg?w=2000" class="img-fluid" alt="Dealer 4">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Slide 2 -->
                                <div class="carousel-item">
                                    <div class="row g-4 justify-content-center">
                                        <div class="col-6 col-md-3 text-center">
                                            <div class="dealer-card p-3 bg-light rounded shadow-sm">
                                                <img src="https://img.freepik.com/premium-vector/real-estate-industry-logo-design_579677-9.jpg" class="img-fluid" alt="Dealer 5">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 text-center">
                                            <div class="dealer-card p-3 bg-light rounded shadow-sm">
                                                <img src="https://th.bing.com/th/id/OIP.ICra-sFzmBs4hB_TYNDPyAAAAA?w=260&h=280&rs=1&pid=ImgDetMain" class="img-fluid" alt="Dealer 6">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 text-center">
                                            <div class="dealer-card p-3 bg-light rounded shadow-sm">
                                                <img src="https://th.bing.com/th/id/OIP.9xY89XIR2H8BwPgCJzXgeQAAAA?w=250&h=217&rs=1&pid=ImgDetMain" class="img-fluid" alt="Dealer 7">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 text-center">
                                            <div class="dealer-card p-3 bg-light rounded shadow-sm">
                                                <img src="https://bloggytalky.com/wp-content/uploads/2017/07/create-a-free-logo-design-logo-designs-design-a-free-logo-design-a-free-logo-alltech-just-free-logo-design.png" class="img-fluid" alt="Dealer 8">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Custom Navigation Arrows -->
                            <button class="carousel-control-prev custom-arrow" type="button" data-bs-target="#clientCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next custom-arrow" type="button" data-bs-target="#clientCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>

                            <!-- Custom Indicators -->
                            <div class="carousel-indicators custom-indicators">
                                <button type="button" data-bs-target="#clientCarousel" data-bs-slide-to="0" class="active"></button>
                                <button type="button" data-bs-target="#clientCarousel" data-bs-slide-to="1"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Dealer Card Styling */
            .dealer-card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .dealer-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }

            .dealer-card img {
                max-height: 100px;
                width: auto;
                object-fit: contain;
            }

            /* Custom Arrow Styling */
            .custom-arrow {
                width: 50px;
                height: 50px;
                background: rgba(26, 118, 209, 0.8);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                z-index: 10;
                transition: 0.3s;
            }

            .custom-arrow:hover {
                background: rgba(26, 118, 209, 1);
            }

            .carousel-control-prev {
                left: -25px;
            }

            .carousel-control-next {
                right: -25px;
            }

            /* Custom Indicators */
            .custom-indicators {
                position: relative;
                margin-top: 20px;
            }

            .custom-indicators button {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background-color: #ccc;
                margin: 0 5px;
            }

            .custom-indicators button.active {
                background-color: #1A76D1;
            }

            /* Welcome Section Image */
            .welcome-section img {
                transition: transform 0.3s ease;
            }

            .welcome-section img:hover {
                transform: scale(1.02);
            }
        </style>
        <!-- About End -->

        <!-- Service Start -->
        <div class="container-fluid service py-5" style="background-color: #fff;">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h2 class="fw-bold text-primary mb-3">Our Products</h2>
            <p class="text-muted">Discover our range of high-quality laboratory equipment and solutions</p>
        </div>

        <!-- First Row of Products -->
        <div class="row g-4 justify-content-center">
            <?php while ($info = $result->fetch_assoc()) { ?>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="product-card">
                        <div class="product-img-container pb-4">
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
                              
                                <a class="btn btn-read-more " href="product1.php?id=<?php echo htmlspecialchars($info['id']); ?>">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="row g-4 justify-content-center mt-4">
            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                <a class="btn btn-primary rounded-pill py-3 px-5" href="product.php" 
                   style="font-size: 19px; transition: all 0.3s ease;">
                    Explore More
                </a>
            </div>
        </div>
    </div>
</div>

<style>
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
        padding: 18px 18px 0 18px;
        text-align: center;
        background: #fff;
    }

    .product-img {
        max-width: 100%;
        height: 200px;
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
        background: #fff;
    }

    .product-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #222;
        text-align: center;
    }

    .in-stock {
        color: #2ecc40;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .product-price {
        font-size: 1.15rem;
        font-weight: 600;
        color: #222;
        margin-bottom: 10px;
    }

    .btn-add-cart {
        background: #fff;
        color: #43a047;
        border: 1.5px solid #43a047;
        border-radius: 22px;
        padding: 6px 18px;
        font-weight: 500;
        font-size: 1rem;
        transition: background 0.2s, color 0.2s;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-add-cart:hover {
        background: #43a047;
        color: #fff;
    }

    .btn-read-more {
        background: #1A76D1;
        color: #fff;
        border-radius: 22px;
        padding: 6px 18px;
        font-weight: 500;
        font-size: 1rem;
        border: none;
        margin-left: 8px;
        transition: background 0.2s;
    }

    .btn-read-more:hover {
        background: #155a9c;
        color: #fff;
    }
</style>
<!-- Service End -->


        <!--Product category Start -->

        <?php
// Database connection
$data = mysqli_connect($host, $user, $password, $db);
$sql = "SELECT * FROM categories LIMIT 15";
$result = mysqli_query($data, $sql);
$categories = [];
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}
?>


<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-4" style="max-width: 800px;">
            <h2 class="fw-bold text-primary">Popular Categories</h2>
        </div>

        <div class="row justify-content-center text-center">
            <?php foreach ($categories as $info) { ?>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
                    <a href="category.php?id=<?php echo $info['id']; ?>" class="btn btn-outline-primary w-100 py-2" style="font-size: 16px;">
                        <?php echo htmlspecialchars($info['name']); ?>
                    </a>
                </div>
            <?php } ?>
        </div>

        <div class="text-center mt-4">
            <a class="btn btn-primary rounded-pill py-3 px-5" href="product.php" style="font-size: 18px;">Explore More</a>
        </div>
    </div>
</div>

<!-- Product Category End -->


        <div class=" bg-white container-fluid bg-light py-5">
            <div class="container pb-5">
                <!-- Choose Us Section with Centered Feature Boxes -->
                <div class=" p-5 rounded shadow-sm" style="background-color: #f8f9fa;">
                    <h2 class="fw-bold text-primary text-center mb-4">Why Choose Us</h2>
                    <p class="text-center mb-5" style="font-size: 16px; color: #666; max-width: 800px; margin: 0 auto;">
                        Our dedicated team is here to support and enhance your journey in advancing research and driving innovation in the scientific community.
                    </p>
                    
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-6 col-lg-3">
                            <div class="feature-box p-4 text-center bg-light rounded shadow-sm h-100">
                                <div class="feature-icon mb-4">
                                    <i class="fa fa-star fa-3x" style="color:#1A76D1;"></i>
                                </div>
                                <h5 class="mb-3" style="font-size: 19px; color: #333;">Deication to Excellence</h5>
                                <p class="text-muted mb-0">Committed to delivering the highest quality products and services</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="feature-box p-4 text-center bg-light rounded shadow-sm h-100">
                                <div class="feature-icon mb-4">
                                    <i class="fa fa-clock fa-3x" style="color:#1A76D1;"></i>
                                </div>
                                <h5 class="mb-3" style="font-size: 19px; color: #333;">Customized Solutions</h5>
                                <p class="text-muted mb-0">Tailored to meet your specific requirements and needs</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="feature-box p-4 text-center bg-light rounded shadow-sm h-100">
                                <div class="feature-icon mb-4">
                                    <i class="fa fa-microchip fa-3x" style="color:#1A76D1;"></i>
                                </div>
                                <h5 class="mb-3" style="font-size: 19px; color: #333;">Diverse Product Range</h5>
                                <p class="text-muted mb-0">Comprehensive selection of laboratory equipment and supplies</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="feature-box p-4 text-center bg-light rounded shadow-sm h-100">
                                <div class="feature-icon mb-4">
                                    <i class="fa fa-users fa-3x" style="color:#1A76D1;"></i>
                                </div>
                                <h5 class="mb-3" style="font-size: 19px; color: #333;">Exceptional Support</h5>
                                <p class="text-muted mb-0">Dedicated customer service and technical assistance</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .feature-box {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                border: 1px solid rgba(0,0,0,0.05);
            }

            .feature-box:hover {
                transform: translateY(-5px);
                box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            }

            .feature-icon {
                transition: transform 0.3s ease;
            }

            .feature-box:hover .feature-icon {
                transform: scale(1.1);
            }

            .feature-box h5 {
                transition: color 0.3s ease;
            }

            .feature-box:hover h5 {
                color: #1A76D1 !important;
            }
        </style>
        
        

        <!-- product category End -->
        <!-- FAQs Start -->
        <!-- <div class="container-fluid faq-section bg-light py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="h-100">
                            <div class="mb-5">
                                <h4 class="text-primary">Some Important FAQ's</h4>
                                <h1 class="display-4 mb-0">Common Frequently Asked Questions</h1>
                            </div>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Q:  What types of lab products does LabServ offer?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show active" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body rounded">
                                            A: LabServ offers a diverse range of high-quality lab products including microscopes, centrifuges, spectrophotometers, pipettes, and various diagnostic kits. Our products cater to various laboratory needs such as research, clinical diagnostics, and quality control.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Q:  How can I determine which product is right for my lab?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            A: To determine the best product for your needs, consider factors such as the type of tests you perform, the required accuracy, and the scale of operations. You can also consult our product specialists for personalized recommendations based on your specific requirements.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Q: Are LabServ products certified for quality and accuracy?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            A:Yes, all LabServ products are certified to meet rigorous quality standards. We adhere to industry certifications and regulatory requirements to ensure that our products deliver reliable and accurate performance.
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s">
                        <img src="https://th.bing.com/th/id/OIP.0hjiRksGJFoVGbn5qnQFegHaE7?rs=1&pid=ImgDetMain" class="img-fluid w-100" alt="">
                    </div>
                </div>
            </div>
        </div> -->
        <!-- FAQs End -->

        <!-- Blog Start -->
        <!-- <div class="container-fluid blog py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h2 class="fw-bold text-primary ">Blog & Event</h2>
                    
                    <p style="text-align: justify;" class="mb-0">Stay updated with the latest advancements and insights in lab services. Explore our blog for valuable information and updates on our offerings.</p>
                    
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="https://www.softclinicsoftware.com/wp-content/uploads/2021/06/close-up-researcher-holding-glassware-scaled.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="blog-categiry py-2 px-4">
                                    <span>Lab News</span>
                                </div>
                            </div>
                            <div class="blog-content p-4">
                                <div class="blog-comment d-flex justify-content-between mb-3">
                                    <div class="small"><span class="fa fa-user text-primary"></span>Dev</div>
                                    <div class="small"><span class="fa fa-calendar text-primary"></span> 30 Dec 2025</div>
                                    <div class="small"><span class="fa fa-comment-alt text-primary"></span> 6 Comments</div>
                                </div>
                                <a href="#" class="h4 d-inline-block mb-3">New Innovations in Lab Testing Technology</a>
                                <p class="mb-3">Discover the latest technological advancements in lab testing that are enhancing accuracy and efficiency.</p>
                                <a href="detailblog.html" class="btn p-0">Read More  <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="https://www.softclinicsoftware.com/wp-content/uploads/2021/06/close-up-researcher-holding-glassware-scaled.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="blog-categiry py-2 px-4">
                                    <span>Lab News</span>
                                </div>
                            </div>
                            <div class="blog-content p-4">
                                <div class="blog-comment d-flex justify-content-between mb-3">
                                    <div class="small"><span class="fa fa-user text-primary"></span>Samir</div>
                                    <div class="small"><span class="fa fa-calendar text-primary"></span> 30 Dec 2025</div>
                                    <div class="small"><span class="fa fa-comment-alt text-primary"></span> 6 Comments</div>
                                </div>
                                <a href="#" class="h4 d-inline-block mb-3">How Our New Equipment Improves Diagnostic Accuracy</a>
                                <p class="mb-3">Learn how the latest additions to our lab equipment inventory are helping to achieve more precise and reliable test results.</p>
                                <a href="#" class="btn p-0">Read More  <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="https://www.softclinicsoftware.com/wp-content/uploads/2021/06/close-up-researcher-holding-glassware-scaled.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="blog-categiry py-2 px-4">
                                    <span>Lab News</span>
                                </div>
                            </div>
                            <div class="blog-content p-4">
                                <div class="blog-comment d-flex justify-content-between mb-3">
                                    <div class="small"><span class="fa fa-user text-primary"></span>Ram</div>
                                    <div class="small"><span class="fa fa-calendar text-primary"></span> 30 Dec 2025</div>
                                    <div class="small"><span class="fa fa-comment-alt text-primary"></span> 6 Comments</div>
                                </div>
                                <a href="#" class="h4 d-inline-block mb-3">The Benefits of Regular Lab Equipment Maintenance</a>
                                <p class="mb-3">Understand the importance of regular maintenance for lab equipment and how it can prevent costly issues.</p>
                                <a href="#" class="btn p-0">Read More  <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                        <a class="btn rounded-pill py-2 px-4" 
                        href="blog.html" 
                        style="background-color: #001f3f; color: #ffffff; border: none; text-align: center; display: inline-block; text-decoration: none; font-size: 0.875rem;">
                        More Blog
                     </a>
                    </div>
                    
                </div>
            </div>
        </div> -->
        <!-- Blog End -->

        <!-- Team Start -->
        <!-- <div class="container-fluid team pb-5">
            <div class="container pb-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Team</h4>
                    <h1 class="display-4 mb-4">Meet Our Expert Team Members</h1>
                    <p class="mb-0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur adipisci facilis cupiditate recusandae aperiam temporibus corporis itaque quis facere, numquam, ad culpa deserunt sint dolorem autem obcaecati, ipsam mollitia hic.
                    </p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/team-1.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-0" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-4">
                                <h4 class="mb-0">David James</h4>
                                <p class="mb-0">Profession</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/team-2.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-0" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-4">
                                <h4 class="mb-0">David James</h4>
                                <p class="mb-0">Profession</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/team-3.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-0" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-4">
                                <h4 class="mb-0">David James</h4>
                                <p class="mb-0">Profession</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="img/team-4.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-0" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-4">
                                <h4 class="mb-0">David James</h4>
                                <p class="mb-0">Profession</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Team End -->

        <!-- Testimonial Start -->
        <!-- <div class="container-fluid testimonial pb-5">
            <div class="container pb-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h2 class="fw-bold text-primary ">Testimonial</h2>
                   
                    <p class="mb-0" style="text-align: center; display: inline-block; width: 100%; text-align: justify; text-align-last: center;">
                        Our customers praise LabServ India for providing high-quality lab equipment and exceptional after-sales service. They trust us for reliable products and prompt support, making us their go-to partner for all laboratory needs.
                    </p>
                    
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.2s">
                    <div class="testimonial-item bg-light rounded">
                        <div class="row g-0">
                            <div class="col-4  col-lg-4 col-xl-3">
                                <div class="h-100 d-flex align-items-center justify-content-center">
                                    <i class="fa fa-quote-left fa-5x text-primary"></i>
                                </div>
                            </div>
                            <div class="col-8 col-lg-8 col-xl-9">
                                <div class="d-flex flex-column my-auto text-start p-4">
                                    <h4 class="text-dark mb-0">Gurav Mallik</h4>
                                   
                                    <div class="d-flex text-primary mb-3">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="mb-0">You do not have to worry about repair and maintenance work of the lab equipment if you have chosen LabServ. They provide speedy servicing, and they never miss a maintenance servicing date.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded">
                        <div class="row g-0">
                            <div class="col-4  col-lg-4 col-xl-3">
                                <div class="h-100 d-flex align-items-center justify-content-center">
                                    <i class="fa fa-quote-left fa-5x text-primary"></i>
                                </div>
                            </div>
                            <div class="col-8 col-lg-8 col-xl-9">
                                <div class="d-flex flex-column my-auto text-start p-4">
                                    <h4 class="text-dark mb-0">Leena Patwardhan</h4>
                                   
                                    <div class="d-flex text-primary mb-3">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star text-body"></i>
                                    </div>
                                    <p class="mb-0">One call to LabServ  and you can be assured that the lab instrument of your choice is delivered to your site on time and in perfect condition, that too at the best price.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded">
                        <div class="row g-0">
                            <div class="col-4  col-lg-4 col-xl-3">
                                <div class="h-100 d-flex align-items-center justify-content-center">
                                    <i class="fa fa-quote-left fa-5x text-primary"></i>
                                </div>
                            </div>
                            <div class="col-8 col-lg-8 col-xl-9">
                                <div class="d-flex flex-column my-auto text-start p-4">
                                    <h4 class="text-dark mb-0">Sunder Deshmukh</h4>
                                   
                                    <div class="d-flex text-primary mb-3">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star text-body"></i>
                                        <i class="fas fa-star text-body"></i>
                                    </div>
                                    <p class="mb-0">
                                        We have been associated with LabServ  for three years now, and it must be said that their service is impeccable as well as swift
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
                        <h5 class="mb-4 mb-md-0" style="color: white; font-size: 19px;" >Empowering science, research and innovation for global well- being
                        </h5>
                    </div>
                    <!-- Right Side: Button -->
                    <div class="col-md-4 text-center text-md-end">
                        <a class="btn btn-light btn-lg" href="contact.php" style="font-size: 19px;">GET IN TOUCH</a>
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
        <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s" style="background-color: #1A76D1;">
            <div class="container py-5">
                <div class="row g-5">
                    <!-- Gallery Section -->
                    <div class="col-md-4 col-lg-3">
                        <div class="footer-item">
                            <h4 class="mb-4 text-white">Gallery</h4>
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
                                            <!-- Duplicate images for seamless effect -->
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
                                <h4 class="text-white mb-4 ">LabServ India</h4>
                            </a>
                            <p class="text-white-100 mb-4" style="line-height: 1.8;">
                                LabServ India is recognised for delivering top-quality laboratory instruments. We offer a diverse range of essential equipments including microscopes, autoclaves, incubators & more tailored to meet the needs of our clients.
                            </p>
                        </div>
                    </div>

                    <!-- Useful Links Section -->
                    <div class="col-md-1 col-lg-2">
                        <div class="footer-item">
                            <h4 class="text-white mb-4">Useful Links</h4>
                            <div class="d-flex flex-column gap-2">
                                <a href="index.php" class="text-white-100 text-decoration-none hover-primary">
                                    <i class="fas fa-angle-right me-2"></i>Home
                                </a>
                                <a href="about.html" class="text-white-100 text-decoration-none hover-primary">
                                    <i class="fas fa-angle-right me-2"></i>About Us
                                </a>
                                <a href="product.php" class="text-white-100 text-decoration-none hover-primary">
                                    <i class="fas fa-angle-right me-2"></i>Products
                                </a>
                                <a href="contact.php" class="text-white-100 text-decoration-none hover-primary">
                                    <i class="fas fa-angle-right me-2"></i>Contact Us
                                </a>
                                <a href="FAQ.html" class="text-white-100 text-decoration-none hover-primary">
                                    <i class="fas fa-angle-right me-2"></i>FAQs
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Us Section -->
                    <div class="col-md-4 col-lg-3">
                        <div class="footer-item">
                            <h4 class="text-white mb-4">Contact Us</h4>
                            
                            <!-- Address -->
                            <div class="d-flex mb-3">
                                <i class="fa fa-map-marker-alt text-white-100 me-3" style="font-size: 14px; line-height: 1.5;"></i>
                                <div>
                                    <span class="text-white-100" style="line-height: 1.6;">
                                        Reg. off: 18, The Nest Society<br>
                                        Vidhate Colony, D.P. Road<br>
                                        Aundh, Pune, Maharashtra
                                    </span>
                                </div>
                            </div>
                    
                            <!-- Phone Number -->
                            <div class="d-flex mb-3 align-items-center">
                                <i class="fa fa-phone text-white-100     me-3" style="font-size: 14px;"></i>
                                <a href="tel:+918806973003" class="text-white-100 text-decoration-none hover-primary">
                                    <span style="line-height: 1.6;">+91 8806973003</span>
                                </a>
                            </div>
                    
                            <!-- Email -->
                            <div class="d-flex mb-3 align-items-center">
                                <i class="fa fa-envelope text-white-100 me-3" style="font-size: 14px;"></i>
                                <a href="mailto:labservindia@gmail.com" class="text-white-100 text-decoration-none hover-primary">
                                    <span style="line-height: 1.6;">labservindia@gmail.com</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .footer {
                background-color: #1A76D1;
                color: white;
            }

            .footer-item h4 {
                position: relative;
                padding-bottom: 15px;
                color:rgb(255, 255, 255) !important;
            }

            .footer-item h4::after {
                content: '';
                position: absolute;
                left: 0;
                bottom: 0;
                width: 50px;
                height: 2px;
                background-color: #1A76D1;
            }

            .hover-primary {
                transition: color 0.3s ease;
            }

            .hover-primary:hover {
                color: #1A76D1 !important;
            }

            .gallery-item {
                display: block;
                overflow: hidden;
                border-radius: 8px;
                margin: 0 5px;
            }

            .gallery-img {
                height: 200px;
                width: 250px;
                object-fit: cover;
                border: 2px solid rgba(255,255,255,0.1);
                border-radius: 8px;
                transition: transform 0.3s ease;
            }

            .gallery-item:hover .gallery-img {
                transform: scale(1.05);
                border-color: #1A76D1;
            }

            @keyframes scroll {
                0% {
                    transform: translateX(0);
                }
                100% {
                    transform: translateX(-50%);
                }
            }

            .scrolling-gallery-images {
                display: flex;
                width: calc(250px * 6);
                animation: scroll 15s linear infinite;
            }
        </style>
        <!-- Footer End -->

        <!-- Copyright Start -->
        <div class="container-fluid copyright py-4" style="background-color: #155a9c;">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-12 text-center text-md-between text-white d-flex justify-content-between align-items-center px-md-4">
                        <!-- Left Side: Copyright Information -->
                        <div class="text-white-50 me-3">
                            Designed by 
                            <a href="https://g.co/kgs/nAViT23" class="text-white-50 text-decoration-none hover-primary">Cloud Booking Software Solutions</a>
                        </div>
                        
                        <span class="text-white-50 me-md-3">
                            <a href="#" class="text-white-50 text-decoration-none hover-primary">
                                <i class="fas fa-copyright text-light me-2"></i>2024
                            </a> | LabServ India | All rights reserved
                        </span>
                        
                        <!-- Right Side: Social Media Icons -->
                        <div class="footer-btn d-flex">
                            <a class="btn btn-social" href="#" style="
                                width: 40px; 
                                height: 40px; 
                                border-radius: 50%; 
                                display: flex; 
                                align-items: center; 
                                justify-content: center; 
                                background-color: rgba(255,255,255,0.1); 
                                color: #fff;
                                text-decoration: none; 
                                font-size: 18px; 
                                margin-right: 15px;
                                transition: all 0.3s ease;
                            "><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-social" href="#" style="
                                width: 40px; 
                                height: 40px; 
                                border-radius: 50%; 
                                display: flex; 
                                align-items: center; 
                                justify-content: center; 
                                background-color: rgba(255,255,255,0.1); 
                                color: #fff;
                                text-decoration: none; 
                                font-size: 18px; 
                                margin-right: 15px;
                                transition: all 0.3s ease;
                            "><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-social" href="#" style="
                                width: 40px; 
                                height: 40px; 
                                border-radius: 50%; 
                                display: flex; 
                                align-items: center; 
                                justify-content: center; 
                                background-color: rgba(255,255,255,0.1); 
                                color: #fff;
                                text-decoration: none; 
                                font-size: 18px; 
                                margin-right: 15px;
                                transition: all 0.3s ease;
                            "><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-social" href="#" style="
                                width: 40px; 
                                height: 40px; 
                                border-radius: 50%; 
                                display: flex; 
                                align-items: center; 
                                justify-content: center; 
                                background-color: rgba(255,255,255,0.1); 
                                color: #fff;
                                text-decoration: none; 
                                font-size: 18px;
                                transition: all 0.3s ease;
                            "><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .btn-social:hover {
                background-color: #1A76D1 !important;
                transform: translateY(-3px);
            }
        </style>
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
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
           
            function redirectTo(country) {
                if (country === 'india') {
                    window.location.href = 'https://india-website-url.com';  // Replace with India's website URL
                } else if (country === 'australia') {
                    window.location.href = 'https://australia-website-url.com';  // Replace with Australia's website URL
                }
            }
        
           
            window.onload = function () {
                var countrySelectionModal = new bootstrap.Modal(document.getElementById('countrySelectionModal'), {
                    keyboard: false,
                    backdrop: 'static'
                });
                countrySelectionModal.show();
            };
        </script> -->
        
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