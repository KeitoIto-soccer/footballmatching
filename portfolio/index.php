<?php session_start() ?>
<?php 
if(isset($_SESSION['team_name'] )){
}

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
if(isset($_SESSION['team_name'])){
  $dbh=dbConnect();
  $sql='SELECT count(*) from matching 
  where user_id=?
  OR opponent_id=?';
  $stmt=$dbh->prepare($sql);
  $stmt->execute(array($_SESSION['team_name'],$_SESSION['team_name']));
  $result=$stmt->fetch(PDO::FETCH_ASSOC);
}



 ?>
<!doctype html>
<html lang="ja" >
  <head>
    <title>FootBallMatching</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="./src/css/index.css" rel="stylesheet">
  </head>
  <body >

    <header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">FootBallMatching</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="./form.php">投稿</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./opponent.php">対戦相手を探す</a>
        </li>

      </ul>
      <form class="form-inline mt-2 mt-md-0">

      <?php
    if(isset($_SESSION['team_name'] )):?>
      <a href="http://localhost/portfolio/logout.php"class="btn btn-outline-success my-2 my-sm-0" >ログアウト</a>
     
    <?php else : ?>
      <a href="http://localhost/portfolio/login.php"class="btn btn-outline-success my-2 my-sm-0" >ログイン</a>
        <a href="http://localhost/portfolio/register.html"class="btn btn-outline-success my-2 my-sm-0" >新規登録</a>
    <?php endif ; ?>
        
      </form>
    </div>
  </nav>
</header>

<main role="main">

  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    </ol>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="first-slide" src="src/img/soccer.1.jpg" alt="First slide">
        <div class="container">
          <div class="carousel-caption text-left">
            
         <?php if(empty($_SESSION['team_name'])): ?>
          <h2>サッカーの対戦相手を探そう！ <span class="badge badge-secondary"></span></h2>
          <?php endif; ?> 
            <?php if(!empty($_SESSION['team_name'])&&$result['count(*)']>0): ?>
            <p><a class="btn btn-lg btn-primary" href="./matching.php" role="button">確定された練習試合があります。</a></p>
            <?php elseif(!empty($_SESSION['team_name'])&&$result['count(*)']=0): ?>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">練習試合を組もう</a></p>
            <?php endif ; ?>
          </div>
        </div>
      </div>
      </div>
    </div>
    
   
  </div>
</main>
<script src="../../assets/js/vendor/holder.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>
  window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')
</script><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script><script src="/docs/4.3/assets/js/vendor/anchor.min.js"></script>
<script src="/docs/4.3/assets/js/vendor/clipboard.min.js"></script>
<script src="/docs/4.3/assets/js/vendor/bs-custom-file-input.min.js"></script>
<script src="/docs/4.3/assets/js/src/application.js"></script>
<script src="/docs/4.3/assets/js/src/search.js"></script>
<script src="/docs/4.3/assets/js/src/ie-emulation-modes-warning.js"></script>
  </body>
</html>