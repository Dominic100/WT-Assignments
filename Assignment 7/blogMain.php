<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Blog Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="blogMainStyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Exo&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Bruno+Ace+SC&family=Bungee+Hairline&family=Flavors&family=Sixtyfour&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="blogMain.php">Blogs</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="about.php">About-Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
<br>
<br>
<br>
<div class="center-grid">
    <h1 class="hot-cards text-center" id="color-changing-heading" style="font-family: 'Audiowide', sans-serif">Explore</h1>
    <br>
    <div class="container mt-5">
        <input type="text" id="searchInput" class="form-control" placeholder="Search for blogs..." onkeyup="searchBlogs()">
    </div>
    <div class="card-body mt-5" id="cardContainer">
        <?php
        $json_data = file_get_contents("cardData.json");
        $blogs = json_decode($json_data, true);

        $cards_per_row = 3;

        foreach ($blogs as $index => $blog) {
            if ($index % $cards_per_row === 0) {
                echo '<div class="row mt-3">';
            }

            echo '<div class="col-md-4 mt-3">';
            echo '<div class="card ' . $blog["class"] . '"style="background-color: black; margin-bottom: 30px;">';
            echo '<div class="card-header" style="background-color: #FF5722; color: #FFFFFF; font-family: Bruno Ace SC, sans-serif; font-size: 20px; height: 63px; padding: 2px; padding-left: 10px; padding-right: 10px; border-radius: 20px;">' . $blog["header"] . '</div>';
            echo '<div class="card-body" style="background-color: black;"><img src="' . $blog["body"] . '" class="card-img-top" style="height: 350px; border-radius: 10px;"></div>';
            echo '<div class="card-footer" style="background-color: #9C27B0; color: #FFFFFF; font-family: Bruno Ace SC, sans-serif; font-size: 20px; height: 35px; padding: 0; padding-left: 20px; border-radius: 20px;">' . $blog["footer"] . '</div>';
            echo '<button class="btn btn-primary" style="font-family: Sixtyfour, sans-serif; font-size: 20px; font-stretch: extra-expanded; height: 40px; width: 250px; align-self: center; border-radius: 20px; background-color: black; color: white; border-color: black;" onclick="window.location.href=\'blogPage.php?id=' . ($index + 1) . '\'" onmouseover="this.style.backgroundColor=\'#D3D3D3\'; this.style.color=\'black\'; this.style.fontWeight=\'bold\'; this.style.boxShadow=\'0 0 100px 20px rgba(255, 255, 255, 0.7)\';" onmouseout="this.style.backgroundColor=\'black\'; this.style.color=\'white\'; this.style.fontWeight=\'normal\'; this.style.boxShadow=\'none\';">READ MORE</button>';
            echo '</div>';
            echo '</div>';

            if (($index + 1) % $cards_per_row === 0 || $index === count($blogs) - 1) {
                echo '</div>';
            }
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="blogMainScript.js"></script>
</body>
</html>
