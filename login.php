<?php
session_start();// セッション開始
$errorMessage = "";//エラーメッセージの宣言
//ログインボタンが押されたとき
if(isset($_POST['login'])){
    $id=$_POST['id'];//idを格納
    $password=$_POST['password'];
    //空じゃないとき
    if(!empty($id) && !empty($password)){
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=forever','root','' );//DB接続
            $stmt = $dbh->prepare("SELECT * FROM user WHERE id = ?");//idのデータを検索
            $stmt->bindValue(1,$id,PDO::PARAM_STR);
            $_SESSION['name']=$stmt['name'];
            //パスワードが一致したとき
            if ($stmt["password"]===$password) {
                //管理者のとき
                if($stmt['admin_flg']==1){
                    header('Location: http://localhost/forever/kanrisya.php');
                    exit;
                }else{
                    header('Location: http://localhost/forever/ippan.php');
                    exit;
                }
            }else{
                $errorMessage = 'IDとパスワードが一致しません。';
            }
        }catch (PDOException $e) {
            $errorMessage= "エラー!: " ;
            die();
        }            
    }else{
        $errorMessage= 'IDまたはパスワードが未入力です。';
    }
}
?>
<html>
    <head>
            <meta charset="UTF-8">
            <title>ログイン</title>
    </head>
    <body>
        <h1>ログイン画面</h1>
        <p><?php $errorMessage ?></p>
        <form action="login.php" method="POST">
            <p>ID:<input type="text" name="id" placeholder="IDを入力"></p>
            <p>パスワード<input type="password" name="password" placeholder="パスワードを入力"></p>
            <input type="submit" id="login" name="login" value="ログイン">
        </form>
    </body>
</html>