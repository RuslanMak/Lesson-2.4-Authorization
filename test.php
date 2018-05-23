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
<form action="result.php" method="post">
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
    <input type="hidden" name="file" value="<?php echo $file; ?>">
    <button type="submit">Проверить</button>
</form>
