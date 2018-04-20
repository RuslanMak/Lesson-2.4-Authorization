<?php

require_once __DIR__ . '/functions.php';

if ($_FILES['userfile']['name'] != null) {
    move_uploaded_file($_FILES['userfile']['tmp_name'], 'test/test.json');
    header('Location: test.php');
} else {
    echo "Новые тесты не были еще загружены!";
}

echo "<br><br>";

$json = file_get_contents(__DIR__ . '/test/test.json');
$data = json_decode($json, true);

for ($i = 0; $i < count($data); $i++) {
    echo $data[$i]['number'] . ") ";
    echo $data[$i]['question'] . "<br>";
    echo $data[$i]['variant1'] . "; ";
    echo $data[$i]['variant2'] . "; ";
    echo $data[$i]['variant3'] . "<br>";
    echo "Answer is: ";
    echo $data[$i]['answer'] . "<br><br>";
}

echo "<a href='test.php'><h1>Go to test</h1></a>";


echo "<a href='certificate.php'><h1>Получить сертификат</h1></a>";

if (isAdmin()) {
    echo "<a href='admin.php'><h1>Add test</h1></a>";
}