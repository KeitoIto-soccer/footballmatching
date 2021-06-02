<?php
$dsn = 'mysql:dbname=portfolio;host=localhost';
$user = 'root';
$password = '';

$id=$_POST['post_id'];
try{
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  $sql = 'DELETE from post
  where post_id=:post_id';
  // ?←何かを入れることができる。
  // 特定のユーザーを指定
  $stmt=$dbh->prepare($sql);
  $stmt->bindValue(':post_id',(int)$id,PDO::PARAM_INT);
  $results=$stmt->execute();
}catch (PDOException $e){
  print('Error:'.$e->getMessage());
  die();
}

try{
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = 'INSERT INTO 
    matching(user_id,date,coat_id,opponent_id,time,created_at)
    value(:user_id,:date,:coat_id,:opponent_id,:time,NULL)';
    // ?←何かを入れることができる。
    // 特定のユーザーを指定
    $stmt=$dbh->prepare($sql);
  $stmt->bindValue(':user_id',$_POST['user_id'],PDO::PARAM_INT);
  $stmt->bindValue(':date',$_POST['date'],PDO::PARAM_STR);
  $stmt->bindValue(':coat_id',$_POST['coat_id'],PDO::PARAM_INT);
  $stmt->bindValue(':opponent_id',$_POST['opponent_id'],PDO::PARAM_INT);
  $stmt->bindValue(':time',$_POST['time'],PDO::PARAM_STR);
  //$stmt->bindValue(':created_at',$_POST['created_at'],PDO::PARAM_STR);
    $result=$stmt->execute();
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}



?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="./src/css/confirm.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>試合確定画面</title>
</head>
<body background="img/src/soccer.3.jpg">
  <p>試合の予約が確定しました。</p>
  <a href="./index.php">戻る</a>
</body>
</html>