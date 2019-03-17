<?php
session_start();
if(isset($_POST['logout'])){
    $_SESSION = array();
    @session_destroy();
    header('Location: http://localhost/forever/login.php');
    exit;
}
?>
<html> 
    <head> 
            <meta charset="UTF-8"> 
            <title>一般ユーザ</title> 
    </head> 
    <body> 
        <h1>ホーム画面</h1> 
        <?php print "こんにちは"?>
        <?php
        print $_SESSION['name'];
        ?>
        <form action="ippan.php" method="POST">
        <p>一般ユーザログイン完了</p> 
        <input type="submit" id="logout" name="logout" value="ログアウト">
        </form>
    </body>
</html> 