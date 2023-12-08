<link rel="stylesheet" href="css/logout-input.css?v=1.0.2">
<div class="flex">
<figure class="image"><img 
src="image/rogo.jpg">
</figure>
<h1>ログアウト</h1>
<div class="nav">
    
    <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
    <input id="drawer_input" class="drawer_hidden" type="checkbox">

    <!-- ハンバーガーアイコン -->
    <label for="drawer_input" class="drawer_open"><span></span></label>

    <!-- メニュー -->
    <nav class="nav_content">
      <ul class="nav_list">
        <li class="nav_item"><a href="mypage.php" id="b">マイページへ</a></li>
        <li class="nav_item"><a href="favorite-show.php" id="b">お気に入りへ</a></li>
        <li class="nav_item"><a href="shohin_top.php" id="b">商品一覧</a></li>
        <li class="nav_item"><a href="cart-show.php" id="b">カート</a></li>
      </ul>
    </nav>

  </div>
</div>
<div id='a'>
<?php require 'header.php'; ?>
<p class='log'>ログアウトします本当によろしいですか？</br>
ログアウト後のログイン画面へ移行します</p>
</div>
<a href="logout_output.php"><button>ログアウト</button></a>
<?php require 'footer.php'; ?>