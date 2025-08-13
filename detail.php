<?php
// idパラメーターがない場合TOPページへリダイレクト
if (!isset($_GET['id'])) {
  header('location: index.php');
  exit;
}

require './config/dbconnect.php';

$sql = 'SELECT * FROM pizzas WHERE id = ?';
// 👇セキュリティ上良くない書き方
// $db->query("SELECT * FROM pizzas WHERE id = {$_GET['id']}");
$stmt = $db->prepare($sql);
$stmt->bindValue(1, $_GET['id']);
$result = $stmt->execute();

if ($result) {
  $pizza = $stmt->fetch(); //1件のみデータを取得
}

?>
<?php include './template/header.php' ?>

<div class="container">
  <h1 class="h3 text-center">Pizza Detail</h1>

  <?php if (isset($pizza) && !empty($pizza)): ?>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card">
          <img src="./img/pizza.jpg" alt="" class="card-img-top">
          <div class="card-body">
            <h2 class="h4"><?= htmlspecialchars($pizza['pizza_name']); ?></h2>
            <p class="card-text">
              <?= htmlspecialchars($pizza['toppings']); ?>
            </p>
            <p class="card-text text-secondary">
              <?= htmlspecialchars($pizza['chef_name']); ?>
            </p>
            <p class="card-text text-end fs-6">
              <?= htmlspecialchars($pizza['created_at']); ?>
            </p>
          </div>
          <div class="card-footer text-end">
            <button class="btn btn-danger">削除</button>
          </div>
        </div>
      </div>
    </div>
  <?php else: ?>
    <p class="alert alert-danger">
      ピザの情報が存在しません
    </p>
    <div class="text-center">
      <a href="index.php" class="btn btn-primary">TOPページへ戻る</a>
    </div>
  <?php endif; ?>
</div>

<?php include './template/footer.php' ?>