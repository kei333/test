<html> 
    <head> 
            <meta charset="UTF-8"> 
            <title>一般ユーザ</title> 
    </head> 
    <body> 
        <h1>ホーム画面</h1> 
        <p>一般ユーザログイン完了</p> 
        <?php
        session_start();
        print $_SESSION['name'];
        exit;
        ?>
        <input value="ログアウト" onclick="history.back();" type="button">
    </body> 
</html> 