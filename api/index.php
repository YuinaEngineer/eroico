<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/Config.php';
Config::set_config_directory($_SERVER['DOCUMENT_ROOT']. '/config');
if(isset($_SESSION['id'])){
$userid = $_SESSION['id'];
}else{
header("location:".Config::get('app.url')."login");
}

preg_match('|' . dirname($_SERVER['SCRIPT_NAME']) . '/([\w%/]*)|', $_SERVER['REQUEST_URI'], $matches);
$paths = explode('/', $matches[1]);
$id[1] = isset($paths[1]) ? htmlspecialchars($paths[1]) : null;
$id[2] = isset($paths[2]) ? htmlspecialchars($paths[2]) : null;
switch (strtolower($_SERVER['REQUEST_METHOD']) . ':' . $paths[0]) {
  case 'get:nuketa':
    require_once $_SERVER['DOCUMENT_ROOT'].'/api/nuketa.php';
    break;
  case 'get:mylist':
    require_once $_SERVER['DOCUMENT_ROOT'].'/api/mylist.php';
    break;
  case 'get:omikuji':
    require_once $_SERVER['DOCUMENT_ROOT'].'/api/omikuji.php';
    break;
  case 'post:follow':
    require_once $_SERVER['DOCUMENT_ROOT'].'/api/follow.php';
    break;
  case 'post:unfollow':
    require_once $_SERVER['DOCUMENT_ROOT'].'/api/unfollow.php';
    break;
  case 'post:edit':
    require_once $_SERVER['DOCUMENT_ROOT'].'/api/edit.php';
    break;
  case 'post:video':
    require_once $_SERVER['DOCUMENT_ROOT'].'/api/add-av.php';
    break;
}
?>
