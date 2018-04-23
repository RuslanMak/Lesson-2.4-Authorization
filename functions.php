<?php

session_start();

echo "<h4><a href='logout.php'> Log out</a></h4>";

function login($login, $password) {
    $user = getUser($login);
    if ($user && $user['password'] == $password) {
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}

function isUser() {
    return !empty($_SESSION['user']['login']);
}

function isAuthorized() {
    return isUser() && $_SESSION['user']['password'];
}

/**
 *  Для удаление последней строки в JSON
 */
function delLastSymbol() {
    $file = file(__DIR__ . "/data/login.json"); // Считываем весь файл в массив
    $n = count($file); // Подсчот количество строк в массиве

    for ($i = 0; $i < $n; $i++) {
        if ($i == ($n - 1)) unset($file[$i]);
        $fp = fopen(__DIR__ . "/data/login.json", "w");
        fputs($fp, implode("", $file));
        fclose($fp);
    }
}

/**
 *  Получает список пользователей
 */
function getUsers() {
    $fileData = file_get_contents(__DIR__ . '/data/login.json');
    $users = json_decode($fileData, true);
    if (empty($users)) {
        return [];
    }
    return $users;
}

function redirect($page) {
    header("Location: $page.php");
    die;
}
/**
 *  Получает пользователя по его логину
 */
function getUser($login) {
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['login'] == $login) {
            return $user;
        }
    }
    return null;
}

function logout() {
    session_destroy();
    header('Location: index.php');
}