<link rel="stylesheet" href="css/logout-input.css">
<div class="flex">
<figure class="image"><img 
src="image/rogo.jpg">
</figure>
<h1>ログアウト<h1>
</div>
<div id='a'>
<?php require 'header.php'; ?>
<p class='log'>ログアウトします本当によろしいですか？</br>
ログアウト後のログイン画面へ移行します</p>
</div>
<a href="logout_output.php"><button>ログアウト</button></a>
<a href="index.php" id="my"><button>マイページへ</button></a>
<?php require 'footer.php'; ?>