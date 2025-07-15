<?php
$movie = $_SESSION['movie'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($movie['Title'] ?? 'Movie Info') ?></title>
  <style>
    body {
      background-color: #013220;
      font-family: Arial, sans-serif;
      color: #c4ffe0;
      margin: 0;
      padding: 20px;
      display: flex;
      justify-content: center;
    }

    .container {
      max-width: 700px;
      background-color: #014e2e;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
      padding: 20px;
      display: flex;
      gap: 20px;
      color: #d6ffe7;
    }

    .poster {
      flex: 0 0 200px;
    }

    .poster img {
      width: 100%;
      border-radius: 10px;
    }

    .info {
      flex: 1;
    }

    .info h1 {
      color: #33ffd6;
      margin: 0 0 10px;
    }

    .info p {
      margin: 5px 0;
    }

    .info .genre {
      color: #99ffe1;
    }

    .info .rating {
      color: #ffe066;
    }

    .back-link {
      text-align: center;
      margin-top: 30px;
    }

    .back-link a {
      color: #66ffcc;
      text-decoration: none;
      font-weight: bold;
    }

    .back-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="poster">
      <img src="<?= htmlspecialchars($movie['Poster'] ?? '') ?>" alt="Movie Poster">
    </div>
    <div class="info">
      <h1><?= htmlspecialchars($movie['Title'] ?? 'Unknown Title') ?> (<?= htmlspecialchars($movie['Year'] ?? '-') ?>)</h1>
      <p><strong>Director:</strong> <?= htmlspecialchars($movie['Director'] ?? 'N/A') ?></p>
      <p class="genre"><strong>Genre:</strong> <?= htmlspecialchars($movie['Genre'] ?? 'N/A') ?></p>
      <p class="rating"><strong>IMDb Rating:</strong> <?= htmlspecialchars($movie['imdbRating'] ?? 'N/A') ?></p>
      <p><strong>Plot:</strong> <?= htmlspecialchars($movie['Plot'] ?? 'No description available.') ?></p>
    </div>
  </div>

  <div class="back-link">
    <p><a href="/movieRating">🔙 Back to Search</a></p>
  </div>

</body>
</html>
