<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        #aboutUs {
            padding: 50px 0;
        }

        #aboutUs h2 {
            color: #fff;
            font-size: 80px;
            font-family: Bungee Hairline, sans-serif;
            text-align: center;
        }

        #aboutUs p {
            color: #ccc;
            font-size: 1.1rem;
            font-family: Roboto, sans-serif;
        }

        #aboutUs img {
            max-width: 100%;
            margin-left: 60px;
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
            margin-left: -200px;
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

        #aboutUs a {
            font-family: Audiowide, sans-serif;
            font-size: 30px;
            height: 60px;
            background-color: black;
            color: white;
            border-color: black;
        }

        #aboutUs a:hover {
            background-color: white;
            color: black;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#" style="color: #FFD700; font-family: Sixtyfour, sans-serif">Meet the Gamers</a>
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
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="aboutUs" class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>About Us</h2>
            <div id="aboutContent">
            </div>
            <a href="index.php" class="btn btn-primary d-block mx-auto">Back to Home</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const aboutData = {
            title: "About Us",
            image: "https://media.istockphoto.com/id/496280806/photo/computer-keyboard-about-us.jpg?s=612x612&w=0&k=20&c=g8mfKNgYDzOzuekpoKwviAJ0bAt7LubJ2bRf7adu4Wc=",
            content: [
                "Welcome to Gamer's Paradise, your ultimate destination for everything related to gaming!",
                "At Gamer's Paradise, we are passionate gamers ourselves, dedicated to sharing our love for gaming with fellow enthusiasts.",
                "Our team of experienced writers covers a wide range of gaming topics, including game reviews, tips and tricks, industry news, and much more.",
                "Whether you're a hardcore gamer, a casual player, or just someone interested in the world of gaming, you'll find something to enjoy at Gamer's Paradise.",
                "Join us on our journey to explore the latest releases, uncover hidden gems, and dive deep into the fascinating world of video games.",
                "At Gamer's Paradise, gaming isn't just a hobby – it's a way of life.",
                "So come on in, grab your controller, and let's embark on an epic gaming adventure together!"
            ]
        };

        const aboutContent = document.getElementById('aboutContent');

        const aboutContentHTML = `
            <img src="${aboutData.image}" alt="${aboutData.title} Image" class="mb-3">
            ${aboutData.content.map(paragraph => `<p>${paragraph}</p>`).join('')}
        `;
        aboutContent.innerHTML = aboutContentHTML;
    });
</script>
</body>
</html>