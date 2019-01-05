<!--フォッローリスト-->
<ul class="video-list2">
<?php
$_follower = $nukeruvideo->get_follower_list($_userid);
$i=1;
foreach($_follower as $_follower_user){
  if($i % 3 == 1){
    $adclass = " first";
  }else{
    $adclass = "";
  }
  $userid = $_follower_user['from'];
?>
<li class='item<?php echo $adclass; ?>'>

  <div class="eroui box">
  <div class="eroui header">
  <div class="header image"></div>
  <div class="avater image" style="background-image:url('<?php echo Config::get('app.url'); ?>assets/img/avatar/<?php echo $userid; ?>')"></div>
  </div>
  <div class="eroui profile">
  <p class="eroui label username">
    <?php echo $nukeruvideo->userinfo($userid,"name"); ?>
    <?php if($userid == Config::get('app.service_admin')){ ?>
      <br/><span class="ui label basic pink"><span><i class="icon pink star"></i>ADMIN</span></span>
    <?php }elseif($userid == Config::get('app.account_official')){  ?>
      <br/><span class="ui label basic blue"><span><i class="icon blue star"></i>OFFICIAL</span></span>
    <?php }else{ ?>
      <br/><span class="ui label basic green"><span><i class="icon user green"></i>USER</span></span>
    <?php } ?>
  </p>
  <!--
  <p style="word-wrap:break-word;overflow-wrap:break-word;">
    <?php echo $nukeruvideo->userinfo($userid,"profile_txt"); ?>
  </p>
  -->
  <?php
  //オリジナルフォローボタン
  if(isset($_SESSION['id'])){
  if($nukeruvideo->follow_check($_SESSION['id'],$userid) == 0){
  ?>
  <div style="height:10px;"></div>
  <button class="ui pink fluid button btn-follow" data-userid="<?php echo $userid; ?>"><i class="icon plus"></i> フォローする</button>
  <?php
  }else{
  ?>
  <div style="height:10px;"></div>
  <button class="ui pink fluid button btn-unfollow" data-userid="<?php echo $userid; ?>"><i class="icon minus"></i> フォロー解除</button>
  <?php
  }
  }
  ?>

  </div>
  </div>


</li>
<?php
if($i % 3 == 0){
?>
<div class="clear"></div>
<div style="height:20px;"></div>
<?php
}
++$i;
}
?>
<!--フォローリスト-->
</ul>
