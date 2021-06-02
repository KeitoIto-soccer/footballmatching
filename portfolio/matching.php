<?php
$dsn = 'mysql:dbname=portfolio;host=localhost';
$user = 'root';
$password = '';

session_start();
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

function getAllOpponent(){
	$dbh=dbConnect();
	 $sql='SELECT * from matching 
   join users on matching.opponent_id=users.id 
   join coat on matching.coat_id=coat.coat_id
   where user_id=?';
   $stmt=$dbh->prepare($sql);
   $stmt->execute(array($_SESSION['team_name']));
	 $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
   $dbh=null;
 return $result;
}

$opponentData=getAllOpponent();

try{
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  $sql = 'DELETE from matching
  where date < DATE_SUB(now(),INTERVAL 1 day)';
  // ?←何かを入れることができる。
  // 特定のユーザーを指定
  $stmt=$dbh->prepare($sql);
  $results=$stmt->execute();
}catch (PDOException $e){
  print('Error:'.$e->getMessage());
  die();
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>FootBallMatching</title>
</head>
<body>
<h2>対戦相手情報</h2>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">チーム名</th>
      <th scope="col">コート</th>
      <th scope="col">住所</th>
      <th scope="col">試合日時</th>
      <th scope="col">試合開始時間</th>
    </tr>
  </thead>
  <?php foreach($opponentData as $column): ?>
  <tbody>
    <tr>
      <th scope="row"><?php echo $column['team_name']?></th>
      <td><?php echo $column['coat_name'] ?></td>
      <td><?php echo $column['address'] ?></td>
      <td><?php echo $column['date']?></td>
      <td><?php echo $column['time']?></td>
    </tr>
  </tbody>
  <?php endforeach; ?>
</table>
  
  
  
  <a href="index.php">戻る</a>
  </form>
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>