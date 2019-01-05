<div class="eroui box" style="padding:15px;">
<h1>🎉 あなたのプロフィールを設定しましょう！</h1>
<form action="<?php echo Config::get('app.url'); ?>api/edit" method="post" id="form" class="ui form">
  <div class="field">
    <label>プロフィールアイコン</label>
    <input type="file" class="form-control" id="imgFile">
    <input type="hidden" name="profile_icon" id="input-file-base64">
    <small class="form-text text-muted">使いたい画像を選択してね。</small>
    <div style="height:10px;"></div>
    <div class="nukeruvideo-crop-box" style="display:none;">
    <div class="bg-dark" id="preview" style="width:0px;height:0px;overflow:hidden;">
    <img id="image" src="" style="display:none;">
    </div>
    <div style="height:10px;"></div>
    <button class="ui button fluid pink big" type="button" id="done">切り取りを確定する</button>
    </div>
  </div>
  <div class="field">
    <label>ユーザー名</label>
    <input type="text" name="username" class="form-control" placeholder="山田 太郎" id="demo2" value="<?php echo $nukeruvideo->userinfo($_SESSION['id'],'name'); ?>">
    <small class="form-text text-muted">ユーザーを入力してね。</small>
  </div>
<div class="field">
  <label>プロフィール文</label>
  <textarea name="profile_txt" class="form-control" id="demo1"><?php echo str_replace("<br>","\r\n",$nukeruvideo->userinfo($_SESSION['id'],'profile_txt')); ?></textarea>
  <small class="form-text text-muted">改行も反映されます。</small>
</div>
<div class="field">
  <label>Pornkey.mlのアカウント</label>
  <input type="text" name="usersns" class="form-control" placeholder="@yuina" value="<?php echo $nukeruvideo->userinfo($_SESSION['id'],'sns'); ?>">
  <small class="form-text text-muted">Pornkey.mlにあなたのアカウントがある場合は入力してね。</small>
</div>
<button type="submit" class="ui pink button">ユーザー情報更新</button>
</form>
<script>
  $(document).ready(function() {
    $("#demo1").emojioneArea({
      autoHideFilters: true,
      pickerPosition   : "bottom"
    });
    $("#demo2").emojioneArea({
      autoHideFilters: true,
      pickerPosition   : "bottom"
    });
  });
$('#imgFile').change(
function () {
if (!this.files.length) {
return;
}
var file = $(this).prop('files')[0];
var fr = new FileReader();
fr.onload = function() {
$("#image").attr("src",fr.result);
}
fr.readAsDataURL(file);
}
);
var element = $('#image');
var _width;
var _height;
element.on('load',function(){
$('#image').cropper("destroy");
var img = new Image();
img.src = element.attr('src');
var width = img.width;
var height = img.height;
var __width = (width / 278);
_width = 278;
_height = (height / __width);
$("#preview").width(_width);
$("#preview").height(_height);
$('#image').cropper({
aspectRatio: 1 / 1
});
$(".nukeruvideo-crop-box").fadeIn();
});
$("#cropstart").click(function(){
});
$("#done").click(function(){
document.getElementById("input-file-base64").value = $('#image').cropper('getCroppedCanvas').toDataURL();
//console.log();
})
</script>
</div>
