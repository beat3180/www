<?php
//定数ファイルの読み込み
require_once '../conf/const.php';
///var/www/html/../model/functions.phpというドキュメントルートを通り汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
///var/www/html/../model/user.phpというドキュメントルートを通りuserデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'user.php';
///var/www/html/../model/contents.phpというドキュメントルートを通りcontentsデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'contents.php';
///var/www/html/../model/category.phpというドキュメントルートを通りcategoryデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'category.php';

//セッションの開始、作成
session_start();


//CSRFトークンの生成、セッションに登録する
$token = get_csrf_token();

//DB接続
$db = get_db_connect();

//$_SESSION['user_id']でDBusersテーブルから該当するuser_idを抽出し、情報を返す
$user = get_login_user($db);


//DBcontentsテーブルの全ての情報を取得し、変数で出力する
$contents = get_open_contents($db);



//定数、/var/www/html/../view/index_view.phpというドキュメントルートを通り、index_viewデータを読み取る
include_once VIEW_PATH . 'index_view.php';
