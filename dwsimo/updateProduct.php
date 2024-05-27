<?php
// Include the database connection file
include 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST["id"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $image = $_FILES["image"]["name"];

    // Check if a new image is uploaded
    if ($image) {
        // Move the uploaded image to the uploads folder
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // SQL query to update the product with new image
            $sql = "UPDATE products SET name = '$name', description = '$description', price = '$price', image = '$image' WHERE id = $id";
        } else {
            echo "Error uploading file.";
            exit();
        }
    } else {
        // SQL query to update the product without changing the image
        $sql = "UPDATE products SET name = '$name', description = '$description', price = '$price' WHERE id = $id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
