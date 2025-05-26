<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K&P Movie Hub</title>
    <link rel="stylesheet" href="style.css">
    <style>

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0a1a2f;
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .intro {
            max-width: 800px;
            text-align: center;
            margin-bottom: 50px;
        }

        .intro h2 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #60a5fa;
        }

        .intro p {
            font-size: 18px;
            line-height: 1.6;
            color: #e2e8f0;
        }

        .profiles {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 40px;
        }

        .card {
            background-color: #1e293b;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            width: 280px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.1);
        }

        .card img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 15px;
            object-fit: cover;
            border: 3px solid #60a5fa;
        }

        .card h3 {
            margin: 10px 0 5px;
            font-size: 20px;
            color: #ffffff;
        }

        .card span {
            font-size: 14px;
            color: #93c5fd;
        }

        .card p {
            margin-top: 10px;
            font-size: 14px;
            color: #cbd5e1;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #0f172a;
            color:rgb(255, 255, 255);
            font-size: 14px;
            margin-top: auto; 
        }

        @media (max-width: 600px) {
            .card {
                width: 100%;
            }

            .profiles {
                flex-direction: column;
                align-items: center;
            }

            nav {
                flex-direction: column;
                align-items: flex-end;
                gap: 10px;
            }
        }
    </style>
</head>
<body>

  <!-- Header -->
<header>
  <div class="logo-title">
    <a href="index.php">
      <img src="logomovie.png" alt="Logo" class="logo" />
    </a>
    <a href="index.php" style="style.css">
      <h1>K&P Movie Hub</h1>
    </a>
  </div>
  <nav>
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="logout.php">Logout</a>
  </nav>
</header>

<!-- Main Content -->
<div class="container">
    <div class="intro">
        <h2>Meet the Developers</h2>
        <p>
            Welcome to K&P Movie Hub — a system created with passion and dedication by two aspiring IT students. We built this project to help users manage and enjoy their favorite movies with ease.
        </p>
    </div>

    <div class="profiles">
        <div class="card">
            <img src="magrata.jpg" alt="Kathleen Magrata">
            <h3>Kathleen M. Magrata</h3>
            <span>Contact Details:</span>
            <p>magrata.kathleen.bsit@gmail.com</p>
            <p>0930-421-4537</p>
        </div>

        <div class="card">
            <img src="romero.jpg" alt="Pinky Mae Romero">
            <h3>Pinky Mae Romero</h3>
            <span>Contact Details:</span>
            <p>romero.pinkymae.bsit@gmail.com</p>
            <p>0926-531-2661</p>
        </div>
    </div>
</div>

<!-- Footer -->
<footer>
    &copy; 2025 K&P Movie Hub. All rights reserved.
</footer>

</body>
</html>
