<?php require('partials/head.php') ?>

<div class="container">
    <h1 class="text-center my-4">Загрузка CSV</h1>
    <form action="/upload" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="csvFile">Выберите CSV файл</label>
            <input type="file" name="csv_file" id="csvFile" class="form-control" required accept=".csv">
        </div>
        <?php if(array_key_exists('error', $_SESSION)): ?>
            <small class="text-danger"><?= $_SESSION['error']; ?></small>
        <?php endif; ?>
        <div class="text-center my-4">
            <a href="/" class="btn btn-secondary">Назад</a>
            <button type="submit" class="btn btn-primary">Загрузить</button>
        </div>
    </form>
</div>

<?php require('partials/footer.php') ?>