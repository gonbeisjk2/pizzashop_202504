<?php
require './config/dbconnect.php';

$sql = 'SELECT * FROM pizzas';
$stmt = $db->query($sql); //stmt = PDOStatement オブジェクト(データ取扱専門部署)が作成される
// $result = $stmt->fetch(); // データ取得
$resultAll = $stmt->fetchAll(); // データ取得(全件)
// echo '<pre>';
// var_dump($result);
// var_dump($resultAll);
// echo '</pre>';

?>
<?php include './template/header.php' ?>

<div class="container">

  <h1 class="text-center my-5 display-4">Our Special Pizzas</h1>

  <div class="row">
    <?php foreach ($resultAll as $pizza): ?>
      <div class="col-lg-4 mb-3">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title h4"><?= htmlspecialchars($pizza['pizza_name']); ?></h2>
            <p class="card-text"><?= htmlspecialchars($pizza['toppings']); ?></p>
            <a href="detail.php?id=<?= htmlspecialchars($pizza['id']); ?>" class="btn btn-primary">詳細</a>
          </div>
        </div><!-- /card -->
      </div><!-- /col-lg-4 -->
    <?php endforeach; ?>
  </div>

</div>

<?php include './template/footer.php' ?>