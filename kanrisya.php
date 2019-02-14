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
        exit;
        ?>
        <p>管理者ログイン完了</p> 
        <input value="ログアウト" onclick="history.back();" type="button">
    </body> 
</html> 