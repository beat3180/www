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



<div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
            <div class="card-body">
              <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
              <p class="card-text">これは写真の解説文付きのカードです。自然に説明を加えることができます。しかしこの文章は少し長いかもしれません。</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">見る</button>
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">編集</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
                <small class="text-muted">9分</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
            <div class="card-body">
              <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
              <p class="card-text">これは写真の解説文付きのカードです。自然に説明を加えることができます。しかしこの文章は少し長いかもしれません。</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">見る</button>
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">編集</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
                <small class="text-muted">9分</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
            <div class="card-body">
              <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
              <p class="card-text">これは写真の解説文付きのカードです。自然に説明を加えることができます。しかしこの文章は少し長いかもしれません。</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">見る</button>
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">編集</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
                <small class="text-muted">9分</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
            <div class="card-body">
              <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
              <p class="card-text">これは写真の解説文付きのカードです。自然に説明を加えることができます。しかしこの文章は少し長いかもしれません。</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">見る</button>
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">編集</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
                <small class="text-muted">9分</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
            <div class="card-body">
              <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
              <p class="card-text">これは写真の解説文付きのカードです。自然に説明を加えることができます。しかしこの文章は少し長いかもしれません。</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">見る</button>
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">編集</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
                <small class="text-muted">9分</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
            <div class="card-body">
              <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
              <p class="card-text">これは写真の解説文付きのカードです。自然に説明を加えることができます。しかしこの文章は少し長いかもしれません。</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">見る</button>
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">編集</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
                <small class="text-muted">9分</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
            <div class="card-body">
              <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
              <p class="card-text">これは写真の解説文付きのカードです。自然に説明を加えることができます。しかしこの文章は少し長いかもしれません。</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">見る</button>
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">編集</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
                <small class="text-muted">9分</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
            <div class="card-body">
              <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
              <p class="card-text">これは写真の解説文付きのカードです。自然に説明を加えることができます。しかしこの文章は少し長いかもしれません。</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">見る</button>
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">編集</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
                <small class="text-muted">9分</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
            <div class="card-body">
              <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
              <p class="card-text">これは写真の解説文付きのカードです。自然に説明を加えることができます。しかしこの文章は少し長いかもしれません。</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">見る</button>
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
                  <button type="button" class="btn btn-sm btn-outline-secondary">編集</button>
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
                <small class="text-muted">9分</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  </body>
</html>
