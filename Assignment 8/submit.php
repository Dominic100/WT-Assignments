<?php
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Blog Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Flavors&display=swap">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: black;
        }
        h2 {
            font-family: Flavors, sans-serif;
            color: black;
            text-align: center;
        }
        form {
            margin-top: 400px;
            width: 600px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            background-color: #fff;
            transition: box-shadow 0.2s ease-in-out;
        }
        form:hover {
            box-shadow: 0 0 50px 0 rgba(255,255,255,0.7);
        }
        label {
            font-family: 'Flavors', sans-serif;
            font-size: 18px;
            color: #333;
        }
        input[type="text"],
        input[type="submit"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            /*font-family: 'Flavors', sans-serif;*/
            font-size: 16px;
        }
        input[type="submit"] {
            font-family: 'Flavors', sans-serif;
            font-size: 20px;
            border-radius: 20px;
            align-self: center;
            margin-left: 23%;
            width: 300px;
            background-color: white;
            color: black;
            cursor: pointer;
            /*transition: background-color 0.3s;*/
            transition: box-shadow 0.2s ease-in-out, background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }
        input[type="submit"]:hover {
            color: #FFD700;
            background-color: black;
            box-shadow: 0 0 100px 20px rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body>
<form action="submit_handler.php" method="post" enctype="multipart/form-data">
    <h2>Submit Blog Post</h2>

    <label for="author">Author Name (to be displayed):</label><br>
    <input type="text" id="author" name="author" required><br><br>

    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" required><br><br>

    <label for="imageCard">Card Image:</label><br>
    <input type="text" id="image_url_card" name="image_url_card" placeholder="Enter image URL"><br>

    <label for="contentP1">Paragraph 1:</label><br>
    <textarea id="contentP1" name="contentP1" required></textarea><br><br>

    <label for="image1">Image 1:</label><br>
    <input type="text" id="image_url1" name="image_url1" placeholder="Enter image URL"><br>

    <label for="contentP2">Paragraph 2:</label><br>
    <textarea id="contentP2" name="contentP2" required></textarea><br><br>

    <label for="image2">Image 2:</label><br>
    <input type="text" id="image_url2" name="image_url2" placeholder="Enter image URL"><br>

    <label for="contentP3">Paragraph 3 (optional):</label><br>
    <textarea id="contentP3" name="contentP3"></textarea><br><br>

    <label for="contentP4">Paragraph 4 (optional):</label><br>
    <textarea id="contentP4" name="contentP4"></textarea><br><br>

    <label for="contentP5">Paragraph 5 (optional):</label><br>
    <textarea id="contentP5" name="contentP5"></textarea><br><br>

    <input type="submit" value="Submit">
</form>
</body>
</html>
