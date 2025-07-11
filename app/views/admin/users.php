<?php require_once 'app/views/templates/headerAdmin.php' ?>
<?php
// Step 1: Parse logins.log to get last successful login per user
$logFile = 'logins.log';
$userLastLogin = [];
$loginsThisMonth = [];

$currentMonth = date('Y-m'); // e.g., "2025-07"

if (file_exists($logFile)) {
    $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (preg_match('/^(\d{4}-\d{2}-\d{2}) \d{2}:\d{2}:\d{2} - (\w+) - SUCCESS$/', $line, $matches)) {
            $date = $matches[1];
            $user = $matches[2];

            // Track latest login date
            if (!isset($userLastLogin[$user]) || $date > $userLastLogin[$user]) {
                $userLastLogin[$user] = $date;
            }

            // Count logins for the current month
            if (strpos($date, $currentMonth) === 0) {
                if (!isset($loginsThisMonth[$user])) {
                    $loginsThisMonth[$user] = 0;
                }
                $loginsThisMonth[$user]++;
            }
        }
    }
}

ksort($userLastLogin); // Sort users alphabetically
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Last User Logins</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    table { border-collapse: collapse; width: 70%; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
    th { background-color: #f0f0f0; }
  </style>
</head>
<body>
  <h1>Last Successful Login per User</h1>

  <table>
    <thead>
      <tr>
        <th>Username</th>
        <th>Last Login Date</th>
        <th>Logins This Month</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($userLastLogin as $username => $date): ?>
        <tr>
          <td><?= htmlspecialchars($username) ?></td>
          <td><?= htmlspecialchars($date) ?></td>
          <td><?= isset($loginsThisMonth[$username]) ? $loginsThisMonth[$username] : 0 ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
