<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Rate the Movie</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #014421; /* dark green background */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #00ffaa;
    }

    .rating-container {
      background-color: #015c2c;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
      width: 300px;
      text-align: center;
      border: 2px solid #017a3a;
    }

    .rating-container h1 {
      font-size: 24px;
      color: #21f3c1;
      margin-bottom: 20px;
    }

    .stars {
      font-size: 30px;
      color: gold;
      margin-bottom: 20px;
    }

    textarea {
      width: 100%;
      height: 80px;
      border-radius: 10px;
      border: none;
      padding: 10px;
      resize: none;
      background-color: #003d1f;
      color: #e0f5e9;
      font-size: 14px;
    }

    textarea::placeholder {
      color: #a0c0b0;
    }

    button {
      margin-top: 15px;
      padding: 12px 25px;
      background-color: #00c78c;
      border: none;
      border-radius: 10px;
      color: #003d1f;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
    }

    .thanks {
      margin-top: 20px;
      color: #20f770;
      font-size: 16px;
    }
  </style>
</head>
<body>
  <div class="rating-container">
    <h1>🎬 Rate a Movie 🎬</h1>
    <div class="stars">⭐ ⭐ ⭐ ⭐ ⭐</div>
    <textarea placeholder="What's the name of the movie?"></textarea><br>
    <button type="submit">Submit</button>
    <div class="thanks">🍿Let's get some information! 🍿</div>
  </div>
</body>
</html>
