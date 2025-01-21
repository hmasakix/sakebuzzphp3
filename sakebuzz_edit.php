<?php
include("functions.php");

$id = $_GET["id"];

$pdo = connect_to_db();

$sql = 'SELECT * FROM sakebuzz WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sakebuzz（編集画面）</title>
  <style>
     body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    fieldset {
      border: 1px solid #ccc;
      padding: 20px;
      margin-bottom: 20px;
      background-color: #fdfe55;
    } 

    legend {
      font-size: 18px;
      font-weight: bold;
    }

    div {
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="date"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    button {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background-color: #45a049;
    }

    a {
      display: inline-block;
      margin-top: 10px;
      color: #333;
      text-decoration: none;
    }

    @media screen and (max-width: 600px) {
      input[type="text"],
      input[type="date"],
      button {
        width: 100%;
      }
    }
  </style> 
</head>

<body>
  <form action="sakebuzz_update.php" method="POST">
    <fieldset>
      <legend>sakebuzz（編集画面）</legend>
      <h4>
        編集できます。
      </h4>
      <a href="sakebuzz_read.php">一覧画面</a>
      <div>
        お酒の名前 <input type="text" name="product_name" value="<?= $record["product_name"] ?>">
      </div>
      <div>
        味の特徴 <input type="text" name="flavor" value="<?= $record["flavor"] ?>">
      </div> 
      <div>
        お店の名前 <input type="text" name="restaurant" value="<?= $record["restaurant"] ?>">
      </div>
      <div>
        <button>更新</button>
      </div>
      <input type="hidden" name="id" value="<?= $record["id"] ?>">
    </fieldset>
  </form>

</body>

</html>