<?php
include('functions.php');

// POSTデータ確認
if (
    !isset($_POST['product_name']) || $_POST['product_name'] === '' ||
    !isset($_POST['flavor']) || $_POST['flavor'] === ''||
    !isset($_POST['restaurant']) || $_POST['restaurant'] === ''||
    !isset($_POST['created_at']) || $_POST['created_at'] === ''
    ) {
    exit('ParamError');
  }

  $product_name = $_POST['product_name'];
  $flavor = $_POST['flavor']; 
  $restaurant = $_POST['restaurant']; 
  $created_at = $_POST['created_at']; 

// 各種項目設定
$dbn ='mysql:dbname=gs_php_dev16;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

// SQL作成&実行
$sql = 'INSERT INTO sakebuzz (id, product_name, flavor, restaurant, updated_at) VALUES (NULL, :product_name, :flavor, :restaurant,now())';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':product_name', $product_name, PDO::PARAM_STR);
$stmt->bindValue(':flavor', $flavor, PDO::PARAM_STR);
$stmt->bindValue(':restaurant', $restaurant, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行の処理
header('Location:sakebuzz_input.php');
exit();