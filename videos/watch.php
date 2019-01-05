<?php
$watchid = str_replace('nv','',$id[1]);
$nukeruvideo->get_av($watchid);
$nukeruvideo->nukeplay("nv".$watchid,$_SESSION['id']);
?>
<div class="ui embed" data-placeholder="/images/image-16by9.png" data-icon="right circle arrow">
  <<?php echo $nukeruvideo->videoInfo['site']; ?> src="<?php echo $nukeruvideo->videoInfo['url']; ?>" width="100%" height="100%"></<?php echo $nukeruvideo->videoInfo['site']; ?>>
</div>
<h1><?php echo $nukeruvideo->videoInfo['title']; ?></h1>
<div style="height:10px;"></div>
<a href="<?php echo Config::get('app.url'); ?>@<?php echo $nukeruvideo->videoInfo['userid']; ?>" style="color:#000;">
<img class="ui avatar mini image" src="<?php echo Config::get('app.url'); ?>assets/img/avatar/<?php echo $nukeruvideo->videoInfo['userid']; ?>">
<span><?php echo $nukeruvideo->userinfo($nukeruvideo->videoInfo['userid'],'name'); ?> さん</a>が <?php echo date('Y-m-d',strtotime($nukeruvideo->videoInfo['datetime'])); ?> に投稿</span>
<div style="height:20px;"></div>
<div class="ui labeled button btn-mylist" tabindex="0">
  <div class="ui red button">
    <i class="heart icon"></i> LIKE!
  </div>
  <a class="ui basic red left pointing label">
    <?php echo number_format($nukeruvideo->mylist_count("{$id[1]}")); ?>
  </a>
</div>
<div class="ui labeled button btn-nuketa" tabindex="0">
  <div class="ui blue button">
    <i class="tint icon"></i> ヌイた！
  </div>
  <a class="ui basic blue left pointing label">
    <?php echo number_format($nukeruvideo->nuki_count("{$id[1]}")); ?>
  </a>
</div>
<div class="ui blue button">
  <i class="twitter icon"></i> tweet
</div>
<?php
  if($nukeruvideo->videoInfo['tags'] !== ""){
    echo '
    <div style="height:20px;"></div>
    <div class="ui tag labels">
    ';
    $tags = explode(" ", $nukeruvideo->videoInfo['tags']);
    foreach ($tags as $tag) {
      if($tag !== ""){
        echo "<a href='".Config::get('app.url')."videos/tag/{$tag}' class='ui teal tag label'>{$tag}</a>";
      }
    }
    echo '</div>';
  }
?>
<?php
  $performer = explode(" ", $nukeruvideo->videoInfo["actress"]);
  if($nukeruvideo->videoInfo["actress"] !== " "){
    echo '
    <div style="height:20px;"></div>
    <div class="ui big labels">
    ';
    if($performer !== null){
      foreach ($performer as $actress) {
        if($actress !== ""){
          $actress_img = $nukeruvideo->get_actress_data($actress,"pics");
          $actress_name = $nukeruvideo->get_actress_data($actress,"name");
          echo "<a href='".Config::get('app.url')."videos/actress/{$actress}' class='ui image pink label'><img src='{$actress_img}'>{$actress_name}</a>";
        }
      }
      echo "</div>";
    }
  }
?>
<div style="height:20px"></div>
<div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://nukerubideo.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

<script>
$(function(){
  <?php
    if(isset($_SESSION['id'])){
      echo '
      $(".btn-nuketa").click(function(){
        $.get("'.Config::get('app.url').'api/nuketa",{videoid: "'.$id[1].'", userid: "'.$_SESSION['id'].'" },function(data){
          const formatter = new Intl.NumberFormat(\'ja-JP\');
          var _data = formatter.format(data);
          $(".btn-nuketa .label").html(_data);
        });
      });
      $(".btn-mylist").click(function(){
        $.get("'.Config::get('app.url').'api/mylist",{videoid: "'.$id[1].'", userid: "'.$_SESSION['id'].'" },function(data){
          const formatter = new Intl.NumberFormat(\'ja-JP\');
          var _data = formatter.format(data);
          $(".btn-mylist .label").html(_data);
        });
      });';
    }else{
      echo "
      $('.btn-nuketa').click(function(){
        swal({
          title: 'ログインしてください',
          text: 'この機能を利用するにはログインが必要です',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'twitterでログイン/登録'
        }).then((result) => {
          if (result.value) {
            location.href='https://nukeru-video.jp/login';
          }
        })
      });
      $('.btn-mylist').click(function(){
        swal({
          title: 'ログインしてください',
          text: 'この機能を利用するにはログインが必要です',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'twitterでログイン/登録'
        }).then((result) => {
          if (result.value) {
            location.href='https://nukeru-video.jp/login';
          }
        })
      });";
    }
  ?>
})
</script>

<script src="<?php echo Config::get('app.url'); ?>assets/js/phml.min.js"></script>
