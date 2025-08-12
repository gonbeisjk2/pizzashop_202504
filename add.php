<?php
// エラーメッセージ用の配列
$errors = [
  'pizza-name' => '',
  'chef-name' => '',
  'toppings' => '',
];

// 入力値再反映用変数
$pizzaname = '';
$chefname = '';
$toppings = '';

// $error_flag = false;

// 送信チェック
if (isset($_POST['submit'])) {
  // echo '<pre>';
  // var_dump($_POST);
  // echo '</pre>';

  // echo $_POST['pizza-name'];
  // echo '<br>';
  // echo htmlspecialchars($_POST['pizza-name']);

  // 検証
  if (empty($_POST['pizza-name'])) {
    $errors['pizza-name'] = 'ピザの名前が入力されていません';
    // $error_flag = true;
  } else {
    $pizzaname = $_POST['pizza-name'];
    if (!preg_match('/^([^\x01-\x7E]|[\da-zA-Z ])+$/', $_POST['pizza-name'])) {
      $errors['pizza-name'] = '日本語、英数字のみ有効です。記号等は使用できません';
      // $error_flag = true;
    }
  }

  if (empty($_POST['chef-name'])) {
    $errors['chef-name'] = 'シェフの名前が入力されていません';
  } else {
    $chefname = $_POST['chef-name'];
    if (!preg_match('/^([^\x01-\x7E]|[\da-zA-Z ])+$/', $_POST['chef-name'])) {
      $errors['chef-name'] = '日本語、英数字のみ有効です。記号等は使用できません';
    }
  }

  if (empty($_POST['toppings'])) {
    $errors['toppings'] = 'トッピングが入力されていません';
  } else {
    $toppings = $_POST['toppings'];
    if (!preg_match('/^([^\x01-\x7E]|[\da-zA-Z ])+$/', $_POST['toppings'])) {
      $errors['toppings'] = '日本語、英数字のみ有効です。記号等は使用できません';
    }
  }

  // エラーがあったかどうかをチェック
  // if ($error_flag) {
  //   echo '何らかのエラーがありました';
  // }

  // array_filter エラーメッセージを含む配列（エラーがあった場合）、もしくは空の配列(エラーがなかった場合)
  // if文に要素がある配列を入れるとtrue, 空の配列を入れるとfalse
  // エラーがなかった場合の処理
  if (!array_filter($errors)) {
    // TOPページへリダイレクト
    header("location: index.php");
    exit; //処理をここでストップする
  }
}
?>
<?php include './template/header.php' ?>

<div class="container">
  <h1 class="my-5 h4 text-center">ピザの追加</h1>

  <div class="row justify-content-center">
    <div class="col-md-8 bg-white p-4 rounded">

      <form action="add.php" method="post">
        <div class="mb-3">
          <label for="pizza-name" class="form-label">ピザの名前</label>
          <input type="text" class="form-control" id="pizza-name" name="pizza-name" value="<?= htmlspecialchars($pizzaname); ?>">
          <small class="form-text text-danger"><?= $errors['pizza-name']; ?></small>
        </div>
        <div class="mb-3">
          <label for="chef-name" class="form-label">シェフの名前</label>
          <input type="text" class="form-control" id="chef-name" name="chef-name" value="<?= htmlspecialchars($chefname); ?>">
          <small class="form-text text-danger"><?= $errors['chef-name']; ?></small>
        </div>
        <div class="mb-3">
          <label for="toppings" class="form-label">トッピング</label>
          <input type="text" class="form-control" id="toppings" name="toppings" value="<?= htmlspecialchars($toppings); ?>">
          <small class="form-text text-danger"><?= $errors['toppings']; ?></small>
        </div>
        <div class="text-center">
          <button class="btn btn-primary" name="submit" value="submit">追加する</button>
        </div>
      </form>

    </div>
  </div>
</div>


<?php include './template/footer.php' ?>