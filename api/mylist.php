<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/nukeruvideo.php';
  $nukeruvideo = new nukeruvideo();
  $nukeruvideo->mylist($_GET['videoid'],$_GET['userid']);
  echo $nukeruvideo->mylistcount($_GET['videoid']);
?>
