<?php
// 定数ファイルの読み込み
require_once '../conf/const.php';
///var/www/html/../model/functions.phpというドキュメントルートを通り汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
///var/www/html/../model/ccategory.phpというドキュメントルートを通りcategoryデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'category.php';

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


//create_view.phpからPOSTで飛んできた特定のcategoryの情報を変数で出力
$category = get_post('category');

if(regist_category($db, $category)){
  //$_SESSION['__messages'][]に商品を登録しました。というメッセージを格納する
  set_message('カテゴリーを追加しました。');
  //何らかの処理が失敗した場合
}else {
  //$_SESSION['__errors'][]に商品の登録に失敗しました。というメッセージを格納する
  set_error('カテゴリーの追加に失敗しました。');
}

//このページが表示されないよう、admin.phpにリダイレクトする
redirect_to(CREATE_URL);
