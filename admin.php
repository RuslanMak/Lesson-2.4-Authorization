<?php
require_once __DIR__ . '/functions.php';

if (!isAuthorized()) {
    http_response_code(403);
    echo 'Вам доступ запрещен!';
    echo "<h1>Ошибка 403!!!</h1>";
    die;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body>
<h1>Add test</h1>
<form enctype="multipart/form-data" action="list.php" method="post">
    <input name="userfile" type="file">
    <input type="submit" value="Send">
</form>
</body>
</html>
