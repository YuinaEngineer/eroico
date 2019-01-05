<img class="ui middle rounded aligned tiny image" src="<?php echo $nukeruvideo->get_actress_data($id[1],'pics'); ?>">
<h3 style="text-indent:0.5em;display:inline-block;"><?php echo $nukeruvideo->get_actress_data($id[1],'name'); ?></h3>
<div class="ui divider"></div>
<?php
$_search = $nukeruvideo->actresscount($id[1]);
if($_search !== 0){
$nukeruvideo->actress_search($id[1]);
?>
<div class="ui divider"></div>
<?php
}
?>
<?php
$api_id = 'bNKvmKPuTDunaEwC6GAP';
$affiliate_id = 'utamita-990';
$api_url = "https://api.dmm.com/affiliate/v3/ItemList?api_id={$api_id}&affiliate_id={$affiliate_id}&site=FANZA&article=actress&article_id={$id[1]}&hits=15&sort=rank&output=json";
$json = json_decode(file_get_contents($api_url));
echo '<div style="width:100%;"><ul class="video-list3">';
$i = 1;
foreach($json->result->items as $item){
if($i % 3 == 1){
$adclass = " first";
}else{
$adclass = "";
}
$url = $item->affiliateURL;
//$id = $row['index'];
//$nukeruvideo_url = 'https://nukeru-video.jp/watch/nv'.$id;
$title1 = $item->title;
$title2 = $nukeruvideo->trimword($item->title,25);
$thumbnail = $item->imageURL->large;
//$video = $row['movie'];
$datetime = date("Y/m/d H:i",strtotime($item->date));
//$site = $row['site'];
echo "<li class='item{$adclass}'>";
echo "<abbr title='{$title1}'><a href='{$url}' target='_blank'>";
echo "<div class='video-thumbnail'><img src='{$thumbnail}'>";
echo "<span class='site-badge fanza text-danger'><b>FANZA</b></span>";
echo "<span class='nuki-badge'>オススメ！</span>";
echo "</div>";
echo "<div style='height:5px;'></div>";
echo "<span class='video-title'>{$title2}</span>";
echo '</a></abbr>';
echo '</li>';
if($i % 3 == 0){
echo '<div class="clear"></div><div style="height:20px;"></div>';
}
++$i;
}
echo '<div class="clear"></div></ul></div>';
?>
