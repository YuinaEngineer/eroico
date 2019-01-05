<?php
  session_start();
  require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/Config.php';
  Config::set_config_directory($_SERVER['DOCUMENT_ROOT']. '/config');
  require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/nukeruvideo.php';
  $nukeruvideo = new nukeruvideo();
  $_POST['profile_txt'] = str_replace("\r\n","<br>",$_POST['profile_txt']);
  $nukeruvideo->set_profile($_SESSION['id'],strip_tags($_POST['username']),strip_tags($_POST['profile_txt'],"<br></br>"),$_POST['profile_icon'],$_POST['usersns']);
  header("location:".Config::get('app.url')."mypage");
?>
