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
            /*margin-bottom: -40px;*/
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
                <!--                <img class="card-img-top" id="blogImage" src="" alt="Card image cap">-->
                <div class="card-body">
                    <?php
                    $json_data = file_get_contents("blogData.json");
                    $blogs = json_decode($json_data, true);
                    $postId = isset($_GET['id']) ? intval($_GET['id']) : 0;

                    $blogPost = null;
                    foreach ($blogs as $post) {
                        if ($post['id'] === $postId) {
                            $blogPost = $post;
                            break;
                        }
                    }

                    if ($blogPost) {
                        echo '<h2 class="card-title" style="font-family: Audiowide, sans-serif">' . $blogPost['title'] . '</h2>';
                        foreach ($blogPost['content'] as $index => $paragraph) {
                            echo '<p class="card-text">' . $paragraph . '</p>';
                            if ($index < count($blogPost['images']) && isset($blogPost['images'][$index])) {
                                echo '<img src="' . $blogPost['images'][$index] . '" class="img-fluid my-3" alt="Image ' . ($index + 1) . '">';
                            }
                        }
                        echo '<div class="card-footer text-muted">Posted by ' . $blogPost['author'] . ' on ' . $blogPost['date'] . '</div>';
                    } else {
                        echo '<h2 class="card-title">Blog Post Not Found</h2>';
                        echo '<p class="card-text">The requested blog post could not be found.</p>';
                    }
                    ?>
                </div>
                <div class="card-footer text-muted" id="blogMeta"></div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <form id="commentForm">
                <h2 class="comment-form-title text-center">Share Your Thoughts</h2>
                <div class="form-group">
                    <label for="commentName" style="color: #D3D3D3;">Name:</label>
                    <input type="text" class="form-control" id="commentName" required>
                </div>
                <div class="form-group">
                    <label for="commentEmail" style="color: #D3D3D3;">Email:</label>
                    <input type="email" class="form-control" id="commentEmail" required>
                </div>
                <div class="form-group">
                    <label for="commentContent" style="color: #D3D3D3;">Comment:</label>
                    <textarea class="form-control" id="commentContent" rows="3" required></textarea>
                </div>
                <br>
                <button type="submit" class="btn submit-btn" style="justify-content: center; align-self: center; text-align: center; padding-top: -10px;">Submit</button>
            </form>

            <div id="commentsContainer" class="container mt-5">
                <div id="commentsSection" class="row justify-content-center">

                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let comments = [];
        function displayComments() {
            const commentsSection = document.getElementById('commentsSection');
            commentsSection.innerHTML = '';

            const colors = ['#CCCCCC', '#2F4F4F', '#556B2F', '#6A5ACD'];

            comments.forEach((comment, index) => {
                const commentDiv = document.createElement('div');
                commentDiv.classList.add('card', 'mt-3');
                commentDiv.style.width = "700px";
                commentDiv.style.backgroundColor = "black";

                const cardBody = document.createElement('div');
                cardBody.classList.add('card-body');
                cardBody.style.backgroundColor = colors[index % colors.length];
                cardBody.style.borderRadius = "10px";

                const commenterInfo = document.createElement('p');
                commenterInfo.innerHTML = `<strong>${comment.name}</strong> (${comment.email})`;

                const commentContent = document.createElement('p');
                commentContent.textContent = comment.content;

                cardBody.appendChild(commenterInfo);
                cardBody.appendChild(commentContent);
                commentDiv.appendChild(cardBody);

                commentsSection.appendChild(commentDiv);
            });

            if (comments.length > 0) {
                const commentsTitle = document.createElement('h2');
                commentsTitle.classList.add('text-center');
                commentsTitle.textContent = "Comments";
                commentsTitle.style.fontFamily = "DOOMFont, sans-serif";
                commentsTitle.style.color = "white";
                commentsTitle.style.fontSize = "50px";
                commentsTitle.style.justifyContent = "center";
                commentsSection.insertBefore(commentsTitle, commentsSection.firstChild);
            }
        }


        const commentForm = document.getElementById('commentForm');
        commentForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const name = document.getElementById('commentName').value;
            const email = document.getElementById('commentEmail').value;
            const content = document.getElementById('commentContent').value;

            comments.push({ name, email, content });

            displayComments();

            document.getElementById('commentName').value = '';
            document.getElementById('commentEmail').value = '';
            document.getElementById('commentContent').value = '';
        });
    });
</script>
</body>
</html>