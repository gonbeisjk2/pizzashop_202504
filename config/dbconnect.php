<?php
// DBへの接続
$dsn = 'mysql:host=localhost;dbname=pizzashop;charset=utf8';
$user = 'pizzataro';
$pass = 'b3gILmXNHF[/0oDg';
$option = [
  // エラーの表示の仕方
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  // データの受け取り方（連想配列として受け取る設定）ASSOC = Associative Array(連想配列)の略
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
  $db = new PDO($dsn, $user, $pass, $option);
  // var_dump($db);
} catch (PDOException $error) {
  // echo '<pre>';
  // var_dump($error);
  // echo '</pre>';

  echo $error->getMessage();
}
