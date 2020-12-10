<?php
//定数ファイルの読み込み
require_once '../conf/const.php';
///var/www/html/../model/functions.phpというドキュメントルートを通り汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';

//セッションの開始、作成
session_start();

//(isset($_SESSION['user_id'])を取得できた場合TRUEを返す
if(is_logined() === true){
  //セッションidを再発行
   session_regenerate_id(TRUE);
  // header関数処理を実行し、index.phpページへリダイレクトする
  redirect_to(HOME_URL);
}

//CSRFトークンの生成、セッションに登録する
$token = get_csrf_token();

//定数、/var/www/html/../view/signup_view.phpというドキュメントルートを通り、signup_viewデータを読み取る
include_once VIEW_PATH . 'signup_view.php';
