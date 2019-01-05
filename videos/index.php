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
      <div class="eroui box" style="padding:10px;">
    <?php
    preg_match('|' . dirname($_SERVER['SCRIPT_NAME']) . '/([\w%/]*)|', $_SERVER['REQUEST_URI'], $matches);
    $paths = explode('/', $matches[1]);
    $id[1] = isset($paths[1]) ? htmlspecialchars($paths[1]) : null;
    $id[2] = isset($paths[2]) ? htmlspecialchars($paths[2]) : null;
    switch (strtolower($_SERVER['REQUEST_METHOD']) . ':' . $paths[0]) {
      case 'get:':
        $nukeruvideo->get_avs(32);
        break;
      case 'get:actress':
        require_once $_SERVER['DOCUMENT_ROOT'].'/videos/actress.php';
        break;
      case 'get:actress_us':
        echo "<ul class='tag-list'>";
        $mysqli = new mysqli('localhost', 'gxxwacyv_yu0022yu', '6t3r9i3c4kY', 'gxxwacyv_nukeruvideo');
        if ($mysqli->connect_error) {
        echo $mysqli->connect_error;
        exit();
        } else {
        $mysqli->set_charset("utf8");
        }
          $sql = "SELECT * FROM actress ORDER BY RAND() LIMIT 40;";
        if ($result = $mysqli->query($sql)) {
        // 連想配列を取得
        $i=1;
        while ($row = $result->fetch_assoc()) {
          if($i % 3 == 1){
            $adclass = " first";
          }else{
            $adclass = "";
          }
          $pics = str_replace("http://","https://",$row['pics']);
          echo "<a href='".Config::get('app.url')."videos/actress/{$row['index']}'><li class='item{$adclass}' style='background-image:url(\"{$pics}\");background-size:auto 100%;background-repeat:no-repeat;background-position:center;'><span class='tag-txt'>{$row['name']}</span><span class='tag-badge'><i class='video icon'></i> {$nukeruvideo->actresscount($row['index'])}</span></li></a>";
          if($i % 3 == 0){
            echo '<div class="clear"></div><div style="height:20px;"></div>';
          }
          ++$i;
        }
        // 結果セットを閉じる
        $result->close();
        }
        // DB接続を閉じる
        $mysqli->close();
        echo "</ul>";
          break;
      case 'get:tags':
        echo "<ul class='tag-list'>";
        $i=1;
        foreach($nukeruvideo->video_tag01 as $tag){
          if($i % 3 == 1){
            $adclass = " first";
          }else{
            $adclass = "";
          }
          echo "<a href='".Config::get('app.url')."videos/tag/{$tag}'><li class='item{$adclass}' style='background-image:url(\"{$nukeruvideo->tagimage($tag)}\")'><span class='tag-txt'>{$tag}</span><span class='tag-badge'><i class='video icon'></i> {$nukeruvideo->tagcount($tag)}</span></li></a>";
          if($i % 3 == 0){
            echo '<div class="clear"></div><div style="height:20px;"></div>';
          }
          ++$i;
        }
        echo "</ul>";
        break;
      case 'get:tag':
        $nukeruvideo->search(urldecode($id[1]));
        break;
      case 'get:search':
        $nukeruvideo->search(urldecode($_GET['q']));
        break;
      case 'get:watch':
        require_once $_SERVER['DOCUMENT_ROOT'].'/videos/watch.php';
        break;
    }
    ?>
  </div>
</div>
<div class="right" style="width:210px;">
  <!--サイドメニュー2-->
  <?php require $_SERVER['DOCUMENT_ROOT'].'/tmp/side_menu2.php'; ?>
  <!--サイドメニュー2-->
</div>
    </div>
    <div class="clear"></div>
    <!--フッター-->
    <?php require $_SERVER['DOCUMENT_ROOT'].'/tmp/footer.php'; ?>
    <!--フッター-->
  </div>
  <script>
  $(".btn-unfollow").click(function(){
    var _userid = $(this).data("userid");
    $.post( "<?php echo Config::get('app.url'); ?>plugins/unfollow.php", { userid: _userid } ).done(function( data ) {location.reload();});
  });
  $(".btn-follow").click(function(){
    var _userid = $(this).data("userid");
    $.post( "<?php echo Config::get('app.url'); ?>plugins/follow.php", { userid: _userid } ).done(function( data ) {location.reload();});
  });
  </script>
  </body>
</html>
