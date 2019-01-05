<div class="eroui box">
  <div class="eroui title">
    <i class="icon calendar"></i>カレンダー
  </div>
  <div class="eroui center" style="padding:14px 0px;line-height:2em;"><span>🎉Happy New Year!!<br/><span id="clock" style="font-size:16px;"></span></span></div>
  <script>
  function set2fig(num) {
     // 桁数が1桁だったら先頭に0を加えて2桁に調整する
     var ret;
     if( num < 10 ) { ret = "0" + num; }
     else { ret = num; }
     return ret;
  }
  function showClock2() {
     var nowTime = new Date();
     var nowYear = nowTime.getFullYear();
     var nowMonth = nowTime.getMonth()+1;
     var nowWeek = nowTime.getDay();
     var nowDay = nowTime.getDate();
     var nowHour = set2fig( nowTime.getHours() );
     var nowMin  = set2fig( nowTime.getMinutes() );
     var nowSec  = set2fig( nowTime.getSeconds() );
     var msg = nowYear + "/" + nowMonth + "/" + nowDay + "<br><span style='font-size:25px;'>" + nowHour + ":" + nowMin + ":" + nowSec+"</span>";
     document.getElementById("clock").innerHTML = msg;
  }
  setInterval('showClock2()',1000);
  </script>
</div>
<div class="eroui box">
  <a href="<?php echo Config::get('app.url'); ?>mypage/follow/" class="eroui title">
    <span class="left"><i class="icon user circle"></i>フォロー</span>
    <span class="right"><?php echo $nukeruvideo->follow_count($_SESSION['id']); ?>人</span>
  </a>
  <div class="eroui follow list">
    <?php
      $_follower = $nukeruvideo->get_follow_list($_SESSION['id']);
      foreach($_follower as $_follower_user){
        $follower_id = $_follower_user['to'];
        echo "<a href=\"".Config::get('app.url')."@{$follower_id}\" class=\"eroui item\" style=\"background-image:url('".Config::get('app.url')."assets/img/avatar/{$follower_id}');\"></a>";
      }
    ?>
  </div>
</div>
<div class="eroui box">
  <a href="<?php echo Config::get('app.url'); ?>mypage/follower/" class="eroui title">
    <span class="left"><i class="icon user circle"></i>フォロワー</span>
    <span class="right"><?php echo $nukeruvideo->follower_count($_SESSION['id']); ?>人</span>
  </a>
  <div class="eroui follower list">
    <?php
      $_follower = $nukeruvideo->get_follower_list($_SESSION['id']);
      foreach($_follower as $_follower_user){
        $follower_id = $_follower_user['from'];
        echo "<a href=\"".Config::get('app.url')."@{$follower_id}\" class=\"eroui item\" style=\"background-image:url('".Config::get('app.url')."assets/img/avatar/{$follower_id}');\"></a>";
      }
    ?>
  </div>
</div>
<?php if($_SESSION['id'] == Config::get('app.service_admin')){ ?>
<div class="eroui box">
  <div class="eroui title">
    <span class="left"><i class="icon server"></i>インスタンス情報</span>
  </div>
  <div class="eroui content">
    Admin: <a href="<?php echo Config::get('app.url'); ?>@<?php echo Config::get('app.service_admin'); ?>">@<?php echo Config::get('app.service_admin'); ?></a><br/>
    Server: <?php echo $_SERVER['SERVER_SOFTWARE']; ?><br/>
    PHP: <?php echo phpversion(); ?><br/>
    Version: <?php echo Config::get('app.version_num'); ?>
  </div>
</div>
<?php } ?>
