<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

// Establish connection to MySQL database
$conn = new mysqli("localhost", "root", "", "assignment8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user's blogs from the database based on their user ID
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM blog_posts WHERE author_id = '$user_id'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Flavors&display=swap">
</head>
<body>
<div class="container">
    <h1>Welcome to Your Account</h1>
    <h2>Your Blogs:</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h3>" . $row["title"] . "</h3>";
            // Display other blog details as needed
            echo "</div>";
        }
    } else {
        echo "No blogs found for this user.";
    }
    ?>
</div>
</body>
</html>

<?php
$conn->close();
?>