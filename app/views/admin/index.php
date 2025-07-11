<?php require_once 'app/views/templates/headerAdmin.php' ?>

<?php //find top five logins
$logFile = 'logins.log';
$lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$userLoginCounts = [];

foreach ($lines as $line) {
    if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} - (.+?) - (SUCCESS|NEW USER)$/', $line, $matches)) {
        $username = $matches[1];
        if (!isset($userLoginCounts[$username])) {
            $userLoginCounts[$username] = 0;
        }
        $userLoginCounts[$username]++;
    }
}

// Sort by number of logins descending
arsort($userLoginCounts);

// Get top 5
$topUsers = array_slice($userLoginCounts, 0, 5, true);

// Store in session or display directly
$_SESSION['topUsers'] = $topUsers;


?>

<?php  //get data fpr ACTIVE/INACTIVE/NEW USERS
$logFile = 'logins.log';
$daysBack = 30;
$lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$users = []; // username => [firstSeen => date, logins => [dates]]
$newUsers = [];

$cutoffDate = date('Y-m-d', strtotime("-$daysBack days"));

foreach ($lines as $line) {
    if (preg_match('/^(\d{4}-\d{2}-\d{2}) \d{2}:\d{2}:\d{2} - (.+?) - (SUCCESS|NEW USER)$/', $line, $matches)) {
        $date = $matches[1];
        $username = $matches[2];
        $status = $matches[3];

        if (!isset($users[$username])) {
            $users[$username] = [
                'firstSeen' => $date,
                'logins' => [],
                'isNew' => ($status === 'NEW USER')
            ];
        }

        $users[$username]['logins'][] = $date;

        // Mark as new if their first log is NEW USER in the last 30 days
        if ($status === 'NEW USER' && $date >= $cutoffDate) {
            $newUsers[$username] = true;
        }
    }
}

// Determine active/inactive counts
$active = 0;
$inactive = 0;
foreach ($users as $username => $info) {
    $hasRecentLogin = false;
    foreach ($info['logins'] as $loginDate) {
        if ($loginDate >= $cutoffDate) {
            $hasRecentLogin = true;
            break;
        }
    }

    if ($hasRecentLogin) {
        $active++;
    } elseif ($info['firstSeen'] < $cutoffDate) {
        $inactive++;
    }
}

$new = count($newUsers);

// Store in session for display
$_SESSION['stats'] = [
    'active' => $active,
    'inactive' => $inactive,
    'new' => $new
];

?>

<?php  //routine to get the logins/day for the last 30 days
$logFile = 'logins.log';
$daysBack = 30;
$loginsPerDay = [];

// 1,  Initialize array with the last 30 days (YYYY-MM-DD => 0)
for ($i = $daysBack - 1; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $loginsPerDay[$date] = 0;
}

//2.  Read the log file line by line
$lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    // 3.  Match the log format: YYYY-MM-DD HH:MM:SS - username - result
    if (preg_match('/^(\d{4}-\d{2}-\d{2}) \d{2}:\d{2}:\d{2} - .* - (SUCCESS|NEW USER)$/', $line, $matches)) {
        $logDate = $matches[1];
        if (isset($loginsPerDay[$logDate])) {
            $loginsPerDay[$logDate]++;
        }
    }
}
$_SESSION['loginsPerDay'] = $loginsPerDay;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-sm">

  <!-- Top Bar -->
  <nav class="bg-white shadow px-4 py-2 flex justify-between items-center">
    <h1 class="text-base font-bold text-gray-800">Administrator's Dashboard(last 30 days)</h1>
    <span class="text-xs text-gray-600">Logged in as: <strong>admin</strong></span>
  </nav>

  <div class="p-4 space-y-2">

    <!-- Summary Cards -->
    <div class="grid grid-cols-3 gap-2">
      <div class="bg-white p-3 rounded shadow text-center">
        <h2 class="text-xs text-gray-500">Active</h2>
        <p class="text-xl font-bold text-green-600"><?= $_SESSION['stats']['active'] ?></p>
      </div>
      <div class="bg-white p-3 rounded shadow text-center">
        <h2 class="text-xs text-gray-500">Inactive</h2>
        <p class="text-xl font-bold text-red-600"><?= $_SESSION['stats']['inactive'] ?></p>
      </div>
      <div class="bg-white p-3 rounded shadow text-center">
        <h2 class="text-xs text-gray-500">New (30d)</h2>
        <p class="text-xl font-bold text-blue-600"><?= $_SESSION['stats']['new'] ?></p>

      </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-2 gap-2">
      <div class="bg-white p-3 rounded shadow">
        <h2 class="text-sm font-semibold mb-1">Logins (30d)</h2>
        <canvas id="loginsChart" height="80"></canvas>
      </div>
      <div class="bg-white p-3 rounded shadow">
        <h2 class="text-sm font-semibold mb-1">Top 5 Users by Logins</h2>
        <canvas id="remindersChart" height="80"></canvas>
      </div>
    </div>

  </div>

  <!-- Chart Scripts -->
  <script>
    const loginsCtx = document.getElementById('loginsChart').getContext('2d');
    new Chart(loginsCtx, {
      type: 'line',
      data: {
        labels: [...Array(30).keys()].map(i => `D${i+1}`),
        datasets: [{
          label: 'Logins',
          data: <?php echo json_encode(array_values($_SESSION['loginsPerDay'])); ?>,
          borderColor: 'rgba(59,130,246,1)',
          fill: false,
          tension: 0.3,
          pointRadius: 0
        }]
      },
      options: { plugins: { legend: { display: false } }, scales: { x: { display: false }, y: { display: false } } }
    });

  const remindersCtx = document.getElementById('remindersChart').getContext('2d');

  const topUserLabels = <?= json_encode(array_keys($_SESSION['topUsers'])); ?>;
  const topUserCounts = <?= json_encode(array_values($_SESSION['topUsers'])); ?>;

  new Chart(remindersCtx, {
    type: 'bar',
    data: {
      labels: topUserLabels,
      datasets: [{
        label: 'Logins',
        data: topUserCounts,
        backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#6366f1']
      }]
    },
    options: {
      plugins: {
        legend: { display: false }
      },
      scales: {
        x: { display: true },
        y: { display: true }
      }
    }
  });  </script>

</body>
</html>
