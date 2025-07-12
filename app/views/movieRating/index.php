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
      background-color: #014421;
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
      width: 90%;
      max-width: 400px;
      text-align: center;
      border: 2px solid #017a3a;
    }

    .rating-container h1 {
      font-size: 26px;
      color: #21f3c1;
      margin-bottom: 20px;
    }

    .stars {
      font-size: 30px;
      color: gold;
      margin-bottom: 20px;
    }

    input[type="text"] {
      width: 100%;
      border-radius: 10px;
      border: none;
      padding: 12px;
      background-color: #003d1f;
      color: #e0f5e9;
      font-size: 16px;
      box-sizing: border-box;
      margin-bottom: 20px;
    }

    input::placeholder {
      color: #a0c0b0;
    }

    .button-group {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
      margin-bottom: 20px;
    }

    .button-group button {
      flex: 1 1 45%;
      padding: 10px;
      background-color: #00c78c;
      border: none;
      border-radius: 10px;
      color: #003d1f;
      font-size: 14px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .button-group button:hover {
      background-color: #03e7a3;
    }

    .thanks {
      margin-top: 10px;
      color: #20f770;
      font-size: 16px;
    }
  </style>
</head>
<body>
  <div class="rating-container">
    <h1>🎬 Rate a Movie 🎬</h1>
    <div class="stars">⭐ ⭐ ⭐ ⭐ ⭐</div>
    <input type="text" placeholder="What's the name of the movie?" />

    <div class="button-group">
      <button>Movie Information</button>
      <button>Our Ratings</button>
      <button>Your Rating</button>
      <button>Exit</button>
    </div>

    <div class="thanks">🍿 Let's get some information! 🍿</div>
  </div>
</body>
</html>
