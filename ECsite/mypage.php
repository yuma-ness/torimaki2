<?php session_start();?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php require 'db-connect.php';?>
<?php
     $pdo=new PDO($connect,USER,PASS);
     $name=$address=$post=$useraddress=$password='';
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
         echo'<tr><td>ユーザー名</td><td>';
         echo'<p>','<input type="text" align="center" name="name" value="',$name,'">','</p>';
         echo'</td></tr>';
         echo'<tr><td>メールアドレス</td><td>';
         echo'<p>','<input type="text" name="address" value="',$address,'">','</p>';
         echo'</td></tr>';
         echo'<tr><td>パスワード</td><td>';
         echo'<p>','<input type="text" name="password" value="',$password,'">','</p>';
         echo'</td></tr>';
         echo'<tr><td>郵便番号</td><td>';
         echo'<p>','<input type="text" name="post" value="',$post,'">','</p>';
         echo'</td></tr>';
         echo'<tr><td>住所</td><td>';
         echo'<p>','<input type="text" name="useraddress" value="',$useraddress,'">','</p>';
         echo'</td></tr>';
         echo'</table>';
         echo'<p>','<input type="submit" value="更新">','</p>';
         echo'</form>';

     if($_SERVER["REQUEST_METHOD"]=='POST'){
        if(isset($_SESSION['customer'])){
            $sql=$pdo->prepare('update customer set user_name=?, password=?,mail_address=?,user_address=?,post=? where id=?');
            $sql->execute([
                $_REQUEST['name'],$_REQUEST['password'],
                $_REQUEST['address'],$_REQUEST['useraddress'],$_REQUEST['post'],$id
            ]);
            $_SESSION['customer']=[
                'id'=>$id,'name'=>$_REQUEST['name'],
                'password'=>$_REQUEST['password'],'address'=>$_REQUEST['address'],
                'useraddress'=>$_REQUEST['useraddress'],'post'=>$_REQUEST['post']
            ];
            echo 'お客様情報を更新しました。';
        }
    }
    ?>
            <a href="shohin_top.php"><button>検索画面戻る</button></a>
    </body>