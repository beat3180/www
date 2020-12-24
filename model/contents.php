<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

// DB利用

//DBcontentsテーブルからcontents_idで該当する情報を抽出し、返す
function get_content($db, $contents_id){
  $sql = "
    SELECT
      contents.contents_id,
      contents.title,
      contents.contents,
      contents.user_id,
      contents.image,
      contents.status,
      contents.category_id,
      contents.created_datetime,
      categorys.category,
      users.name,
      users.type
    FROM
      contents
    JOIN
      categorys
    ON
      contents.category_id = categorys.category_id
    JOIN
     users
    ON
      contents.user_id = users.user_id
    WHERE
      contents_id = ?
  ";
//キーをカラム毎に、値をそれぞれのカラムに充てた配列で取得する。
  return fetch_query($db, $sql,[$contents_id]);
}


//DBcontentsテーブルからcontents_idで該当する情報を抽出し、返す
function get_user_contents($db, $user_id){
  $sql = "
    SELECT
      contents.contents_id,
      contents.title,
      contents.contents,
      contents.user_id,
      contents.image,
      contents.status,
      contents.category_id,
      contents.created_datetime,
      categorys.category,
      users.name,
      users.type
    FROM
      contents
    JOIN
      categorys
    ON
      contents.category_id = categorys.category_id
    JOIN
     users
    ON
      contents.user_id = users.user_id
    WHERE
      users.user_id = ?
  ";
//キーを連番に、値をカラム毎の配列で取得する。
  return fetch_all_query($db, $sql,[$user_id]);
}



//contentsの情報を全て開示する
function get_contents($db,$is_open = false){
  $sql = '
    SELECT
      contents.contents_id,
      contents.title,
      contents.contents,
      contents.user_id,
      contents.image,
      contents.status,
      contents.category_id,
      contents.created_datetime,
      categorys.category,
      users.name,
      users.type
    FROM
      contents
    JOIN
      categorys
    ON
      contents.category_id = categorys.category_id
    JOIN
     users
    ON
      contents.user_id = users.user_id
  ';
  //trueの引数が入っていた場合、ステータス1のみ開示する
  if($is_open === true){
    $sql .= '
      WHERE status = 1
  ';
  }
  //キーを連番に、値をカラム毎の配列で取得する。
  return fetch_all_query($db, $sql);
}


//DBitemsテーブルのステータスに関わらず全ての情報を開示する
function get_all_contents($db){
  return get_contents($db);
}

//DBitemsテーブルのステータス1=openのみの情報を開示する
function get_open_contents($db){
  return get_contents($db,true);
}

//画像ファイルの処理やエラー処理を通し、最終的に商品を登録する
function regist_contents($db, $title, $category_id, $status, $contents,$user_id, $image=null){

  if($image !== null){
    //画像ファイルがアップロードされた時の関数の処理
    $filename = get_upload_filename($image);
  }
  //エラー関数処理の結果falseが返ってきた場合
  if(validate_contents($title, $status, $contents) === false){
    return false;
  }
  //トランザクションを絡めて商品を登録する関数を返す
  return regist_contents_transaction($db, $title, $category_id, $status, $contents, $user_id, $image, $filename);
}

//トランザクションを絡めて商品を登録する関数
function regist_contents_transaction($db, $title, $category_id, $status, $contents, $user_id, $image, $filename){
  //トランザクションを開始
  $db->beginTransaction();
  //アイテムをインサートする際の処理関数かつ、アップロードした画像ファイルをimagesフォルダに移動させる関数
  if(insert_contents($db, $user_id,$category_id,$title,$contents,$filename,$status)){
    if($image !== null){
      save_image($image, $filename);
    }
    //結果をコミットする
    $db->commit();
    //trueを返す
    return true;
  }
  //失敗した場合ロールバックする
  $db->rollback();
  //falseを返す
  return false;

}

//商品をcontentsテーブルにインサートする際の処理関数
function insert_contents($db, $user_id,$category_id,$title,$contents,$filename,$status){
  //定数のキーと受け取ったステータスの値が一致した情報を変数で出力
  $status_value = PERMITTED_CONTENTS_STATUSES[$status];
  //SQL文の処理
  $sql = "
    INSERT INTO
      contents(
        user_id,
        category_id,
        title,
        contents,
        image,
        status
      )
    VALUES(?,?,?,?,?,?);
  ";
  //実行した結果を返す
  return execute_query($db, $sql,[$user_id,$category_id,$title,$contents,$filename,$status_value]);
}

//DBitemsテーブル、item_idで抽出した該当のstatusをアップデートし、情報を返す
function update_contents_status($db, $contents_id, $status){
  $sql = "
    UPDATE
      contents
    SET
      status = ?
    WHERE
      contents_id = ?
    LIMIT 1
  ";

  //実行した結果を返す
  return execute_query($db, $sql,[$status,$contents_id]);
}

//DBitemsテーブル、item_idで抽出した該当のstockをアップデートし、情報を返す
function update_item_stock($db, $item_id, $stock){
  $sql = "
    UPDATE
      items
    SET
      stock = ?
    WHERE
      item_id = ?
    LIMIT 1
  ";
//実行した結果を返す
  return execute_query($db, $sql,[$stock,$item_id]);
}

//DBcontentsテーブル、contents_idで抽出した該当のカラムを抽出し、デリートする
function destroy_contents($db, $contents_id){
//特定のcontents_idでDBから情報を抽出する
  $contents = get_content($db, $contents_id);
  //contents情報を抽出できなかった場合、falseを返す
  if($contents === false){
    return false;
  }
  //トランザクションを開始する
  $db->beginTransaction();
//抽出したcontents_idによってcontentsを削除し、画像も削除する
  if(delete_contents($db, $contents['contents_id'])){
    if($content['image'] !== null){
      delete_image($contents['image']);
    }
      //結果をコミットする
    $db->commit();
    //trueを返す
    return true;
  }
  //処理が失敗した場合ロールバックする
  $db->rollback();
  return false;
}

//DBitemsテーブルから特定のitem_idで抽出したカラムをデリートするSQL文
function delete_contents($db, $contents_id){
  $sql = "
    DELETE FROM
      contents
    WHERE
      contents_id = ?
    LIMIT 1
  ";

  //実行した結果を返す
  return execute_query($db, $sql,[$contents_id]);
}


// 非DB

//商品のステータスが1=openであるものを返す
function is_open($contents){
  return $contents['status'] === 1;
}

//エラー処理をまとめた関数
function validate_contents($title, $status, $contents){
  //それぞれの関数処理の結果を変数で出力する
  $is_valid_contents_title = is_valid_contents_title($title);
  $is_valid_contents_status = is_valid_contents_status($status);
  $is_valid_contents = is_valid_contents($contents);

  //変数の結果を返す
  return $is_valid_contents_title
    && $is_valid_contents_status
    && $is_valid_contents;
}

//タイトル関連のエラー処理
function is_valid_contents_title($title){
  $is_valid = true;
  //定数の設定より、タイトルの文字数が1文字以上100文字以下に設定され、それが異なる場合
  if(is_valid_length($title, TITLE_NAME_LENGTH_MIN, TITLE_NAME_LENGTH_MAX) === false){
    //$_SESSION['__errors'][]に'タイトルは'. TITLE_NAME_LENGTH_MIN . '文字以上、' . TITLE_NAME_LENGTH_MAX . '文字以内にしてください。'というメッセージを格納する
    set_error('タイトルは'. TITLE_NAME_LENGTH_MIN . '文字以上、' . TITLE_NAME_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  //trueかfalse、if文で分岐させたいずれかの値を返す
  return $is_valid;
}

//ステータスのエラー処理
function is_valid_contents_status($status){
  $is_valid = true;
  //ステータスの値と定数が一致しない場合
  if(isset(PERMITTED_CONTENTS_STATUSES[$status]) === false){
    $is_valid = false;
  }
  //trueかfalse、if文で分岐させたいずれかの値を返す
  return $is_valid;
}

//画像ファイルのバリデーション処理
function is_valid_contents_filename($filename){
  $is_valid = true;
  //ファイルに何も入っていない場合
  if($filename === ''){
    $is_valid = false;
  }
   //trueかfalse、if文で分岐させたいずれかの値を返す
  return $is_valid;
}

//記事のバリデーション処理
function is_valid_contents($contents){
  $is_valid = true;
  //定数の設定より、コンテンツの文字数が10文字以上1500文字以下に設定され、それが異なる場合
  if(is_valid_length($contents, CONTENTS_LENGTH_MIN, CONTENTS_LENGTH_MAX) === false){
    //$_SESSION['__errors'][]に'コンテンツは'. TITLE_NAME_LENGTH_MIN . '文字以上、' . TITLE_NAME_LENGTH_MAX . '文字以内にしてください。'というメッセージを格納する
    set_error('コンテンツは'. CONTENTS_LENGTH_MIN . '文字以上、' . CONTENTS_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  //trueかfalse、if文で分岐させたいずれかの値を返す
  return $is_valid;
}
