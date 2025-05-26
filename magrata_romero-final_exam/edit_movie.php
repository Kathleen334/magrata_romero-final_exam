<?php
$xml = simplexml_load_file("movies.xml");
$id = $_GET['id'] ?? null;
$selectedMovie = null;

if ($id) {
    foreach ($xml->movie as $movie) {
        if ($movie->id == $id) {
            $selectedMovie = $movie;
            break;
        }
    }
}

if (!$selectedMovie) {
    die("Movie not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedMovie->title = $_POST["title"];
    $selectedMovie->description = $_POST["description"];
    $selectedMovie->release_year = $_POST["release_year"];
    $selectedMovie->image = $_POST["image"];
    $xml->asXML("movies.xml");
    header('Location: index.php?success=edited');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Movie - K&P Movie Hub</title>
  <link rel="stylesheet" href="style.css" />
  <style>
   
    form.edit-form {
      max-width: 600px;
      margin: 40px auto 60px auto;
      background-color: #1e293b;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.4);
      color: white;
      font-family: Arial, sans-serif;
      box-sizing: border-box;
    }

    form.edit-form label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      font-size: 1rem;
      color: #facc15;
    }

    form.edit-form input[type="text"],
    form.edit-form input[type="number"],
    form.edit-form textarea {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 20px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 1rem;
      font-family: inherit;
    }

    form.edit-form textarea {
      resize: vertical;
      min-height: 100px;
    }

    form.edit-form input[type="submit"] {
      background-color: #10b981;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      font-weight: 700;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
    }

    form.edit-form input[type="submit"]:hover {
      background-color: #059669;
    }

    a {
      text-decoration: none;
      font-weight: 600;
      color: #facc15;
      display: inline-block;
      margin-top: 10px;
    }

    a:hover {
      text-decoration: underline;
    }

    .button-wrapper {
      text-align: center;
      margin-top: 15px;
    }

  </style>
</head>
<body>

  <!-- Header and Navigation -->
<header>
  <div class="logo-title">
    <img src="logomovie.png" alt="Logo" class="logo">
    <h1>K&P Movie Hub</h1>
  </div>
  <nav>
    <a href="index.php">Home</a>
     <a href="about.php">About</a>
    <a href="logout.php">Logout</a>
  </nav>
</header>

  <!-- Form container -->
  <form method="POST" class="edit-form" novalidate>
    <h1 style="text-align:center; margin-bottom: 25px;">🎬 Edit Movie</h1>

    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?= htmlspecialchars($selectedMovie->title) ?>" required />

    <label for="description">Description:</label>
    <textarea id="description" name="description" required><?= htmlspecialchars($selectedMovie->description) ?></textarea>

    <label for="release_year">Release Year:</label>
    <input type="number" id="release_year" name="release_year" value="<?= htmlspecialchars($selectedMovie->release_year) ?>" required />

    <label for="image">Image URL or local path:</label>
    <input type="text" id="image" name="image" value="<?= htmlspecialchars($selectedMovie->image) ?>" required />

    <input type="submit" value="Update Movie" />
    
    <div class="button-wrapper">
      <a href="index.php">⬅️ Back to Movie List</a>
    </div>
  </form>

</body>
</html>
