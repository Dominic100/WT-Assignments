<?php
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish connection to MySQL database
    $conn = new mysqli("localhost", "root", "", "assignment8");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and retrieve form data
    $title = htmlspecialchars($_POST["title"]);
    $author = htmlspecialchars($_POST["author"]);
    $footer = "by " . htmlspecialchars($_POST["author"]);
    $contentP1 = htmlspecialchars($_POST["contentP1"]);
    $contentP2 = htmlspecialchars($_POST["contentP2"]);
    $contentP3 = htmlspecialchars($_POST["contentP3"]);
    $contentP4 = htmlspecialchars($_POST["contentP4"]);
    $contentP5 = htmlspecialchars($_POST["contentP5"]);
    $image_card = $_POST['image_url_card'];
    $image1 = $_POST['image_url1'];
    $image2 = $_POST['image_url2'];

    // Create an array for blog content and images
    $blogContent = array($contentP1, $contentP2, $contentP3, $contentP4, $contentP5);
    $blogImages = array($image1, $image2);

    // Get current user's ID from the session
    $user_id = $_SESSION['user_id'];

    // Get current date
    $currentDate = date("Y-m-d");

    // Insert data into cards table
    $sql = "INSERT INTO cards (header, body, footer, class) VALUES ('$title', '$image_card', '$footer', '')";
    $conn->query($sql);

    // Get last inserted card ID
    $cardId = $conn->insert_id;

    // Insert data into blogs table with user ID
    $sql = "INSERT INTO blog_posts (title, content, images, author, author_id, date) VALUES ('$title', '" . json_encode($blogContent) . "', '" . json_encode($blogImages) . "', '$author', '$user_id', '$currentDate')";
    $conn->query($sql);

    // Close connection
    $conn->close();

    // Redirect after successful submission
    header("Refresh: 3; URL=index.php");
    echo "Blog post submitted successfully! Redirecting...";
    exit(); // Ensure that script stops executing after redirect header
} else {
    // If the form was not submitted via POST method, show an error
    echo "Error: Form submission method not allowed.";
}
?>
