<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

        #contactUs {
            padding: 50px 0;
        }

        #contactUs h2 {
            color: #fff;
            font-size: 80px;
            font-family: Bungee Hairline, sans-serif;
            text-align: center;
        }

        #contactUs p {
            color: #ccc;
            font-size: 1.1rem;
            font-family: Roboto, sans-serif;
        }

        #contactUs img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            background-color: black;
        }

        .navbar-brand {
            font-family: Sixtyfour, sans-serif;
            font-size: 50px;
            margin-left: -150px;
            color: #FFD700;
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
            border-radius: 50px;
            transition: box-shadow 0.2s ease-in-out, background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        .navbar-nav a:hover {
            color: #b8860b;
            background-color: #FFFFFFB2;
            box-shadow: 0 0 100px 20px rgba(255, 255, 255, 0.7);
        }

        #contactUs a {
            font-family: Audiowide, sans-serif;
            font-size: 30px;
            height: 60px;
            background-color: black;
            color: white;
            border-color: black;
        }

        #contactUs a:hover {
            background-color: white;
            color: black;
        }

        .comment-form-title {
            font-family: 'DOOMFont', sans-serif;
            color: #D3D3D3;
            font-size: 50px;
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
            font-family: Audiowide, sans-serif;
            font-size: 25px;
            height: 50px;
            padding-bottom: 0;
            color: white;
            /*padding-top: -10px;*/
            justify-content: center;
            align-items: center;
            margin-left: 38%;
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
        <a class="navbar-brand" href="#" style="color: #FFD700;">Get in Touch</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blogMain.php">Blogs</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="contactUs" class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
            <h2>Contact Us</h2>
            <div id="contactContent">
                <!-- Content will be dynamically populated here -->
            </div>
            <a href="index.php" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
    <br>
    <br>
    <form id="commentForm">
        <h2 class="comment-form-title text-center mt-5">Share Your Queries</h2>
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
        <button type="submit" class="btn submit-btn d-block mx-auto">Submit</button>
    </form>

    <div id="commentsContainer" class="container mt-5">
        <div id="commentsSection" class="row justify-content-center">

        </div>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Custom Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const contactData = {
            title: "Contact Us",
            image: "https://img.freepik.com/premium-photo/words-with-contact-us-business-concept-idea_352439-357.jpg",
            content: [
                "Have questions or feedback? We'd love to hear from you!",
                "Feel free to reach out to us using the contact form below or via email.",
                "We typically respond to inquiries within 24 hours.",
                "Thank you for your interest in Gamer's Paradise!",
            ]
        };

        const contactContent = document.getElementById('contactContent');

        const contactContentHTML = `
            <img src="${contactData.image}" alt="${contactData.title} Image" class="mb-3">
            ${contactData.content.map(paragraph => `<p>${paragraph}</p>`).join('')}
        `;
        contactContent.innerHTML = contactContentHTML;

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