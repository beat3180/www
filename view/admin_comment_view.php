<!DOCTYPE html>
<html lang="ja">
<head>
  <!--//定数、/var/www/html/../view/templates/head.phpというドキュメントルートを通り、head.phpデータを読み取る-->
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>コメント一覧・管理</title>
</head>
<body>
<!--//定数、/var/www/html/../view/templates/header_logined.phpというドキュメントルートを通り、header_logined.phpデータを読み取る-->
  <?php
  include VIEW_PATH . 'templates/header_logined.php';
  ?>
  <!--//定数、/var/www/html/../view/templates/messages.phpというドキュメントルートを通り、messages.phpデータを読み取る-->
<?php include VIEW_PATH . 'templates/messages.php'; ?>

  <div class="container">
    <h1 class="my-4">コメント一覧・管理</h1>



      <!--$contentsに一つ以上値が入っていた場合は表示される-->
    <?php if(count($comments) > 0){ ?>
      <table class="table table-bordered text-center p-md-3 m-md-3">
        <thead class="thead-light">
          <tr>
            <th>操作</th>
            <th>コメントID</th>
            <th>コメント</th>
            <th>ユーザー名</th>
            <th>コンテンツID</th>
            <th>投稿日時</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($comments as $comment){ ?>
          <tr>
            <td>
              <form method="post" action="comment_delete.php">
                <input type="submit" value="削除" class="btn btn-sm btn-danger delete">
                <input type="hidden" name="comment_id" value="<?php print($comment['comment_id']); ?>">
                <input type="hidden" name="admin_comment_delete" value="admin_comment_delete">
                <!--CSRF対策のセッションに登録されたトークンを送信する-->
                <input type="hidden" name="csrf" value="<?php print($token); ?>">
              </form>

              <form method="get"  action="contents_detail.php">
               <input type="submit" value="記事詳細へ" class="btn btn-sm btn-primary">
               <input type="hidden" name="contents_id" value="<?php print($comment['contents_id']); ?>">
              </form>

            </td>
            <td><?php print h(($comment['comment_id'])); ?></td>
            <td><?php print h(($comment['comment'])); ?></td>
            <td><?php print h(($comment['name'])); ?></td>
            <td><?php print h(($comment['contents_id'])); ?></td>
            <td><?php print h(($comment['created_datetime'])); ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <!--$categoryに何も値が入っていない場合-->
    <?php } else { ?>
      <p>コメントはありません。</p>
    <?php } ?>
  </div>
   <!--jQuery、$('.delete')で要素を特定、confirmでダイアログを開く-->
  <script>
    $('.delete').on('click', () => confirm('本当に削除しますか？'))
  </script>
</body>
</html>
