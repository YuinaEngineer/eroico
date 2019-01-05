<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/Config.php';
Config::set_config_directory($_SERVER['DOCUMENT_ROOT']. '/config');
require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/nukeruvideo.php';
$nukeruvideo = new nukeruvideo();
if(isset($_SESSION['id'])){
$userid = $_SESSION['id'];
}else{
$userid = "guest";
}
$args = $_POST['av-url'];
echo $userid;
if(
  preg_match('/video.fc2.com\/a\/content\/([a-zA-Z0-9_]+)/is',$args,$match)
){
  $site = 'fc2';
  $url = 'https://'.$match[0];
  if($html = @file_get_contents($url))
  {
  // サムネイル
  preg_match("/og:image\" content=\"(http.+?)\"/is",$html,$match);
  if($match[1])
  {
  $thumbnail = str_replace("http://","https://",$match[1]);
  }
  }
  $movie = '<fc2 src="'.$url.'" width="100%" height="100%"></fc2>';
  // タイトル
  $title = $_POST['av-title'];
  $category = $_POST['av-category'];
  $tags = $_POST['av-tags'];
}else if(
  preg_match('/jp.pornhub.com\/view_video.php\?viewkey=([a-zA-Z0-9_]+)/is',$args,$match)
){
  $site = 'pornhub';
  $url = 'https://'.$match[0];
  $id = $match[1];
  $apiurl = "https://jp.pornhub.com/webmasters/video_by_id?id={$id}&thumbsize=medium";
  $json = json_decode(file_get_contents($apiurl));
  $thumbnail = preg_replace("/¥(.+?¥)/", "", $json->video->default_thumb);
  $movie = '<iframe src="https://jp.pornhub.com/embed/'.$match[1].'"></iframe>';
}else if(
preg_match('/static\.(xvideos\.com)\/swf\/.+?id_video=([0-9]+)/is',$args,$match)
|| preg_match('/(xvideos\.com)\/embedframe\/([0-9]+)/is',$args,$match)
|| preg_match('/(xvideos\.com)\/video([0-9]+)/is',$args,$match)
)
{
if( $match[0] )
{
  $site = 'xvideos';
// 動画URL
$url = 'https://www.'.$match[1].'/video'.$match[2].'/';

// 埋め込み動画
$movie = 'https://www.'.$match[1].'/embedframe/'.$match[2];

if($html = @file_get_contents($url))
{
// サムネイル
preg_match("/og:image\" content=\"(http.+?)\"/is",$html,$match);
if($match[1])
{
$thumbnail = str_replace("http://","https://",$match[1]);
}


// mp4
preg_match("/setVideoUrlHigh\(\'(http.+?)\'\)/s",$html,$match);
if($match[1])
$download = urldecode($match[1]);
}
}
}
else if(
  preg_match('/javynow.com\/video\/([0-9a-zA-Z]+)/is',$args,$match)
){
  $site = 'javynow';
  $id = $match[1];
  $url = 'https://javynow.com/cushion/'.$id.'/';
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, $url );
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  $html = curl_exec( $ch );
  curl_close($ch);
  $dom = phpQuery::newDocument($html);
  $thumbnail = $dom["#cushion div img"]->attr("src");
  $movie = '<iframe src="https://javynow.com/player/'.$id.'/"></iframe>';
}
else if(
  preg_match('/ero-video.net\/movie\/\?mcd=([0-9a-zA-Z]+)/is',$args,$match)
){
  $site = 'erovideo';
  $id = $match[1];
  $url = $args;
  $movie = '';
  $url2 = str_replace("movie","blogframe",$url);
  if($html = @file_get_contents($url2))
  {
  // サムネイル
  preg_match("/NMA.video.poster = \"(.*?)\";/is",$html,$match);
  if($match[1])
  {
  $thumbnail = str_replace("//","https://",$match[1]);
  }

  // mp4
  preg_match("/setVideoUrlHigh\(\'(http.+?)\'\)/s",$html,$match);
  if($match[1])
  $download = urldecode($match[1]);
  }
}
else if(
  preg_match('/xhamster.com\/videos\/([0-9a-zA-Z-#]+)/is',$args,$match)
){
  $site = 'xhamster';
  $id = $match[1];
  $url = $args;
  $movie = '<xhamster src="'.$url.'" width="100%" height="100%"></xhamster>';
  if($html = @file_get_contents($url))
  {
  // サムネイル
  preg_match("/og:image\" content=\"(http.+?)\"/is",$html,$match);
  if($match[1])
  {
  $thumbnail = str_replace("http://","https://",$match[1]);
  }

  // mp4
  preg_match("/setVideoUrlHigh\(\'(http.+?)\'\)/s",$html,$match);
  if($match[1])
  $download = urldecode($match[1]);
  }
}
$datetime = date('Y-m-d H:i:s');
$_tags = $_POST['av-tags'];
$___actress = $_POST['av-actress'][0];
$actress = explode(',',$___actress);
$_actress = "";
foreach($actress as $actres){
  $_actress .= "{$actres} ";
}
$_actress2 = "";
foreach($actress as $actres){
  $_actress2 .= "{$nukeruvideo->get_actress_data($actres,'name')} ";
}
$title = $_POST['av-title'];
$category = $_POST['av-category'];
$video_url = $nukeruvideo->add_av($userid,$datetime,$movie,$thumbnail,$title,$category,$_tags,$_actress,$_actress2,$site,$url);

header("location:{$video_url}");
?>
