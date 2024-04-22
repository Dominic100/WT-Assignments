<?php
session_start();

// Establish connection to MySQL database
$conn = new mysqli("localhost", "root", "", "assignment8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming postId variable contains the ID of the current blog post
$postId = isset($_POST['postId']) ? intval($_POST['postId']) : 0;

// Fetch user's ID if logged in
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

// Handle like/dislike action
if (isset($_POST['action']) && ($_POST['action'] == 'like' || $_POST['action'] == 'dislike')) {
    $action = $_POST['action'];
    $reaction = ($action == 'like') ? 'likes' : 'dislikes';

    // Check if the user has already reacted
    $checkSql = "SELECT * FROM post_reactions WHERE post_id = $postId AND user_id = $user_id AND reaction = '$action'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        // User has already reacted, remove the reaction
        $conn->query("DELETE FROM post_reactions WHERE post_id = $postId AND user_id = $user_id AND reaction = '$action'");
        echo 'decrement';
    } else {
        // User has not reacted, add the reaction
        $conn->query("INSERT INTO post_reactions (post_id, user_id, reaction) VALUES ($postId, $user_id, '$action')");
        echo 'increment';
    }

    // Update the like/dislike count in the blog_posts table
    $conn->query("UPDATE blog_posts SET $reaction = $reaction + 1 WHERE id = $postId");
    exit;
}

$conn->close();
?>