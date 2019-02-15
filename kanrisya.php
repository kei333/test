<?php
if(isset($_POST['logout'])){
    $_SESSION = array();// セッションの変数のクリア
    @session_destroy();// セッションクリア
    header('Location: http://localhost/forever/login.php');
    exit;
}
?>
<html> 
    <head> 
            <meta charset="UTF-8"> 
            <title>管理者</title> 
    </head> 
    <body> 
        <h1>ホーム画面</h1> 
        <?php
        session_start();
        print $_SESSION['name'];
        ?>
        <form action="kanrisya.php" method="POST">
        <p>管理者ログイン完了</p> 
        <input type="submit" id="logout" name="logout" value="ログアウト">
        </form>
    </body> 
</html> 