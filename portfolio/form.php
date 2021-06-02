<?php
 session_start();

 function dbConnect(){
    $dsn='mysql:host=localhost;dbname=portfolio;charset=utf8';
    $user="root";
    $pass="";
  
    try{
      $dbh=new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
      ]);
      
    }catch(PDOException $e){
     echo '接続失敗'.$e->getMessage();
     exit();
    }
    return $dbh;
  }
 function getAllCoat(){
        $dbh = dbConnect();
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sql = 'select * from coat';
        $stmt=$dbh->prepare($sql);
	     $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $dbh=null;
        return $result;
 }

 function getPrefDate($pref){
	$dbh=dbConnect();
	 //①sqlの準備
	 $sql='SELECT * from coat
     where area_id=?';
	 //②sqlの実行
	 $stmt=$dbh->prepare($sql);
	 $stmt->execute(array($pref));
	 //③sqlの結果を受け取る
 $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
 $dbh=null;
 return $result;
}
if(isset($_GET['area_id'])){
	$prefDate=getPrefDate($_GET['area_id']);
}else{
  $prefDate=getAllCoat();
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
    <link href="./src/css/form.css" rel="stylesheet">

    <title>FootBallMatching</title>
</head>
<body>
<h2>投稿</h2>
<form action="form.php" method="">
  <div class="form-group">
    <label for="exampleFormControlSelect1">活動地域</label>
    <select class="form-control" name="area_id" id="exampleFormControlSelect1">
                <option value="1">北海道</option>
                <option value="2">青森県</option>
                <option value="3">岩手県</option>
                <option value="4">宮城県</option>
                <option value="5">秋田県</option>
                <option value="6">山形県</option>
                <option value="7">福島県</option>
                <option value="8">茨城県</option>
                <option value="9">栃木県</option>
                <option value="10">群馬県</option>
                <option value="11">埼玉県</option>
                <option value="12">千葉県</option>
                <option value="13">東京都</option>
                <option value="14">神奈川県</option>
                <option value="15">新潟県</option>
                <option value="16">富山県</option>
                <option value="17">石川県</option>
                <option value="18">福井県</option>
                <option value="19">山梨県</option>
                <option value="20">長野県</option>
                <option value="21">岐阜県</option>
                <option value="22">静岡県</option>
                <option value="23">愛知県</option>
                <option value="24">三重県</option>
                <option value="25">滋賀県</option>
                <option value="26">京都府</option>
                <option value="27">大阪府</option>
                <option value="28">兵庫県</option>
                <option value="29">奈良県</option>
                <option value="30">和歌山県</option>
                <option value="31">鳥取県</option>
                <option value="32">島根県</option>
                <option value="33">岡山県</option>
                <option value="34">広島県</option>
                <option value="35">山口県</option>
                <option value="36">徳島県</option>
                <option value="37">香川県</option>
                <option value="38">愛媛県</option>
                <option value="39">高知県</option>
                <option value="40">福岡県</option>
                <option value="41">佐賀県</option>
                <option value="42">長崎県</option>
                <option value="43">熊本県</option>
                <option value="44">大分県</option>
                <option value="45">宮崎県</option>
                <option value="46">鹿児島県</option>
                <option value="47">沖縄県</option>
                <input type="submit" value="確定">
    </select>
  </div>
  
</form>
  
  <form action="soccer_post.php" method="post">
  <?php if(empty($_GET['area_id'])): ?>
    <p>対戦する地域を指定してください。</p>
    <?php elseif(!empty($_GET['area_id'])): ?>
        <input type="hidden" name="area_id" value="<?= $_GET['area_id'] ?>">
        <?php endif ;?>
  <div class="form-group">
    <label for="exampleFormControlSelect2">試合会場</label>
    <select class="form-control" name="coat_id" id="exampleFormControlSelect2">
    <?php foreach($prefDate as $column): ?>
                  <option value="<?php echo $column['coat_id'] ?>"><?php echo $column['coat_name'] ?></option>
                <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">試合日時</label>
    <input type="date" name="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">試合開始時間</label>
    <input type="time" name="time" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">詳細</label>
    <textarea class="form-control" name="detail" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <?php if(isset($_SESSION['team_name'] )):?>
            <input type="submit" value="送信">
          <?php else : ?>
           <p>ログインしてください</p>
          <?php endif ; ?>
  </form>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>