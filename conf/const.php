<?php
//クリックジャッキング対策
header('X-FRAME-OPTIONS: DENY');
//定数、/var/www/html/というドキュメントルートを取得し、../model/というドキュメントルートに繋げる。
define('MODEL_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../model/');
//定数、/var/www/html/というドキュメントルートを取得し、../view/というドキュメントルートに繋げる
define('VIEW_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../view/');



//定数、/assets/images/というドキュメントルートを取得する
define('IMAGE_PATH', '/assets/images/');
//定数、/assets/css/というドキュメントルートを取得する
define('STYLESHEET_PATH', '/assets/css/');
//定数、/var/www/html/というドキュメントルートを取得し、/assets/images/というドキュメントルートに繋げる。
define('IMAGE_DIR', $_SERVER['DOCUMENT_ROOT'] . '/assets/images/' );
//Mysqlのホスト名
define('DB_HOST', 'mysql');
//Mysqlのデータベース名
define('DB_NAME', 'sample');
//Mysqlのユーザー名
define('DB_USER', 'testuser');
//Mysqlのパスワード
define('DB_PASS', 'password');
//Mysqlの文字セット
define('DB_CHARSET', 'utf8');

//top.phpのドキュメントルート
define('TOP_URL', '/top.php');
//signup.phpのドキュメントルート
define('SIGNUP_URL', '/signup.php');
//login.phpのドキュメントルート
define('LOGIN_URL', '/login.php');
//logout.phpのドキュメントルート
define('LOGOUT_URL', '/logout.php');
//index.phpのドキュメントルート
define('HOME_URL', '/index.php');
//cart.phpのドキュメントルート
define('CART_URL', '/cart.php');
//finish.phpのドキュメントルート
define('FINISH_URL', '/finish.php');
//history.phpのドキュメントルート
define('HISTORY_URL', '/history.php');
//post.phpのドキュメントルート
define('POST_URL', '/post.php');
//create.phpのドキュメントルート
define('CREATE_URL', '/create.php');
//admin_contents.phpのドキュメントルート
define('ADMIN_CONTENTS_URL', '/admin_contents.php');
//create.phpのドキュメントルート
define('CONTENTS_DETAIL_URL', '/contents_detail.php?contents_id=' . print($contents_id) );
//user_contents.phpのドキュメントルート
define('USER_CONTENTS_URL', '/user_contents.php');
//admin.phpのドキュメントルート
define('ADMIN_URL', '/admin.php');

//正規表現、文字列の先頭から末尾まで1文字以上のアルファベットのaからzとAからZ、数字の0から9で直前の文字が1回以上の繰り返しで構成されているということ
define('REGEXP_ALPHANUMERIC', '/\A[0-9a-zA-Z]+\z/');
//正規表現、文字列の先頭から末尾まで数字の0から9で直前の文字が0回以上の繰り返しか、0文字で構成されているということ
define('REGEXP_POSITIVE_INTEGER', '/\A([1-9][0-9]*|0)\z/');


//ユーザー名の長さが6文字以上
define('USER_NAME_LENGTH_MIN', 6);
//ユーザー名の長さが100文字以下
define('USER_NAME_LENGTH_MAX', 100);
//パスワードの長さが6文字以上
define('USER_PASSWORD_LENGTH_MIN', 6);
//パスワードの長さが100文字以下
define('USER_PASSWORD_LENGTH_MAX', 100);

//DBusersテーブル、typeカラム1
define('USER_TYPE_ADMIN', 1);
//DBusersテーブル、typeカラム2
define('USER_TYPE_NORMAL', 2);

//タイトルの長さが一文字以上
define('TITLE_NAME_LENGTH_MIN', 1);
//タイトルの長さが100文字以下
define('TITLE_NAME_LENGTH_MAX', 100);
//カテゴリーの長さが一文字以上
define('CATEGORY_NAME_LENGTH_MIN', 1);
//カテゴリーの長さが100文字以下
define('CATEGORY_NAME_LENGTH_MAX', 100);
//コンテンツの長さが10文字以上
define('CONTENTS_LENGTH_MIN', 10);
//コンテンツの長さが1500文字以下
define('CONTENTS_LENGTH_MAX', 1500);

//DBcontentsテーブル、statusカラム1
define('CONTENTS_STATUS_OPEN', 1);
//DBcontentsテーブル、statusカラム0
define('CONTENTS_STATUS_CLOSE', 0);

//コンテンツステータスを設定する定数、連想配列でキーがopenの場合1の値が入り、キーがcloseの場合0の値が入る
define('PERMITTED_CONTENTS_STATUSES', array(
  'open' => 1,
  'close' => 0,
));

//画像ファイルの拡張子を確認する
define('PERMITTED_IMAGE_TYPES', array(
  IMAGETYPE_JPEG => 'jpg',
  IMAGETYPE_PNG => 'png',
));
