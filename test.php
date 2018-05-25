<?php

require_once __DIR__ . '/functions.php';

$file = $_POST['test'];

$json = file_get_contents(__DIR__ . '/' . $file);
$data = json_decode($json, true);

if ($data[0]['number'] == false) {
//    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo "Ошибка 404!!! Загрузите или выберете сначала соответствующие тесты!!!!";
    echo "<br>"."<a href='list.php'>Выбрать тест -></a>";
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
        <input type="hidden" name="test" value="<?php echo $file ?>">
        <input type="hidden" name="result" value="result">
        <?php for ($i = 0; $i < count($data); $i++): ?>
            <p><?php echo$data[$i]['number'] . ") " . $data[$i]['question'] ?></p>

            <?php foreach ($data[$i]['variants'] as $k => $v) : ?>
                <label><input type="radio" name="<?php echo $data[$i]['number'] ?>" value="<?php echo $v ?>">
                <?php echo $v ?></label><br>
            <?php endforeach; ?>
            <br>
        <?php endfor; ?>
        <button type="submit">Проверить</button>
    </form>

<?php

$v = 1;
$mark = 0;

if ($_POST['result'] != null) {
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

    $conclusion = strval($_POST['FirstName'] . "! Your mark is: " . $mark);
}
?>


<form action="certificate.php" method="post">
    <input type="hidden" name="conclusion" value="<?php echo $conclusion ?>">
    <?php
    if ($mark >= 1) {
        echo "<h2>Желаете получить сертификат?</h2>";
        echo "<button type='submit'>Получить сертификат</button>";
    }?>
</form>
