<?php
date_default_timezone_set('Asia/Tokyo');
ini_set( 'session.gc_probability', 1 );  // 分子(デフォルト:1)
ini_set( 'session.gc_divisor', 1 );  // 分母(デフォルト:100)

class nukeruvideo{
  public $video_tag01 = array(
    '白人',
    '黒人',
    '素人',
    'OL',
    '女教師',
    '看護婦・ナース',
    '処女',
    '女子大生',
    '女子校生',
    '痴女',
    '人妻',
    '美女',
    '美少女',
    'お姉さん',
    '巨乳',
    '美乳',
    'ギャル',
    'パイパン',
    '貧乳・微乳',
    'ロリ系',
    '水着',
    'SM',
    '企画',
    'イメージビデオ',
    'アイドル',
    'コスプレ',
    '色白',
    '近親相姦',
    'レイプ',
    '痴漢',
    '盗撮・のぞき',
    'ナンパ',
    'マッサージ',
    '野外・露出',
    '乱交',
    'アナル',
    'イラマチオ',
    'オナニー',
    '顔射',
    'ごっくん',
    '手コキ',
    '中出し',
    '潮吹き',
    '複数',
    '3P',
    'イケメン',
    'パイズリ',
    'フェラ',
    'ぶっかけ',
    'ハメ撮り',
    'アニメ',
    '個人撮影',
    'レズ',
    'クンニ',
    'おもちゃ',
    'バイブ',
    '乳首責め',
    'SM',
    '寸止め',
    'フェチ',
    '風俗',
    '剃毛'
  );
  public $video_site01 =  array(
    'XVIDEOS',
    'FC2',
    'Pornhub',
    'JavyNow',
    'XHAMSTER',
    'erovideo'
  );
  public $sites =  array(
    'xvideos'=>'<span style="color:red;">X</span><span style="color:#fff;">VIDEOS</span>',
    'fc2'=>'<span style="color:#fff;">FC2</span>',
    'pornhub'=>'<span style="color:#fff;">Porn</span><span style="color:#000;">hub</span>',
    'javynow'=>'JavyNow',
    'xhamster'=>'<span style="color:red;">X</span><span style="color:#fff;">HAMSTER</span>',
    'erovideo'=>'<span style="color:red;">ero</span><span style="color:blue">video</span>'
  );

  public function create_tables(){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "create table `follow` (`index` int unique, `from` text, `to` text,`status` int);";
    $mysqli->query($sql);
    $sql = "create table `mylist` (`videoid` text, `userid` text, `datetime` datetime);";
    $mysqli->query($sql);
    $sql = "create table `nuketa` (`videoid` text, `userid` text, `datetime` datetime);";
    $mysqli->query($sql);
    $sql = "create table `play_log` (`videoid` text, `userid` text, `datetime` datetime);";
    $mysqli->query($sql);
    $sql = "create table `users` (`index` int unique, `id` varchar(200) unique,`passwd` longtext,`name` longtext CHARACTER SET utf8mb4,`profile_txt` longtext CHARACTER SET utf8mb4,`profile_icon` longtext, `sns` longtext);";
    $mysqli->query($sql);
    $sql = "create table `omikuji` (`id` varchar(200) unique, `date` date,`unsei` text,`color` text,`rgb` text);";
    $mysqli->query($sql);
    $sql = "create table `videos` (`index` int unique, `userid` longtext,`url` longtext,`datetime` datetime,`movietime` time,`movie` longtext,`thumbnail` longtext,`title` longtext,`description` longtext,`category` text,`tags` longtext,`actress` longtext,`actress2` longtext,`site` text,`deleted` int);";
    $mysqli->query($sql);
    $sql = "create table `message` (`index` int unique, `from` text,`to` text,`datetime` datetime,`body` longtext,`status` int);";
    $mysqli->query($sql);
    $mysqli->close();
  }

  public function omikuji($userid){
    $_unsei = array(
      '大吉',
      '中吉',
      '小吉',
      '吉',
      '半吉',
      '末吉',
      '末小吉',
      '凶',
      '小凶',
      '半凶',
      '末凶',
      '大凶'
    );
    $_color = array(
      '梔子色',
      '紫苑色',
      '黄蘗色',
      '柑子色',
      '焦茶色',
      '鳩羽鼠',
      '蓬色',
      '茜色',
      '栗色',
      '水色',
      '珊瑚色',
      '瑠璃色',
      '緋色',
      '浅葱色',
      '朱色',
      '牡丹色',
      '躑躅色',
      '柿色',
      '山吹色',
      '海老色',
      '露草色',
      '藤色',
      '香色',
      '青竹色',
      '蘇芳色',
      '撫子色',
      '桜色',
      '白緑',
      '萌黄色',
      '桃色',
      '蒲公英色',
      '鶸色',
      '雀色',
      '抹茶色',
      '紅梅色',
      '瓶覗',
      '藍色',
      '松葉色',
      '黄金色',
      '紅色'
    );
    $_rgb = array(
      '251,202,77',
      '163,111,162',
      '236,211,24',
      '244,163,70',
      '78,45,31',
      '133,127,142',
      '15,144,120',
      '193,0,43',
      '145,54,11',
      '168,225,205',
      '239,137,132',
      '58,73,157',
      '216,12,24',
      '0,133,163',
      '233,71,9',
      '211,84,153',
      '227,49,125',
      '228,94,57',
      '250,190,0',
      '125,0,62',
      '0,128,200',
      '165,154,202',
      '244,219,173',
      '0,141,120',
      '183,22,73',
      '244,179,194',
      '248,204,220',
      '182,221,202',
      '157,195,23',
      '237,121,120',
      '255,222,0',
      '199,203,17',
      '148,48,50',
      '136,161,79',
      '239,138,150',
      '202,232,237',
      '0,72,122',
      '0,94,70',
      '246,171,0',
      '202,46,90'
    );

    $_date = date('Y-m-d');
    if($this->omikujiinfo($userid,'date') !== $_date){
      $index1 = array_rand($_unsei, 1);
      $index2 = array_rand($_color, 1);
      $return = array(
        'unsei'=>$_unsei[$index1],
        'color'=>$_color[$index2],
        'rgb'=>$_rgb[$index2]
      );
      $this->omikujipost($userid,$_date,$_unsei[$index1],$_color[$index2],$_rgb[$index2]);
    }else{
      $return = array(
        'unsei'=>$this->omikujiinfo($userid,'unsei'),
        'color'=>$this->omikujiinfo($userid,'color'),
        'rgb'=>$this->omikujiinfo($userid,'rgb')
      );
    }
    return $return;
  }

  public function omikujipost($id,$date,$unsei,$color,$rgb){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8mb4");
    }
    $sql = "insert into `omikuji` (`id`,`date`,`unsei`,`color`,`rgb`) values ('{$id}','{$date}','{$unsei}','{$color}','{$rgb}') on DUPLICATE KEY update `id`='{$id}',`date`='{$date}',`unsei`='{$unsei}',`color`='{$color}',`rgb`='{$rgb}';";
    if( $mysqli->query( $sql ) ) {
    }
    else {
    echo 'INSERT失敗';
    }
    // DB接続を閉じる
    $mysqli->close();
  }

  public function omikujiinfo($id,$type){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8mb4");
    }

    $sql = "SELECT * FROM omikuji where `id`= '{$id}'";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    while ($row = $result->fetch_assoc()) {
      $data = $row["{$type}"];
      $return = $data;
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $return;
  }

  public function user_add($id,$passwd){
    if($this->userinfo($id,'index') == ""){
      $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
      if ($mysqli->connect_error) {
      echo $mysqli->connect_error;
      exit();
      } else {
      $mysqli->set_charset("utf8");
      }
      if($this->userinfo($id,'index') >= 1){
        $index = $this->userinfo($id,'index');
      }else{
        $index = $this->user_count()+1;
      }
      $_passwd = md5(md5($passwd));
      $sql = "insert into `users` (`index`,`id`,`passwd`) values ({$index},'{$id}','{$_passwd}') on DUPLICATE KEY update `index`={$index},`id`='{$id}',`profile_icon`='{$profile_icon}';";
      if( $mysqli->query( $sql ) ) {
      }
      else {
      echo 'INSERT失敗';
      }

      // DB接続を閉じる
      $mysqli->close();
      return true;
    }else{
      return false;
    }
  }

  public function nukeplay($videoid,$userid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    if($userid == ""){
      $userid = "guest";
    }
    $datetime = date('Y-m-d H:i:s');
    $sql = "insert into `play_log` (`videoid`,`userid`,`datetime`) values ('{$videoid}','{$userid}','{$datetime}');";
    if( $mysqli->query( $sql ) ) {
    }
    else {
    echo 'INSERT失敗';
    }

    // DB接続を閉じる
    $mysqli->close();
  }

  public function nukeplaycount($videoid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM `play_log` where `videoid` = '{$videoid}';";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $count;
  }

  public function mylist($videoid,$userid){
    if($this->mylisted($videoid,$userid) == 0){
      $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
      if ($mysqli->connect_error) {
      echo $mysqli->connect_error;
      exit();
      } else {
      $mysqli->set_charset("utf8");
      }
      $datetime = date('Y-m-d H:i:s');
      $sql = "insert into `mylist` (`videoid`,`userid`,`datetime`) values ('{$videoid}','{$userid}','{$datetime}');";
      if( $mysqli->query( $sql ) ) {
      }
      else {
      echo 'INSERT失敗';
      }

      // DB接続を閉じる
      $mysqli->close();
    }
  }

  public function actress_list($keyword){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
      $sql = "SELECT * FROM actress where `ruby` like '%{$keyword}%';";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    $i=1;
    $arraylist = array();
    while ($row = $result->fetch_assoc()) {
      array_push($arraylist, array('id'=>$row['index'],'name'=>$row['name']));
      ++$i;
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $arraylist;
  }

  public function actresscount($actress){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM videos where `actress` like '%{$actress}%' and `deleted` = 0;";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $count;
  }

  public function sitecount($site){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM videos where `site` = '{$site}' and `deleted` = 0;";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $count;
  }

  public function tagcount($tag){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM videos where `tags` like '%{$tag}%' and `deleted` = 0;";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $count;
  }

  public function actressimage($actress){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM videos where `actress` like '%{$actress}%' and `deleted` = 0 ORDER BY RAND() LIMIT 1;";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    $thumbnail = $result->fetch_assoc()['thumbnail'];
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $thumbnail;
  }


  public function siteimage($site){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM videos where `site` = '{$site}' and `deleted` = 0 ORDER BY RAND() LIMIT 1;";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    $thumbnail = $result->fetch_assoc()['thumbnail'];
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $thumbnail;
  }

  public function tagimage($tag){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM videos where `tags` like '%{$tag}%' and `deleted` = 0 ORDER BY RAND() LIMIT 1;";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    $thumbnail = $result->fetch_assoc()['thumbnail'];
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $thumbnail;
  }

  public function mylistcount($videoid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM mylist where `videoid` = '{$videoid}';";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $count;
  }

  public function mylisted($videoid,$userid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM mylist where `videoid` = '{$videoid}' and `userid` = '{$userid}';";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $count;
  }

  public function nuketa($videoid,$userid){
    if($this->nuketed($videoid,$userid) == 0){
      $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
      if ($mysqli->connect_error) {
      echo $mysqli->connect_error;
      exit();
      } else {
      $mysqli->set_charset("utf8");
      }
      $datetime = date('Y-m-d H:i:s');
      $sql = "insert into `nuketa` (`videoid`,`userid`,`datetime`) values ('{$videoid}','{$userid}','{$datetime}');";
      if( $mysqli->query( $sql ) ) {
      }
      else {
      echo 'INSERT失敗';
      }

      // DB接続を閉じる
      $mysqli->close();
    }
  }

  public function nukecount($videoid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM nuketa where `videoid` = '{$videoid}';";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $count;
  }

  public function nuketed($videoid,$userid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM nuketa where `videoid` = '{$videoid}' and `userid` = '{$userid}';";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $count;
  }

  public function set_profile($id,$name,$profile_txt,$profile_icon,$sns){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8mb4");
    }
    if($profile_icon == ""){
      $profile_icon = $this->userinfo($id,'profile_icon');
    }
    $sql = "insert into `users` (`id`,`name`,`profile_txt`,`profile_icon`,`sns`) values ('{$id}','{$name}','{$profile_txt}','{$profile_icon}','{$sns}') on DUPLICATE KEY update `id`='{$id}',`name`='{$name}',`profile_txt`='{$profile_txt}',`profile_icon`='{$profile_icon}',`sns`='{$sns}';";
    if( $mysqli->query( $sql ) ) {
    }
    else {
    echo 'INSERT失敗';
    }

    // DB接続を閉じる
    $mysqli->close();
  }

  public function get_profile($id){
    if($id !== null){
      $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
      if ($mysqli->connect_error) {
      echo $mysqli->connect_error;
      exit();
      } else {
      $mysqli->set_charset("utf8mb4");
      }

      $sql = "SELECT * FROM users where `id`= '{$id}'";
      if ($result = $mysqli->query($sql)) {
      // 連想配列を取得
      while ($row = $result->fetch_assoc()) {
      $this->profile['id'] = $row['id'];
      $this->profile['name']=$row['name'];
      $this->profile['mail']=$row['mail'];
      $this->profile['age']=$row['age'];
      $this->profile['filter1']=$row['filter1'];
      $this->profile['filter2']=$row['filter2'];
      }
      // 結果セットを閉じる
      $result->close();
      }
      // DB接続を閉じる
      $mysqli->close();
    }else{
      $this->profile['id'] = '_guest';
      $this->profile['name']='ゲスト';
      $this->profile['mail']=null;
      $this->profile['age']=null;
    }
  }

  public function login($id,$passwd){
    $_passwd = $this->userinfo($id,'passwd');
    if(md5(md5($passwd)) == $_passwd){
      return true;
    }else{
      return false;
    }
  }

  public function join($id,$passwd){
    $_passwd = $this->userinfo($id,'passwd');
    if(md5(md5($passwd)) == $_passwd){
      return true;
    }else{
      return false;
    }
  }

  public function userinfo($id,$type){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8mb4");
    }

    $sql = "SELECT * FROM users where `id`= '{$id}'";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    while ($row = $result->fetch_assoc()) {
      $data = $row["{$type}"];
      if($type == 'profile_icon'){
        if($data == ""){
          $data = Config::get('app.url')."assets/img/noimage.png";
        }
      }else if($type == 'name'){
        if($data == ""){
          $data = "noname";
        }
      }
      $return = $data;
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $return;
  }

  public function set_filter($id,$filter1,$filter2){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }

    $sql = 'insert into `users` (`id`,`filter1`,`filter2`) values ("'.$id.'","'.$filter1.'","'.$filter2.'") on DUPLICATE KEY update `id`="'.$id.'",`filter1`="'.$filter1.'",`filter2`="'.$filter2.'";';
    if( $mysqli->query( $sql ) ) {
    }
    else {
    echo $sql;
    }

    // DB接続を閉じる
    $mysqli->close();
  }

  public function add_actress($index,$name,$ruby,$bust,$cup,$waist,$hip,$height,$birthday,$blood_type,$hobby,$prefectures,$pics){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "insert into `actress` (`index`,`name`,`ruby`,`bust`,`cup`,`waist`,`hip`,`height`,`birthday`,`blood_type`,`hobby`,`prefectures`,`pics`) values ({$index},'{$name}','{$ruby}',{$bust},'{$cup}',{$waist},{$hip},{$height},'{$birthday}','{$blood_type}','{$hobby}','{$prefectures}','{$pics}') on DUPLICATE KEY update `index`={$index},`name`='{$name}',`ruby`='{$ruby}',`bust`={$bust},`cup`='{$cup}',`waist`={$waist},`hip`={$hip},`height`={$height},`birthday`='{$birthday}',`blood_type`='{$blood_type}',`hobby`='{$hobby}',`prefectures`='{$prefectures}',`pics`='{$pics}';";
    if( $mysqli->query( $sql ) ) {
    }
    else {
    $sql;
    }

    // DB接続を閉じる
    $mysqli->close();
    return Config::get('app.url')."videos/watch/nv{$index}";
  }

  public function add_av($userid,$datetime,$movie,$thumbnail,$title,$category,$tags,$actress,$actress2,$site,$url){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $index = $this->av_count()+1;
    $sql = "insert into `videos` (`index`,`userid`,`datetime`,`movie`,`thumbnail`,`title`,`category`,`tags`,`actress`,`actress2`,`site`,`url`,`deleted`) values ({$index},'{$userid}','{$datetime}','{$movie}','{$thumbnail}','{$title}','{$category}','{$tags}','{$actress}','{$actress2}','{$site}','{$url}',0) on DUPLICATE KEY update `index`={$index},`userid`='{$userid}',`datetime`='{$datetime}',`movie`='{$movie}',`thumbnail`='{$thumbnail}',`title`='{$title}',`category`='{$category}',`tags`='{$tags}',`actress`='{$actress}',`actress2`='{$actress2}',`site`='{$site}',`url`='{$url}',`deleted`=0;";
    if( $mysqli->query( $sql ) ) {
    }
    else {
    echo 'INSERT失敗';
    }

    // DB接続を閉じる
    $mysqli->close();
    return Config::get('app.url')."videos/watch/nv{$index}";
  }

  public function get_avs($limit,$type='pc'){

    echo '<div style="width:100%;">
      <ul class="video-list3">';
      $w=3;
      if($type =="sp"){
        $w=2;
      }
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    if($limit !== null){
      $sql = "SELECT * FROM videos where `deleted`=0 ORDER BY datetime DESC LIMIT {$limit};";
    }else{
      $sql = "SELECT * FROM videos where `deleted`=0 ORDER BY datetime DESC;";
    }
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    $i=1;
    while ($row = $result->fetch_assoc()) {
      if($i % $w == 1){
        $adclass = " first";
      }else{
        $adclass = "";
      }
      $url = $row['url'];
      $id = $row['index'];
      $nukeruvideo_url = Config::get('app.url').'videos/watch/nv'.$id;
      $title = $row['title'];
      $thumbnail = $row['thumbnail'];

      $video = $row['movie'];
      $datetime = date("Y/m/d H:i",strtotime($row['datetime']));
      $site = $row['site'];
      echo "<li class='item{$adclass}'>";
      echo "<a href='{$nukeruvideo_url}'>";
      echo "<div class='video-thumbnail'><img src='{$thumbnail}' onerror='this.src=\"".Config::get('app.url')."assets/img/noimage.png\";'>";
      echo "<span class='site-badge {$site}'>{$this->sites[$site]}</span>";
      echo "<span class='nuki-badge'><i class='fas fa-tint'></i> {$this->nuki_count('nv'.$id)}</span>";
      echo "</div>";
      echo "<div style=\"height:5px;\"></div>";
      echo "<span class='video-title'>{$title}</span>";
      echo '</a>';
      echo '</li>';
      if($i % $w == 0){
        echo '<div class="clear"></div><div style="height:20px;"></div>';
      }
      ++$i;
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    echo '<div class="clear"></div>
  </ul>
</div>';
  }

  public function get_timeline_avs1($userid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM videos where `userid` = '{$userid}' and `deleted`=0 ORDER BY datetime DESC;";

    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    while ($row = $result->fetch_assoc()) {
      $url = $row['url'];
      $id = $row['index'];
      $nukeruvideo_url = Config::get('app.url').'videos/watch/nv'.$id;
      $title = $row['title'];
      $thumbnail = $row['thumbnail'];
      $video = $row['movie'];
      $datetime = date("Y-m-d H:i",strtotime($row['datetime']));
      $date = date("Y-m-d",strtotime($row['datetime']));
      $time = date("H:i",strtotime($row['datetime']));
      $site = $row['site'];
      echo '<li>
    		<time class="cbp_tmtime" datetime="'.$datetime.'"><span>'.$date.'</span> <span>'.$time.'</span></time>
    		<div class="cbp_tmicon cbp_tmicon-earth"></div>
    		<div class="cbp_tmlabel">
          <span>'.$title.'</span>
          <div style="height:5px;"></div>
          <img src="'.$thumbnail.'" style="height:150px;">
          <div style="height:5px;"></div>
    			<a class="text-white" href="'.Config::get('app.url').'videos/watch/nv'.$id.'">'.Config::get('app.url').'videos/watch/nv'.$id.'</a>
    		</div>
    	</li>';
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
  }

  public function get_timeline_avs2($userid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM mylist where `userid` = '{$userid}' ORDER BY datetime DESC;";

    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    while ($row = $result->fetch_assoc()) {
      $url = $row['url'];
      $id = str_replace("nv","",$row['videoid']);
      $nukeruvideo_url = Config::get('app.url').'videos/watch/nv'.$id;
      $title = $this->get_av_data($id,"title");
      $thumbnail = $this->get_av_data($id,"thumbnail");
      $datetime = date("Y-m-d H:i",strtotime($row['datetime']));
      $date = date("Y-m-d",strtotime($row['datetime']));
      $time = date("H:i",strtotime($row['datetime']));
      echo '<li>
    		<time class="cbp_tmtime" datetime="'.$datetime.'"><span>'.$date.'</span> <span>'.$time.'</span></time>
    		<div class="cbp_tmicon cbp_tmicon-earth"></div>
    		<div class="cbp_tmlabel">
          <span>'.$title.'</span>
          <div style="height:5px;"></div>
          <img src="'.$thumbnail.'" style="height:150px;">
          <div style="height:5px;"></div>
    			<a class="text-white" href="'.Config::get('app.url').'videos/watch/nv'.$id.'">'.Config::get('app.url').'videos/watch/nv'.$id.'</a>
    		</div>
    	</li>';
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
  }

  public function saisei_avs($limit,$type='pc'){
    $w=4;
    if($type =="sp"){
      $w=2;
    }
    $_data = array();
    echo '<div style="width:100%;">
      <ul class="video-list">';
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }

    $sql = "SELECT * FROM `play_log` ORDER BY datetime DESC;";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    $i=1;
    while ($row = $result->fetch_assoc()) {
      if($this->get_av_data($row['videoid'],'deleted') == '0'){
      if (!in_array($row['videoid'], $_data)) {
        array_push($_data,$row['videoid']);
      }
    }
    }
    foreach($_data as $videoid){
      if($i <= $limit){
        if($i % $w == 1){
          $adclass = " first";
        }else{
          $adclass = "";
        }
        $url = $this->get_av_data($videoid,url);
        $id = $videoid;
        $nukeruvideo_url = Config::get('app.url').'videos/watch/'.$id;
        $title = $this->get_av_data($id,"title");
        $thumbnail = $this->get_av_data($id,"thumbnail");
        $site = $this->get_av_data($id,"site");;
        echo "<li class='item{$adclass}'>";
        echo "<a href='{$nukeruvideo_url}'>";
        echo "<div class='video-thumbnail'><img src='{$thumbnail}'>";
        echo "<span class='site-badge {$site}'>{$this->sites[$site]}</span>";
        echo "<span class='nuki-badge'><i class='fas fa-tint'></i> {$this->nuki_count($id)}</span>";
        echo "</div>";
        echo "<div style=\"height:5px;\"></div>";
        echo "<span class='video-title'>{$title}</span>";
        echo '</a>';
        echo '</li>';
        if($i % $w == 0){
          echo '<div class="clear"></div><div style="height:20px;"></div>';
        }
      }
      ++$i;
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    echo '<div class="clear"></div>
  </ul>
  </div>';
  }

  public function nuketa_avs($userid){
    $_data = array();
    echo '<div style="width:100%;">
      <ul class="video-list">';
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }

    $sql = "SELECT * FROM `nuketa` where `userid` = '{$userid}' ORDER BY datetime DESC;";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    $i=1;
    while ($row = $result->fetch_assoc()) {
        if($i % 4 == 1){
          $adclass = " first";
        }else{
          $adclass = "";
        }
        $url = $this->get_av_data($videoid,url);
        $id = $row['videoid'];
        $nukeruvideo_url = Config::get('app.url').'videos/watch/'.$id;
        $title = $this->get_av_data($id,"title");
        $thumbnail = $this->get_av_data($id,"thumbnail");
        $site = $this->get_av_data($id,"site");;
        echo "<li class='item{$adclass}'>";
        echo "<a href='{$nukeruvideo_url}'>";
        echo "<div class='video-thumbnail'><img src='{$thumbnail}'>";
        echo "<span class='site-badge {$site}'>{$this->sites[$site]}</span>";
        echo "<span class='nuki-badge'><i class='fas fa-tint'></i> {$this->nuki_count($id)}</span>";
        echo "</div>";
        echo "<div style=\"height:5px;\"></div>";
        echo "<small class='text-secondary'>{$row['datetime']}</small>";
        echo "<div style=\"height:5px;\"></div>";
        echo "<span class='video-title'>{$title}</span>";
        echo '</a>';
        echo '</li>';
        if($i % 4 == 0){
          echo '<div class="clear"></div><div style="height:20px;"></div>';
        }
      ++$i;
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    echo '<div class="clear"></div>
  </ul>
  </div>';
  }

  public function mylist_avs($userid){
    $_data = array();
    echo '<div style="width:100%;">
      <ul class="video-list">';
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }

    $sql = "SELECT * FROM `mylist` where `userid` = '{$userid}' ORDER BY datetime DESC;";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    $i=1;
    while ($row = $result->fetch_assoc()) {
        if($i % 4 == 1){
          $adclass = " first";
        }else{
          $adclass = "";
        }
        $url = $this->get_av_data($videoid,url);
        $id = $row['videoid'];
        $nukeruvideo_url = Config::get('app.url').'videos/watch/'.$id;
        $title = $this->get_av_data($id,"title");
        $thumbnail = $this->get_av_data($id,"thumbnail");
        $site = $this->get_av_data($id,"site");;
        echo "<li class='item{$adclass}'>";
        echo "<a href='{$nukeruvideo_url}'>";
        echo "<div class='video-thumbnail'><img src='{$thumbnail}'>";
        echo "<span class='site-badge {$site}'>{$this->sites[$site]}</span>";
        echo "<span class='nuki-badge'><i class='fas fa-tint'></i> {$this->nuki_count($id)}</span>";
        echo "</div>";
        echo "<div style=\"height:5px;\"></div>";
        echo "<small class='text-secondary'>{$row['datetime']}</small>";
        echo "<div style=\"height:5px;\"></div>";
        echo "<span class='video-title'>{$title}</span>";
        echo '</a>';
        echo '</li>';
        if($i % 4 == 0){
          echo '<div class="clear"></div><div style="height:20px;"></div>';
        }
      ++$i;
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    echo '<div class="clear"></div>
  </ul>
  </div>';
  }

  public function history_avs($userid){
    $_data = array();
    echo '<div style="width:100%;">
      <ul class="video-list">';
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }

    $sql = "SELECT * FROM `play_log` where `userid` = '{$userid}' ORDER BY datetime DESC;";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    $i=1;
    while ($row = $result->fetch_assoc()) {
      if($this->get_av_data($row['videoid'],'deleted') == '0'){
      if($_videoid !== $row['videoid']){
        if($i % 4 == 1){
          $adclass = " first";
        }else{
          $adclass = "";
        }
        $url = $this->get_av_data($videoid,url);
        $id = $row['videoid'];
        $nukeruvideo_url = Config::get('app.url').'videos/watch/'.$id;
        $title = $this->get_av_data($id,"title");
        $thumbnail = $this->get_av_data($id,"thumbnail");
        $site = $this->get_av_data($id,"site");;
        echo "<li class='item{$adclass}'>";
        echo "<a href='{$nukeruvideo_url}'>";
        echo "<div class='video-thumbnail'><img src='{$thumbnail}' onerror='\"".Config::get('app.url')."assets/img/noimage.png\"'>";
        echo "<span class='site-badge {$site}'>{$this->sites[$site]}</span>";
        echo "<span class='nuki-badge'><i class='fas fa-tint'></i> {$this->nuki_count($id)}</span>";
        echo "</div>";
        echo "<div style=\"height:5px;\"></div>";
        echo "<small class='text-secondary'>{$row['datetime']}</small>";
        echo "<div style=\"height:5px;\"></div>";
        echo "<span class='video-title'>{$title}</span>";
        echo '</a>';
        echo '</li>';
        if($i % 4 == 0){
          echo '<div class="clear"></div><div style="height:20px;"></div>';
        }
      ++$i;
      $_videoid = $row['videoid'];
    }
  }
  }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    echo '<div class="clear"></div>
  </ul>
  </div>';
  }

  public function added_avs($userid){
    $_data = array();
    echo '<div style="width:100%;">
      <ul class="video-list">';
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }

    $sql = "SELECT * FROM `videos` where `userid` = '{$userid}' ORDER BY datetime DESC;";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    $i=1;
    while ($row = $result->fetch_assoc()) {
      if($this->get_av_data($row['index'],'deleted') == '0'){
      if($_videoid !== $row['index']){
        if($i % 4 == 1){
          $adclass = " first";
        }else{
          $adclass = "";
        }
        $url = $this->get_av_data($videoid,url);
        $id = 'nv'.$row['index'];
        $nukeruvideo_url = Config::get('app.url').'videos/watch/'.$id;
        $title = $this->get_av_data($id,"title");
        $thumbnail = $this->get_av_data($id,"thumbnail");
        $site = $this->get_av_data($id,"site");;
        echo "<li class='item{$adclass}'>";
        echo "<a href='{$nukeruvideo_url}'>";
        echo "<div class='video-thumbnail'><img src='{$thumbnail}' onerror='this.src=\"".Config::get('app.url')."assets/img/noimage.png\"'>";
        echo "<span class='site-badge {$site}'>{$this->sites[$site]}</span>";
        echo "<span class='nuki-badge'><i class='fas fa-tint'></i> {$this->nuki_count($id)}</span>";
        echo "</div>";
        echo '<div style="height:5px;"></div>';
        echo "<small class='text-secondary'>{$row['datetime']}</small>";
        echo '<div style="height:5px;"></div>';
        echo "<span class='video-title'>{$title}</span>";
        echo '</a>';
        echo '</li>';
        if($i % 4 == 0){
          echo '<div class="clear"></div><div style="height:20px;"></div>';
        }
      ++$i;
      $_videoid = $row['videoid'];
    }
  }
  }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    echo '<div class="clear"></div>
  </ul>
  </div>';
  }

  public function nuketa_user_avs($userid){
    $_data = array();
    echo '<div style="width:100%;">
      <ul class="video-list">';
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }

    $sql = "SELECT * FROM `nuketa` where `userid` = '{$userid}' ORDER BY datetime DESC;";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    $i=1;
    while ($row = $result->fetch_assoc()) {
      if($this->get_av_data($row['videoid'],'deleted') == '0'){
      if($_videoid !== $row['videoid']){
        if($i % 4 == 1){
          $adclass = " first";
        }else{
          $adclass = "";
        }
        $url = $this->get_av_data($videoid,url);
        $id = $row['videoid'];
        $nukeruvideo_url = Config::get('app.url').'videos/watch/'.$id;
        $title = $this->get_av_data($id,"title");
        $thumbnail = $this->get_av_data($id,"thumbnail");
        $site = $this->get_av_data($id,"site");;
        echo "<li class='item{$adclass}'>";
        echo "<a href='{$nukeruvideo_url}'>";
        echo "<div class='video-thumbnail'><img src='{$thumbnail}'>";
        echo "<span class='site-badge {$site}'>{$this->sites[$site]}</span>";
        echo "<span class='nuki-badge'><i class='fas fa-tint'></i> {$this->nuki_count($id)}</span>";
        echo "</div>";
        echo '<div style="height:5px;"></div>';
        echo "<small class='text-secondary'>{$row['datetime']}</small>";
        echo '<div style="height:5px;"></div>';
        echo "<span class='video-title'>{$title}</span>";
        echo '</a>';
        echo '</li>';
        if($i % 4 == 0){
          echo '<div class="clear"></div><div style="height:20px;"></div>';
        }
      ++$i;
      $_videoid = $row['videoid'];
    }
  }
  }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    echo '<div class="clear"></div>
  </ul>
  </div>';
  }

  public function trimword($str, $length=20, $append="...") {
    if (mb_strlen($str) > $length) {
        $str = mb_substr($str, 0, $length, 'UTF-8');

        return $str .  $append;
    }

    return $str;
  }

  public function actress_search($site){
    echo '<div style="width:100%;">
      <ul class="video-list3">';
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }

    $sql = "SELECT * FROM videos where (`actress` like '%{$site}%') and `deleted`=0 ORDER BY datetime DESC;";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    $i=1;
    while ($row = $result->fetch_assoc()) {
      if($i % 3 == 1){
        $adclass = " first";
      }else{
        $adclass = "";
      }
      $url = $row['url'];
      $id = $row['index'];
      $nukeruvideo_url = Config::get('app.url').'videos/watch/nv'.$id;
      $title = $row['title'];
      $thumbnail = $row['thumbnail'];
      $video = $row['movie'];
      $datetime = date("Y/m/d H:i",strtotime($row['datetime']));
      $site = $row['site'];
      echo "<li class='item{$adclass}'>";
      echo "<a href='{$nukeruvideo_url}'>";
      echo "<div class='video-thumbnail'><img src='{$thumbnail}'>";
      echo "<span class='site-badge {$site}'>{$this->sites[$site]}</span>";
      echo "<span class='nuki-badge'><i class='fas fa-tint'></i> {$this->nuki_count('nv'.$id)}</span>";
      echo "</div>";
      echo '<div style="height:5px;"></div>';
      echo "<span class='video-title'>{$title}</span>";
      echo '</a>';
      echo '</li>';
      if($i % 3 == 0){
        echo '<div class="clear"></div><div style="height:20px;"></div>';
      }
      ++$i;
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    echo '<div class="clear"></div></ul></div>';
  }

  public function site_search($site){
    echo '<div style="width:100%;">
      <ul class="video-list">';
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }

    $sql = "SELECT * FROM videos where (`site` = '{$site}') and `deleted`=0 ORDER BY datetime DESC;";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    $i=1;
    while ($row = $result->fetch_assoc()) {
      if($i % 4 == 1){
        $adclass = " first";
      }else{
        $adclass = "";
      }
      $url = $row['url'];
      $id = $row['index'];
      $nukeruvideo_url = Config::get('app.url').'videos/watch/nv'.$id;
      $title = $row['title'];
      $thumbnail = $row['thumbnail'];
      $video = $row['movie'];
      $datetime = date("Y/m/d H:i",strtotime($row['datetime']));
      $site = $row['site'];
      echo "<li class='item{$adclass}'>";
      echo "<a href='{$nukeruvideo_url}'>";
      echo "<div class='video-thumbnail'><img src='{$thumbnail}'>";
      echo "<span class='site-badge {$site}'>{$this->sites[$site]}</span>";
      echo "<span class='nuki-badge'><i class='fas fa-tint'></i> {$this->nuki_count('nv'.$id)}</span>";
      echo "</div>";
      echo '<div style="height:5px;"></div>';
      echo "<span class='video-title'>{$title}</span>";
      echo '</a>';
      echo '</li>';
      if($i % 4 == 0){
        echo '<div class="clear"></div><div style="height:20px;"></div>';
      }
      ++$i;
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    echo '<div class="clear"></div></ul></div>';
  }

  public function search($keyword){
    echo '<div style="width:100%;">
      <ul class="video-list3">';
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }

    $sql = "SELECT * FROM videos where (`title` like '%{$keyword}%' or `tags` like '%{$keyword}%' or `actress2` like '%{$keyword}%') and `deleted`=0 ORDER BY datetime DESC;";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    $i=1;
    while ($row = $result->fetch_assoc()) {
      if($i % 3 == 1){
        $adclass = " first";
      }else{
        $adclass = "";
      }
      $url = $row['url'];
      $id = $row['index'];
      $nukeruvideo_url = Config::get('app.url').'videos/watch/nv'.$id;
      $title = $row['title'];
      $thumbnail = $row['thumbnail'];
      $video = $row['movie'];
      $datetime = date("Y/m/d H:i",strtotime($row['datetime']));
      $site = $row['site'];
      echo "<li class='item{$adclass}'>";
      echo "<a href='{$nukeruvideo_url}'>";
      echo "<div class='video-thumbnail'><img src='{$thumbnail}' onerror='this.src=\"".Config::get('app.url')."assets/img/noimage.png\"'>";
      echo "<span class='site-badge {$site}'>{$this->sites[$site]}</span>";
      echo "<span class='nuki-badge'><i class='fas fa-tint'></i> {$this->nuki_count('nv'.$id)}</span>";
      echo "</div>";
      echo '<div style="height:5px;"></div>';
      echo "<span class='video-title'>{$title}</span>";
      echo '</a>';
      echo '</li>';
      if($i % 3 == 0){
        echo '<div class="clear"></div><div style="height:20px;"></div>';
      }
      ++$i;
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    echo '<div class="clear"></div></ul></div>';
  }

  public function get_av_data($videoid,$name){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $id = str_replace("nv","",$videoid);
    $sql = "SELECT * FROM videos Where `index` = {$id};";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    $i=1;
    while ($row = $result->fetch_assoc()) {
      return $row["{$name}"];
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
  }

  public function get_actress_data($id,$name){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM actress Where `index` = {$id};";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    $i=1;
    while ($row = $result->fetch_assoc()) {
      if($row['pics'] == ""){
        $row['pics'] = Config::get('app.url')."assets/img/noimage.png";
      }else{
        $row['pics'] = str_replace("http://","//",$row['pics']);
      }
      return $row["{$name}"];
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
  }

  public function get_av($search_url = ''){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }

    $sql = "SELECT * FROM videos Where `index` = {$search_url};";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    $i=1;
    while ($row = $result->fetch_assoc()) {
      $this->videoInfo['url'] = $row['url'];
      $this->videoInfo['id'] = 'nv'.$row['index'];
      $this->videoInfo['title'] = $row['title'];
      $this->videoInfo['description'] = $row['description'];
      $this->videoInfo['thumbnail'] = $row['thumbnail'];
      $this->videoInfo['movie'] = $row['movie'];
      $this->videoInfo['datetime'] = $row['datetime'];
      $this->videoInfo['tags'] = $row['tags'];
      $this->videoInfo['actress'] = $row['actress'];
      $this->videoInfo['site'] = $row['site'];
      $this->videoInfo['userid'] = $row['userid'];
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
  }

  public function user_count(){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }

    $sql = "SELECT * FROM users;";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $count;
  }

  public function all_follow_count(){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }

    $sql = "SELECT MAX( `index` ) as mx FROM follow;";
    if ($result = $mysqli->query($sql)) {
      $row = $result->fetch_assoc();
      $count = $row['mx'];
      $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $count;
  }

  public function actress_count(){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM actress;";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return number_format($count);
  }

  public function av_count($type="all"){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    if($type == "all"){
      $sql = "SELECT * FROM videos;";
    }else if($type == "no-delete"){
      $sql = "SELECT * FROM videos where `deleted` != 1;";
    }
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return number_format($count);
  }

  public function play_count($videoid="all"){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    if($videoid == "all"){
      $sql = "SELECT * FROM play_log;";
    }else{
      $sql = "SELECT * FROM play_log where `videoid` = '{$videoid}';";
    }
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return number_format($count);
  }

  public function play_user_count($userid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
      $sql = "SELECT * FROM play_log where `userid` = '{$userid}';";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return number_format($count);
  }

  public function nuki_count($videoid="all"){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    if($videoid == "all"){
      $sql = "SELECT * FROM nuketa;";
    }else{
      $sql = "SELECT * FROM nuketa where `videoid` = '{$videoid}';";
    }
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return number_format($count);
  }

  public function video_user_count($userid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM videos where `userid` = '{$userid}';";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return number_format($count);
  }

  public function convert_to_fuzzy_time($time_db){
    $unix   = strtotime($time_db);
    $now    = time();
    $diff_sec   = $now - $unix;

    if($diff_sec < 60){
        $time   = $diff_sec;
        $unit   = "秒前";
    }
    elseif($diff_sec < 3600){
        $time   = $diff_sec/60;
        $unit   = "分前";
    }
    elseif($diff_sec < 86400){
        $time   = $diff_sec/3600;
        $unit   = "時間前";
    }
    elseif($diff_sec < 2764800){
        $time   = $diff_sec/86400;
        $unit   = "日前";
    }
    else{
        if(date("Y") != date("Y", $unix)){
            $time   = date("Y年n月j日", $unix);
        }
        else{
            $time   = date("n月j日", $unix);
        }

        return $time;
    }

    return (int)$time .$unit;
  }

  public function message_get_count($userid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM messages where `to` = '{$userid}';";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return number_format($count);
  }

  public function message_get_contents($userid){
      $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
      if ($mysqli->connect_error) {
      echo $mysqli->connect_error;
      exit();
      } else {
      $mysqli->set_charset("utf8");
      }
      $sql = "SELECT * FROM messages where `to`='{$userid}' ORDER BY datetime DESC;";
      if ($result = $mysqli->query($sql)) {
      // 連想配列を取得
      $i=1;
      while ($row = $result->fetch_assoc()) {
        echo '
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="row">
            <div class="col-2"><img src="'.$this->userinfo($row['from'],'profile_icon').'" class="w-100 rounded-circle"></div>
            <div class="col-10">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">'.$this->userinfo($row['from'],'name').'</h5>
                <small>'.$this->convert_to_fuzzy_time($row['datetime']).'</small>
              </div>
              <p class="mb-1">'.$row['body'].'</p>
            </div>
          </div>
        </a>';
      }
      // 結果セットを閉じる
      $result->close();
      }
      // DB接続を閉じる
      $mysqli->close();
      echo '<div class="clear"></div>
    </ul>
  </div>';
  }

  public function nuki_user_count($userid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM nuketa where `userid` = '{$userid}';";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return number_format($count);
  }

  public function mylist_count($videoid="all"){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    if($videoid == "all"){
      $sql = "SELECT * FROM mylist;";
    }else{
      $sql = "SELECT * FROM mylist where `videoid` = '{$videoid}';";
    }
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return number_format($count);
  }

  public function post_count($userid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM videos where `userid` = '{$userid}';";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return number_format($count);
  }

  public function follow_count($userid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM follow where `from` = '{$userid}';";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return number_format($count);
  }

  public function follower_count($userid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM follow where `to` = '{$userid}';";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return number_format($count);
  }

  public function follow_check($userid1,$userid2){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM follow where `from` = '{$userid1}' and `to` = '{$userid2}';";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return number_format($count);
  }

  public function unfollow($myid,$userid){
      $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
      if ($mysqli->connect_error) {
      echo $mysqli->connect_error;
      exit();
      } else {
      $mysqli->set_charset("utf8");
      }
      $sql = "DELETE FROM follow where `from` = '{$myid}' and `to` = '{$userid}';";
      $res = $mysqli->query($sql);
      $mysqli->close();
      return $res;
  }

  public function follow($myid,$userid){
    if($this->follow_check($myid,$userid) == 0){
      $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
      if ($mysqli->connect_error) {
      echo $mysqli->connect_error;
      exit();
      } else {
      $mysqli->set_charset("utf8");
      }
      $index = $this->all_follow_count()+1;
      $sql = "insert into `follow` (`index`,`from`,`to`) values ('{$index}','{$myid}','{$userid}');";
      if( $mysqli->query( $sql ) ) {
      }
      $mysqli->close();
      return $index;
    }
  }

  public function get_follow_list($userid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }

    $sql = "SELECT * FROM follow where `from` = '{$userid}';";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    $i=1;
    $follow_list = array();
    while ($row = $result->fetch_assoc()) {
      array_push($follow_list,$row);
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $follow_list;
  }

  public function get_follower_list($userid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }

    $sql = "SELECT * FROM follow where `to` = '{$userid}';";
    if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    $i=1;
    $follow_list = array();
    while ($row = $result->fetch_assoc()) {
      array_push($follow_list,$row);
    }
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return $follow_list;
  }

  public function mylist_user_count($userid){
    $mysqli = new mysqli(Config::get('app.mysql_address'), Config::get('app.mysql_userid'), Config::get('app.mysql_passwd'), Config::get('app.mysql_dbname'));
    if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
    } else {
    $mysqli->set_charset("utf8");
    }
    $sql = "SELECT * FROM mylist where `userid` = '{$userid}';";
    if ($result = $mysqli->query($sql)) {
    $count = $result->num_rows;
    // 結果セットを閉じる
    $result->close();
    }
    // DB接続を閉じる
    $mysqli->close();
    return number_format($count);
  }
}
