<?php
// セッション開始
session_start();
try {
    $dbh = new PDO('mysql:host=localhost;dbname=forever','root','' ); 
    $id=$_POST["id"];
    $password=$_POST["password"];
    foreach($dbh->query('SELECT * from user') as $row) {
        $result = $dbh->query('SELECT * FROM user WHERE ID = ' .$id);
    }
    } catch (PDOException $e) {
        print "エラー!: " . $e->getMessage() . "<br/>";
        die();
    }
?>

 <?php
 $errorMessage = '';
// ログイ(ンボタンが押された場合
if(isset($_POST['login'])){
    // IDの入力チェック
    if(empty($_POST["id"])){// emptyは値が空のとき
        $errorMessage = 'IDが未入力です。';
    }elseif(empty($_POST["password"])){
        $errorMessage = 'パスワードが未入力です。';
    } 
}
?>

<?php
//ログインボタンが押された場合
if(isset($_POST["login"])){
    if(($_POST['Admin_flg'])==1){
        header('Location: http://localhost/forever/kanrisya.php');
        exit;
    }else{
        header('Location: http://localhost/forever/ippan.php');
        exit;
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
        <form action="login.php" method="POST">
            <p>ID:<input type="text" name="id" placeholder="IDを入力"></p>
            <p>パスワード<input type="password" name="password" placeholder="パスワードを入力"></p>
            <?php echo $errorMessage; ?>
            <input type="submit" id="login" name="login" value="ログイン">
        </form>
    </body>
</html>