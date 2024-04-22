<?php
session_start();
include('config.php');

$login_message = "";
if (!isset($_SESSION['user_id'])) {
    $login_message = "You are not logged in. Please log in first.";
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$user = null;
if ($user_id) {
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    $query_posts = "SELECT * FROM blog_posts WHERE author_id = $user_id";
    $result_posts = mysqli_query($conn, $query_posts);

    $num_posts = mysqli_num_rows($result_posts);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Bruno+Ace+SC&family=Bungee+Hairline&family=Flavors&family=Sixtyfour&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="blogMainStyle.css">
    <style>
        /* Add any additional CSS styles here */
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #333;
            color: white;
            box-sizing: border-box;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .card {
            width: 300px;
            background-color: #333;
            color: white;
            border: 1px solid #555;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            padding: 10px;
            background-color: #222;
            border-bottom: 1px solid #555;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .card-body {
            padding: 10px;
        }

        a {
            color: white;
            font-family: Audiowide, sans-serif;
            text-decoration: none;
            /*background-color: #007bff;*/
            padding: 10px 20px;
            border-radius: 5px;
            transition: box-shadow 0.2s ease-in-out, background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        a:hover {
            color: #FFD700;
            background-color: black;
            box-shadow: 0 0 100px 20px rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body>
<?php if ($login_message) : ?>
    <script>
        function redirectToLogin() {
            window.location.href = 'login.php';
        }
    </script>
    <div>
        <p><?php echo $login_message; ?></p>
        <button onclick="redirectToLogin()">OK</button>
    </div>
<?php elseif ($user) : ?>
    <div class="headings" style="display: block; align-items: center; justify-content: center; justify-items: center; justify-self: center; margin-left: 45%;">
        <h1 style="font-family: Sixtyfour, sans-serif; align-self: center; align-items: center; align-content: center; justify-content: center; margin-left: -20%; padding-top: 20px">Welcome, <?php echo $user['name']; ?>!</h1>
        <br>
        <br>
        <br>
        <h2 style="font-family: Audiowide, sans-serif; align-self: center; align-items: center;">Your Posts:</h2>
    </div>

    <!-- Search bar -->
    <div class="container mt-5" style="display: flex">
        <h3 style="font-family: Audiowide, sans-serif; margin-right: 15px; margin-top: 5px">Search</h3>
        <input type="text" id="searchInput" class="form-control" placeholder="Search for your posts..." onkeyup="searchUserPosts()">
    </div>

    <?php if ($num_posts > 0) : ?>
    <div class="card-body mt-5" id="cardContainer">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            $conn = new mysqli("localhost", "root", "", "assignment8");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

            if ($user_id) {
                $sql_posts = "SELECT * FROM blog_posts WHERE author_id = $user_id";
                $result_posts = $conn->query($sql_posts);

                if ($result_posts->num_rows > 0) {
                    while ($row_post = $result_posts->fetch_assoc()) {
                        $blog_id = $row_post['id'];

                        // Fetch cards corresponding to the current blog post
                        $sql_cards = "SELECT * FROM cards WHERE id = $blog_id";
                        $result_cards = $conn->query($sql_cards);

                        if ($result_cards->num_rows > 0) {
                            $counter = 0; // Initialize counter
                            while ($row_card = $result_cards->fetch_assoc()) {
                                // Open a new row every third card
                                if ($counter % 3 == 0) {
                                    echo '<div class="row mt-3">';
                                }
                                ?>
                                <div class="col-md-4 mt-3">
                                    <div class="card <?php echo $row_card["class"]; ?>" style="background-color: black; margin-bottom: 30px; width: 600px; border-color: transparent; margin-right: 20px;">
                                        <div class="card-header" style="background-color: #FF5722; color: #FFFFFF; font-family: Bruno Ace SC, sans-serif; font-size: 20px; height: 63px; padding: 2px; padding-left: 10px; padding-right: 10px; border-radius: 20px;"><?php echo $row_card["header"]; ?></div>
                                        <div class="card-body" style="background-color: black;"><img src="<?php echo $row_card["body"]; ?>" class="card-img-top" style="height: 350px; border-radius: 10px;"></div>
                                        <div class="card-footer" style="background-color: #9C27B0; color: #FFFFFF; font-family: Bruno Ace SC, sans-serif; font-size: 20px; height: 35px; padding: 0; padding-left: 20px; border-radius: 20px;"><?php echo $row_card["footer"]; ?></div>
                                        <button class="btn btn-primary" style="font-family: Sixtyfour, sans-serif; font-size: 20px; font-stretch: extra-expanded; height: 40px; width: 250px; align-self: center; border-radius: 20px; background-color: black; color: white; border-color: black; margin-left: 0" onclick="window.location.href='blogPage.php?id=<?php echo $row_card["id"]; ?>'" onmouseover="this.style.backgroundColor='#D3D3D3'; this.style.color='black'; this.style.fontWeight='bold'; this.style.boxShadow='0 0 100px 20px rgba(255, 255, 255, 0.7)';" onmouseout="this.style.backgroundColor='black'; this.style.color='white'; this.style.fontWeight='normal'; this.style.boxShadow='none';">READ MORE</button>
                                        <button class="btn btn-primary" style="font-family: Sixtyfour, sans-serif; font-size: 20px; font-stretch: extra-expanded; height: 40px; width: 250px; align-self: center; border-radius: 20px; background-color: black; color: white; border-color: black; margin-left: 0" onclick="window.location.href='editPage.php?id=<?php echo $row_card["id"]; ?>'" onmouseover="this.style.backgroundColor='#D3D3D3'; this.style.color='black'; this.style.fontWeight='bold'; this.style.boxShadow='0 0 100px 20px rgba(255, 255, 255, 0.7)';" onmouseout="this.style.backgroundColor='black'; this.style.color='white'; this.style.fontWeight='normal'; this.style.boxShadow='none';">EDIT</button>
                                        <button class="btn btn-primary" style="font-family: Sixtyfour, sans-serif; font-size: 20px; font-stretch: extra-expanded; height: 40px; width: 250px; align-self: center; border-radius: 20px; background-color: black; color: white; border-color: black; margin-left: 0" onclick="window.location.href='blogPage.php?id=<?php echo $row_card["id"]; ?>'" onmouseover="this.style.backgroundColor='#D3D3D3'; this.style.color='black'; this.style.fontWeight='bold'; this.style.boxShadow='0 0 100px 20px rgba(255, 255, 255, 0.7)';" onmouseout="this.style.backgroundColor='black'; this.style.color='white'; this.style.fontWeight='normal'; this.style.boxShadow='none';">DELETE</button>
                                    </div>
                                </div>
                                <?php
                                // Close the row after every third card or if it's the last card
                                if ($counter % 3 == 2 || $counter == $result_cards->num_rows - 1) {
                                    echo '</div>';
                                }
                                $counter++;
                            }
                        }
                    }
                } else {
                    echo "<p>No posts yet.</p>";
                }
            } else {
                echo "<p>Please log in to view your posts.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>


<?php else : ?>
    <p>No posts yet.</p>
<?php endif; ?>
    <div class="buttons" style="display: flex; justify-content: center; justify-items: center; justify-self: center; align-self: center; margin-bottom: 20px">
        <a href="submit.php">Create New Post</a>
        <a href="logout.php">Logout</a>
        <a href="index.php">Home</a>
    </div>
<?php endif; ?>

<!-- JavaScript for search functionality -->
<script>
    function searchUserPosts() {
        const searchQuery = document.getElementById('searchInput').value.toLowerCase();
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            const headerText = card.querySelector('.card-header').textContent.toLowerCase();
            if (headerText.includes(searchQuery)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
</body>
</html>