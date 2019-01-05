<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/Config.php';
Config::set_config_directory($_SERVER['DOCUMENT_ROOT']. '/config');
require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/nukeruvideo.php';
$nukeruvideo = new nukeruvideo();
header('Content-Type: image/png');
if($_GET['id'] !== '_guest'){
  $avatar = $nukeruvideo->userinfo($_GET['id'],"profile_icon");
  readfile($avatar);
}else{
  readfile(Config::get('app.url').'img/noimage.png');
}
?>
