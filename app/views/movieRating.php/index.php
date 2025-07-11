<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Rate A Movie</title>
  <style>
    body {
      background: #0f3d32;
      color: #e2e8f0;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 2rem;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .rating-container {
      background: #145c4b;
      padding: 2rem;
      border-radius: 20px;
      box-shadow: 0 0 20px rgba(0,0,0,0.4);
      width: 400px;
    }

    .rating-container h1 {
      margin-bottom: 1rem;
      text-align: center;
      font-size: 2rem;
      color: #5eead4;
    }

    .stars {
      display: flex;
      justify-content: center;
      margin-bottom: 1rem;
    }

    .star {
      font-size: 2rem;
      color: #93c5fd;
      cursor: pointer;
      transition: color 0.2s;
    }

    .star:hover,
    .star.hovered,
    .star.selected {
      color: #facc15;
    }

textarea {
  width: 100%;
  height: 80px;
  margin-bottom: 1rem;
  padding: 0.5rem;
  border-radius: 10px;
  border: none;
  resize: none;
  font-size: 1rem;
  background-color: #0f3d32;
  color: #e2e8f0;
}
button {
  width: 100%;
  padding: 0.75rem;
  background-color: #5eead4;
  border: none;
  border-radius: 10px;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  color: #0f3d32;
}
    .thank-you {
      display: none;
      text-align: center;
      font-size: 1.2rem;
      color: #22c55e;
      margin-top: 1rem;
    }
  </style>
</head>
<body>
  <div class="rating-container">
    <h1>🎬 Rate a Movie 🎬 </h1>

    <div class="stars" id="starContainer">
      <span class="star" data-value="1">&#9733;</span>
      <span class="star" data-value="2">&#9733;</span>
      <span class="star" data-value="3">&#9733;</span>
      <span class="star" data-value="4">&#9733;</span>
      <span class="star" data-value="5">&#9733;</span>
    </div>

    <textarea id="comment" placeholder="What movie would you like to rate?"></textarea>
    <button onclick="submitRating()">Submit</button>

    <div class="thank-you" id="thankYouMsg"> 🍿 We appreciate your rating! 🍿</div>
  </div>

  <script>
    const stars = document.querySelectorAll('.star');
    let selectedRating = 0;

    stars.forEach(star => {
      star.addEventListener('mouseover', () => {
        highlightStars(star.dataset.value);
      });

      star.addEventListener('mouseout', () => {
        highlightStars(selectedRating);
      });

      star.addEventListener('click', () => {
        selectedRating = star.dataset.value;
        highlightStars(selectedRating);
      });
    });

    function highlightStars(rating) {
      stars.forEach(star => {
        star.classList.remove('selected');
        if (star.dataset.value <= rating) {
          star.classList.add('selected');
        }
      });
    }

    function submitRating() {
      const comment = document.getElementById('comment').value;
      if (selectedRating === 0) {
        alert("Please select a star rating!");
        return;
      }
      if (comment.trim() === '') {
        alert("Please leave a comment!");
        return;
      }
      document.getElementById('thankYouMsg').style.display = 'block';
    }
  </script>
</body>
</html>

