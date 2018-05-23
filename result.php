<?php

require_once __DIR__ . '/functions.php';

$file = $_POST['file'];

$json = file_get_contents(__DIR__ . '/' . $file);
$data = json_decode($json, true);

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