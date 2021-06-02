<?php

$dsn = 'mysql:dbname=portfolio;host=localhost';
$user = 'root';
$password = '';
if(empty($_POST['team_name'])){
  exit('チーム名を入力してください');
}
if(mb_strlen($_POST['team_name'])>20){
  exit('チーム名は20文字以下にしてください');
}
if(empty($_POST['mailaddress'])){
  exit('メールアドレスを入力してください');
}

if(empty($_POST['password'])){
  exit('パスワードを入力してください');
}



      
 try{
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  $sql='INSERT into 
  users(team_name,mailaddress,password)
  values(:team_name,:mailaddress,:password)';
$stmt=$dbh->prepare($sql);
$stmt->bindValue(':team_name',$_POST['team_name'],PDO::PARAM_STR);
$stmt->bindValue(':mailaddress',$_POST['mailaddress'],PDO::PARAM_STR);
$stmt->bindValue(':password',$_POST['password'],PDO::PARAM_STR);
$result=$stmt->execute();
}catch(PDOException $e){
  exit($e);
}

if(isset($_POST["address"])){
  $mail = $_POST["address"];
  $pass = $_POST["password"];
  
$dsn = 'mysql:dbname=portfolio;host=localhost';
$user = 'root';
$password = '';

try{
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = 'select * from users WHERE mailaddress=? AND password=?';
    // ?←何かを入れることができる。
    // 特定のユーザーを指定
    $stmt=$dbh->prepare($sql);
    // dbhのprepareという関数を指定　-> = of
    // $stmtに格納される
    // prepareは代入するもの
    $stmt->execute(array($mail,$pass));
    // executeには配列で渡さなければいけない
    // arrayの後に変数を指定
    // 実行
    $name=$stmt->fetchColumn();
    // fetchColumn();は特定のcolumnを取得
    if($name != ""){
      session_start();
      //$_sessionはサーバーに一時的にデータを保存する。
      //$_session['team_name]に$nameを代入している。
      $_SESSION['team_name']=$name;
      header('Location:http://localhost/portfolio');
    }
    // foreach ($dbh->query($sql) as $row) {
    //   // $dbh->query($sql)がデータの取得、処理結果がforeach
    //     print($row['id'].',');
    //     print($row['name']);
    //     print($row['password'].',');
    //     print('<br />');
    // }
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー登録完了画面</title>
</head>
<body>
  <p>ユーザー登録が完了しました。</p>
  <a href="./index.php">戻る</a>
</body>
</html>

