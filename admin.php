<?php
require_once __DIR__ . '/functions.php';

if (!isAdmin()) {
    http_response_code(403);
    echo 'Вам доступ запрещен!';
    echo "<h1>Ошибка 403!!!</h1>";
    die;
}
?>
<html>
<head>
    <title>Form</title>
</head>
<body>
<h1>Add test</h1>
<form enctype="multipart/form-data" action="list.php" method="post">
    <input name="userfile" type="file">
    <input type="submit" value="Send">
</form>
</body>
</html>