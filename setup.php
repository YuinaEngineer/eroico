<?php
require_once __DIR__.'/plugins/Config.php';
Config::set_config_directory(__DIR__. '/config');
require_once __DIR__.'/plugins/nukeruvideo.php';
$nukeruvideo = new nukeruvideo();
$nukeruvideo->create_tables();
?>
