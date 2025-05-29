<?php
session_start(); // Start the session only once at the top of the script
//session_destroy();
include("config/dbcon.php");
include('authentication.php');

// Logout functionality
if (isset($_POST['logout_btn'])) {
    session_destroy(); // Destroy the session completely
    unset($_SESSION['auth']); // Unset authentication session variables
    unset($_SESSION['auth_user']);

    $_SESSION['status'] = "Logged out successfully";
    header('Location: login.php');
    exit(0); // Ensure no further code is executed after redirecting
}











































// Handle subcategory update
if (isset($_POST['subcategory_update'])) {
    $subcategory_id = $_POST['subcategory_id'];
    $subcategory_name = $_POST['subcategory_name'];
    $category_id = $_POST['category_id'];
    
    // Handle image upload if a new image is provided
    if (isset($_FILES['subcategory_image']) && $_FILES['subcategory_image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['subcategory_image'];
        $image_name = time() . '_' . basename($image['name']); // Create a unique image name
        $target_directory = "uploaded_images/"; // Directory to save the image
        $target_file = $target_directory . $image_name;

        // Check if image file is valid
        $check = getimagesize($image['tmp_name']);
        if ($check === false) {
            echo "File is not an image.";
            exit;
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($image['tmp_name'], $target_file)) {
            // Update the subcategory with the new image
            $query = "UPDATE subcategories SET category_id='$category_id', name='$subcategory_name', image='$image_name' WHERE id='$subcategory_id'";
        } else {
            echo "Error uploading image.";
            exit;
        }
    } else {
        // Update the subcategory without changing the image
        $query = "UPDATE subcategories SET category_id='$category_id', name='$subcategory_name' WHERE id='$subcategory_id'";
    }

    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $_SESSION['message'] = "Subcategory updated successfully.";
        header("Location: subcategory.php"); // Redirect to your page
        exit(0);
    } else {
        echo "Failed to update subcategory.";
    }
}


if (isset($_POST['subcategory_save'])) {
    // Connect to database
    
    // Get form data
    $subcategory_name = $_POST['subcategory_name'];
    $category_id = $_POST['category_id'];

    // Handle file upload
    if (isset($_FILES['subcategory_image']) && $_FILES['subcategory_image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['subcategory_image'];
        $image_name = time() . '_' . basename($image['name']); // Create a unique image name
        $target_directory = "uploaded_images/"; // Directory to save the image
        $target_file = $target_directory . $image_name;

        // Check if image file is a valid image
        $check = getimagesize($image['tmp_name']);
        if ($check === false) {
            echo "File is not an image.";
            exit;
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($image['tmp_name'], $target_file)) {
            // Insert into the database
            $query = "INSERT INTO subcategories (category_id, image, name) VALUES ('$category_id', '$image_name', '$subcategory_name')";
            $query_run = mysqli_query($db, $query);

            if ($query_run) {
                $_SESSION['message'] = "Subcategory added successfully.";
                header("Location: subcategory.php"); // Redirect to your page
                exit(0);
            } else {
                echo "Failed to add subcategory.";
            }
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "No image uploaded.";
    }
}

// Handle deletion of subcategory
if (isset($_POST['subcat_delete_btn'])) {
    $subcat_delete_id = $_POST['subcat_delete_id'];
    $delete_query = "DELETE FROM subcategories WHERE id='$subcat_delete_id'";
    $delete_query_run = mysqli_query($db, $delete_query);

    if ($delete_query_run) {
        $_SESSION['message'] = "Subcategory deleted successfully.";
        header("Location: subcategory.php"); // Redirect to your page
        exit(0);
    } else {
        echo "Failed to delete subcategory.";
    }
}




























// Check if delete request is made
if (isset($_POST['order_delete_btn'])) {
    // Sanitize input
    $order_delete_id = mysqli_real_escape_string($db, $_POST['order_delete_id']);

    // Debugging: Check received ID
    error_log("Received ID for deletion: " . $order_delete_id);

    // Check if the order ID exists before deleting
    $check_query = "SELECT * FROM orders WHERE id='$order_delete_id' LIMIT 1";
    $check_query_run = mysqli_query($db, $check_query);

    if ($check_query_run && mysqli_num_rows($check_query_run) > 0) {
        // Delete the order
        $delete_query = "DELETE FROM orders WHERE id='$order_delete_id'";
        $delete_query_run = mysqli_query($db, $delete_query);

        if ($delete_query_run) {
            $_SESSION['status'] = "Order deleted successfully!";
        } else {
            $_SESSION['status'] = "Order deletion failed: " . mysqli_error($db);
        }
    } else {
        $_SESSION['status'] = "No record found for this ID!";
    }

    header("Location: order.php");
    exit();
}



// Add Product
// if (isset($_POST['product_save'])) {
//     $name = mysqli_real_escape_string($db, $_POST['name']);
//     $description = mysqli_real_escape_string($db, $_POST['description']);
//     $price = mysqli_real_escape_string($db, $_POST['price']);
//     $stock = mysqli_real_escape_string($db, $_POST['stock']);
    
    
//     $photo = '';
//     if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
//         $photoName = $_FILES['photo']['name'];
//         $fileTmpPath = $_FILES['photo']['tmp_name'];
//         $fileNameCmps = explode(".", $photoName);
//         $fileExtension = strtolower(end($fileNameCmps));
//         $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

//         if (in_array($fileExtension, $allowedExtensions)) {
//             $uploadFileDir = __DIR__ . '/uploaded_images/';
//             if (!is_dir($uploadFileDir)) {
//                 mkdir($uploadFileDir, 0777, true); 
//             }
//             $newFileName = uniqid() . '.' . $fileExtension; 
//             $dest_path = $uploadFileDir . $newFileName;

//             if (move_uploaded_file($fileTmpPath, $dest_path)) {
//                 $photo = $newFileName; 
//             } else {
//                 $_SESSION['status'] = "Error moving uploaded file.";
//                 header("Location: product.php");
//                 exit();
//             }
//         } else {
//             $_SESSION['status'] = "Unsupported file type. Please upload jpg, jpeg, png, or gif.";
//             header("Location: product.php");
//             exit();
//         }
//     } else {
//         if ($_FILES['photo']['error'] !== UPLOAD_ERR_NO_FILE) {
//             $_SESSION['status'] = "File upload error: " . $_FILES['photo']['error'];
//         } else {
//             $_SESSION['status'] = "No file uploaded.";
//         }
//         header("Location: product.php");
//         exit();
//     }

  
//     $query = "INSERT INTO products (name, price, stock, photo, description) VALUES (?, ?, ?, ?, ?)";
//     $stmt = $db->prepare($query);

//     if ($stmt) {
//         $stmt->bind_param("sdiss", $name, $price, $stock, $photo, $description);

//         if ($stmt->execute()) {
//             $_SESSION['status'] = "Product inserted successfully";
//         } else {
//             $_SESSION['status'] = "Error: " . $stmt->error;
//         }

//         $stmt->close();
//     } else {
//         $_SESSION['status'] = "Error preparing statement: " . $db->error;
//     }

//     header("Location: product.php");
//     exit();
// }

// Add Product
if (isset($_POST['product_save'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    
    // Remove line breaks (\r\n or \n) from the description and specification
    $description = mysqli_real_escape_string($db, str_replace(["\r\n", "\r", "\n"], ' ', $_POST['description']));
    $specification = mysqli_real_escape_string($db, str_replace(["\r\n", "\r", "\n"], ' ', $_POST['specification']));
    
    $category_id = mysqli_real_escape_string($db, $_POST['category_id']);  // Get category_id from the form
    
    // Handle image upload
    $photo = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photoName = $_FILES['photo']['name'];
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileNameCmps = explode(".", $photoName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadFileDir = __DIR__ . '/uploaded_images/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true); // Create directory if it does not exist
            }
            $newFileName = uniqid() . '.' . $fileExtension; // Generate unique file name
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $photo = $newFileName; // Store only the file name in the database
            } else {
                $_SESSION['status'] = "Error moving uploaded file.";
                header("Location: product.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Unsupported file type. Please upload jpg, jpeg, png, or gif.";
            header("Location: product.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "No file uploaded.";
        header("Location: product.php");
        exit();
    }

    // Handle PDF upload
    $pdf = '';
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        $pdfName = $_FILES['pdf']['name'];
        $fileTmpPath = $_FILES['pdf']['tmp_name'];
        $fileNameCmps = explode(".", $pdfName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedExtensions = array('pdf');

        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadFileDir = __DIR__ . '/uploaded_pdfs/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true); // Create directory if it does not exist
            }
            $newFileName = uniqid() . '.' . $fileExtension; // Generate unique file name
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $pdf = $newFileName; // Store only the file name in the database
            } else {
                $_SESSION['status'] = "Error moving uploaded PDF.";
                header("Location: product.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Unsupported file type. Please upload a PDF.";
            header("Location: product.php");
            exit();
        }
    }

    // Prepare and execute the insert query with category_id
    $query = "INSERT INTO products (name, photo, pdf, description, specification, category_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssssss", $name, $photo, $pdf, $description, $specification, $category_id); // Bind category_id as well

        if ($stmt->execute()) {
            $_SESSION['status'] = "Product inserted successfully";
        } else {
            $_SESSION['status'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['status'] = "Error preparing statement: " . $db->error;
    }

    header("Location: product.php");
    exit();
}


    // Prepare and execute the insert query
//     $query = "INSERT INTO products (name, photo, pdf, description, specification) VALUES (?, ?, ?, ?, ?)";
//     $stmt = $db->prepare($query);

//     if ($stmt) {
//         $stmt->bind_param("sssss", $name, $photo, $pdf, $description, $specification);

//         if ($stmt->execute()) {
//             $_SESSION['status'] = "Product inserted successfully";
//         } else {
//             $_SESSION['status'] = "Error: " . $stmt->error;
//         }

//         $stmt->close();
//     } else {
//         $_SESSION['status'] = "Error preparing statement: " . $db->error;
//     }

//     header("Location: product.php");
//     exit();
// }
// Update Product
if (isset($_POST['product_update'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $specification = mysqli_real_escape_string($db, $_POST['specification']);
    $category_id = mysqli_real_escape_string($db, $_POST['category']);

    // Handle image upload
    $photo = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photoName = $_FILES['photo']['name'];
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileNameCmps = explode(".", $photoName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadFileDir = './uploaded_images/';
            $dest_path = $uploadFileDir . $photoName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $photo = $photoName;
            } else {
                $_SESSION['status'] = "Error moving uploaded file.";
                header("Location: product.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Unsupported file type.";
            header("Location: product.php");
            exit();
        }
    } else {
        // Fetch existing photo if no new file is uploaded
        $query = "SELECT photo FROM products WHERE id='$id'";
        $query_run = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($query_run);
        $photo = $row['photo'];
    }

    // Handle PDF upload
    $pdf = '';
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        $pdfName = $_FILES['pdf']['name'];
        $fileTmpPath = $_FILES['pdf']['tmp_name'];
        $fileNameCmps = explode(".", $pdfName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedExtensions = array('pdf');

        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadFileDir = './uploaded_pdfs/';
            $dest_path = $uploadFileDir . $pdfName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $pdf = $pdfName;
            } else {
                $_SESSION['status'] = "Error moving uploaded PDF.";
                header("Location: product.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Unsupported PDF file type.";
            header("Location: product.php");
            exit();
        }
    } else {
        // Fetch existing PDF if no new file is uploaded
        $query = "SELECT pdf FROM products WHERE id='$id'";
        $query_run = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($query_run);
        $pdf = $row['pdf'];
    }

    // Prepare and execute the update query for product and category
    $query = "UPDATE products SET name=?, photo=?, pdf=?, description=?, specification=?, category_id=? WHERE id=?";
    $stmt = $db->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssssssi", $name, $photo, $pdf, $description, $specification, $category_id, $id);

        if ($stmt->execute()) {
            $_SESSION['status'] = "Product updated successfully";
        } else {
            $_SESSION['status'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['status'] = "Error preparing statement: " . $db->error;
    }

    header("Location: product.php");
    exit();
}



// if (isset($_POST['product_update'])) {
//     $id = mysqli_real_escape_string($db, $_POST['id']);
//     $name = mysqli_real_escape_string($db, $_POST['name']);
//     $description = mysqli_real_escape_string($db, $_POST['description']);
//     $price = mysqli_real_escape_string($db, $_POST['price']);
//     $stock = mysqli_real_escape_string($db, $_POST['stock']);
    
 
//     $photo = '';
//     if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
//         $photoName = $_FILES['photo']['name'];
//         $fileTmpPath = $_FILES['photo']['tmp_name'];
//         $fileNameCmps = explode(".", $photoName);
//         $fileExtension = strtolower(end($fileNameCmps));
//         $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

//         if (in_array($fileExtension, $allowedExtensions)) {
//             $uploadFileDir = './uploaded_images/';
//             $dest_path = $uploadFileDir . $photoName;

//             if (move_uploaded_file($fileTmpPath, $dest_path)) {
//                 $photo = $photoName;
//             } else {
//                 $_SESSION['status'] = "Error moving uploaded file.";
//                 header("Location: product.php");
//                 exit();
//             }
//         } else {
//             $_SESSION['status'] = "Unsupported file type.";
//             header("Location: product.php");
//             exit();
//         }
//     } else {
        
//         $query = "SELECT photo FROM products WHERE id='$id'";
//         $query_run = mysqli_query($db, $query);
//         $row = mysqli_fetch_assoc($query_run);
//         $photo = $row['photo'];
//     }

//     /
//     $query = "UPDATE products SET name=?, price=?, stock=?, photo=?, description=? WHERE id=?";
//     $stmt = $db->prepare($query);

//     if ($stmt) {
//         $stmt->bind_param("sdissi", $name, $price, $stock, $photo, $description, $id);

//         if ($stmt->execute()) {
//             $_SESSION['status'] = "Product updated successfully";
//         } else {
//             $_SESSION['status'] = "Error: " . $stmt->error;
//         }

//         $stmt->close();
//     } else {
//         $_SESSION['status'] = "Error preparing statement: " . $db->error;
//     }

//     header("Location: product.php");
//     exit();
// }


// Delete Product
if (isset($_POST['pro_delete_btn'])) {
    $pro_delete_id = mysqli_real_escape_string($db, $_POST['pro_delete_id']);

    // Debugging: Check received ID
    error_log("Received ID for deletion: " . $pro_delete_id);

    // Check if the ID exists before deleting
    $check_query = "SELECT * FROM products WHERE id='$pro_delete_id' LIMIT 1";
    $check_query_run = mysqli_query($db, $check_query);

    if ($check_query_run && mysqli_num_rows($check_query_run) > 0) {
        // Delete the product
        $delete_query = "DELETE FROM products WHERE id='$pro_delete_id'";
        $delete_query_run = mysqli_query($db, $delete_query);

        if ($delete_query_run) {
            $_SESSION['status'] = "Product deleted successfully!";
        } else {
            $_SESSION['status'] = "Product deletion failed: " . mysqli_error($db);
        }
    } else {
        $_SESSION['status'] = "No record found for this ID!";
    }

    header("Location: product.php");
    exit();
}




// Add category
if (isset($_POST['category_save'])) {
    $name = mysqli_real_escape_string($db, $_POST['category_name']);
    $image = ''; // Default to an empty string

    // Handle image upload
    if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] === UPLOAD_ERR_OK) {
        $imageName = $_FILES['category_image']['name'];
        $fileTmpPath = $_FILES['category_image']['tmp_name'];
        $fileNameCmps = explode(".", $imageName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadFileDir = 'uploaded_images/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }
            $newFileName = uniqid() . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $image = $newFileName;
            } else {
                $_SESSION['status'] = "Error moving uploaded file.";
                header("Location: category.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Unsupported file type. Please upload jpg, jpeg, png, or gif.";
            header("Location: category.php");
            exit();
        }
    }

    // Insert data into the database
    $query = "INSERT INTO categories (name, image) VALUES (?, ?)";
    $stmt = $db->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ss", $name, $image);

        if ($stmt->execute()) {
            $_SESSION['status'] = "Category added successfully";
        } else {
            $_SESSION['status'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['status'] = "Error preparing statement: " . $db->error;
    }

    header("Location: category.php");
    exit();
}

// Update category
if (isset($_POST['category_update'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $name = mysqli_real_escape_string($db, $_POST['category_name']);
    $current_image = mysqli_real_escape_string($db, $_POST['current_image']);

    // Handle image upload
    $image = $current_image; // Default to the current image
    if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] === UPLOAD_ERR_OK) {
        $imageName = $_FILES['category_image']['name'];
        $fileTmpPath = $_FILES['category_image']['tmp_name'];
        $fileNameCmps = explode(".", $imageName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadFileDir = './uploaded_images/';
            $newFileName = uniqid() . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Delete the old image if it exists
                if (!empty($current_image) && file_exists($uploadFileDir . $current_image)) {
                    unlink($uploadFileDir . $current_image);
                }
                $image = $newFileName;
            } else {
                $_SESSION['status'] = "Error moving uploaded file.";
                header("Location: category-edit.php?id=$id");
                exit();
            }
        } else {
            $_SESSION['status'] = "Unsupported file type. Please upload jpg, jpeg, png, or gif.";
            header("Location: category-edit.php?id=$id");
            exit();
        }
    }

    // Prepare and execute the update query
    $query = "UPDATE categories SET name=?, image=? WHERE id=?";
    $stmt = $db->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssi", $name, $image, $id);

        if ($stmt->execute()) {
            $_SESSION['status'] = "Category updated successfully";
        } else {
            $_SESSION['status'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['status'] = "Error preparing statement: " . $db->error;
    }

    header("Location: category.php");
    exit();
}

// Delete category
if (isset($_POST['cat_delete_btn'])) {
    $id = mysqli_real_escape_string($db, $_POST['cat_delete_id']);
    
    // First, fetch the current image name to delete it later
    $query = "SELECT image FROM categories WHERE id=?";
    $stmt = $db->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($current_image);
        $stmt->fetch();
        $stmt->close();

        // Delete all subcategories that reference this category
        $delete_subcategories_query = "DELETE FROM subcategories WHERE category_id=?";
        $stmt = $db->prepare($delete_subcategories_query);

        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }

        // Now delete the category
        $query = "DELETE FROM categories WHERE id=?";
        $stmt = $db->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                // Delete the image from the server
                if (!empty($current_image) && file_exists('./uploaded_images/' . $current_image)) {
                    unlink('./uploaded_images/' . $current_image);
                }
                $_SESSION['status'] = "Category deleted successfully";
            } else {
                $_SESSION['status'] = "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $_SESSION['status'] = "Error preparing statement: " . $db->error;
        }
    }

    header("Location: category.php");
    exit();
}








// Add blog
if (isset($_POST['blog_save'])) {
    $heading = mysqli_real_escape_string($db, $_POST['heading']);
    $paragraph = mysqli_real_escape_string($db, $_POST['paragraph']);
    $writer_name = mysqli_real_escape_string($db, $_POST['writer_name']);
    $date = mysqli_real_escape_string($db, $_POST['date']);

    // Define the upload directory
    $upload_dir = 'uploaded_images/';

    // Handle Single Image Upload
    $single_image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $single_image_name = $_FILES['image']['name'];
        $single_image_tmp_name = $_FILES['image']['tmp_name'];
        $single_image_extension = pathinfo($single_image_name, PATHINFO_EXTENSION);
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array(strtolower($single_image_extension), $allowed_extensions)) {
            $single_image_new_name = uniqid("blog_", true) . "." . $single_image_extension;
            $single_image_path = $upload_dir . $single_image_new_name;

            // Move the single image to the uploaded_images/ folder
            if (!move_uploaded_file($single_image_tmp_name, $single_image_path)) {
                $_SESSION['message'] = "Failed to upload main image.";
                header("Location: blog.php");
                exit(0);
            }
        }
    }

    // Handle Multiple Image Uploads
    $uploaded_images = [];
    if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
        for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
            $image_name = $_FILES['images']['name'][$i];
            $image_tmp_name = $_FILES['images']['tmp_name'][$i];
            $image_error = $_FILES['images']['error'][$i];

            if ($image_error === 0) {
                $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);

                if (in_array(strtolower($image_extension), $allowed_extensions)) {
                    $new_image_name = uniqid("blog_", true) . "_" . $i . "." . $image_extension;
                    $upload_path = $upload_dir . $new_image_name;

                    // Move each image
                    move_uploaded_file($image_tmp_name, $upload_path);
                    $uploaded_images[] = $upload_path; // Store image paths
                }
            }
        }
    }

    // Convert the array of image paths to JSON for storing in the database
    $images_json = json_encode($uploaded_images);

    // Save blog data with single image and multiple images in the database
    $query = "INSERT INTO blogs (heading, paragraph, writer_name, date, image, additional_images) 
              VALUES ('$heading', '$paragraph', '$writer_name', '$date', '$single_image_path', '$images_json')";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $_SESSION['message'] = "Blog Added Successfully";
        header("Location: blog.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Blog Not Added";
        header("Location: blog.php");
        exit(0);
    }
}

// Update blog
if (isset($_POST['blog_update'])) {
    $blog_id = mysqli_real_escape_string($db, $_POST['blog_id']);
    $heading = mysqli_real_escape_string($db, $_POST['heading']);
    $paragraph = mysqli_real_escape_string($db, $_POST['paragraph']);
    $writer_name = mysqli_real_escape_string($db, $_POST['writer_name']); // New field
    $date = mysqli_real_escape_string($db, $_POST['date']); // New field

    // Initialize the image with the existing one
    $image = '';

    // Handle file upload if a new file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = $_FILES['image']['name'];
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadFileDir = './uploaded_images/';
            $dest_path = $uploadFileDir . $imageName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $image = $dest_path;
            } else {
                $_SESSION['status'] = "Error moving uploaded file.";
                header("Location: blog-edit.php?id=$blog_id");
                exit();
            }
        } else {
            $_SESSION['status'] = "Unsupported file type.";
            header("Location: blog-edit.php?id=$blog_id");
            exit();
        }
    } else {
        // Fetch the existing image if no new file is uploaded
        $query = "SELECT image FROM blogs WHERE id='$blog_id'";
        $query_run = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($query_run);
        $image = $row['image'];
    }

    // Handle Multiple Additional Image Uploads
    $additional_images = [];
    if (isset($_FILES['additional_images']) && count($_FILES['additional_images']['name']) > 0) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        for ($i = 0; $i < count($_FILES['additional_images']['name']); $i++) {
            $image_name = $_FILES['additional_images']['name'][$i];
            $image_tmp_name = $_FILES['additional_images']['tmp_name'][$i];
            $image_error = $_FILES['additional_images']['error'][$i];

            if ($image_error === 0) {
                $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

                if (in_array($image_extension, $allowedExtensions)) {
                    $new_image_name = uniqid("blog_", true) . "_" . $i . "." . $image_extension;
                    $upload_path = 'uploaded_images/' . $new_image_name;

                    // Move the uploaded image to the directory
                    if (move_uploaded_file($image_tmp_name, $upload_path)) {
                        $additional_images[] = $upload_path; // Store the image path
                    }
                }
            }
        }
    }

    // Retrieve existing additional images if no new ones were uploaded
    if (empty($additional_images)) {
        $query = "SELECT additional_images FROM blogs WHERE id='$blog_id'";
        $query_run = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($query_run);
        $existing_images = json_decode($row['additional_images'], true);
        $additional_images = $existing_images ? $existing_images : [];
    }

    // Convert the additional images array to JSON
    $additional_images_json = json_encode($additional_images);

    // Prepare and execute the update query
    $query = "UPDATE blogs SET heading=?, paragraph=?, writer_name=?, date=?, image=?, additional_images=? WHERE id=?";
    $stmt = $db->prepare($query);

    if ($stmt) {
        // Bind the parameters correctly
        $stmt->bind_param("ssssssi", $heading, $paragraph, $writer_name, $date, $image, $additional_images_json, $blog_id);

        if ($stmt->execute()) {
            $_SESSION['status'] = "Blog updated successfully";
        } else {
            $_SESSION['status'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['status'] = "Error preparing statement: " . $db->error;
    }

    header("Location: blog.php");
    exit();
}
// Delete blog
if (isset($_POST['blog_delete_btn'])) {
    // Sanitize and assign form data
    $id = mysqli_real_escape_string($db, $_POST['blog_delete_id']);
    
    // Prepare and execute the delete query
    $query = "DELETE FROM blogs WHERE id=?";
    $stmt = $db->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $_SESSION['status'] = "Blog deleted successfully";
        } else {
            $_SESSION['status'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['status'] = "Error preparing statement: " . $db->error;
    }

    // Redirect to the blog list page
    header("Location: blog.php");
    exit();
}
