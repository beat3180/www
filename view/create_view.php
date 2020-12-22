<!DOCTYPE html>
<html lang="ja">
<head>
  <!--//定数、/var/www/html/../view/templates/head.phpというドキュメントルートを通り、head.phpデータを読み取る-->
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>カテゴリー・タグ追加</title>
</head>
<body>
<!--//定数、/var/www/html/../view/templates/header_logined.phpというドキュメントルートを通り、header_logined.phpデータを読み取る-->
  <?php
  include VIEW_PATH . 'templates/header_guest.php';
  ?>

  <div class="container">
    <h1>カテゴリー・タグ追加</h1>

<!--//定数、/var/www/html/../view/templates/messages.phpというドキュメントルートを通り、messages.phpデータを読み取る-->
<?php include VIEW_PATH . 'templates/messages.php'; ?>

 <!--form内の情報をacreate_category_insert.phpへ飛ばす-->
    <form method="post" action="create_category_insert.php" class="add_item_form col-md-6">
      <div class="form-group">
        <label for="category">カテゴリー: </label>
        <input class="form-control" type="text" name="category" id="category">
      </div>

      <input type="submit" value="カテゴリー追加" class="btn btn-primary">
       <!--CSRF対策のセッションに登録されたトークンを送信する-->
      <input type="hidden" name="csrf" value="<?php print($token); ?>">
    </form>

<!--$categorysに一つ以上値が入っていた場合は表示される-->
    <?php if(count($categorys) > 0){ ?>
      <table class="table table-bordered text-center p-md-3 m-md-3">
        <thead class="thead-light">
          <tr>
            <th>カテゴリー</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($categorys as $category){ ?>
          <tr>
            <td><?php print h(($category['category'])); ?></td>
            <td>

              <form method="post" action="create_category_delete.php">
                <input type="submit" value="削除" class="btn btn-danger delete">
                <input type="hidden" name="category_id" value="<?php print($category['category_id']); ?>">
                <!--CSRF対策のセッションに登録されたトークンを送信する-->
                <input type="hidden" name="csrf" value="<?php print($token); ?>">
              </form>

            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <!--$categoryに何も値が入っていない場合-->
    <?php } else { ?>
      <p>カテゴリーはありません。</p>
    <?php } ?>
  </div>
   <!--jQuery、$('.delete')で要素を特定、confirmでダイアログを開く-->
  <script>
    $('.delete').on('click', () => confirm('本当に削除しますか？'))
  </script>
</body>
</html>
