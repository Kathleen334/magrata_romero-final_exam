<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$xml = simplexml_load_file("movies.xml") or die("Failed to load XML");

$query = isset($_GET['query']) ? strtolower(trim($_GET['query'])) : '';

$message = '';
$type = '';

if (isset($_GET['success'])) {
  switch ($_GET['success']) {
    case 'added':
      $message = 'Movie added successfully!';
      $type = 'success';
      break;
    case 'edited':
      $message = 'Movie updated successfully!';
      $type = 'success';
      break;
    case 'deleted':
      $message = 'Movie deleted successfully!';
      $type = 'success';
      break;
    case 'notfound':
      $message = 'No movie found with that title.';
      $type = 'error';
      break;
  }
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
    .alert {
      max-width: 600px;
      margin: 20px auto;
      padding: 15px 20px;
      border-radius: 8px;
      font-weight: bold;
      text-align: center;
      font-family: Arial, sans-serif;
    }
    .alert.success {
      background-color: #dcfce7;
      color: #166534;
      border: 1px solid #16a34a;
    }
    .alert.error {
      background-color: #fee2e2;
      color: #991b1b;
      border: 1px solid #dc2626;
    }
  </style>
  <script>
    function confirmDelete() {
      return confirm("Are you sure you want to delete this movie?");
    }

    window.onload = function () {
      const alert = document.getElementById('alert');
      if (alert) {
        setTimeout(() => {
          alert.style.display = 'none';
        }, 3000);
      }
    };
  </script>
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

  <div class="container">

    <!-- Alert Message -->
    <?php if ($message): ?>
      <div id="alert" class="alert <?= $type ?>">
        <?= $message ?>
      </div>
    <?php endif; ?>

    <form method="GET" class="search-form">
      <input type="text" name="query" placeholder="Find a Movie..." value="<?= htmlspecialchars($_GET['query'] ?? '') ?>">
      <button type="submit">Search</button>
    </form>

    <a href="add_movie.php" class="add-button">+ Add Movie</a>

    <div class="movie-grid">
      <?php 
      $found = false;
      foreach ($xml->movie as $movie): 
        $title = strtolower((string)$movie->title);
        $description = strtolower((string)$movie->description);

        if ($query && strpos($title, $query) === false && strpos($description, $query) === false) {
          continue;
        }

        $found = true;
        $movieId = (string)$movie->id;
      ?>
        <div class="movie-card">
          <img src="<?= htmlspecialchars($movie->image) ?>" alt="<?= htmlspecialchars($movie->title) ?>">
          <div class="movie-details">
            <h2><?= htmlspecialchars($movie->title) ?> (<?= htmlspecialchars($movie->release_year) ?>)</h2>
            <p><?= htmlspecialchars($movie->description) ?></p>
          </div>
          <div class="movie-actions">
            <a class="edit" href="edit_movie.php?id=<?= urlencode($movieId) ?>">Edit</a>
            <a class="delete" href="delete_movie.php?id=<?= urlencode($movieId) ?>" onclick="return confirmDelete()">Delete</a>
          </div>
        </div>
      <?php endforeach; ?>

      <?php
      if ($query && !$found) {
        header("Location: index.php?success=notfound");
        exit;
      }
      ?>
    </div>
  </div>

</body>
</html>
