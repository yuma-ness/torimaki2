<?php session_start();?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mypage.css?v=1.0.0">
    <title>Document</title>
</head>
<body>

<div class="flex">
    <figure class="image">
    <img src ="image/rogo.jpg">
    </figure>
    <h1>マイページ</h1>
    <div class="nav">
    
    <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
    <input id="drawer_input" class="drawer_hidden" type="checkbox">

    <!-- ハンバーガーアイコン -->
    <label for="drawer_input" class="drawer_open"><span></span></label>

    <!-- メニュー -->
    <nav class="nav_content">
      <ul class="nav_list">
        <li class="nav_item"><a href="history.php" id="b">注文履歴</a></li>
        <li class="nav_item"><a href="favorite-show.php" id="b">お気に入りへ</a></li>
        <li class="nav_item"><a href="shohin_top.php" id="b">商品トップへ</a></li>
        <li class="nav_item"><a href="cart-show.php" id="b">カート</a></li>
        <li class="nav_item"><a href="logout_input.php" id="b">ログアウト</a></li>
      </ul>
    </nav>

  </div>
</div>

<?php require 'db-connect.php';?>
<?php
     $pdo=new PDO($connect,USER,PASS);
     $name=$address=$post=$useraddress=$password='';
     if($_SERVER["REQUEST_METHOD"]=='POST'){
        if(isset($_SESSION['customer'])){
            $id=$_SESSION['customer']['id'];
            $sql=$pdo->prepare('update customer set user_name=?, password=?,mail_address=?,user_address=?,post=? where id=?');
            $sql->execute([
                $_POST['name'],$_POST['password'],
                $_POST['address'],$_POST['useraddress'],$_POST['post'],$id
            ]);
            $_SESSION['customer']=[
                'id'=>$id,'name'=>$_POST['name'],
                'password'=>$_POST['password'],'address'=>$_POST['address'],
                'useraddress'=>$_POST['useraddress'],'post'=>$_POST['post']
            ];
            echo 'お客様情報を更新しました。';    
        }
    }
     if (isset($_SESSION['customer'])){
        $id=$_SESSION['customer']['id'];
         $name=$_SESSION['customer']['name'];
         $post=$_SESSION['customer']['post'];
         $address=$_SESSION['customer']['address'];
         $useraddress=$_SESSION['customer']['useraddress'];
         $password=$_SESSION['customer']['password'];
     }
         echo'<form action="mypage.php" method="post">';
         echo'<table align="center">';
         echo'<tr><td>ユーザー名</td><td></td><td>';
         echo'<p>','<input type="text" align="center" name="name" value="',$name,'">','</p>';
         echo'</td></tr>';
         echo'<tr><td>メールアドレス</td><td></td><td>';
         echo'<p>','<input type="text" name="address" value="',$address,'">','</p>';
         echo'</td></tr>';
         echo'<tr><td>パスワード</td><td></td><td>';
         echo'<p>','<input type="text" name="password" value="',$password,'">','</p>';
         echo'</td></tr>';
         echo'<tr><td>郵便番号</td><td></td><td>';
         echo'<p>','<input type="text" name="post" value="',$post,'">','</p>';
         echo'</td></tr>';
         echo'<tr><td>住所</td><td></td><td>';
         echo'<p>','<input type="text" name="useraddress" value="',$useraddress,'">','</p>';
         echo'</td></tr>';
         echo '<tr><td></td><td>';
         echo '<p><input type="submit" value="更新"></p>';
         echo'</form>';
         echo '</td><td></td></tr></table>';
    ?>
          
            
            <?php require 'footer.php'; ?> 
    