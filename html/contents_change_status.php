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

//$_SESSION['user_id']を取得する
$user = get_login_user($db);

//view.phpからPOSTで飛んできた特定のcontents_idの情報を変数で出力
$contents_id = get_post('contents_id');
//view.phpからPOSTで飛んできた特定のchanges_toの情報を変数で出力する
$changes_to = get_post('changes_to');

//changes_toで出力された情報がopenの場合
if($changes_to === 'open'){
//DBitemsテーブル、statusカラムをアップデート。CONTENTS_STATUS_OPENは1
  update_contents_status($db, $contents_id, CONTENTS_STATUS_OPEN);
  //$_SESSION['__messages'][]にステータスを変更しました。というメッセージを格納する
  set_message('ステータスを変更しました。');
  //changes_toで出力された情報がcloseの場合
}else if($changes_to === 'close'){
  //DBitemsテーブル、statusカラムをアップデート。CONTENTS_STATUS_CLOSEは0
  update_contents_status($db, $contents_id, CONTENTS_STATUS_CLOSE);
  //$_SESSION['__messages'][]にステータスを変更しました。というメッセージを格納する
  set_message('ステータスを変更しました。');
  //changes_toで出力された情報がopenでもcloseでもない場合
}else {
  //$_SESSION['__errors'][]に不正なリクエストです。というエラーメッセージを格納する
  set_error('不正なリクエストです。');
}


$contents_detail_change_status = get_post('contents_detail_change_status');

$admin_contents_change_status = get_post('admin_contents_change_status');

if($contents_detail_change_status === "contents_detail_change_status"){
  //このページが表示されないよう、contents_datail.phpにリダイレクトする
  redirect_to('/contents_detail.php?contents_id=' . $contents_id);
} else if($admin_contents_change_status === "admin_contents_change_status"){
  //このページが表示されないよう、admin_contents.phpにリダイレクトする
  redirect_to(ADMIN_CONTENTS_URL);
} else {
  //このページが表示されないよう、user_contents.phpにリダイレクトする
  redirect_to(USER_CONTENTS_URL);
}
