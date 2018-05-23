<?php

require_once __DIR__ . '/functions.php';

$file_list = glob('test/*.json');

// удаление теста
if (isset($_POST['delete'])) {
    unlink(__DIR__ . '/' . $_POST['delete']);
    redirect('list');
}

//--------------------------------Вариант 2-----------------------------
//================== Это альтернатива нижнему коду!!! Не пойму причини почему не работает "Вариант 1"
echo "<h3>Выберите теста для прохождения:</h3>";
echo "<form method='post' action='test.php'>";
$c = 1;
foreach ($file_list as $key => $file) {
    echo "<label><input type='radio' name='test' value='" . $file . "' required>Test " . $c . "</label><br>";
    $c++;
}
echo "<input type='submit' value='Пройти тест'>";
echo "</form>";

if (isAuthorized()) {
    echo "<form method='post'>";
        echo "<h2><a href='admin.php'>Add test</a></h2>";
        foreach ($file_list as $key => $file) {
            echo "<label><input type='radio' name='delete' value='" . $file . "' required>" . $file . "</label><br>";
        }
        echo "<button type='submit'>Delete test</button>";
    echo "</form>";
}

// Для вывода ошибки!!!
echo "<h2><a href='certificate.php'>Получить сертификат</a></h2>";
//=======================


/**
//---------------------- Вариант 1--------------------------------------------
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List</title>
</head>
<body>

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
<?php if (isAuthorized()) : ?>
    <form method="post">
        <h2><a href='admin.php'>Add test</a></h2>
        <?php foreach ($file_list as $key => $file) : ?>
            <label><input type="radio" name="delete" value="<?php echo $file; ?>" required> <?php echo $file ?></label><br>
        <? endforeach; ?>
        <button type='submit'>Delete test</button>
    </form>
<?php endif; ?>

<br>
<h2><a href='certificate.php'>Получить сертификат</a></h2>
</body>
</html>

 */


