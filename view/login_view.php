<!DOCTYPE html>
<html lang="ja">
<head>
<!--//定数、/var/www/html/../view/templates/head.phpというドキュメントルートを通り、head.phpデータを読み取る-->
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>ログイン</title>
</head>
<body  class="text-center" >
<!--//定数、/var/www/html/../view/templates/header_guest.phpというドキュメントルートを通り、header_guest.phpデータを読み取る-->
<?php include VIEW_PATH . 'templates/header_guest.php'; ?>

<div class="position-relative overflow-hidden p-3 p-md-5 m-md-5 text-center bg-light">
<form  method="post" action="login_process.php"  class="form-signin">
  <img class="mb-4" src="<?php print(IMAGE_PATH . 'マンガアイコン.png'); ?>" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">ログインしてください</h1>
  <div class="row">
    <div class="col-xs-1 mx-auto">
      <div class="form-group">
        <label for="name">名前</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="name" required autofocus>
      </div>
      <div class="form-group">
        <label for="password">パスワード</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      </div>
    </div>
  </div>
  <div class="mt-3 mb-3">
    <button class="btn btn-lg btn-primary" type="submit">ログイン</button>
  </div>
  <!--CSRF対策のセッションに登録されたトークンを送信する-->
  <input type="hidden" name="csrf" value="<?php print($token); ?>">
</form>
<p>※管理ユーザー名とパスワードはユーザー名:adminbeat パスワード:adminbeatです
</div>
</body>
</html>
