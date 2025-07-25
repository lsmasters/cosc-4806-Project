    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once 'app/views/templates/header.php';
    require_once 'app/functions.php';

    $articles = getLatestNewsArticles();
    ?>

    <div class="container">
        <div class="page-header" id="banner">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Web Data Management</h1>
                    <p>Welcome, <?= $_SESSION['username'] ?></p>
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
        <div class="row">
            <div class="col-lg-12">
                <p><a href="/logout">Click here to logout</a></p>
            </div>
        </div>
    </div>

    <?php require_once 'app/views/templates/footer.php'; ?>
