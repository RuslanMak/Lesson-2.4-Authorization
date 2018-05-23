<?php

require_once __DIR__ . '/functions.php';

echo "<title>List</title>";

$file_list = glob('test/*.json');

?>

<form method="post" action="test.php">
    <h3>Выберите теста для прохождения:</h3>
    <?php
    $c = 1;
    foreach ($file_list as $key => $file) : ?>
        <label><input type="radio" name="test" value="<?php echo $file; ?>" required>Test <?php echo $c ?></label><br>
    <?php $c++; ?>
    <? endforeach; ?>
    <input type="submit" value="Пройти тест">
</form>

<!--Эта форма для удаления тестов-->
<form action="" method="post">
    <input type="hidden" name="delete" value="delete_test">
    <?php
    if (isAuthorized()) {
        echo "<a href='admin.php'><h2>Add test</h2></a>";
        echo "<button type='submit'>Delete test</button>";
        if ($_POST['delete'] == 'delete_test') {
            unlink(__DIR__ . '/test/test.json');
        }
    }?>
</form>

<?php

echo "<a href='certificate.php'><h2>Получить сертификат</h2></a>";

