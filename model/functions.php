<?php

//変数に関する情報をダンプする関数
function dd($var){
  var_dump($var);
  exit();
}

//リダイレクト用の関数
function redirect_to($url){
  header('Location: ' . $url);
  exit;
}

//htmlエスケープ用の関数
function h($s){
	return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

//グローバル変数GETからの情報を取得する関数
function get_get($name){
   //isset関数でGETの情報が入っていることを確認する
  if(isset($_GET[$name]) === true){
    //GETの情報を返す
    return $_GET[$name];
  };
  //GET情報が入っていなかった場合、nullを返している？
  return '';
}

//グローバル変数POSTからの情報を取得する関数
function get_post($name){
  //isset関数でPOSTの情報が入っていることを確認する
  if(isset($_POST[$name]) === true){
    //POSTの情報を返す
    return $_POST[$name];
  };
  //POST情報が入っていなかった場合、nullを返している？
  return '';
}

//グローバル変数FILESで受け取ったファイルを連粗配列にして返す関数
function get_file($name){
  //グローバル変数FILESで受け取ったファイルが入っているか確認する
  if(isset($_FILES[$name]) === true){
    //ファイルの名前を返す
    return $_FILES[$name];
  }
  //$_FILESを連想配列にして返す
  return array();
}

//セッションが存在しているか確認。あればセッションを返し、なければNULLを返す
function get_session($name){
  if(isset($_SESSION[$name]) === true){
    return $_SESSION[$name];
  };
  return '';
}

//セッション名と値を設定する
function set_session($name, $value){
  $_SESSION[$name] = $value;
}

//$_SESSION['__errors'][]にエラーメッセージを格納する
function set_error($error){
  $_SESSION['__errors'][] = $error;
}

//セッションを取得し、無ければNULLを返し、あれば情報を変数で返す
function get_errors(){
  //セッションを取得しつつ、変数に出力する
  $errors = get_session('__errors');
  //変数が空の場合
  if($errors === ''){
    //空の配列を返す
    return array();
  }
  //セッション名を設定し、空の配列の値を設定する
  set_session('__errors',  array());
  //取得していたセッションの変数を返す
  return $errors;
}

//エラーが一つ以上あった場合trueを返す
function has_error(){
  return isset($_SESSION['__errors']) && count($_SESSION['__errors']) !== 0;
}

//$_SESSION['__messages'][]の配列にメッセージを格納する
function set_message($message){
  $_SESSION['__messages'][] = $message;
}

//セッションを取得し、無ければNULLを返し、あれば情報を変数で返す
function get_messages(){
  //セッションを取得しつつ、変数に出力する
  $messages = get_session('__messages');
   //変数が空の場合
  if($messages === ''){
    //空の配列を返す
    return array();
  }
   //セッション名を設定し、空の配列の値を設定する
  set_session('__messages',  array());
  //取得していたセッションの変数を返す
  return $messages;
}

//セッションuser_idが入っていることを確認する
function is_logined(){
  return get_session('user_id') !== '';
}

//画像ファイルがアップロードされた時の関数の処理
function get_upload_filename($file){
  //アップロードされた画像ファイルが正しいものでない場合
  if(is_valid_upload_image($file) === false){
    //NULLを返す
    return '';
  }

  //画像ファイルかどうか確認し、変数で出力する
  $mimetype = exif_imagetype($file['tmp_name']);
  //定数で定められた拡張子を挿入する
  $ext = PERMITTED_IMAGE_TYPES[$mimetype];
  //ランダムでユニークな文字列が作られ、ファイル名となって返す
  return get_random_string() . '.' . $ext;
}

//ランダムでユニークな文字列を作る関数
function get_random_string($length = 20){
  return substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, $length);
}

//一時フォルダに保存していた画像ファイルをimagesフォルダに移動させる関数
function save_image($image, $filename){
  return move_uploaded_file($image['tmp_name'], IMAGE_DIR . $filename);
}

//特定の画像を探し、削除する関数
function delete_image($filename){
  //ファイルまたはディレクトリが存在するか調べる関数、imageフォルダまでのドキュメントルートを繋げる定数
  if(file_exists(IMAGE_DIR . $filename) === true){
    //ファイルを削除する関数
    unlink(IMAGE_DIR . $filename);
    return true;
  }
  return false;

}


//最小文字数から最大文字数の範囲を設定する関数
function is_valid_length($string, $minimum_length, $maximum_length = PHP_INT_MAX){
  //文字列の長さを取得する関数
  $length = mb_strlen($string);
  //最小文字数以上かつ、最大文字数以下という文字数の設定を返す
  return ($minimum_length <= $length) && ($length <= $maximum_length);
}

//正規表現のマッチングを設定する関数。文字列の先頭から末尾まで1文字以上のアルファベットのaからzとAからZ、数字の0から9で直前の文字が1回以上の繰り返しで構成されているということ
function is_alphanumeric($string){
  return is_valid_format($string, REGEXP_ALPHANUMERIC);
}

//ユーザー名が既にあった場合、falseを返す
function is_name_overlap($db,$name){
  //DBusersテーブルから情報を取得し、変数で出力する
  $user = get_user_by_name($db, $name);
  //配列が入っていた場合
  if (is_array($user)) {
     //$userに一つでも値が入っていた場合、falseを返す
    if (count($user) > 0){
      return false;
    }
  }
  return true;
}

//Eメールが既に有った場合、falseを返す
function is_email_overlap($db,$email){
  //DBusersテーブルから情報を取得し、変数で出力する
  $user = get_user_by_email($db, $email);
  //配列が入っていた場合
  if (is_array($user)) {
     //$userに一つでも値が入っていた場合、falseを返す
    if (count($user) > 0){
      return false;
    }
  }
  return true;
}

//正規表現のマッチングを設定する関数。文字列の先頭から末尾まで数字の0から9で直前の文字が0回以上の繰り返しか、0文字で構成されているということ
function is_positive_integer($string){
  return is_valid_format($string, REGEXP_POSITIVE_INTEGER);
}

//正規表現によるマッチングを行う関数
function is_valid_format($string, $format){
  //正規表現とマッチした場合、1を返す
  return preg_match($format, $string) === 1;
}


function is_valid_upload_image($image){
    //POSTでアップロードされたファイルか調べる関数、一時フォルダに保存されたファイルがなにか間違っていた場合
    if(is_uploaded_file($image['tmp_name']) === false){
      //$_SESSION['__errors'][]にファイル形式が不正です。というエラーメッセージを格納する
      set_error('ファイル形式が不正です。');
    //falseを返す
    return false;
  }

  //画像ファイルかどうか拡張子を調べる関数、変数で出力する
  $mimetype = exif_imagetype($image['tmp_name']);
  //定数PERMITTED_IMAGE_TYPESで設定した値と異なる拡張子が入っていた場合
  if( isset(PERMITTED_IMAGE_TYPES[$mimetype]) === false ){
    //$_SESSION['__errors'][]にファイル形式は' . implode('、', PERMITTED_IMAGE_TYPES) . 'のみ利用可能です。というエラーメッセージを格納する。implode関数は配列の文字列を連結、それによりJPG・PNGを表示する
    set_error('ファイル形式は' . implode('、', PERMITTED_IMAGE_TYPES) . 'のみ利用可能です。');
    //falseを返す
    return false;
  }
//問題ない場合trueを返す
return true;
}


//CSRFトークンの生成、セッションに登録する
function get_csrf_token(){
  //CSRF対策の安全安心なトークンを作成
  $token = get_random_string(30);
  set_session('csrf_token', $token);
  return $token;
}

//CSRF対策のトークンのチェック
function is_valid_csrf_token($token){
  if($token === '') {
    return false;
  }
  //セッションの内容を確認し、$tokenと一致しているかチェックする
  return $token === get_session('csrf_token');
}


// ページネーションの数を取得、余った分は切り上げする
function get_pagination($page_num,$max_page = 8){
  return ceil($page_num / $max_page);
}


//GETで現在のページ数を取得する(未入力の場合は1を挿入)
function get_page($get){
  //$_GET[page]が入っているか確認する
  if (isset($_GET['page'])) {
  //$_GETがあればそのまま返す
	return $_GET['page'];
} else {
  //$_GETがなければ1の値を返す
  return 1;
}

}

// スタートのポジションを計算する
function get_page_start($page,$max_page = 8){
  //$_GET[page]が1より大きい場合
  if ($page > 1) {
	  // 例：２ページ目の場合は、『(2 × 8) - 8 = 8』
	  return ($page * $max_page) - $max_page;
  } else {
    //$_GET[page]が1未満の場合、0を返す
	  return 0;
  }

}
