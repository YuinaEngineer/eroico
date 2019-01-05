<?php
$_userid = $_SESSION['id'];
$_sideurl = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>
<?php if(isset($_SESSION['id'])){ ?>
<div class="eroui box">
<div class="eroui header">
<div class="header image"></div>
<div class="avater image" style="background-image:url('<?php echo Config::get('app.url'); ?>assets/img/avatar/<?php echo $_userid; ?>')"></div>
</div>
<div class="eroui profile">
<p class="eroui label username">
  <?php echo $nukeruvideo->userinfo($_userid,"name"); ?>
  <?php if($_userid == Config::get('app.service_admin')){ ?>
    <br/><span class="ui label basic pink"><span><i class="icon pink star"></i>ADMIN</span></span>
  <?php }elseif($_userid == Config::get('app.account_official')){  ?>
    <br/><span class="ui label basic blue"><span><i class="icon blue star"></i>OFFICIAL</span></span>
  <?php }else{ ?>
    <br/><span class="ui label basic green"><span><i class="icon user green"></i>USER</span></span>
  <?php } ?>
</p>
<p style="word-wrap:break-word;overflow-wrap:break-word;padding:0px;margin:14px 0px;">
  <?php echo $nukeruvideo->userinfo($_userid,"profile_txt"); ?>
</p>
<?php
if(strpos($_sideurl,Config::get('app.url')."mypage")!==true){
if($nukeruvideo->userinfo($_userid,'sns') !== ""){
  $sns_id = $nukeruvideo->userinfo($_userid,'sns');
  $sns_url = "https://pornkey.ml/{$sns_id}";
  $sns_screen = '<i class="sns-misskey icon"></i> Pornkey.ml を開く';
?>
<a class="ui pink fluid button" href="<?php echo $sns_url; ?>" target="_blank">
  <?php echo $sns_screen; ?>
</a>
<?php }} ?>
<div class="ui fluid button eromikuji" style="margin:0px;margin-top:10px;">
  <i class="icon">⛩️</i> おみくじを開く
</div>
</div>
</div>
<div class="eroui omikuji box center">
  <h3 class="eroui omikuji title">おみくじ</h3>
  <div class="eroui omikuji unsei">
    【
    <?php
      $nukeruvideo->omikuji($_userid);
      $_unseiTxt = $nukeruvideo->omikujiinfo($_userid,'unsei');
      switch($_unseiTxt){
        case '大吉':
          echo "🎉 {$_unseiTxt}";
          break;
        default:
        echo "{$_unseiTxt}";
        break;
      }
    ?>
    】
  </div>
  <div class="eroui omikuji color" style="margin:14px 0px;">
    あなたのラッキーカラーは<br/>
    <span style="font-size:16px;line-height:16px;height:16px;">
      <span style="display:inline-block;height: 1em;width: 1em;margin: 0 .05em 0 .1em;vertical-align: -0.1em;border-radius:100%;background-color:rgb(<?php echo $nukeruvideo->omikujiinfo($_userid,'rgb'); ?>);"></span>
      <?php
        echo $nukeruvideo->omikujiinfo($_userid,'color');
      ?>
    </span>
  </div>
</div>
<?php } ?>
<?php if(strpos($_sideurl,Config::get('app.url')."mypage")!==false){ ?>
<div class="ui vertical menu">
  <a href="<?php echo Config::get('app.url'); ?>mypage/" class="<?php if($_sideurl == Config::get('app.url')."mypage/"){ ?>active pink <?php } ?>item">
    <span>プロフィール設定</span>
  </a>
  <a href="<?php echo Config::get('app.url'); ?>mypage/follow/" class="<?php if($_sideurl == Config::get('app.url')."mypage/follow/"){ ?>active pink <?php } ?>item">
    <span>フォロー</span>
    <div class="ui pink label"><?php echo number_format($nukeruvideo->follow_count($userid)); ?></div>
  </a>
  <a href="<?php echo Config::get('app.url'); ?>mypage/follower/" class="<?php if($_sideurl == Config::get('app.url')."mypage/follower/"){ ?>active pink <?php } ?>item">
    <span>フォロワー</span>
    <div class="ui pink label"><?php echo number_format($nukeruvideo->follower_count($userid)); ?></div>
  </a>
  <a href="<?php echo Config::get('app.url'); ?>mypage/posted/" class="<?php if($_sideurl == Config::get('app.url')."mypage/posted/"){ ?>active pink <?php } ?>item">
    <span>投稿</span>
    <div class="ui pink label"><?php echo number_format($nukeruvideo->video_user_count($userid)); ?></div>
  </a>
  <a href="<?php echo Config::get('app.url'); ?>mypage/like/" class="<?php if($_sideurl == Config::get('app.url')."mypage/like/"){ ?>active pink <?php } ?>item">
    <span>LIKE!</span>
    <div class="ui pink label"><?php echo number_format($nukeruvideo->mylist_user_count($userid)); ?></div>
  </a>
  <a href="<?php echo Config::get('app.url'); ?>mypage/nuketa/" class="<?php if($_sideurl == Config::get('app.url')."mypage/nuketa/"){ ?>active pink <?php } ?>item">
    <span>ヌケた!</span>
    <div class="ui pink label"><?php echo number_format($nukeruvideo->nuki_user_count($userid)); ?></div>
  </a>
  <a href="<?php echo Config::get('app.url'); ?>mypage/history/" class="<?php if($_sideurl == Config::get('app.url')."mypage/history/"){ ?>active pink <?php } ?>item">
    <span>再生履歴</span>
  </a>
  <a href="<?php echo Config::get('app.url'); ?>logout" class="item">
    <span><i class="sign-out icon"></i> ログアウト</span>
  </a>
  <div class="item">
    <div class="ui transparent icon input eroicosearch">
      <input type="text" placeholder="Search video...">
      <i class="search icon"></i>
    </div>
    <script>
    $(".eroicosearch input").keypress(function(e){
      if ( e.which == 13 ) {
        var _q = $(this).val();
        alert(_q);
        location.href = "<?php echo Config::get('app.url'); ?>videos/search?q=" + _q;
    		return false;
    	}
    });
    </script>
  </div>
</div>
<?php }else{ ?>
<div class="ui vertical menu">
  <?php if(!isset($_SESSION['id'])){ ?>
    <a href="<?php echo Config::get('app.url'); ?>login" class="item">
      <span><i class="sign-in icon"></i> ログイン</span>
    </a>
    <a href="<?php echo Config::get('app.url'); ?>join" class="item">
      <span><i class="user plus icon"></i> 新規会員登録</span>
    </a>
  <?php } ?>
  <div class="item">
    <div class="ui transparent icon input eroicosearch">
      <input type="text" placeholder="Search video...">
      <i class="search icon"></i>
    </div>
    <script>
    $(".eroicosearch input").keypress(function(e){
      if ( e.which == 13 ) {
        var _q = $(this).val();
        location.href = "<?php echo Config::get('app.url'); ?>videos/search?q=" + _q;
    		return false;
    	}
    });
    </script>
  </div>
</div>
<?php } ?>
<div class="eroui center" style="margin-bottom:14px;">
<span class="ui label grey">ver <?php echo Config::get('app.version_num'); ?> (<?php echo Config::get('app.version_name'); ?>)</span>
</div>
