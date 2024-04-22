<?php
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $blog_id = $_POST["blog_id"];
    $title = htmlspecialchars($_POST["title"]);
    $author = htmlspecialchars($_POST["author"]);
    $contentP1 = htmlspecialchars($_POST["contentP1"]);
    $contentP2 = htmlspecialchars($_POST["contentP2"]);
    $contentP3 = htmlspecialchars($_POST["contentP3"]);
    $contentP4 = htmlspecialchars($_POST["contentP4"]);
    $contentP5 = htmlspecialchars($_POST["contentP5"]);
    $image_card = $_POST['image_url_card'];
    $image1 = $_POST['image_url1'];
    $image2 = $_POST['image_url2'];

    // Create an array for blog content and images
    $content = array($contentP1, $contentP2, $contentP3, $contentP4, $contentP5);
    $images = array($image_card, $image1, $image2);

    // Update data in the database
    $sql = "UPDATE blog_posts SET title='$title', author='$author', content='" . json_encode($content) . "', images='" . json_encode($images) . "' WHERE id=$blog_id";

    if (mysqli_query($conn, $sql)) {
        // Redirect after successful update
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating blog post: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    // If the form was not submitted via POST method, show an error
    echo "Error: Form submission method not allowed.";
}
?>