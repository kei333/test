<?php
// セッション開始
session_start();
$errorMessage = ""; //エラーメッセージの宣言
if(isset($_POST['login'])){ //ログインボタンが押されたとき
    $id=$_POST['id']; //idを格納
    $password=$_POST['password'];
    try {
         //DB検索
        $dbh = new PDO('mysql:host=localhost;dbname=forever','root','' );
         //idのデータを検索
        $stmt = $dbh->query('SELECT * FROM user WHERE id = ' .$id);
        //$results = $stmt->fetchall(PDO::FETCH_ASSOC);
        $_SESSION['name']=$stmt['name'];
        if(!empty($id) && !empty($password)){ //空じゃないとき
            if ($stmt["password"]===$password) { //パスワードが一致したとき
                if($stmt['admin_flg']==1){ //管理者のとき
                    header('Location: http://localhost/forever/kanrisya.php');
                    exit;
                }else{
                    header('Location: http://localhost/forever/ippan.php');
                    exit;
                }
            }else{
                $errorMessage = 'IDとパスワードが一致しません。';
            }
        }else{
            $errorMessage= 'IDまたはパスワードが未入力です。';
        }
    }catch (PDOException $e) {
        $errorMessage= "エラー!: " ;
        die();
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
        <?php $errorMessage ?>
        <form action="login.php" method="POST">
            <p>ID:<input type="text" name="id" placeholder="IDを入力"></p>
            <p>パスワード<input type="password" name="password" placeholder="パスワードを入力"></p>
            <input type="submit" id="login" name="login" value="ログイン">
        </form>
    </body>
</html>