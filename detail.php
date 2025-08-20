<?php
session_start();

require './config/dbconnect.php';

// 商品削除用コード =========================
if (isset($_POST['delete'])) {
  $sql = 'DELETE FROM pizzas WHERE id = ?';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(1, $_POST['delete']);
  $result = $stmt->execute();

  if ($result && $stmt->rowCount()) {
    $_SESSION['message'] = "{$_POST['delete']}のピザの削除に成功しました";
    header('location: index.php');
    exit;
  }
}

// 詳細ページ表示用コード =========================
// idパラメーターがない場合TOPページへリダイレクト
if (!isset($_GET['id'])) {
  header('location: index.php');
  exit;
}

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
          <div class="card-footer text-end d-flex justify-content-end gap-2">
            <a href="update.php?id=<?= htmlspecialchars($pizza['id']); ?>" class="btn btn-primary">編集</a>
            <form action="detail.php" method="post" id="delete-form">
              <input type="hidden" name="delete" value="<?= htmlspecialchars($pizza['id']); ?>">
              <button class="btn btn-danger">削除</button>
            </form>
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

<script>
  const deleteForm = document.querySelector('#delete-form');

  deleteForm.addEventListener('submit', e => {
    e.preventDefault();
    if (confirm('本当に削除しますか？')) {
      deleteForm.submit();
    }
  });
</script>

<?php include './template/footer.php' ?>