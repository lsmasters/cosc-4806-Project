<?php  //show the appropriate header public/privzgd or notLoggedIn and LoggedIn
include 'loadHeader.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Our Reviews</title>
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

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #2a4d2a;
      box-shadow: 0 0 8px rgba(0,0,0,0.5);
    }

    th, td {
      padding: 12px;
      border: 1px solid #3c6;
      text-align: left;
    }

    th {
      background-color: #3a6a3a;
      color: #ffffff;
    }

    tr:nth-child(even) {
      background-color: #335533;
    }

    .no-data {
      text-align: center;
      font-style: italic;
      padding: 20px;
    }
  </style>
</head>
<body>

<h1>Our Reviews</h1>

<?php if (!empty($_SESSION['movies']) ): ?>

  <?php
    // Sort by movie name (A-Z) and then rating (high to low)
    usort($_SESSION['movies'], function($a, $b) {
        $movieCompare = strcmp($a['movieName'], $b['movieName']);
        if ($movieCompare === 0) {
            return $b['rating'] <=> $a['rating']; // Descending rating
        }
        return $movieCompare; // Alphabetical movie name
    });
  ?>

  <table>
    <thead>
      <tr>
        <th>Movie Name</th>
        <th>Rater</th>
        <th>Rating</th>
        <th>Comment</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($_SESSION['movies'] as $entry): ?>
        <tr>
          <td><?= htmlspecialchars($entry['movieName']) ?></td>
          <td><?= htmlspecialchars($entry['userID']) ?></td>
          <td><?= htmlspecialchars($entry['rating']) ?>/10</td>
          <td><?= nl2br(htmlspecialchars($entry['comment'])) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <div class="no-data">No reviews available.</div>
<?php endif; ?>

</body>
</html>
