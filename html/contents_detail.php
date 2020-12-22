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

//index_view.phpからPOSTで飛んできた特定の$tokenの情報を変数で出力
$token = get_post('csrf');

//CSRF対策のトークンのチェック
//if(is_valid_csrf_token($token) === false){
  // header関数処理を実行し、login.phpページへリダイレクトする
  //redirect_to(LOGOUT_URL);
//}

//DB接続
$db = get_db_connect();

//CSRFトークンの生成、セッションに登録する
$token = get_csrf_token();

//$_SESSION['user_id']でDBusersテーブルから該当するuser_idを抽出し、情報を返す
$user = get_login_user($db);


//index_view.phpからPOSTで飛んできた特定のcontents_idの情報を変数で出力
$contents_id = get_get('contents_id');

//contents_idでDBcontentsテーブルの情報を取得、変数で出力する
$contents = get_content($db,$contents_id);



//定数、/var/www/html/../view/contents_detail_view.phpというドキュメントルートを通り、contents_detail_viewデータを読み取る
include_once VIEW_PATH . 'contents_detail_view.php';
