<?php
// セッション開始
session_start();
?>

<?php
try {
$dbh = new PDO('mysql:host=localhost;dbname=user_1','root','' ); 
    foreach($dbh->query('SELECT * from users') as $row) {
        
    }
    $dbh = null;
    } catch (PDOException $e) {
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
    }

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // IDの入力チェック
    if (empty($_POST["id"])) {  // emptyは値が空のとき
        $errorMessage = 'IDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["id"]) && !empty($_POST["password"])) {
        // 入力したIDを格納
        $userid = $_POST["id"];

        // IDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare('SELECT * FROM user WHERE Name = ?');
            $stmt->execute(array($id));

            $password = $_POST["password"];

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['password'])) {
                    session_regenerate_id(true);

                    // 入力したIDのユーザー名を取得
                    $id = $row['id'];
                    $sql = "SELECT * FROM user WHERE id = $id";  //入力したIDからユーザー名を取得
                    $stmt = $pdo->query($sql);
                    foreach ($stmt as $row) {
                        $row['name'];  // ユーザー名
                    }
                    $_SESSION["NAME"] = $row['name'];
                    header("Location: Main.php");  // メイン画面へ遷移
                    exit();  // 処理終了
                } else {
                    // 認証失敗
                    $errorMessage = 'IDあるいはパスワードに誤りがあります。';
                }
            }
        } catch (PDOException $e) {
            $errorMessage = '';
        }
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
        <form method="POST">
            <p>ID:<input type="text" id="id" name="id" placeholder="IDを入力"></p>
            <p>パスワード<input type="password" id="password" name="password" placeholder="パスワードを入力"></p>
            <input type="submit" id="login" name="login" value="ログイン">
            <?php
            if(isset($_GET['Admin_flg'])==1){
                header('Location: http://localhost/forever/kanrisya.php');
                exit;
            }else{
                header('Location: http://localhost/forever/ippan.php');
                exit;
            }
            ?>
    </body>
</html>