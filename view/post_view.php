<!DOCTYPE html>
<html lang="ja">
<head>
<!--//定数、/var/www/html/../view/templates/head.phpというドキュメントルートを通り、head.phpデータを読み取る-->
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>記事投稿</title>
</head>
<body>
<!--//定数、/var/www/html/../view/templates/header_guest.phpというドキュメントルートを通り、header_guest.phpデータを読み取る-->
<?php include VIEW_PATH . 'templates/header_guest.php'; ?>

<div class="position-relative overflow-hidden p-3 p-md-5 m-md-5">
  <div class="container">
    <div class="panel panel-default">
      <h2 class="panel-heading">記事投稿</h2>
      <div class="panel-body">
        <form  method="post" action="post_insert.php" enctype="multipart/form-data">
          <div class="form-group">
            <label class="control-label">タイトル</label>
            <input class="form-control" type="text" name="title">
          </div>
          <div class="form-group">
            <label class="control-label">カテゴリー</label>
            <select name="category" class="form-control">
              <option>選択肢1</option>
              <option>選択肢2</option>
              <option>選択肢3</option>
              <option>選択肢4</option>
              <option>選択肢5</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">本文</label>
            <textarea name="contents" rows="20" id="textarea1" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label class="control-label">サムネイル</label>
            <input type="file" name="image" id="image">
          </div>
          <div class="form-group">
            <label for="status">ステータス: </label>
            <select class="form-control" name="status" id="status">
              <option value="open">公開</option>
              <option value="close">非公開</option>
            </select>
          </div>
          <button class="btn btn-default">送信</button>
          <!--CSRF対策のセッションに登録されたトークンを送信する-->
          <input type="hidden" name="csrf" value="<?php print($token); ?>">
        </form>
      </div>
    </div>
  </div>
</div>
</html>
