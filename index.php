<?php

require_once __DIR__ . '/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (login($login, $password)) {
        echo "Ok";
    } else {
        delLastSymbol();

        $l = $_POST['login'];
        $p = $_POST['password'];

        $fh = fopen(__DIR__ . '/data/login.json', 'a');
        fwrite($fh, "},\n{\n\"login\":\"$l\",\n\"password\":\"$p\"\n}]");
        fclose($fh);
    }
    redirect('list');
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
</head>
<body>
    <h1>Авторизация</h1>
    <form action="" method="post">
        <div>
            <p>Вы можете войти как "ГОСТЬ" введя только "Логин"</p>
            <label for="lg">Введите ваше имя</label>
            <input type="text" placeholder="Имя" name="login" id="lg" required>
        </div>
        <div>
            <label for="key">Пароль</label>
            <input type="password"  placeholder="Пароль" name="password" id="key">
        </div>
        <input type="submit" value="Log in">
    </form>
</body>
</html>
