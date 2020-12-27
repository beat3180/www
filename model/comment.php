<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

// DB利用

function get_comment($db, $comment_id){
  $sql = "
    SELECT
      comment_id,
      user_id,
      contents_id,
      comment
    FROM
      comments
    WHERE
      comment_id = ?
  ";
//キーをカラム毎に、値をそれぞれのカラムに充てた配列で取得する。
  return fetch_query($db, $sql,[$comment_id]);
}

function get_comments($db){
  $sql = '
    SELECT
      comments.comment_id,
      comments.user_id,
      comments.contents_id,
      comments.comment,
      comments.created_datetime,
      users.name
    FROM
      comments
    JOIN
      users
    ON
      comments.user_id = users.user_id
  ';
  //キーを連番に、値をカラム毎の配列で取得する。
  return fetch_all_query($db, $sql);
}


//DBcommentsテーブルからcontents_idで該当する情報を抽出し、返す
function get_contents_comments($db, $contents_id){
  $sql = "
    SELECT
      comments.comment_id,
      comments.user_id,
      comments.contents_id,
      comments.comment,
      comments.created_datetime,
      users.name
    FROM
      comments
    JOIN
      users
    ON
      comments.user_id = users.user_id
    WHERE
      contents_id = ?
  ";
//キーを連番に、値をカラム毎の配列で取得する。
  return fetch_all_query($db, $sql,[$contents_id]);
}


function regist_comment($db,$user_id,$contents_id,$comment){
  //エラー関数処理の結果falseが返ってきた場合
  if(validate_comment($comment) === false){
    return false;
  }
  //カテゴリーを登録する関数を返す
  return insert_comment($db,$user_id,$contents_id,$comment);
}


//カテゴリーのエラー処理
function validate_comment($comment){
  $is_valid = true;
  //定数の設定より、タイトルの文字数が1文字以上100文字以下に設定され、それが異なる場合
  if(is_valid_length($comment, COMMENT_LENGTH_MIN, COMMENT_LENGTH_MAX) === false){
    //$_SESSION['__errors'][]に'カテゴリーは'. TITLE_NAME_LENGTH_MIN . '文字以上、' . TITLE_NAME_LENGTH_MAX . '文字以内にしてください。'というメッセージを格納する
    set_error('カテゴリーは'. COMMENT_LENGTH_MIN . '文字以上、' . COMMENT_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  //trueかfalse、if文で分岐させたいずれかの値を返す
  return $is_valid;
}

//categoryをテーブルにインサートする際の処理関数
function insert_comment($db,$user_id,$contents_id,$comment){
  //SQL文の処理
  $sql = "
    INSERT INTO
      comments(
        contents_id,
        user_id,
        comment
      )
    VALUES(?,?,?);
  ";

  //実行した結果を返す
  return execute_query($db, $sql,[$contents_id,$user_id,$comment]);
}


function destroy_comment($db, $comment_id){
  $comment = get_comment($db, $comment_id);
  if($comment === false){
    return false;
  }
  if(delete_comment($db, $comment['comment_id'])){
    //trueを返す
    return true;
  }
  return false;
}


function delete_comment($db, $comment_id){
  $sql = "
    DELETE FROM
      comments
    WHERE
      comment_id = ?
    LIMIT 1
  ";

  //実行した結果を返す
  return execute_query($db, $sql,[$comment_id]);
}
