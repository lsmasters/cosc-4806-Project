<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Select a Movie Review</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #1b3d1b;
      color: #f0fff0;
      padding: 20px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    form {
      max-width: 900px;
      margin: 0 auto;
    }

    .review {
      background-color: #2a4d2a;
      border-radius: 12px;
      padding: 15px;
      margin-bottom: 20px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    }

    label {
      display: flex;
      align-items: flex-start;
      cursor: pointer;
    }

    input[type="radio"] {
      margin-right: 16px;
      margin-top: 6px;
      transform: scale(1.5);
      accent-color: #00cc66;
    }

    .submit-button {
      display: block;
      width: 100%;
      padding: 15px;
      font-size: 18px;
      margin-top: 30px;
      background-color: #00cc66;
      color: white;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-weight: bold;
      box-shadow: 0 4px 6px rgba(0,0,0,0.3);
    }

    .submit-button:hover {
      background-color: #00aa55;
    }
  </style>
</head>
<body>

<h1>Select Your Favorite Movie Review</h1>

<form action="/movieRating/saveReview" method="post">
  <?php
    $textBlock = $_SESSION['review']['candidates'][0]['content']['parts'][0]['text'];
    $reviews = preg_split('/\*\*Rating: \d+\/10\*\*/', $textBlock, -1, PREG_SPLIT_NO_EMPTY);

    foreach ($reviews as $index => $reviewText) {
        $fullReview = trim($reviewText) . "\n**Rating: 5/10**";
        $lines = explode("\n", $fullReview);
        $title = array_shift($lines); // Get first line as title
        $body = implode("\n", $lines); // Rest of review

        echo "<div class='review'>";
        echo "<label for='review$index'>";
        echo "<input type='radio' name='selectedReview' value='" . htmlspecialchars($fullReview, ENT_QUOTES) . "' id='review$index' required>";
        echo "<div>";
        echo "<strong>" . htmlspecialchars($title) . "</strong><br><br>";
        echo "<pre style='white-space: pre-wrap; margin: 0;'>" . htmlspecialchars($body) . "</pre>";
        echo "</div>";
        echo "</label>";
        echo "</div>";
    }
  ?>

  <input type="hidden" name="movieTitle" value="<?= htmlspecialchars($_POST['movieTitle'] ?? '') ?>">
  <input type="hidden" name="score" value="<?= htmlspecialchars($_POST['score'] ?? '') ?>">

  <button type="submit" class="submit-button">Save Selected Review</button>
</form>

</body>
</html>
