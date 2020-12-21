<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

// DB利用

function get_categorys($db){
  $sql = '
    SELECT
      category_id,
      category
    FROM
      categorys
  ';
  //キーを連番に、値をカラム毎の配列で取得する。
  return fetch_all_query($db, $sql);
}

function get_category($db, $category_id){
  $sql = "
    SELECT
      category_id,
      category
    FROM
      categorys
    WHERE
      category_id = ?
  ";
//キーをカラム毎に、値をそれぞれのカラムに充てた配列で取得する。
  return fetch_query($db, $sql,[$category_id]);
}




function regist_category($db, $category){
  //エラー関数処理の結果falseが返ってきた場合
  if(validate_category($category) === false){
    return false;
  }
  //カテゴリーを登録する関数を返す
  return insert_category($db, $category);
}


//カテゴリーのエラー処理
function validate_category($category){
  $is_valid = true;
  //定数の設定より、タイトルの文字数が1文字以上100文字以下に設定され、それが異なる場合
  if(is_valid_length($category, CATEGORY_NAME_LENGTH_MIN, CATEGORY_NAME_LENGTH_MAX) === false){
    //$_SESSION['__errors'][]に'カテゴリーは'. TITLE_NAME_LENGTH_MIN . '文字以上、' . TITLE_NAME_LENGTH_MAX . '文字以内にしてください。'というメッセージを格納する
    set_error('カテゴリーは'. CATEGORY_NAME_LENGTH_MIN . '文字以上、' . CATEGORY_NAME_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  //trueかfalse、if文で分岐させたいずれかの値を返す
  return $is_valid;
}

//categoryをテーブルにインサートする際の処理関数
function insert_category($db, $category){
  //SQL文の処理
  $sql = "
    INSERT INTO
      categorys(
        category
      )
    VALUES(?);
  ";

  //実行した結果を返す
  return execute_query($db, $sql,[$category]);
}



function destroy_category($db, $category_id){
  $category = get_category($db, $category_id);
  if($category === false){
    return false;
  }
  if(delete_category($db, $category['category_id'])){
    //trueを返す
    return true;
  }
  return false;
}

function delete_category($db, $category_id){
  $sql = "
    DELETE FROM
      categorys
    WHERE
      category_id = ?
    LIMIT 1
  ";

  //実行した結果を返す
  return execute_query($db, $sql,[$category_id]);
}
