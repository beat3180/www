<!DOCTYPE html>
<html lang="ja">
<head>
<!--//定数、/var/www/html/../view/templates/head.phpというドキュメントルートを通り、head.phpデータを読み取る-->
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>記事詳細</title>
  <!--//定数、/assets/css/top.cssというドキュメントルートを通り、top.cssを読み込む-->
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'top.css'); ?>">
</head>
<style>
img{
  height: 250px;
}

</style>
<body  class="bg-light" >
<!--//定数、/var/www/html/../view/templates/header_guest.phpというドキュメントルートを通り、header_guest.phpデータを読み取る-->
<?php include VIEW_PATH . 'templates/header_guest.php'; ?>

<!--//定数、/var/www/html/../view/templates/messages.phpというドキュメントルートを通り、messages.phpデータを読み取る-->
<?php include VIEW_PATH . 'templates/messages.php'; ?>

<div class="container">
  <div class="position-relative overflow-hidden p-3 p-md-1 m-md-1 text-center bg-light">
      <?php if($contents['image'] !== null){ ?>
      <img src="<?php print(IMAGE_PATH . $contents['image']); ?>" alt="Card image cap">
      <?php } else { ?>
      <img src="/assets/images/漫画デフォルト.png" alt="Card image">
      <?php } ?>
  </div>

    <div class="row d-flex">
      <div class="col-sm-5 ml-4">
        <p><?php print h($contents['name']); ?></p>
        <div class="border py-3 rounded-pill text-center bg-warning">
          <h4><?php print h($contents['category']); ?></h4>
        </div>
      </div>

      <small class="ml-auto"><?php print h($contents['created_datetime']); ?></small>
    </div>
</div>



<div class=" container py-4 text-center">
  <h1 class="font-weight-normal py-4" style="border-bottom: 5px solid;"><?php print h($contents['title']); ?></h1>
  <h5 class="text-left py-3 pb-5 mb-5" style="border-bottom: 3px solid;"><?php print h($contents['contents']); ?></h5>
</div>

  </body>
</html>
