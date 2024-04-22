<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "assignment8";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Exo&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Bruno+Ace+SC&family=Bungee+Hairline&family=Flavors&family=Sixtyfour&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body style="max-width: 1880px">

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="z-index: 1000;">
    <div class="container">
        <a class="navbar-brand" href="index.php" data-bs-toggle="offcanvas" data-bs-target="#demo" style="color: #FFD700; margin-right: 50px">GAMER'S PARADISE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
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
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="redirectToWrite()">Write</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="carousel-container mb-5" style="height: 1000px; margin-bottom: -150px">
    <div class="left-section"></div>
    <div id="carousel-slide" class="carousel slide" data-bs-ride="carousel" style="max-width: 1700px; margin: auto;">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel-slide" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carousel-slide" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carousel-slide" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#carousel-slide" data-bs-slide-to="3"></button>
            <button type="button" data-bs-target="#carousel-slide" data-bs-slide-to="4"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images3.alphacoders.com/825/825895.jpg" alt="COD_WW2" class="d-block w-100" style="max-height: 850px;">
            </div>
            <div class="carousel-item">
                <img src="https://images8.alphacoders.com/132/1329760.jpeg" alt="CS2" class="d-block w-100" style="max-height: 850px;">
            </div>
            <div class="carousel-item">
                <img src="https://wallpapercave.com/wp/wp5248836.jpg" alt="BloonsTD6" class="d-block w-100" style="max-height: 850px;">
            </div>
            <div class="carousel-item">
                <img src="https://variety.com/wp-content/uploads/2015/06/bak_sshot130.jpg?w=1000&h=563&crop=1" alt="Batman_AK" class="d-block w-100" style="max-height: 850px;">
            </div>
            <div class="carousel-item">
                <img src="https://www.topgear.com/sites/default/files/2023/07/Black%20Flag%20weapons%20free.jpg?w=976&h=549" alt="ACBF" class="d-block w-100" style="max-height: 850px;">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-slide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel-slide" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
    <div class="right-section"></div>
</div>

<h3 class="card-showcase text-center" style="margin-top: -100px">What's Hot!</h3>
<br>

<div class="center-grid">
    <div class="card-body mt-5" id="cardContainer" style="background-color: black">
        <?php
        $sql = "SELECT * FROM cards";
        $result = $conn->query($sql);
        $cards_per_row = 3; // Define the number of cards per row

        if ($result->num_rows > 0) {
            $counter = 0; // Initialize a counter
            while ($row = $result->fetch_assoc()) {
                if ($counter % $cards_per_row === 0) {
                    echo '<div class="row mt-3">';
                }
                echo '<div class="col-md-4 mt-3">';
                echo '<div class="card ' . $row["class"] . '"style="background-color: black; margin-bottom: 30px;">';
                echo '<div class="card-header" style="background-color: #FF5722; color: #FFFFFF; font-family: Bruno Ace SC, sans-serif; font-size: 20px; height: 63px; padding: 2px; padding-left: 10px; padding-right: 10px; border-radius: 20px;">' . $row["header"] . '</div>';
                echo '<div class="card-body" style="background-color: black;"><img src="' . $row["body"] . '" class="card-img-top" style="height: 350px; border-radius: 10px;"></div>';
                echo '<div class="card-footer" style="background-color: #9C27B0; color: #FFFFFF; font-family: Bruno Ace SC, sans-serif; font-size: 20px; height: 35px; padding: 0; padding-left: 20px; border-radius: 20px;">' . $row["footer"] . '</div>';
                echo '<button class="btn btn-primary" style="font-family: Sixtyfour, sans-serif; font-size: 20px; font-stretch: extra-expanded; height: 40px; width: 250px; align-self: center; border-radius: 20px; background-color: black; color: white; border-color: black;" onclick="window.location.href=\'blogPage.php?id=' . $row["id"] . '\'" onmouseover="this.style.backgroundColor=\'#D3D3D3\'; this.style.color=\'black\'; this.style.fontWeight=\'bold\'; this.style.boxShadow=\'0 0 100px 20px rgba(255, 255, 255, 0.7)\';" onmouseout="this.style.backgroundColor=\'black\'; this.style.color=\'white\'; this.style.fontWeight=\'normal\'; this.style.boxShadow=\'none\';">READ MORE</button>';
                echo '</div>';
                echo '</div>';
                if (($counter + 1) % $cards_per_row === 0) {
                    echo '</div>'; // Close the row after displaying the desired number of cards
                }
                $counter++;
            }
            if ($counter % $cards_per_row !== 0) {
                echo '</div>';
            }
        }
        ?>
    </div>
</div>

<script>
    function redirectToWrite() {
        <?php
        // Check if the user is logged in
        if (!isset($_SESSION["user_id"])) {
        ?>
        // If the user is not logged in, prompt them to log in
        var proceed = confirm("You need to log in to write a blog. Do you want to proceed to login?");
        if (proceed) {
            // Redirect to the login page
            window.location.href = "login.php";
        }
        <?php
        } else {
        ?>
        // If the user is logged in, redirect them to the write page
        window.location.href = "submit.php";
        <?php
        }
        ?>
    }

    document.addEventListener("DOMContentLoaded", function() {
        // const offcanvasData = {
        //     title: "Quote of the Day",
        //     bodyContent: [
        //         "\"Victory is always possible for the person who refuses to stop fighting.\" ",
        //         "- Napoleon Hill"
        //     ],
        //     buttonText: "A Button",
        //     imageUrl: "https://example.com/image.jpg"
        // };
        //
        // const offcanvasTitle = document.getElementById('offcanvasTitle');
        // offcanvasTitle.textContent = offcanvasData.title;
        //
        // const offcanvasBody = document.getElementById('offcanvasBody');
        // offcanvasData.bodyContent.forEach(paragraph => {
        //     const p = document.createElement('p');
        //     p.textContent = paragraph;
        //     offcanvasBody.appendChild(p);
        // });

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

        $(document).ready(function() {
            $(".card-showcase").hover(function() {
                $(this).stop().animate({
                    fontSize: "80px",
                    marginBottom: "-60px"
                }, 300);
            }, function() {
                $(this).stop().animate({
                    fontSize: "70px",
                    marginBottom: "-50px"
                }, 300);
            });
        });
    });
</script>

<div class="offcanvas offcanvas-start" id="demo">
    <div class="offcanvas-header">
        <h1 class="offcanvas-title" id="offcanvasTitle"></h1>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body" id="offcanvasBody">
        <ul class="list-group">
            <li class="list-group-item">
                <a class="canvas-link" style="font-family: 'Audiowide', sans-serif; font-size: 50px; text-decoration: none" href="register.php">Register</a>
            </li>
            <li class="list-group-item">
                <a class="canvas-link" style="font-family: 'Audiowide', sans-serif; font-size: 50px; text-decoration: none" href="login.php">Login</a>
            </li>
        </ul>
    </div>
</div>

<form id="commentForm">
    <h2 class="comment-form-title text-center mt-5">Share Your Thoughts</h2>
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
    <button type="submit" class="btn submit-btn">Submit</button>
</form>

<div id="commentsContainer" class="container mt-5">
    <div id="commentsSection" class="row justify-content-center">
    </div>
</div>

<footer class="footer mt-5">
    <div class="container text-center">
        <span class="text-muted" style="color: white !important;">© 2024 Dynamic Blog. All rights reserved.</span>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>