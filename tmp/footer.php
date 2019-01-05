<!--
<div class="right" style="width:calc(100% - 230px);">
  <div style="height:40px;"></div>
  <div class="ui centered leaderboard test ad">
    <?php //echo $ad3; ?>
  </div>
  <div style="height:40px;"></div>
</div>
<div class="clear"></div>
-->
<div style="height:20px;"></div>
<div class="eroui window">
<div class="eroui title">
  <span class="left">新規投稿</span>
  <span class="right"><i class="icon times"></i></span>
</div>
<div class="eroui content">
  <form action="<?php echo Config::get('app.url'); ?>api/video" method="post" id="add-av-form" class="ui form">
    <div class="field">
      <input type="url" name="av-url" class="form-control" required placeholder="動画URL">
      <small class="form-text text-muted">動画視聴ページのURLを入力してください。</small>
    </div>
    <div class="field">
      <input type="text" name="av-title" class="form-control" required placeholder="動画タイトル">
      <small class="form-text text-muted">設定したい動画のタイトルを入力してください。</small>
    </div>
    <div class="field">
      <input type="text" name="av-tags" class="form-control" required placeholder="動画タグ">
      <small class="form-text text-muted">半角スペース区切り</small>
    </div>
    <button class="ui button pink big right" type="submit"><i class="icon pencil"></i>投稿</button>
  </form>
</div>
</div>
<script>
  twemoji.parse(document.body);

  var _omikuji = false;
  $(".eromikuji").click(function(){
    if(_omikuji == false){
      var _txt = $(this).html().replace("開く","閉じる");
      $(this).html(_txt);
      $(".eroui.omikuji.box").slideDown();
      _omikuji = true;
    }else{
      var _txt = $(this).html().replace("閉じる","開く");
      $(this).html(_txt);
      $(".eroui.omikuji.box").slideUp();
      _omikuji = false;
    }
  });
</script>
<script src="//eroico.ml/assets/js/jquery.funcHoverDiv.js"></script>
<script src="//eroico.ml/assets/js/toast.js"></script>
<script>
  var toast = new Toast();
  toast.show('トースト通知テストです', 5000);
  $('.ui.button.btn-post').funcHoverDiv({
       hoverid:'.eroui.window',  // 擬似ウィンドウのID
       dragid:'.eroui.window .eroui.title',  // ドラッグ移動可能な要素のID
       closeid:'.eroui.window .eroui.title .right',   // 擬似ウィンドウを閉じる要素のID
       isModal: true,         // モーダル化　★ここを変更
       width:'600px',         // 擬似ウィンドウのwidth
       height:'345px'         // 擬似ウィンドウのheight
   });
   var audio = new Audio('<?php echo Config::get('app.url'); ?>assets/sound/pon.mp3');
   $(".btn-post").click(function(){
     audio.play();
   });

</script>
