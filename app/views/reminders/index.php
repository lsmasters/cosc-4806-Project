<?php require_once 'app/views/templates/header.php' ?>

<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Reminders</h1>
                
                <p class="lead"> <?= date("F jS, Y"); ?></p>
                <p><a href='/reminders/create'>Create Reminder</a></p>
            </div>
        </div>
    </div>
</div>


<?php foreach($data['reminders'] as $item): ?>
    <?php if ($_SESSION['userID'] == $item['user_id']): ?>
        
    <div class="d-flex justify-content-between align-items-center border p-2 mb-2 rounded">
        <div>
            <?=   $item['id'] ?>
        </div>
           
        <div>
            <?= htmlspecialchars($item['subject']) ?>
            
        </div>
        <div>
            <form action="/change" method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <button type="submit" class="btn btn-primary btn-sm">EDIT</button>
            </form>

            <a href="/reminders/deleteItem/<?= $item['id'] ?>" class="btn btn-danger btn-sm">DELETE</a>
        </div>
    </div>
    <?php endif; ?>
<?php endforeach; ?>


<?php require_once 'app/views/templates/footer.php' ?>
