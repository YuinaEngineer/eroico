<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/nukeruvideo.php';
$nukeruvideo = new nukeruvideo();
$_myid = $_SESSION['id'];
$_userid = $_POST['userid'];
if(isset($_myid) && isset($_userid) && $_userid !== "")
if($_myid !== $_userid){
echo $nukeruvideo->follow($_myid,$_userid);
}
?>
