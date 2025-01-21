<?php
include("functions.php");

if (
  !isset($_POST['product_name']) || $_POST['product_name'] === '' ||
  !isset($_POST['flavor']) || $_POST['flavor'] === ''||
  !isset($_POST['restaurant']) || $_POST['restaurant'] === ''||
  !isset($_POST['id']) || $_POST['id'] === ''
  // !isset($_POST['created_at']) || $_POST['created_at'] === ''
) {
  exit('paramError');
}

$product_name = $_POST["product_name"];
$flavor = $_POST["flavor"];
$restaurant = $_POST["restaurant"];
$id = $_POST["id"];

$pdo = connect_to_db();

$sql = "UPDATE sakebuzz SET product_name=:product_name, flavor=:flavor, restaurant=:restaurant, updated_at=now() WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':product_name', $product_name, PDO::PARAM_STR);
$stmt->bindValue(':flavor', $flavor, PDO::PARAM_STR);
$stmt->bindValue(':restaurant', $restaurant, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:sakebuzz_read.php");
exit();
