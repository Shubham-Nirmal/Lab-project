<?php
include('config/dbcon.php');

if (isset($_POST['product_id'])) {
    $product_id = mysqli_real_escape_string($db, $_POST['product_id']);
    $query = "SELECT name, photo FROM products WHERE id = '$product_id'";
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $product = mysqli_fetch_assoc($query_run);
        echo json_encode([
            'name' => htmlspecialchars($product['name']),
            'photo' => htmlspecialchars($product['photo'])
        ]);
    } else {
        echo json_encode(['name' => 'Product Not Found', 'photo' => '']);
    }
}
?>
