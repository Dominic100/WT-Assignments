<?php
session_start();
include('config.php');

function registerUser($name, $email, $password) {
    global $conn;

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        // Registration successful
        $_SESSION['user_id'] = $conn->insert_id; // Log in the user
        header("Location: dashboard.php");
        exit();
    } else {
        // Registration failed
        return "Error: Registration failed.";
    }
}

// Handle user registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name']; // Get user's name
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Register user
    $register_result = registerUser($name, $email, $password);

    if ($register_result !== true) {
        $error_message = $register_result;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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
        .headingRegister {
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
    <h2 class="headingRegister text-center">User Registration</h2>
    <br>
    <?php if(isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    <form action="register.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role:</label>
            <select class="form-select" id="role" name="role" required>
                <option value="regular">Regular</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="mb-3" id="passcode_field" style="display: none;">
            <label for="passcode" class="form-label">Admin Passcode:</label>
            <input type="password" class="form-control" id="passcode" name="passcode">
        </div>
        <script>
            document.getElementById('role').addEventListener('change', function() {
                var passcodeField = document.getElementById('passcode_field');
                if (this.value === 'admin') {
                    passcodeField.style.display = 'block';
                } else {
                    passcodeField.style.display = 'none';
                }
            });
        </script>
        <button type="submit" class="btn btn-primary text-center justify-content-center" style="align-self: center; justify-self: center; text-align: center; margin-left: 35px; font-family: 'Flavors', sans-serif; font-size: 20px">Register</button>
        <a href="index.php" class="btn btn-secondary" style="align-self: center; justify-self: center; margin-left: 15px; font-family: 'Flavors', sans-serif; font-size: 20px">Home</a>
    </form>
    <p class="mt-3">Already have an account? <a href="login.php">Login here</a>.</p>
</div>
</body>
</html>