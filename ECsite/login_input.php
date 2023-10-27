<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<form action="login_output.php" method="post">
    ログイン名<input type="text" name="login"><br>
    <p>--------------------------------------------------</p>
    パスワード<input type="password" name="password"><br>
    <p>--------------------------------------------------</p>
    <input type="submit" value="ログイン">
</form>
<a href="customer-input.php">新規登録</a>
<a href="index.php" id="my">マイページへ</a>
<?php require 'footer.php'; ?>    