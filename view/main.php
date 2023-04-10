<form method="post" enctype="multipart/form-data">
    <div>
        <label for="file">Документ:</label>
        <input name="file" type="file" accept=".csv">
    </div>
    <div>
        <button style="margin-top: 10px;"> Конвертировать</button>
    </div>
</form>


<?php if (isset($_FILES['file'])) : ?>
    <pre>
        <?= json_encode(MainController::getUploadFile($_FILES['file']), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>
    </pre>
<?php endif; ?>