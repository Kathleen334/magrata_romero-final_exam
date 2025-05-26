<?php
$xml = simplexml_load_file("movies.xml") or die("Failed to load XML");
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Movie ID not provided.");
}

$index = 0;
foreach ($xml->movie as $movie) {
    if ((string)$movie->id === $id) {
        unset($xml->movie[$index]);
        break;
    }
    $index++;
}

if ($xml->asXML("movies.xml")) {
    header("Location: index.php");
    exit;
} else {
    die("Failed to save XML.");
}
?>
