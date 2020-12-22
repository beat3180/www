<?php
// 定数ファイルの読み込み
require_once '../conf/const.php';
///var/www/html/../model/functions.phpというドキュメントルートを通り汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
///var/www/html/../model/user.phpというドキュメントルートを通りuserデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'user.php';
///var/www/html/../model/contents.phpというドキュメントルートを通りcontentsデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'contents.php';

//セッションの開始、作成
session_start();

//(isset($_SESSION['user_id'])を取得しようとして、取得できなかった場合TRUEを返す
if(is_logined() === false){
  // header関数処理を実行し、login.phpページへリダイレクトする
  redirect_to(TOP_URL);
}

//admin_view.phpからPOSTで飛んできた特定の$tokenの情報を変数で出力
$token = get_post('csrf');

//CSRF対策のトークンのチェック
if(is_valid_csrf_token($token) === false){
  // header関数処理を実行し、login.phpページへリダイレクトする
  redirect_to(LOGOUT_URL);
}

//DB接続
$db = get_db_connect();

//$_SESSION['user_id']でDBusersテーブルから該当するuser_idを抽出し、情報を返す
$user = get_login_user($db);
//post_view.phpからPOSTで飛んできた特定のtitleの情報を変数で出力
$title = get_post('title');
//post_view.phpからPOSTで飛んできた特定のcategoryの情報を変数で出力
$category_id = get_post('category_id');
//post_view.phpからPOSTで飛んできた特定のstatusの情報を変数で出力
$status = get_post('status');
//post_view.phpからPOSTで飛んできた特定のcontentsの情報を変数で出力
$contents = get_post('contents');

//view_post.phpから飛んできたimageをグローバル変数FILESに配列として格納し、変数で出力する
$image = get_file('image');

//出力された変数を引数として用い、さまざまな処理を通して商品を登録する
if(regist_contents($db, $title, $category_id, $status, $contents,$user['user_id'], $image)){
   //$_SESSION['__messages'][]に商品を登録しました。というメッセージを格納する
  set_message('記事を投稿しました。');
  //何らかの処理が失敗した場合
}else {
  //$_SESSION['__errors'][]に商品の登録に失敗しました。というメッセージを格納する
  set_error('記事の投稿に失敗しました。');
}

//このページが表示されないよう、admin.phpにリダイレクトする
redirect_to(POST_URL);
