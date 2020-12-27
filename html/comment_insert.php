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
///var/www/html/../model/comment.phpというドキュメントルートを通りcommentデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'comment.php';

//セッションの開始、作成
session_start();

//(isset($_SESSION['user_id'])を取得しようとして、取得できなかった場合TRUEを返す
if(is_logined() === false){
  // header関数処理を実行し、login.phpページへリダイレクトする
  redirect_to_(TOP_URL);
}

//index_view.phpからPOSTで飛んできた特定の$tokenの情報を変数で出力
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

$contents_id = get_post('contents_id');

$comment = get_post('comment');

if(regist_comment($db,$user['user_id'],$contents_id,$comment)){
  //$_SESSION['__messages'][]に商品を登録しました。というメッセージを格納する
  set_message('コメントを投稿しました。');
  //何らかの処理が失敗した場合
}else {
  //$_SESSION['__errors'][]に商品の登録に失敗しました。というメッセージを格納する
  set_error('コメントの投稿に失敗しました。');
}



//このページが表示されないよう、contents_datail.phpにリダイレクトする
redirect_to('/contents_detail.php?contents_id=' . $contents_id);
