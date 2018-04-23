<?php

require_once __DIR__ . '/functions.php';

$json = file_get_contents(__DIR__ . '/test/test.json');
$data = json_decode($json, true);

//print_r($_SESSION['user']['login']);

if ($data[0]['number'] == false) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo "Ошибка 404!!! Загрузите сначала соответствующие тесты!!!!";
    exit;
}

if (!isUser()) {
    http_response_code(403);
    echo 'Вам доступ запрещен!';
    echo "<h1>Ошибка 403!!!</h1>";
    echo 'Сначала пройдите авторизацию!!!' . "<br>";
    echo "<a href='index.php'>Пройти авторизацию -></a>";
    die;
}
?>

<h2><?php echo $_SESSION['user']['login'] ?>, дайте ответы на вопроссы</h2>
<form action="test.php" method="post">
<!--    <label>-->
<!--        <p>Введите ваше имя</p>-->
<!--        <input type='text' name='user' required><br>-->
<!--    </label>-->
    <?php for ($i = 0; $i < count($data); $i++): ?>
    <p><?php echo$data[$i]['number'] . ") " . $data[$i]['question'] ?></p>
    <input type="radio" name="<?php echo $data[$i]['number'] ?>" value="<?php echo $data[$i]['variant1'] ?>">
        <?php echo $data[$i]['variant1'] ?><br>
    <input type="radio" name="<?php echo $data[$i]['number'] ?>" value="<?php echo $data[$i]['variant2'] ?>">
        <?php echo $data[$i]['variant2'] ?><br>
    <input type="radio" name="<?php echo $data[$i]['number'] ?>" value="<?php echo $data[$i]['variant3'] ?>">
        <?php echo $data[$i]['variant3'] ?><br>
    <br>
    <?php endfor; ?>
    <button type="submit">Проверить</button>
</form>

<?php

$v = 1;
$mark = 0;

if ($_POST[1] != null) {

    echo $_SESSION['user']['login'];
    echo "<br><br>";

    for ($i = 0; $i < count($data); $i++) {

        $num_answer = $data[$i]['number'];
        $answer = $data[$i]['answer'];

        if ($_POST[$v] == null) {
            echo "$num_answer" . ") " . "ОТВЕТ НЕ ВЫБРАН!!!!" . "<br>";
        } else if ($_POST[$v] == $answer) {
            echo "$num_answer" . ") " . "Правильно, ответ = " . "$answer" . "<br>";
            $mark++;
        } else {
            echo "$num_answer" . ") " . "Не правильно!" . "<br>";
        }

        $v++;
    }
    echo "<br>" . "Оценка: " . $mark. "<br>";

    $conclusion = strval($_SESSION['user']['login'] . "! Your mark is: " . $mark);
}
?>

<form action="certificate.php" method="post">
    <input type="hidden" name="conclusion" value="<?php echo $conclusion ?>">
    <?php
    if ($_POST[1] != null) {
        echo "<h2>Желаете получить сертификат?</h2>";
        echo "<button type='submit'>Получить сертификат</button>";
    }?>
</form>

