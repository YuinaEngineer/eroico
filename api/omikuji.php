<?php
  session_start();
  require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/nukeruvideo.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'/tmp/ads.php';
  $nukeruvideo = new nukeruvideo();
  $_omikuji = $nukeruvideo->omikuji($_SESSION['id']);
  header('Access-Control-Allow-Origin: '.Config::get('app.url'));
  header('Content-type: application/json');
  echo json_encode($_omikuji);
?>
