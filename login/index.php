<?php
$ua=$_SERVER['HTTP_USER_AGENT'];
if((strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'iPad')!==false)||(strpos($ua,'Android')!==false)) {
  //require_once("./sp.php");
  echo 'ComingSoon';
}else{
  require_once("./pc0.php");
}
?>
