<?php
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
include('config.php');

// Check if blog post ID is provided in URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $blog_id = $_GET['id'];

    // Fetch blog post data from database
    $query = "SELECT * FROM blog_posts WHERE id = $blog_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $author = $row['author'];
        $content = json_decode($row['content']);
        $images = json_decode($row['images']);
        $image_card = isset($images[0]) ? $images[0] : '';
        $image1 = isset($images[1]) ? $images[1] : '';
        $image2 = isset($images[2]) ? $images[2] : '';
    } else {
        // If blog post ID is not found
        echo "Blog post not found.";
        exit();
    }
} else {
    // If no blog post ID is provided
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Flavors&display=swap">
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
<form action="edit_handler.php" method="post" enctype="multipart/form-data">
    <h2>Edit Blog Post</h2>

    <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>">

    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" value="<?php echo $title; ?>" required><br><br>

    <label for="author">Author Name:</label><br>
    <input type="text" id="author" name="author" value="<?php echo $author; ?>" required><br><br>

    <label for="imageCard">Card Image:</label><br>
    <input type="text" id="image_url_card" name="image_url_card" value="<?php echo $image_card; ?>" placeholder="Enter image URL"><br>

    <label for="contentP1">Paragraph 1:</label><br>
    <textarea id="contentP1" name="contentP1" required><?php echo isset($content[0]) ? $content[0] : ''; ?></textarea><br><br>

    <label for="image1">Image 1:</label><br>
    <input type="text" id="image_url1" name="image_url1" value="<?php echo $image1; ?>" placeholder="Enter image URL"><br>

    <label for="contentP2">Paragraph 2:</label><br>
    <textarea id="contentP2" name="contentP2" required><?php echo isset($content[1]) ? $content[1] : ''; ?></textarea><br><br>

    <label for="image2">Image 2:</label><br>
    <input type="text" id="image_url2" name="image_url2" value="<?php echo $image2; ?>" placeholder="Enter image URL"><br>

    <label for="contentP3">Paragraph 3:</label><br>
    <textarea id="contentP3" name="contentP3"><?php echo isset($content[2]) ? $content[2] : ''; ?></textarea><br><br>

    <label for="contentP4">Paragraph 4:</label><br>
    <textarea id="contentP4" name="contentP4"><?php echo isset($content[3]) ? $content[3] : ''; ?></textarea><br><br>

    <label for="contentP5">Paragraph 5:</label><br>
    <textarea id="contentP5" name="contentP5"><?php echo isset($content[4]) ? $content[4] : ''; ?></textarea><br><br>

    <input type="submit" value="Submit">
</form>
</body>
</html>
