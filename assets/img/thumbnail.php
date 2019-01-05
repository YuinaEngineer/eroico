<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/Config.php';
Config::set_config_directory($_SERVER['DOCUMENT_ROOT']. '/config');
require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/nukeruvideo.php';
$nukeruvideo = new nukeruvideo();
$url = $nukeruvideo->get_av_data($_GET['id'],thumbnail);
header('Content-Type: image/png');
readfile($url);
?>
