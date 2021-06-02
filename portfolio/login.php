<?php
// var_dump($_GET);
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
<!doctype html>
<html lang="ja" >
  <head>
    <title>Signin Template for Bootstrap · Bootstrap</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="./src/css/login.css" rel="stylesheet">
  </head>
  <body  class="text-center" >
  <form class="form-signin" action = "login.php" method = "post">
  <img class="mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
  <!-- <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1> -->
  <h1 class="h3 mb-3 font-weight-normal">サインインする</h1>
  <!-- <label for="inputEmail" class="sr-only">Email address</label> -->
  <label for="inputEmail" class="sr-only">メールアドレス</label>
  <!-- <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus> -->
  <input name="address" type="email" id="inputEmail" class="form-control" placeholder="メールアドレス" required autofocus>
  <!-- <label for="inputPassword" class="sr-only">Password</label> -->
  <label for="inputPassword" class="sr-only">パスワード</label>
  <!-- <input type="password" id="inputPassword" class="form-control" placeholder="Password" required> -->
  <input name="password" type="password" id="inputPassword" class="form-control" placeholder="パスワード" required>
  <div class="checkbox mb-3">
    <label>
      <!-- <input type="checkbox" value="remember-me"> Remember me -->
      <input type="checkbox" value="remember-me"> 記憶する
    </label>
  </div>
  <!-- <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button> -->
  <button class="btn btn-lg btn-primary btn-block" type="submit">サインイン</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>

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