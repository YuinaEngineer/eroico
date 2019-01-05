<?php
$_menuurl = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>
<div class="ui top fixed menu borderless">
  <div class="ui container">
    <div class="item">
      <img src="<?php echo Config::get('app.url'); ?>assets/img/eroico-icon.png?date=<?php echo date("YmdHis"); ?>">
    </div>
    <a href="<?php echo Config::get('app.url'); ?>" class="<?php if($_menuurl == Config::get('app.url')){ ?>active pink <?php } ?>item">
      <span><i class="home icon"></i> ホーム</span>
    </a>
    <a href="<?php echo Config::get('app.url'); ?>" class="<?php if($_menuurl == Config::get('app.url')."messages/"){ ?>active pink <?php } ?>item">
      <span><i class="mail icon"></i> メッセージ</span>
    </a>
    <a href="<?php echo Config::get('app.url'); ?>videos" class="<?php if($_menuurl == Config::get('app.url')."videos/"){ ?>active pink <?php } ?>item">
      <span><i class="video icon"></i> ビデオ</span>
    </a>
    <a href="<?php echo Config::get('app.url'); ?>" class="<?php if($_menuurl == Config::get('app.url')."illust/"){ ?>active pink <?php } ?>item">
      <span><i class="paint brush icon"></i> イラスト</span>
    </a>
    <div class="right menu">
      <div class="ui dropdown item">
        <img class="ui avatar image" src="<?php echo Config::get('app.url'); ?>assets/img/avatar/<?php echo $nukeruvideo->profile['id']; ?>">
        <span><?php echo $nukeruvideo->profile['name']; ?> さん</span> <i class="dropdown icon"></i>
        <div class="menu">
          <?php if(isset($_SESSION['id'])){ ?>
          <a class="item" href="<?php echo Config::get('app.url'); ?>mypage">
            <span>プロフィール設定</span>
          </a>
          <a class="item" href="<?php echo Config::get('app.url'); ?>logout">
            <span><i class="sign out icon"></i> ログアウト</span>
          </a>
        <?php }else{ ?>
          <a class="item" href="<?php echo Config::get('app.url'); ?>login">
            <span><i class="sign in icon"></i> ログイン</span>
          </a>
          <a class="item" href="<?php echo Config::get('app.url'); ?>join">
            <span><i class="user plus icon"></i> 新規会員登録</span>
          </a>
        <?php } ?>
        </div>
      </div>
      <script>
      $('.ui.dropdown')
      .dropdown()
    ;
      </script>
      <div class="item">
        <div class="ui button blue" data-content="通知はまだ機能しません"><i class="bell slash icon"></i>通知</div>
      </div>
      <div class="item"><button type="button" class="ui pink button btn-post"><i class="pencil icon"></i>投稿</button></div>
    </div>
  </div>
</div>
