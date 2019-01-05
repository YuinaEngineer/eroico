<div class="eroui box user">
<div class="eroui header">
<div class="header image"></div>
<div class="avater image user" style="background-image:url('<?php echo Config::get('app.url'); ?>assets/img/avatar/<?php echo $_GET['userid']; ?>')"></div>
</div>
<div class="eroui profile user">
<p class="eroui label username">
  <?php echo $nukeruvideo->userinfo($_GET['userid'],"name"); ?>
  <?php if($_GET['userid'] == Config::get('app.service_admin')){ ?>
    <br/><span class="ui label basic pink"><span><i class="icon pink star"></i>ADMIN</span></span>
  <?php }elseif($_GET['userid'] == Config::get('app.account_official')){  ?>
    <br/><span class="ui label basic blue"><span><i class="icon blue star"></i>OFFICIAL</span></span>
  <?php }else{ ?>
    <br/><span class="ui label basic green"><span><i class="icon user green"></i>USER</span></span>
  <?php } ?>
</p>
<p style="word-wrap:break-word;overflow-wrap:break-word;padding:0px;margin:14px 0px;">
  <?php echo $nukeruvideo->userinfo($_GET['userid'],"profile_txt"); ?>
</p>
<div class="eroui count nums">
  <div class="item"><span class="number"><?php echo number_format($nukeruvideo->post_count($_GET['userid'])); ?></span>投稿</div>
  <div class="item"><span class="number"><?php echo number_format($nukeruvideo->follow_count($_GET['userid'])); ?></span>フォロー</div>
  <div class="item"><span class="number"><?php echo number_format($nukeruvideo->follower_count($_GET['userid'])); ?></span>フォロワー</div>
</div>
<?php
if(strpos($_sideurl,Config::get('app.url')."mypage")!==true){
if($nukeruvideo->userinfo($_GET['userid'],'sns') !== ""){
  $sns_id = $nukeruvideo->userinfo($_GET['userid'],'sns');
  $sns_url = "https://pornkey.ml/{$sns_id}";
  $sns_screen = '<i class="sns-misskey icon"></i> Pornkey.ml を開く';
?>
<a class="ui pink fluid big button" href="<?php echo $sns_url; ?>" target="_blank">
  <?php echo $sns_screen; ?>
</a>
<?php }} ?>
<?php
//オリジナルフォローボタン
if(isset($_SESSION['id'])&&$_GET['userid'] !== $_SESSION['id']){
if($nukeruvideo->follow_check($_SESSION['id'],$_GET['userid']) == 0){
?>
<div style="height:10px;"></div>
<button class="ui pink fluid button big btn-follow" data-userid="<?php echo $_GET['userid']; ?>"><i class="icon plus"></i> フォローする</button>
<?php
}else{
?>
<div style="height:10px;"></div>
<button class="ui pink fluid button big btn-unfollow" data-userid="<?php echo $_GET['userid']; ?>"><i class="icon minus"></i> フォロー解除</button>
<?php
}
}
?>
</div>
</div>
