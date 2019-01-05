<div class="eroui box" style="padding:15px;">
<h1>🎉 あなたのお気に入りの動画を投稿しましょう！</h1>
<p style="padding:0px;margin:0px;line-height:2em;">
Eroicoでは、投稿された動画をデータベースへ保管し検索結果に反映しております。<br/>
XVIDEOS,Pornhub,XHAMSTER,erovideo,javynow,FC2動画に対応しております。
</p>
<div style="height:5px;"></div>
<form action="add-av.php" method="post" id="add-av-form" class="ui form">
  <div class="field">
    <label>投稿する動画のURL</label>
    <input type="url" name="av-url" class="form-control" required>
    <small class="form-text text-muted">動画視聴ページのURLを入力してください。</small>
  </div>
  <div class="field">
    <label>投稿する動画のタイトル</label>
    <input type="text" name="av-title" class="form-control" required>
    <small class="form-text text-muted">設定したい動画のタイトルを入力してください。</small>
  </div>
  <button class="ui pink button btn-popular-tag" type="button">
    <i class="icon tag"></i> タグを選択
  </button>
  <div style="height:5px;"></div>
  <section class="list-popular-tag">
    <?php
      $i =1;
      foreach ($nukeruvideo->video_tag01 as $tag){
        echo "<input type=\"checkbox\" name=\"av-tags[]\" value=\"{$tag}\" id=\"checkbox{$i}\" />
        <label for=\"checkbox{$i}\" class=\"checkbox\">{$tag}</label>";
        ++$i;
      }
    ?>
  </section>
  <div style="height:15px;"></div>
  <input type="text" id="actress_ruby" class="form-control" placeholder="ひらがなで入力してください（例：うえはらあい）">
  <div style="height:10px;"></div>
  <button class="ui pink fluid button btn-actress" type="button">
    <i class="icon users"></i> AV女優検索
  </button>
  <div style="height:10px;"></div>
  <div class="actress-selected-lists" style="background-color:#f2f2f2;padding:10px;border-radius:5px;border:1px #ddd solid;"></div>
  <div style="height:10px;"></div>
  <section class="list-actress-list">
    <div class="actress-lists" style="background-color:#f2f2f2;padding:10px;border-radius:5px;border:1px #ddd solid;"></div>
    <input type="hidden" name="av-actress[]">
  </section>
  <div style="height:5px;"></div>
  <button  type="submit" class="ui pink fluid button">アダルトビデオ情報を登録</button>
</form>
</div>
<script>
  var popular_t = 0;
  $(".btn-popular-tag").click(function(){
    if(popular_t != 1){
      $(".list-popular-tag").slideDown();
      var _poptag = $(".btn-popular-tag").html();
      _poptag = _poptag.replace("down","up");
      $(".btn-popular-tag").html(_poptag);
      popular_t = 1;
    }else{
      $(".list-popular-tag").slideUp();
      var _poptag = $(".btn-popular-tag").html();
      _poptag = _poptag.replace("up","down");
      $(".btn-popular-tag").html(_poptag);
      popular_t = 0;
    }
  })

  var actress_data = [];

  $(".btn-actress").click(function(){
    if($("#actress_ruby").val() !== ""){
      $(".actress-lists").html("");
      $.getJSON("https://api.nukeru-video.jp/actress/?q="+$("#actress_ruby").val() , function(data) {
        var len = data.length;
        for(var i = 0; i < len; i++) {
          $(".actress-lists").append("<button type=\"button\" class='ui big image pink label actress-btn' data-id=\""+data[i].id+"\" style=\"margin:8px;\"><img src=\""+data[i].pics+"\">"+data[i].name+"</button>");
        }
      });
    }else{
      alert("１文字は入力してください。");
    }
  })

  $(".actress-lists").on('click','.actress-btn',function() {
    if (actress_data.indexOf($(this).data('id')) == -1){
      actress_data.push($(this).data('id'));
      $(".actress-selected-lists").append($(this));
    }
    console.log(actress_data)
  })

  $(".actress-selected-lists").on('click','.actress-btn',function() {
    var idx = $.inArray($(this).data('id'), actress_data);
    if(idx >= 0){
     actress_data.splice(idx, 1);
    }
    $(".actress-lists").append($(this));
    console.log(actress_data)
  })

  $('#add-av-form').submit(function(){
    $('input[name="av-actress[]"]').val(actress_data);
  })
</script>
