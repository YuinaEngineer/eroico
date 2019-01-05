<?php
return [
    'url' => 'https://example.com/',//サービスを稼働させるURL(http or https)
    'service_name' => 'Eroico',//サービスの名前
    'service_keywords' => 'Eroico,アダルトSNS',//meta:keywordsに使用します。
    'service_description' => '危ない広告一切なしの安心・安全なアダルトSNSプラットフォーム',//meta:descriptionおよびOGPに使用します。
    'service_admin' => '',//adminユーザーID(今の所、adminバッジが付与されるだけです。)
    'account_official' => '',//officialユーザーID(今の所、officialバッジが付与されるだけです。)
    'mysql_address' => 'localhost',#mySQLのアドレス
    'mysql_userid' => 'root',#mySQLのユーザーID
    'mysql_passwd' => 'root',#mySQLのパスワード
    'mysql_dbname' => 'eroico',#mySQLのデータベース(空のデータベースを指定してください。)
    'version_num' => '1.0.7',#eroicoの現バージョン(改造した場合は書き換えてください。)
    'version_name' => 'HelenaEngine',#eroicoの現バージョン(改造した場合は書き換えてください。)
];
