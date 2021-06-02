<?php
session_start();
$id=$_GET['id'];


function dbConnect(){
  $dsn='mysql:host=localhost;dbname=portfolio;charset=utf8';
  $user="root";
  $pass="";

  try{
    $dbh=new PDO($dsn,$user,$pass,[
      PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_EMULATE_PREPARES=>false,
    ]);
    
  }catch(PDOException $e){
   echo '接続失敗'.$e->getMessage();
   exit();
  }
  return $dbh;
}

	$dbh=dbConnect();
	 $sql='SELECT * from post 
   join prefecture ON post.area_id=prefecture.id
   join users on post.user_id=users.id
   join coat on post.coat_id=coat.coat_id
   where post_id=:post_id';
   $stmt=$dbh->prepare($sql);
   $stmt->bindValue(':post_id',(int)$id,PDO::PARAM_INT);
   $stmt->execute();
	 $result=$stmt->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./src/css/matching.css" rel="stylesheet">
  <title>FootBallMatching</title>
</head>
<body>
  <h2>対戦相手情報</h2>
  <p>チーム名：<?php echo $result['team_name']?></p>
  <p>活動地域：<?php echo $result['name']?></p>
  <p>グラウンド：<?php echo $result['coat_name'] ?></p>
  <p>住所：<?php echo $result['address'] ?></p>
  <p>試合日時：<?php echo $result['date']?></p>
  <p>試合開始時間：<?php echo $result['time']?></p>
  <p>詳細：<?php echo $result['detail']?></p>
  <hr>
  <?php
    if(isset($_SESSION['team_name'] )):?>
      <p>練習試合を申し込みますか？</p>
  <form action="./confirm.php" method="post">
    <input type="hidden" name="post_id" value="<?= $result['post_id'] ?>">
     <input type="hidden" name="user_id" value="<?= $_SESSION['team_name']?>">
     <input type="hidden" name="date" value="<?= $result['date']?>">
     <input type="hidden" name="coat_id" value="<?= $result['coat_id']?>">
     <input type="hidden" name="opponent_id" value="<?= $result['user_id']?>">
     <input type="hidden" name="time" value="<?= $result['time']?>">
    
    <input type="submit" value="はい">
    <?php else : ?>
      ログインしてください。
    <?php endif ; ?>
        
  
  </form>
</body>
</html>