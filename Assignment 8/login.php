<?php
session_start();
include('config.php');

function verifyCredentials($email, $password) {
    global $conn;

    $sql = "SELECT id, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $db_email, $db_password);
        $stmt->fetch();

        // Verify password hash
        if (password_verify($password, $db_password)) {
            // Login successful
            $_SESSION['user_id'] = $user_id; // Set user's ID in session
            header("Location: dashboard.php");
            exit();
        }
    }

    // Close the statement
    $stmt->close();
    return false;
}

// Handle user login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verify user credentials
    if (verifyCredentials($email, $password)) {
        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
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
        .headingLogin {
            font-family: Flavors, sans-serif;
        }
        .form-container {
            max-width: 400px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            background-color: #fff;
            transition: box-shadow 0.2s ease-in-out;
        }
        .form-container:hover {
            box-shadow: 0 0 50px 0 rgba(255,255,255,0.7);
        }
        .btn {
            color: black;
            background-color: white;
            border: black 1px solid;
            transition: box-shadow 0.2s ease-in-out, background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }
        .btn:hover {
            color: #FFD700;
            background-color: black;
            box-shadow: 0 0 100px 20px rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2 class="headingLogin text-center">User Login</h2>
    <br>
    <?php if(isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    <form action="login.php" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary" style="align-self: center; justify-self: center; margin-left: 50px; font-family: 'Flavors', sans-serif; font-size: 20px">Login</button>
        <a href="index.php" class="btn btn-secondary" style="align-self: center; justify-self: center; margin-left: 15px; font-family: 'Flavors', sans-serif; font-size: 20px">Home</a>
    </form>
    <p class="mt-3">Don't have an account? <a href="register.php">Register here</a>.</p>
</div>
</body>
</html>