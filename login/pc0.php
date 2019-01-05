<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/Config.php';
Config::set_config_directory($_SERVER['DOCUMENT_ROOT']. '/config');
require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/nukeruvideo.php';
$nukeruvideo = new nukeruvideo();
if(isset($_POST['id'])&&isset($_POST['passwd'])){
  if($_POST['id'] !== "" && $_POST['passwd'] !== ""){
    if($nukeruvideo->login($_POST['id'],$_POST['passwd']) == true){
      $_SESSION['id'] = $_POST['id'];
      $login_status = true;
      //echo $_SESSION['callback_url'];
      header("location:{$_SESSION['callback_url']}");
    }else{
      $login_status = false;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>Eroico</title>
<meta name="keywords" content="">
<meta name="description" content="<?php echo $nukeruvideo->videoInfo['description']; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo Config::get('app.url'); ?>assets/semantic/dist/semantic.min.css">
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="<?php echo Config::get('app.url'); ?>assets/semantic/dist/semantic.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@nukeruvideo">
<meta name="twitter:creator" content="@nukeruvideo">
<meta property="og:url" content="<?php echo Config::get('app.url'); ?>join" />
<meta property="og:title" content="Eroico" />
<meta property="og:description" content="危ない広告一切なしの安心・安全なアダルトSNSプラットフォーム" />
<meta property="og:image" content="<?php echo Config::get('app.url'); ?>assets/img/site-og.jpg" />
<link rel="stylesheet" href="//eroico.ml/assets/css/snsicon.css?date=<?php echo date(); ?>">
<script src="//twemoji.maxcdn.com/2/twemoji.min.js?11.2"></script>
<link rel="stylesheet" type="text/css" href="//eroico.ml/assets/css/style.css?date=<?php echo date("YmdHis"); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.js"></script>
</head>
<body>
  <div style="height:150px;"></div>
  <div class="eroui box" style="width:600px;padding:20px;margin:auto;">
    <center>
    <h1 style="display:inline-block;height:40px;line-height:40px;padding:0px;margin:0px;vertical-align:bottom;"><img src="//eroico.ml/assets/img/logo-box.png?date=<?php echo date(); ?>" class="emoji"> Eroico</h1>
    </center>
    <div style="height:20px;"></div>
    <hr style="padding:0px;margin:0px;">
    <div style="height:20px;"></div>
    <form action="" method="post" class="ui form">
      <input type="text" minlength='3' maxlength='20' name="id" pattern="^[0-9A-Za-z_]+$" class="form-control" placeholder="ユーザーID(3〜20文字)" value="<?php if(isset($_POST['id'])){ echo $_POST['id']; }?>">
      <div style="height:15px;"></div>
      <?php if(isset($_POST['id'])){if($_POST['id']==""){?>
      <p class="text-danger" style="padding:0px;margin:0px;">※ユーザーIDを入力してください。</p>
      <div style="height:15px;"></div>
      <?php }} ?>
      <input type="password" minlength='6' maxlength='20' name="passwd" class="form-control" placeholder="パスワード(6〜20文字)" value="<?php if(isset($_POST['passwd'])){ echo $_POST['passwd']; }?>">
      <div style="height:15px;"></div>
      <?php if(isset($_POST['passwd'])){if($_POST['passwd']==""){?>
      <p class="text-danger" style="padding:0px;margin:0px;">※パスワードを入力してください。</p>
      <div style="height:15px;"></div>
      <?php }} ?>
      <center>
        <button type="submit" class="button pink ui"><i class="icon sign in"></i>ログインする</button>
        <div style="height:15px;"></div>
        申し訳ございませんが、2019年1月5日 23:18 以前のデータが消えてしまいました。<br/>
        登録いただいていた方は再度ご登録くださいますようお願い申し上げます。<br/><br/>
        <a href="<?php echo Config::get('app.url'); ?>join">会員登録がまだの方はコチラ</a>
      </center>
      <?php
      if($login_status==false && $login_status!==null){
      ?>
      <div style="height:15px;"></div>
      <p class="text-danger" style="padding:0px;margin:0px;">※IDまたはパスワードが間違っています。</p>
      <?php
      }
      ?>
    </form>
  </div>
</body>
</html>
