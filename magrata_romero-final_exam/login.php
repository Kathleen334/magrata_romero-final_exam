<?php
session_start();

$xmlFile = 'users.xml';
$xml = simplexml_load_file($xmlFile);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    foreach ($xml->user as $user) {
        if ((string)$user->username === $username && password_verify($password, (string)$user->password)) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        }
    }

    header("Location: login.php?error=invalid");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - K&P Movie Hub</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            height: 100vh;
        }


        .left-panel {
            flex: 1;
            background-color: #0a1a2f;
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .left-panel img {
            width: 300px;
            height: auto;
            margin-bottom: 30px;
        }

        .left-panel h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .left-panel p {
            font-size: 18px;
            line-height: 1.6;
            margin: 10px 0;
        }

        .right-panel {
            flex: 1;
            background: url('background.jpg') no-repeat center center;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            background-color: rgba(10, 25, 47, 0.92);
            padding: 30px;
            border-radius: 12px;
            width: 350px;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 26px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            font-size: 14px;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 6px;
            background-color: #e2e8f0;
            font-size: 15px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #1d4ed8;
        }

        .form-container .error {
            color: #f87171;
            text-align: center;
            margin-bottom: 15px;
        }

        .form-container a {
            display: block;
            text-align: center;
            margin-top: 12px;
            text-decoration: none;
            color: #60a5fa;
            font-size: 14px;
        }

        .form-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="left-panel">
    <img src="logomovie.png" alt="K&P Movie Hub Logo">
    <div>
        <h1>K&P Movie Hub</h1>
        <p>K&P Movie Hub is a user-friendly website that allows you to create, read, update, and delete movie records with ease — perfect for organizing your favorite films.</p>
        <p><strong>Submitted by:</strong><br>Magrata, Kathleen M.<br>Romero, Pinky Mae</p>
    </div>
</div>

<div class="right-panel">
    <div class="form-container">
        <h2>Login</h2>
        <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid'): ?>
            <div class="error">Invalid username or password!</div>
        <?php endif; ?>
        <form method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <a href="signup.php">Don't have an account? Sign up</a>
    </div>
</div>

</body>
</html>
