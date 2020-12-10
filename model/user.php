<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

//DBusersテーブルからuser_idを用いて情報を抽出する
function get_user($db, $user_id){
  $sql = "
    SELECT
      user_id,
      name,
      email,
      password,
      type
    FROM
      users
    WHERE
      user_id = ?
    LIMIT 1
  ";
//キーをカラム毎に、値をそれぞれのカラムに充てた配列で取得する。
  return fetch_query($db, $sql,[$user_id]);
}

//DBusersテーブルにある情報を特定のnameで抽出し、取得する
function get_user_by_name($db, $name){
  $sql = "
    SELECT
      user_id,
      name,
      email,
      password,
      type
    FROM
      users
    WHERE
      name = ?
    LIMIT 1
  ";

//キーをカラム毎に、値をそれぞれのカラムに充てた配列で取得する。
  return fetch_query($db, $sql,[$name]);
}

//DBusersテーブルにある情報を特定のemailで抽出し、取得する
function get_user_by_email($db, $email){
  $sql = "
    SELECT
      user_id,
      name,
      email,
      password,
      type
    FROM
      users
    WHERE
      email = ?
    LIMIT 1
  ";

//キーをカラム毎に、値をそれぞれのカラムに充てた配列で取得する。
  return fetch_query($db, $sql,[$email]);
}


//入力された情報をDBuserテーブルと照合、user_idをセッションに登録しユーザー情報を返す関数
function login_as($db, $name, $password){
  //抽出したuser情報を変数として出力する
  $user = get_user_by_name($db, $name);
  //ユーザー情報が間違っていたか、パスワードが間違っていた場合
  if($user === false || password_verify($password, $user['password']) === false){
    //falseを返す
    return false;
  }
  //user_idをセッションに設定する
  set_session('user_id', $user['user_id']);
  //セッションidを再発行
   session_regenerate_id(TRUE);
  //ユーザー情報を返す
  return $user;
}

 //$_SESSION['user_id']でDBusersテーブルから該当するuser_idを抽出し、情報を返す
function get_login_user($db){
  //$_SESSION['user_id']を変数として出力する
  $login_user_id = get_session('user_id');
//DBuserテーブルからuser_idを用いて該当する情報を返す
  return get_user($db, $login_user_id);
}


//ユーザー名とパスワードのエラー処理を行い、間違っていた場合falseを返す.。間違っていなかった場合DBuserテーブルにユーザー名とパスワードをインサート
function regist_user($db, $name, $email, $password, $password_confirmation) {
  if( is_valid_user($db, $name, $email, $password, $password_confirmation) === false){
    return false;
  }

  return insert_user($db, $name, $email, $password);
}

//DBテーブルusers、typeカラムを抽出して返す
function is_admin($user){
  return $user['type'] === USER_TYPE_ADMIN;
}

//ユーザー名とパスワードのエラー処理を行い、結果を返す
function is_valid_user($db,$name, $email, $password, $password_confirmation){
  // 短絡評価を避けるため一旦代入。
  //ユーザー名のエラー処理、結果を変数で出力
  $is_valid_user_name = is_valid_user_name($db,$name);
  //Eメールのエラー処理、結果を変数で出力
  $is_valid_email = is_valid_email($db,$email);
  //パスワードのエラー処理、結果を変数で出力
  $is_valid_password = is_valid_password($password, $password_confirmation);
  //それぞれの結果を返す
  return $is_valid_user_name && $is_valid_password && $is_valid_email;
}

//ユーザー名のエラー処理、最終的な結果を返す
function is_valid_user_name($db, $name){
  $is_valid = true;
  //ユーザー名の長さが6文字以上、100文字以下でない場合
  if(is_valid_length($name, USER_NAME_LENGTH_MIN, USER_NAME_LENGTH_MAX) === false){
    set_error('ユーザー名は'. USER_NAME_LENGTH_MIN . '文字以上、' . USER_NAME_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  //正規表現のマッチングを設定する関数。文字列の先頭から末尾まで1文字以上のアルファベットのaからzとAからZ、数字の0から9で直前の文字が1回以上の繰り返しで構成されているということ
  if(is_alphanumeric($name) === false){
    set_error('ユーザー名は半角英数字で入力してください。');
    $is_valid = false;
  }
  if(is_name_overlap($db,$name) === false){
    set_error('このユーザーは既に登録されています。');
    $is_valid = false;
  }

  //変数を返す
  return $is_valid;
}

//パスワードのエラー処理、最終的な結果を返す
function is_valid_password($password, $password_confirmation){
  $is_valid = true;
  //パスワードの長さが6文字以上、100文字以下でない場合
  if(is_valid_length($password, USER_PASSWORD_LENGTH_MIN, USER_PASSWORD_LENGTH_MAX) === false){
    set_error('パスワードは'. USER_PASSWORD_LENGTH_MIN . '文字以上、' . USER_PASSWORD_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
   //正規表現のマッチングを設定する関数。文字列の先頭から末尾まで1文字以上のアルファベットのaからzとAからZ、数字の0から9で直前の文字が1回以上の繰り返しで構成されているということ
  if(is_alphanumeric($password) === false){
    set_error('パスワードは半角英数字で入力してください。');
    $is_valid = false;
  }
  //パスワードと確認用パスワードを比較
  if($password !== $password_confirmation){
    set_error('パスワードがパスワード(確認用)と一致しません。');
    $is_valid = false;
  }
  //変数を返す
  return $is_valid;
}

//Eメールのエラー処理、最終的な結果を返す
function is_valid_email($db,$email){
  $is_valid = true;
  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    set_error('不正な形式のメールアドレスです。');
    $is_valid = false;
  }
  if(is_email_overlap($db,$email) === false){
    set_error('このEメールは既に登録されています。');
    $is_valid = false;
  }
  //変数を返す
  return $is_valid;
}

//DBusersテーブルにパスワードとユーザー名を登録する
function insert_user($db,$name, $email, $password){
  $sql = "
    INSERT INTO
      users(name,email,password)
    VALUES (?,?,?);
  ";
   //取得したパスワード情報をハッシュ化して変数で出力する
  $hash = password_hash($password, PASSWORD_DEFAULT);
  //実行した結果を返す
  return execute_query($db, $sql,[$name,$email,$hash]);
}
