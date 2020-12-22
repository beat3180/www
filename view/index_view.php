<!DOCTYPE html>
<html lang="ja">
<head>
<!--//定数、/var/www/html/../view/templates/head.phpというドキュメントルートを通り、head.phpデータを読み取る-->
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>記事一覧</title>
  <!--//定数、/assets/css/index.cssというドキュメントルートを通り、index.cssを読み込む-->
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'index.css'); ?>">
</head>
<body  class="bg-light" >
<!--//定数、/var/www/html/../view/templates/header_guest.phpというドキュメントルートを通り、header_guest.phpデータを読み取る-->
<?php include VIEW_PATH . 'templates/header_guest.php'; ?>

<!--//定数、/var/www/html/../view/templates/messages.phpというドキュメントルートを通り、messages.phpデータを読み取る-->
<?php include VIEW_PATH . 'templates/messages.php'; ?>
  <!--$categorysに一つ以上値が入っていた場合は表示される-->
  <?php if(count($contents) > 0){ ?>
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
      <?php foreach($contents as $content){ ?>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <a href="contents_detail.php?contents_id=<?php print($content['contents_id']); ?>">
              <?php if($content['image'] !== null){ ?>
              <img class="card-img-top" src="<?php print(IMAGE_PATH . $content['image']); ?>" alt="Card image cap">
              <?php } else { ?>
              <img class="card-img-top" src="/assets/images/漫画デフォルト.png" alt="Card image">
              <?php } ?>
              <div class="card-body">
                <h4 class="card-text border-bottom"><?php print h($content['title']); ?></h4>
                <div class="align-items-center">
                    <p>カテゴリー:<?php print h($content['category']); ?></p>
                    <p>ユーザー名:<?php print h($content['name']); ?></p>
                </div>
                <div><small class="text-muted"><?php print h($content['created_datetime']); ?></small></div>
              </div>
            </a>
          </div>
        </div>
      <?php } ?>
      </div>

    </div>
  </div>
  <!--$categoryに何も値が入っていない場合-->
  <?php } else { ?>
    <p>カテゴリーはありません。</p>
  <?php } ?>




  </body>
</html>
