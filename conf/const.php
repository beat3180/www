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
