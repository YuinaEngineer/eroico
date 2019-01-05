<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/nukeruvideo.php';
  $nukeruvideo = new nukeruvideo();
  $nukeruvideo->nuketa($_GET['videoid'],$_GET['userid']);
  echo $nukeruvideo->nukecount($_GET['videoid']);
?>
