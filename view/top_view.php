<!DOCTYPE html>
<html lang="ja">
<head>
<!--//定数、/var/www/html/../view/templates/head.phpというドキュメントルートを通り、head.phpデータを読み取る-->
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>トップページ</title>
  <!--//定数、/assets/css/top.cssというドキュメントルートを通り、top.cssを読み込む-->
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'top.css'); ?>">
</head>
<body  class="bg-light" >
<!--//定数、/var/www/html/../view/templates/header_guest.phpというドキュメントルートを通り、header_guest.phpデータを読み取る-->
<?php include VIEW_PATH . 'templates/header_guest.php'; ?>



<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
  <div class="col-md-5 p-lg-5 mx-auto my-5">
    <h1 class="display-4 font-weight-normal">マンガトーカー</h1>
  </div>
  <div class="product-device shadow-sm d-none d-md-block"></div>
  <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>

<footer class="container py-5 text-center">
  <p class="lead font-weight-normal">本WEBサービスはポートフォリオとして作成したマンガに特化した記事投稿サイトです。</p>
    <p class="lead font-weight-norma">下記はゲストアカウントですので自由に閲覧してください。</p>
    <a class="btn btn-outline-secondary mx-auto" href="index.php">ゲストでログインする</a>
</footer>

  </body>
</html>
