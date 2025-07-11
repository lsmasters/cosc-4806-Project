<?php require_once 'app/views/templates/header.php' ?>

<main role="main" class="container">
<h1>CHANGE a Reminder</h1>
<br>

<div class="row">
    <div class="col-sm-auto">
        <form action="change/update" method="POST" >
        
        <fieldset>
            <br>
            <div class="form-group">
                <label for="subject">Enter REVISED reminder here</label>
                <input required type="text" class="form-control" name="subject"
                   placeholder="<?= htmlspecialchars($_SESSION['subject']) ?>" autofocus>
            </div>
            <br>

            <br>
            <button type="submit" class="btn btn-primary">SUBMIT</button>
        </fieldset>
        </form> 

    </div>
</div>
    <?php require_once 'app/views/templates/footer.php' ?>
