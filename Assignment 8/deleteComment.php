<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    // Check if the commentId and postId are set in the request
    if (isset($_POST['commentId']) && isset($_POST['postId'])) {
        $commentId = intval($_POST['commentId']);
        $postId = intval($_POST['postId']);
        $userId = $_SESSION['user_id'];

        // Connect to the database
        $conn = new mysqli("localhost", "root", "", "assignment8");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare a SQL statement to delete the comment
        $deleteCommentSql = "DELETE FROM comments WHERE id = $commentId AND post_id = $postId AND user_id = $userId";

        // Execute the SQL statement
        if ($conn->query($deleteCommentSql) === TRUE) {
            // Comment deleted successfully
            echo "success";
        } else {
            // Failed to delete comment
            echo "error";
        }

        // Close the database connection
        $conn->close();
    } else {
        // Invalid request parameters
        echo "error";
    }
} else {
    // User not logged in
    echo "error";
}
?>
