<?php require_once 'app/views/templates/headerPublic.php'; ?>
<?php  //show the appropriate header public/privzgd or notLoggedIn and LoggedIn
include 'loadHeader.php';
?>
<?php
$raw = $_SESSION['review']['candidates'][0]['content']['parts'][0]['text'] ?? '';
$reviewList = preg_split("/\n{2,}/", trim($raw)); // Split into reviews by blank lines
?>
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

    .review {
      background-color: #2a4d2a;
      border: 2px solid #3c6;
      border-radius: 12px;
      padding: 15px 20px;
      margin-bottom: 20px;
      cursor: pointer;
      transition: 0.2s ease-in-out;
      display: flex;
      align-items: flex-start;
    }

    .review:hover {
      background-color: #3a6a3a;
    }

    .review input[type="radio"] {
      margin-right: 15px;
      margin-top: 5px;
      transform: scale(1.4);
      accent-color: #00cc66;
      cursor: pointer;
    }

    .review-content {
      flex: 1;
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

    // Split the block into individual reviews using "**[number]." as a delimiter
    $reviews = preg_split('/\*\*\d+\.\s*/', $textBlock, -1, PREG_SPLIT_NO_EMPTY);

    foreach ($reviews as $index => $reviewText) {
        $cleanText = trim($reviewText);
        if ($cleanText === '') continue;

        $id = "review$index";
        $escapedReview = htmlspecialchars($cleanText, ENT_QUOTES);

        // Use first line as a title (before the first colon)
        $lines = explode("\n", $cleanText);
        $title = explode(':', $lines[0])[0] ?? "Review #" . ($index + 1);
        $escapedTitle = htmlspecialchars($title);
        $escapedBody = htmlspecialchars(implode("\n", array_slice($lines, 1)));

        echo "<label class='review' for='$id'>";
        echo "<input type='radio' name='selectedReview' value='$escapedReview' id='$id' required>";
        echo "<div class='review-content'>";
        echo "<div class='review-title'>$escapedTitle</div>";
        echo "<pre>$escapedBody</pre>";
        echo "</div>";
        echo "</label>";
    }
  ?>

  <input type="hidden" name="movieTitle" value="<?= htmlspecialchars($_POST['movieTitle'] ?? '') ?>">
  <input type="hidden" name="score" value="<?= htmlspecialchars($_POST['score'] ?? '') ?>">
  <button type="submit" class="submit-button">Save Selected Review</button>
</form>

</body>
</html>
