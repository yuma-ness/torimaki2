<?php require 'header.php'; ?>
<div class="main">
<link rel="stylesheet" href="css/login_input.css?v=1.0.0">
<img class="main-image" src="image/wakadan.jpg">
<form action="login_output.php" method="post">
    <p class="main-a">メールアドレス　　　<input type="text" name="login"><br></p>
    <p class="main-a">_____________________________________</p>
    <p class="main-a">パスワード　　　<input type="password" name="password"><br></p>
    <p class="main-a">_____________________________________</p>
    <button type="submit">ログイン</button>
</form>

<p>初めての方はこちらから</p>
<a href="customer-input.php"><button>新規登録</button></a>
</div>
<?php require 'footer.php'; ?>    