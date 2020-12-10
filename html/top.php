<?php
//定数ファイルの読み込み
require_once '../conf/const.php';


//セッションの開始、作成
session_start();





//定数、/var/www/html/../view/top_view.phpというドキュメントルートを通り、top_viewデータを読み取る
include_once VIEW_PATH . 'top_view.php';
