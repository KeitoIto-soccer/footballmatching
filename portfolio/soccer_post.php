
<?php
session_start();
$dsn = 'mysql:dbname=portfolio;host=localhost';
$user = 'root';
$password = '';

 if(empty($_POST['area_id'])){
   exit('活動地域を確定してください');
}
// if(mb_strlen($_POST['area_id'])>30){
//   exit('活動地域はは30文字以下にしてください');
// }
if(empty($_POST['date'])){
  exit('試合日時を入力してください');
}
if(empty($_POST['time'])){
  exit('試合開始時間を入力してください');
}
if(empty($_POST['coat_id'])){
  exit('コートをを入力してください');
}


 try{
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  $sql='INSERT into 
  post(user_id,area_id,coat_id,date,time,detail)
  values(:user_id,:area_id,:coat_id,:date,:time,:detail)';
$stmt=$dbh->prepare($sql);
$stmt->bindValue(':user_id',$_SESSION['team_name'],PDO::PARAM_STR);
$stmt->bindValue(':area_id',$_POST['area_id'],PDO::PARAM_INT);
$stmt->bindValue(':coat_id',$_POST['coat_id'],PDO::PARAM_INT);
$stmt->bindValue(':date',$_POST['date'],PDO::PARAM_STR);
$stmt->bindValue(':time',$_POST['time'],PDO::PARAM_STR);
$stmt->bindValue(':detail',$_POST['detail'],PDO::PARAM_STR);
$result=$stmt->execute();
}catch(PDOException $e){
  exit($e);
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="./src/css/soccer_post.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>投稿完了画面</title>
</head>
<body>
<form action="soccer_post" method="post">
<input type="hidden" name="coat.id" value="<?php echo $results['id'] ?>">
</form>
  <p>投稿が完了しました。</p>
  <a href="./index.php">戻る</a>
</body>
</html>