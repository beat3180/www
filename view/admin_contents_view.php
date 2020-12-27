<!DOCTYPE html>
<html lang="ja">
<head>
  <!--//定数、/var/www/html/../view/templates/head.phpというドキュメントルートを通り、head.phpデータを読み取る-->
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>記事一覧・管理</title>
</head>
<style>
img{
  height: 100px;
}

.close_contents {
  background-color: #dddddd;
}

</style>
<body>
<!--//定数、/var/www/html/../view/templates/header_logined.phpというドキュメントルートを通り、header_logined.phpデータを読み取る-->
  <?php
  include VIEW_PATH . 'templates/header_logined.php';
  ?>
  <!--//定数、/var/www/html/../view/templates/messages.phpというドキュメントルートを通り、messages.phpデータを読み取る-->
<?php include VIEW_PATH . 'templates/messages.php'; ?>

  <div class="container">
    <h1 class="my-4">記事一覧・管理</h1>



      <!--$contentsに一つ以上値が入っていた場合は表示される-->
    <?php if(count($contents) > 0){ ?>
      <table class="table table-bordered text-center p-md-3 m-md-3">
        <thead class="thead-light">
          <tr>
            <th>操作</th>
            <th>コンテンツID</th>
            <th>タイトル</th>
            <th>ユーザー名</th>
            <th>カテゴリー</th>
            <th>記事画像</th>
            <th>投稿日時</th>
            <th>更新日時</th>
            <th>本文</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($contents as $content){ ?>
          <tr class="<?php print (is_open($content) ? '' : 'close_contents'); ?>">
            <td>
              <form method="post" action="contents_change_status.php" class="operation">
                <?php if(is_open($content) === true){ ?>
                  <input type="submit" value="公開 → 非公開" class="btn btn-sm btn-secondary">
                  <input type="hidden" name="changes_to" value="close">
                <?php } else { ?>
                  <input type="submit" value="非公開 → 公開" class="btn btn-sm btn-secondary">
                  <input type="hidden" name="changes_to" value="open">
                <?php } ?>
                <input type="hidden" name="contents_id" value="<?php print($content['contents_id']); ?>">
                <input type="hidden" name="admin_contents_change_status" value="admin_contents_change_status">
                <!--CSRF対策のセッションに登録されたトークンを送信する-->
                <input type="hidden" name="csrf" value="<?php print($token); ?>">
              </form>

              <form method="post" action="contents_delete.php">
                <input type="submit" value="削除" class="btn btn-sm btn-danger delete">
                <input type="hidden" name="contents_id" value="<?php print($content['contents_id']); ?>">
                <input type="hidden" name="admin_contents_delete" value="admin_contents_delete">
                <!--CSRF対策のセッションに登録されたトークンを送信する-->
                <input type="hidden" name="csrf" value="<?php print($token); ?>">
              </form>

              <form method="get"  action="contents_detail.php">
               <input type="submit" value="記事詳細へ" class="btn btn-sm btn-primary">
               <input type="hidden" name="contents_id" value="<?php print($content['contents_id']); ?>">
              </form>

            </td>
            <td><?php print h(($content['contents_id'])); ?></td>
            <td><?php print h(($content['title'])); ?></td>
            <td><?php print h(($content['name'])); ?></td>
            <td><?php print h(($content['category'])); ?></td>
            <td>
              <?php if($content['image'] !== null){ ?>
              <img src="<?php print(IMAGE_PATH . $content['image']); ?>" alt="Card image cap">
              <?php } else { ?>
              <img src="/assets/images/漫画デフォルト.png" alt="Card image">
              <?php } ?>
            </td>
            <td><?php print h(($content['created_datetime'])); ?></td>
            <td><?php print h(($content['update_datetime'])); ?></td>
            <td><?php print h(($content['contents'])); ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <!--$categoryに何も値が入っていない場合-->
    <?php } else { ?>
      <p>記事はありません。</p>
    <?php } ?>
  </div>
   <!--jQuery、$('.delete')で要素を特定、confirmでダイアログを開く-->
  <script>
    $('.delete').on('click', () => confirm('本当に削除しますか？'))
  </script>
</body>
</html>
