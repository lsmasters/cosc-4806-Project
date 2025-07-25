<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'app/views/templates/header.php';
require_once 'app/functions.php';

$articles = getLatestNewsArticles();
?>

<!-- ✅ Google Font + Styling -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-image: url('https://images.unsplash.com/photo-1549921296-3c8dabc9eebc');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        color: white;
        margin: 0;
        padding: 0;
    }

    .container {
        background-color: rgba(0, 0, 0, 0.65);
        border-radius: 10px;
        padding: 30px;
        margin-top: 40px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    }

    .page-header {
        margin-bottom: 30px;
    }

    .page-header h1 img {
        vertical-align: middle;
        margin-right: 10px;
    }

    h1, h3 {
        color: #ffffff;
    }

    a {
        color: #61dafb;
    }

    a:hover {
        text-decoration: underline;
    }

    ul {
        padding-left: 20px;
    }

    li {
        margin-bottom: 10px;
    }

    .logout {
        margin-top: 20px;
    }
</style>

<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>
                    <img src="https://cdn-icons-png.flaticon.com/512/1048/1048946.png" width="40" alt="Data Icon" />
                    Web Data Management
                </h1>
                <p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?></p>
                <p class="lead"><?= date("F jS, Y"); ?></p>
            </div>
        </div>
    </div>

    <!-- ✅ Latest News Section -->
    <div class="row">
        <div class="col-lg-12">
            <h3>Latest News Articles on Web Data Management</h3>
            <ul>
                <?php if (!empty($articles)): ?>
                    <?php foreach ($articles as $article): ?>
                        <li>
                            <a href="<?= htmlspecialchars($article['url']) ?>" target="_blank">
                                <?= htmlspecialchars($article['title']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No articles available right now.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <!-- ✅ Logout Link -->
    <div class="row logout">
        <div class="col-lg-12">
            <p><a href="/logout">Click here to logout</a></p>
        </div>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
