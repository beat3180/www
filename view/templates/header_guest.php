<header>
  <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <a class="navbar-brand mr-auto mr-lg-0" href="<?php print(HOME_URL);?>">マンガトーカー</a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav col-auto ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php print(CREATE_URL);?>">管理</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php print(USER_CONTENTS_URL);?>">MY記事</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php print(POST_URL);?>">記事投稿</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php print(LOGIN_URL);?>">ログイン</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php print(SIGNUP_URL);?>">サインアップ</a>
        </li>
        <li class="nav-item">
          <!-- <a class="nav-link" href="#">Profile</a> -->
          <a class="nav-link" href="logout.php">ログアウト</a>
        </li>
      </ul>
    </div>
    <p style="color: white;">ユーザー名：ゲスト</p>
  </nav>
</header>
