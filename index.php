<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/Config.php';
Config::set_config_directory($_SERVER['DOCUMENT_ROOT']. '/config');
if(isset($_SESSION['id'])){
$userid = $_SESSION['id'];
}else{
header("location:".Config::get('app.url')."login");
}
require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/nukeruvideo.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/tmp/ads.php';
$nukeruvideo = new nukeruvideo();
$nukeruvideo->create_tables();
$nukeruvideo->get_profile($_SESSION['id']);
$_SESSION['callback_url'] = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title><?php echo Config::get('app.service_name'); ?></title>
<meta name="keywords" content="<?php echo Config::get('app.service_keywords'); ?>">
<meta name="description" content="<?php echo Config::get('app.service_description'); ?>">
<meta name="author" content="<?php echo $nukeruvideo->userinfo(Config::get('app.service_admin'),'name'); ?>">
<!--css-->
<link rel="stylesheet" type="text/css" href="<?php echo Config::get('app.url'); ?>assets/semantic/dist/semantic.min.css">
<link rel="stylesheet" href="<?php echo Config::get('app.url'); ?>assets/css/snsicon.css?date=<?php echo date(); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo Config::get('app.url'); ?>assets/css/style.css?date=<?php echo date("YmdHis"); ?>">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.css" />
<!--script-->
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="<?php echo Config::get('app.url'); ?>assets/semantic/dist/semantic.min.js"></script>
<script src="//twemoji.maxcdn.com/2/twemoji.min.js?11.2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.js"></script>
<!--ogp-->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@yuina">
<meta name="twitter:creator" content="@yuina">
<meta property="og:url" content="<?php echo Config::get('app.url'); ?>join" />
<meta property="og:title" content="<?php echo Config::get('app.service_name'); ?>" />
<meta property="og:description" content="<?php echo Config::get('app.service_description'); ?>" />
<meta property="og:image" content="<?php echo Config::get('app.url'); ?>assets/img/site-og.jpg" />
<!--favicon-->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/tmp/favicon.php'; ?>
</head>
<body>
  <?php $nukeruvideo->create_tables(); ?>
  <!--メニュー-->
  <?php require $_SERVER['DOCUMENT_ROOT'].'/tmp/menu.php'; ?>
  <!--メニュー-->
  <div class="ui container">
  <div style="height:73.63px;"></div>
    <div class="left" style="width:210px;">
      <!--サイドメニュー1-->
      <?php require $_SERVER['DOCUMENT_ROOT'].'/tmp/side_menu1.php'; ?>
      <!--サイドメニュー1-->
    </div>
    <div class="left" style="width:calc(100% - 460px);margin-left:20px;">
      <div class="eroui box">
        <div class="eroui title">
          <span class="left"><i class="icon box"></i>新着動画</span>
          <span class="right">MORE<i class="chevron right icon"></i></span>
        </div>
        <div class="eroui content">
          <?php $nukeruvideo->get_avs(6); ?>
        </div>
      </div>
    </div>
    <div class="right" style="width:210px;">
      <!--サイドメニュー2-->
      <?php require $_SERVER['DOCUMENT_ROOT'].'/tmp/side_menu2.php'; ?>
      <!--サイドメニュー2-->
    </div>
    <div class="clear"></div>
    <!--フッター-->
    <?php require $_SERVER['DOCUMENT_ROOT'].'/tmp/footer.php'; ?>
    <!--フッター-->
  </div>
</body>
</html>
