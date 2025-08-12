<?php
// エラーメッセージ用の配列
$errors = [
  'pizza-name' => '',
  'chef-name' => '',
  'toppings' => '',
];

// 入力値再反映用変数
$pizzaname = '';

// 送信チェック
if (isset($_POST['submit'])) {


  echo '<pre>';
  var_dump($_POST);
  echo '</pre>';

  // echo $_POST['pizza-name'];
  // echo '<br>';
  // echo htmlspecialchars($_POST['pizza-name']);

  // 検証
  if (empty($_POST['pizza-name'])) {
    $errors['pizza-name'] = 'ピザの名前が入力されていません';
  } else {
    $pizzaname = $_POST['pizza-name'];
    if (!preg_match('/^([^\x01-\x7E]|[\da-zA-Z ])+$/', $_POST['pizza-name'])) {
      $errors['pizza-name'] = '日本語、英数字のみ有効です。記号等は使用できません';
    }
  }

  if (empty($_POST['chef-name'])) {
    $errors['chef-name'] = 'シェフの名前が入力されていません';
  } else {
    if (!preg_match('/^([^\x01-\x7E]|[\da-zA-Z ])+$/', $_POST['chef-name'])) {
      $errors['chef-name'] = '日本語、英数字のみ有効です。記号等は使用できません';
    }
  }

  if (empty($_POST['toppings'])) {
    $errors['toppings'] = 'トッピングが入力されていません';
  } else {
    if (!preg_match('/^([^\x01-\x7E]|[\da-zA-Z ])+$/', $_POST['toppings'])) {
      $errors['toppings'] = '日本語、英数字のみ有効です。記号等は使用できません';
    }
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
          <input type="text" class="form-control" id="pizza-name" name="pizza-name" value="<?= $pizzaname; ?>">
          <small class="form-text text-danger"><?= $errors['pizza-name']; ?></small>
        </div>
        <div class="mb-3">
          <label for="chef-name" class="form-label">シェフの名前</label>
          <input type="text" class="form-control" id="chef-name" name="chef-name">
          <small class="form-text text-danger"><?= $errors['chef-name']; ?></small>
        </div>
        <div class="mb-3">
          <label for="toppings" class="form-label">トッピング</label>
          <input type="text" class="form-control" id="toppings" name="toppings">
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