<?php
//定数ファイルの読み込み
require_once '../conf/const.php';
///var/www/html/../model/functions.phpというドキュメントルートを通り汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
///var/www/html/../model/user.phpというドキュメントルートを通りuserデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'user.php';

//セッションの開始、作成
session_start();

//(isset($_SESSION['user_id'])を取得できた場合TRUEを返す
if(is_logined() === true){
  //セッションidを再発行
   session_regenerate_id(TRUE);
  // header関数処理を実行し、index.phpページへリダイレクトする
  redirect_to(HOME_URL);
}

//login_view.phpからPOSTで飛んできた特定の$tokenの情報を変数で出力
$token = get_post('csrf');

//CSRF対策のトークンのチェック
if(is_valid_csrf_token($token) === false){
  // header関数処理を実行し、login.phpページへリダイレクトする
  redirect_to(LOGOUT_URL);
}

//login_view.phpから飛んできたname情報を変数で出力する
$name = get_post('name');
//login_view.phpから飛んできたpassword情報を変数で出力する
$password = get_post('password');

//DB接続
$db = get_db_connect();


//入力された情報を照合しuser_idをセッションに登録、返ってきた情報を変数で出力する
$user = login_as($db, $name, $password);
//ユーザー情報が間違っていた場合、login.phpにリダイレクトする
if( $user === false){
  set_error('ログインに失敗しました。');
  redirect_to(LOGIN_URL);
}


set_message('ログインしました。');
//管理者typeに一致した場合、admin_contents.phpへリダイレクトする
if ($user['type'] === USER_TYPE_ADMIN){
  redirect_to(ADMIN_CONTENTS_URL);
}
//一般ユーザーとしてログインに成功した場合、index.phpにリダイレクトする
redirect_to(HOME_URL);
