<?php

require_once __DIR__ . '/functions.php';

echo "<title>List</title>";

$file_list = glob('test/*.json');
//echo "<pre>";
//print_r($file_list);


//foreach ($file_list as $key => $file) {
//    echo $file;
//    echo "<br>";
//}

echo "<br><br>";

//$json = file_get_contents(__DIR__ . '/test/test.json');
//$data = json_decode($json, true);
//
//for ($i = 0; $i < count($data); $i++) {
//    echo $data[$i]['number'] . ") ";
//    echo $data[$i]['question'] . "<br>";
//    echo $data[$i]['variant1'] . "; ";
//    echo $data[$i]['variant2'] . "; ";
//    echo $data[$i]['variant3'] . "<br>";
//    echo "Answer is: ";
//    echo $data[$i]['answer'] . "<br><br>";
//}
//
//foreach ($data as $k => $v) {
//    foreach ($v as $kk => $vv) {
//        echo $kk . " $vv" . "<br>";
//    }
//    echo "<br>";
//}

//echo "<a href='test.php'><h2>Go to test</h2></a>";



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

