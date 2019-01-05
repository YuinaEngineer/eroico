<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/plugins/nukeruvideo.php';
$nukeruvideo = new nukeruvideo();
$_myid = $_SESSION['id'];
$_userid = $_POST['userid'];
echo $nukeruvideo->unfollow($_myid,$_userid);
?>
