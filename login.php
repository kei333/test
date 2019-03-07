<?php
session_start();// セッション開始
$errorMessage = "";//エラーメッセージの宣言
//ログインボタンが押されたとき
if(isset($_POST['login'])){
    $id=$_POST['id'];//idを格納
    $password=$_POST['password'];
    //echo "$id $password";
    //空じゃないとき
    if(!empty($id) && !empty($password)){
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=forever;charset=utf8','root','' );//DB接続
            /*print '接続に成功しました。';
            foreach ($pdo->query('SELECT * FROM user') as $row1){
                var_dump($row1);
            }
            foreach ($pdo->query('SELECT * FROM user WHERE id="KANRISYA"') as $row2){
                var_dump($row2);
            }*/
            $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
            $stmt->bindValue(1, $id, PDO::PARAM_STR);//値をstmtに関連付ける
            //オブジェクトを配列として使用できない対策
            $_SESSION['name']= $pdo->prepare("SELECT name FROM user WHERE id=?");//sessonにidのname格納
            $pass = $pdo->prepare("SELECT password FROM user WHERE id=?");//パスワード格納
            $flg = $pdo->prepare("SELECT admin_flg FROM user WHERE id=?");//権限格納
            //パスワードが一致したとき
            if ($pass === $password) {
                //管理者のとき
                if($flg == 1){
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
        <?php  print $errorMessage ?>
        <form action="login.php" method="POST">
            <p>ID:<input type="text" name="id" placeholder="IDを入力"></p>
            <p>パスワード<input type="password" name="password" placeholder="パスワードを入力"></p>
            <input type="submit" id="login" name="login" value="ログイン">
        </form>
    </body>
</html>