<!DOCTYPE html>
<html lang="ja">
<head>
<!--//定数、/var/www/html/../view/templates/head.phpというドキュメントルートを通り、head.phpデータを読み取る-->
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>記事投稿</title>
</head>
<body>
<!--//定数、/var/www/html/../view/templates/header_logined.phpというドキュメントルートを通り、header_logined.phpデータを読み取る-->
<?php include VIEW_PATH . 'templates/header_logined.php'; ?>

<div class="position-relative overflow-hidden p-3 p-md-5 m-md-5">
<!--//定数、/var/www/html/../view/templates/messages.phpというドキュメントルートを通り、messages.phpデータを読み取る-->
  <?php include VIEW_PATH . 'templates/messages.php'; ?>
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
            <select name="category_id" class="form-control">
              <?php foreach($categorys as $category){ ?>
              <option value="<?php print($category['category_id']); ?>"><?php print ($category['category']); ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">本文</label>
            <textarea name="contents" rows="20" id="textarea1" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label class="control-label">記事画像</label>
            <input type="file" name="image" id="image">
          </div>
          <div class="form-group">
            <label for="status">ステータス: </label>
            <select class="form-control" name="status" id="status">
              <option value="open">公開</option>
              <option value="close">非公開</option>
            </select>
          </div>
          <button class="btn btn-lg btn-primary">記事投稿</button>
          <!--CSRF対策のセッションに登録されたトークンを送信する-->
          <input type="hidden" name="csrf" value="<?php print($token); ?>">
        </form>
      </div>
    </div>
  </div>
</div>
</html>
