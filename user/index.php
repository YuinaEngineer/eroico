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
$nukeruvideo->get_profile($_SESSION['id']);
if($nukeruvideo->profile['name'] !== ""){
$name = $nukeruvideo->profile['name'];
}else{
$name = $nukeruvideo->profile['id'];
}
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.css" />
<!--script-->
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="<?php echo Config::get('app.url'); ?>assets/semantic/dist/semantic.min.js"></script>
<script src="//twemoji.maxcdn.com/2/twemoji.min.js?11.2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.js"></script>
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
  <!--メニュー-->
  <?php require $_SERVER['DOCUMENT_ROOT'].'/tmp/menu.php'; ?>
  <!--メニュー-->
  <div class="ui container">
  <div style="height:73.63px;"></div>
    <div style="width:600px;margin:auto;">
    <?php
    preg_match('|' . dirname($_SERVER['SCRIPT_NAME']) . '/([\w%/]*)|', $_SERVER['REQUEST_URI'], $matches);
    $paths = explode('/', $matches[1]);
    $id[1] = isset($paths[1]) ? htmlspecialchars($paths[1]) : null;
    $id[2] = isset($paths[2]) ? htmlspecialchars($paths[2]) : null;
    echo $id[1];
    switch (strtolower($_SERVER['REQUEST_METHOD']) . ':' . $paths[0]) {
      case 'get:':
        require_once $_SERVER['DOCUMENT_ROOT'].'/components/user/profile.php';
        break;
    }
    ?>
    </div>
    <!--フッター-->
    <?php require $_SERVER['DOCUMENT_ROOT'].'/tmp/footer.php'; ?>
    <!--フッター-->
  </div>
  <script>
  $(".btn-unfollow").click(function(){
    var _userid = $(this).data("userid");
    $.post("<?php echo Config::get('app.url'); ?>api/unfollow", { userid: _userid } ).done(function( data ) {location.reload();});
  });
  $(".btn-follow").click(function(){
    var _userid = $(this).data("userid");
    $.post("<?php echo Config::get('app.url'); ?>api/follow", { userid: _userid } ).done(function( data ) {location.reload();});
  });
  </script>
  </body>
</html>
