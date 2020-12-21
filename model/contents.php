<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

// DB利用

//DBitemsテーブルからitem_idで該当する情報を抽出し、返す
function get_item($db, $item_id){
  $sql = "
    SELECT
      item_id,
      name,
      stock,
      price,
      image,
      status
    FROM
      items
    WHERE
      item_id = ?
  ";
//キーをカラム毎に、値をそれぞれのカラムに充てた配列で取得する。
  return fetch_query($db, $sql,[$item_id]);
}

//DBitemsテーブルにある情報を全て開示する
function get_admin_items($db){
  $sql = '
    SELECT
      item_id,
      name,
      stock,
      price,
      image,
      status
    FROM
      items
  ';
  //キーを連番に、値をカラム毎の配列で取得する。
  return fetch_all_query($db, $sql);
}

//DBitemsテーブルにある情報をstatus=1のみに絞り、8件開示する。デフォルト値は8にする
function get_index_items($db,$start,$max_view = 8){

  $sql = '
    SELECT
      item_id,
      name,
      stock,
      price,
      image,
      status
    FROM
      items
      WHERE
        status = 1
      LIMIT
        ?,?
    ';

//キーを連番に、値をカラム毎の配列で取得する。
  return fetch_all_query($db, $sql,[$start,$max_view]);
}

//DBitemsテーブルのステータスに関わらず全ての情報を開示する
function get_all_items($db){
  return get_items($db);
}

//DBitemsテーブルのステータス1=openのみの情報を開示する
function get_open_items($db){
  return get_items($db,true,$start);
}

//画像ファイルの処理やエラー処理を通し、最終的に商品を登録する
function regist_contents($db, $title, $category_id, $status, $contents,$user_id, $image){
  var_dump($image);
  if(!empty($image)){
    //画像ファイルがアップロードされた時の関数の処理
    $filename = get_upload_filename($image);
  }
  //エラー関数処理の結果falseが返ってきた場合
  if(validate_contents($title, $status, $contents) === false){
    return false;
  }
  //トランザクションを絡めて商品を登録する関数を返す
  return regist_contents_transaction($db, $title, $category_id, $status, $contents, $user_id, $image, $filename=[]);
}

//トランザクションを絡めて商品を登録する関数
function regist_contents_transaction($db, $title, $category_id, $status, $contents, $user_id, $image, $filename){
  //トランザクションを開始
  $db->beginTransaction();
  //アイテムをインサートする際の処理関数かつ、アップロードした画像ファイルをimagesフォルダに移動させる関数
  if(insert_contents($db, $user_id,$category_id,$title,$contents,$filename,$status)){
    if(!empty($image) || (!empty($filename))){
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
function update_item_status($db, $item_id, $status){
  $sql = "
    UPDATE
      items
    SET
      status = ?
    WHERE
      item_id = ?
    LIMIT 1
  ";

  //実行した結果を返す
  return execute_query($db, $sql,[$status,$item_id]);
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

//DBitemsテーブル、item_idで抽出した該当のカラムを抽出し、デリートする
function destroy_item($db, $item_id){
//特定のitem_idでDBから情報を抽出する
  $item = get_item($db, $item_id);
  //item情報を抽出できなかった場合、falseを返す
  if($item === false){
    return false;
  }
  //トランザクションを開始する
  $db->beginTransaction();
//抽出したimte_idによってitemを削除し、画像も削除する
  if(delete_item($db, $item['item_id'])
    && delete_image($item['image'])){
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
function delete_item($db, $item_id){
  $sql = "
    DELETE FROM
      items
    WHERE
      item_id = ?
    LIMIT 1
  ";

  //実行した結果を返す
  return execute_query($db, $sql,[$item_id]);
}


// 非DB

//商品のステータスが1=openであるものを返す
function is_open($item){
  return $item['status'] === 1;
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

//在庫関連のエラー処理
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

//ステータスのバリデーション処理
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

//itemsテーブルのデータ件数を取得する
function get_items_total_count($db){
  $sql = "
   SELECT
    COUNT(*) item_id
   FROM
    items
  ";
  //実行した結果を返す
  return fetch_Column_query($db, $sql);

}
