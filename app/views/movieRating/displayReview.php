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
      max-width: 1000px;
      margin: 0 auto;
    }

    .review-option {
      display: none;
    }

    .review-label {
      display: block;
      border: 2px solid #3c6;
      background-color: #2a4d2a;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
      cursor: pointer;
      transition: 0.3s;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .review-label:hover {
      background-color: #396f39;
    }

    .review-option:checked + .review-label {
      border-color: #00ff88;
      background-color: #3b8040;
      box-shadow: 0 0 10px #00ff88;
    }

    .review-title {
      font-weight: bold;
      margin-bottom: 10px;
    }

    pre {
      white-space: pre-wrap;
      margin: 0;
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
        $title = array_shift($lines);
        $body = implode("\n", $lines);

        $id = "review$index";
        $escapedReview = htmlspecialchars($fullReview, ENT_QUOTES);
        $escapedTitle = htmlspecialchars($title);
        $escapedBody = htmlspecialchars($body);

        echo "<input type='radio' class='review-option' name='selectedReview' value='$escapedReview' id='$id' required>";
        echo "<label class='review-label' for='$id'>";
        echo "<div class='review-title'>$escapedTitle</div>";
        echo "<pre>$escapedBody</pre>";
        echo "</label>";
    }
  ?>

  <input type="hidden" name="movieTitle" value="<?= htmlspecialchars($_POST['movieTitle'] ?? '') ?>">
  <input type="hidden" name="score" value="<?= htmlspecialchars($_POST['score'] ?? '') ?>">

  <button type="submit" class="submit-button">Save Selected Review</button>
</form>

</body>
</html>
