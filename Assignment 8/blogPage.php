<?php
session_start();

// Establish connection to MySQL database
$conn = new mysqli("localhost", "root", "", "assignment8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming postId variable contains the ID of the current blog post
$postId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch blog post data from the database
$sql = "SELECT * FROM blog_posts WHERE id = $postId";
$result = $conn->query($sql);

$row = []; // Initialize $row variable

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}

// Fetch user's information from the database if logged in
$userName = "Guest";
$userEmail = "guest@example.com";
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql_user_info = "SELECT name, email FROM users WHERE id = $user_id";
    $result_user_info = $conn->query($sql_user_info);
    if ($result_user_info->num_rows > 0) {
        $row_user_info = $result_user_info->fetch_assoc();
        $userName = $row_user_info['name'];
        $userEmail = $row_user_info['email'];
    }
}

// Handle comment submission if user is logged in
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    if (isset($_POST['action']) && ($_POST['action'] == 'like' || $_POST['action'] == 'dislike')) {
        $action = $_POST['action'];

        // Check if the user has already reacted to the post
        $checkReactionSql = "SELECT * FROM post_reactions WHERE post_id = $postId AND user_id = $user_id";
        $checkReactionResult = $conn->query($checkReactionSql);

        if ($checkReactionResult->num_rows > 0) {
            $row_reaction = $checkReactionResult->fetch_assoc();
            $existingReaction = $row_reaction['reaction'];

            // If the user's reaction matches the current action, remove the reaction
            if ($existingReaction == $action) {
                $deleteReactionSql = "DELETE FROM post_reactions WHERE post_id = $postId AND user_id = $user_id";
                if ($conn->query($deleteReactionSql) === TRUE) {
                    // Decrease the count
                    $updateCountSql = "UPDATE blog_posts SET ";
                    $updateCountSql .= ($action == 'like') ? "likes = likes - 1" : "dislikes = dislikes - 1";
                    $updateCountSql .= " WHERE id = $postId";
                    if ($conn->query($updateCountSql) === TRUE) {
                        echo ucfirst($action) . " removed successfully.";
                    } else {
                        echo "Error updating count: " . $conn->error;
                    }
                } else {
                    echo "Error deleting reaction: " . $conn->error;
                }
            } else {
                // If the user's reaction is different from the current action, update the reaction
                $updateReactionSql = "UPDATE post_reactions SET reaction = '$action' WHERE post_id = $postId AND user_id = $user_id";
                if ($conn->query($updateReactionSql) === TRUE) {
                    // Increase like/dislike count
                    $updateCountSql = "UPDATE blog_posts SET ";
                    $updateCountSql .= ($action == 'like') ? "likes = likes + 1" : "dislikes = dislikes + 1";
                    $updateCountSql .= " WHERE id = $postId";
                    if ($conn->query($updateCountSql) === TRUE) {
                        echo ucfirst($action) . " updated successfully.";
                    } else {
                        echo "Error updating count: " . $conn->error;
                    }
                } else {
                    echo "Error updating reaction: " . $conn->error;
                }
            }
        } else {
            // If the user has not reacted before, insert the reaction
            $insertReactionSql = "INSERT INTO post_reactions (post_id, user_id, reaction) VALUES ($postId, $user_id, '$action')";
            if ($conn->query($insertReactionSql) === TRUE) {
                // Increase like/dislike count
                $updateCountSql = "UPDATE blog_posts SET ";
                $updateCountSql .= ($action == 'like') ? "likes = likes + 1" : "dislikes = dislikes + 1";
                $updateCountSql .= " WHERE id = $postId";
                if ($conn->query($updateCountSql) === TRUE) {
                    echo ucfirst($action) . " updated successfully.";
                } else {
                    echo "Error updating count: " . $conn->error;
                }
            } else {
                echo "Error inserting reaction: " . $conn->error;
            }
        }
        exit;
    } elseif (isset($_POST['content'])) {
        // Handle comment submission
        $content = $_POST['content'];

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $postId, $_SESSION['user_id'], $content);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "Comment submitted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Invalid action.";
    }
    exit; // Stop further execution
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Post</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Exo&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Bruno+Ace+SC&family=Bungee+Hairline&family=Flavors&family=Sixtyfour&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
            background-color: black;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif, 'DOOMFont';
        }

        .navbar {
            background-color: black;
            height: 80px;
        }

        .navbar-brand {
            margin-top: 0;
            margin-left: -350px;
            margin-right: 150px;
            color: #b8860b;
            font-family: Sixtyfour, sans-serif;
            font-size: 40px;
            height: 70px;
        }

        @font-face {
            font-family: 'DOOMFont';
            src: url("C:/College stuff/SY/WT/Task 3/fonts/amazdoom/AmazDooMLeft.ttf") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        .navbar-nav a {
            font-family: Audiowide, sans-serif;
            font-size: 30px;
        }

        .nav-item .nav-link {
            border-radius: 50px;
            transition: box-shadow 0.2s ease-in-out, background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        .nav-item .nav-link:hover {
            color: #b8860b;
            background-color: #FFFFFFB2;
            box-shadow: 0 0 100px 20px rgba(255, 255, 255, 0.7);
        }

        .comment-form-title {
            font-family: Audiowide, sans-serif;
            color: #D3D3D3;
            font-size: 50px;
            width: fit-content;
            text-align: center;
            justify-content: center;
            align-self: center;
            margin-left: 60px;
        }

        .form-group {
            font-family: Audiowide, sans-serif;
            font-size: 25px;
            margin-bottom: 10px;
        }

        .form-control {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .submit-btn {
            color: white;
            font-family: Audiowide, sans-serif;
            font-size: 25px;
            height: 40px;
            padding-bottom: 10px;
            padding-top: -20px;
            justify-content: center;
            align-items: center;
            margin-left: 42%;
            transition: box-shadow 0.2s ease-in-out, background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        .submit-btn:hover {
            color: #FFD700;
            background-color: black;
            box-shadow: 0 0 100px 20px rgba(255, 255, 255, 0.7);
        }

        /* Add additional styles for comments display */
        .comment {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
        }

        .comment p {
            color: #fff;
            font-size: 18px;
        }

        .comment .commenter-info {
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#" style="color: #b8860b">Gamer's Paradise - Blogs</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blogMain.php">Blogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
<br>
<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <?php
                    $conn = new mysqli("localhost", "root", "", "assignment8");

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $postId = isset($_GET['id']) ? intval($_GET['id']) : 0;

                    $sql = "SELECT * FROM blog_posts WHERE id = $postId";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo '<h2 class="card-title" style="font-family: Audiowide, sans-serif">' . $row['title'] . '</h2>';

                        $paragraphs = json_decode($row['content']);
                        $images = json_decode($row['images']);

                        foreach ($paragraphs as $index => $paragraph) {
                            echo '<p class="card-text">' . $paragraph . '</p>';

                            if (isset($images[$index])) {
                                echo '<img src="' . $images[$index] . '" class="img-fluid my-3" alt="Image ' . ($index + 1) . '">';
                            }
                        }

                        echo '<div class="card-footer text-muted">Posted by ' . $row['author'] . ' on ' . $row['date'] . '</div>';
                    } else {
                        echo '<h2 class="card-title">Blog Post Not Found</h2>';
                        echo '<p class="card-text">The requested blog post could not be found.</p>';
                    }

                    $conn->close();
                    ?>
                </div>
                <div class="card-footer text-muted" id="blogMeta">
                    <button class="btn like-btn" data-action="like">Like</button>
                    <span id="likesCount"><?php echo isset($row['likes']) ? $row['likes'] : 0; ?></span>
                    <button class="btn dislike-btn" data-action="dislike">Dislike</button>
                    <span id="dislikesCount"><?php echo isset($row['dislikes']) ? $row['dislikes'] : 0; ?></span>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <form id="commentForm">
                <h2 class="comment-form-title text-center">Share Your Thoughts</h2>
                <div class="form-group">
                    <label for="commentContent" style="color: #D3D3D3;">Comment:</label>
                    <textarea class="form-control" id="commentContent" rows="3" required></textarea>
                </div>
                <br>
                <button type="submit" class="btn submit-btn">Submit</button>
            </form>

            <div id="commentsSection" class="container mt-5">
                <?php
                // Fetch comments for the current blog post
                $conn = new mysqli("localhost", "root", "", "assignment8");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql_comments = "SELECT comments.*, users.name AS commenter_name, users.email AS commenter_email, comments.id AS comment_id FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = $postId";
                $result_comments = $conn->query($sql_comments);

                if ($result_comments->num_rows > 0) {
                    while ($row_comment = $result_comments->fetch_assoc()) {
                        echo '<div class="comment">';
                        echo '<p class="commenter-info"><strong>' . $row_comment['commenter_name'] . '</strong> (' . $row_comment['commenter_email'] . ')</p>';
                        echo '<p>' . $row_comment['comment'] . '</p>';

                        // Add delete button if the logged-in user is the author of the comment
                        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row_comment['user_id']) {
                            echo '<button class="delete-comment-btn" data-comment-id="' . $row_comment['comment_id'] . '">Delete</button>';
                        }

                        echo '</div>';
                    }
                } else {
                    echo '<p>No comments yet.</p>';
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Assuming postId variable contains the ID of the current blog post
        const postId = <?php echo $postId; ?>;

        // Handle comment submission
        const commentForm = document.getElementById('commentForm');
        commentForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const postId = <?php echo $postId; ?>;

            const content = document.getElementById('commentContent').value;

            // Check if the user is logged in
            <?php if(isset($_SESSION['user_id'])) : ?>
            // Send the comment data to the server using AJAX
            $.ajax({
                url: 'blogPage.php?id=' + postId,
                method: 'POST',
                data: {
                    content: content,
                    postId: postId
                },
                success: function(response) {
                    // If comment submitted successfully, display it in the comments section
                    const commentsSection = document.getElementById('commentsSection');
                    const commentDiv = document.createElement('div');
                    commentDiv.classList.add('comment');
                    commentDiv.innerHTML = '<p class="commenter-info"><strong><?php echo $userName; ?></strong> (<?php echo $userEmail; ?>)</p><p>' + content + '</p>';

                    // Add delete button if the logged-in user is the author of the comment
                    commentDiv.innerHTML += '<button class="delete-comment-btn" data-comment-id="' + response.comment_id + '">Delete</button>';

                    commentsSection.appendChild(commentDiv);

                    // Clear the comment form field
                    document.getElementById('commentContent').value = '';
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(error);
                    alert('Failed to submit comment.');
                }
            });
            <?php else : ?>
            // User is not logged in, prompt a confirmation dialog
            if (confirm('You need to log in to submit a comment. Do you want to proceed to the login page?')) {
                window.location.href = 'login.php'; // Redirect to the login page
            }
            <?php endif; ?>
        });

        // Handle comment deletion
        const commentsSection = document.getElementById('commentsSection');
        commentsSection.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-comment-btn')) {
                const commentId = event.target.dataset.commentId;

                // Confirm deletion
                if (confirm('Are you sure you want to delete this comment?')) {
                    // Send AJAX request to delete the comment
                    $.ajax({
                        url: 'deleteComment.php',
                        method: 'POST',
                        data: {
                            commentId: commentId,
                            postId: postId
                        },
                        success: function(response) {
                            // Check if the deletion was successful
                            if (response === 'success') {
                                // Remove the deleted comment from the UI
                                event.target.parentElement.remove();
                            } else {
                                console.error('Failed to delete comment.');
                                alert('Failed to delete comment.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            alert('Failed to delete comment.');
                        }
                    });
                }
            }
        });

        //function reactPost(action) {
        //    $.ajax({
        //        url: 'blogPost.php?id=<?php //echo $postId; ?>//',
        //        type: 'POST',
        //        data: {
        //            action: action
        //        },
        //        success: function (response) {
        //            alert(response);
        //            // Reload the page to reflect changes in like/dislike counts
        //            location.reload();
        //        }
        //    });
        //}

        // Retrieve user's reaction from session storage
        const userReaction = sessionStorage.getItem('userReaction_' + postId);

        // Highlight the like or dislike button based on the user's reaction
        if (userReaction === 'like') {
            $('.like-btn').addClass('active');
        } else if (userReaction === 'dislike') {
            $('.dislike-btn').addClass('active');
        }

        // Handle like button click
        $('.like-btn').on('click', function() {
            const isAlreadyLiked = $('.like-btn').hasClass('active');
            const isAlreadyDisliked = $('.dislike-btn').hasClass('active');

            if (isAlreadyLiked) {
                // If already liked, remove the like
                removeReaction('like');
            } else {
                // If not already liked, like the post
                addReaction('like');
                // If already disliked, remove the dislike
                if (isAlreadyDisliked) {
                    removeReaction('dislike');
                }
            }
        });

        // Handle dislike button click
        $('.dislike-btn').on('click', function() {
            const isAlreadyLiked = $('.like-btn').hasClass('active');
            const isAlreadyDisliked = $('.dislike-btn').hasClass('active');

            if (isAlreadyDisliked) {
                // If already disliked, remove the dislike
                removeReaction('dislike');
            } else {
                // If not already disliked, dislike the post
                addReaction('dislike');
                // If already liked, remove the like
                if (isAlreadyLiked) {
                    removeReaction('like');
                }
            }
        });

        // Function to add reaction
        function addReaction(reaction) {
            $.ajax({
                url: 'blogPage.php?id=<?php echo $postId; ?>',
                type: 'POST',
                data: {
                    action: reaction
                },
                success: function(response) {
                    $('#' + reaction + 'sCount').text(response);
                    $('.' + reaction + '-btn').addClass('active');
                    // Store user's reaction in session storage
                    sessionStorage.setItem('userReaction_' + postId, reaction);
                }
            });
        }

        // Function to remove reaction
        function removeReaction(reaction) {
            $.ajax({
                url: 'blogPage.php?id=<?php echo $postId; ?>',
                type: 'POST',
                data: {
                    action: reaction
                },
                success: function(response) {
                    $('#' + reaction + 'sCount').text(response);
                    $('.' + reaction + '-btn').removeClass('active');
                    // Remove user's reaction from session storage
                    sessionStorage.removeItem('userReaction_' + postId);
                }
            });
        }
    });
</script>


</body>
</html>