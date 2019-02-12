<?php
// セッション開始
session_start();
if(isset($_POST['login'])){
    $id='';
    $password='';
    $id=$_POST['id'];
    $password=$_POST['password'];
    if(!empty($id) && !empty($password)){
        $dbh = new PDO('mysql:host=localhost;dbname=forever','root','' ); 
        $result = $dbh->query('SELECT * FROM user WHERE ID = ' .$id);
        $result->fetch(PDO::FETCH_ASSOC);
        if ($result["Password"]==$password) {
            if($result['admin_fig']==1){
                header('Location: http://localhost/forever/kanrisya.php');
                exit;
            }else{
                header('Location: http://localhost/forever/ippan.php');
                exit;
            }
        }else{
            print 'IDとパスワードが一致しません';
        }
    } else {
        print 'IDまたはパスワードが未入力です。';
    }
    try {
        
    }catch (PDOException $e) {
        print "エラー!: " ;
        die();
    }
    $dbh = null;
}
?>

<?php
//ログインボタンが押された場合
if(isset($_POST["login"])){
    
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
            <input type="submit" id="login" name="login" value="ログイン">
        
        </form>
    </body>
</html>