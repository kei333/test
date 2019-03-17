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
            $stmt = $pdo->prepare('SELECT * FROM user WHERE id = ?');
            $stmt->bindValue(1, $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            //var_dump($result);
            //疑問符プレースホルダを使用して1からパラメータを始める
            $_SESSION['name']= $result['name'];//nameを格納
            //var_dump($_SESSION['name']);
            $pass = $result['password'];
            //var_dump($result['password']);
            $flg = $result['admin_flg'];
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