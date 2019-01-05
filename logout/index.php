<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/Config.php';
Config::set_config_directory($_SERVER['DOCUMENT_ROOT']. '/config');

header("Content-type: text/html; charset=utf-8");

//セッション変数を全て解除
$_SESSION = array();

//セッションクッキーの削除
if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", '', time() - 1800, '/');
}

//セッションを破棄する
session_destroy();

header("location:".Config::get('app.url'));
