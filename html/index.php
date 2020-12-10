<?php
//定数ファイルの読み込み
require_once '../conf/const.php';


//セッションの開始、作成
session_start();





//定数、/var/www/html/../view/index_view.phpというドキュメントルートを通り、index_viewデータを読み取る
include_once VIEW_PATH . 'index_view.php';
