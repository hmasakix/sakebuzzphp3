<?php
include('functions.php');
$pdo = connect_to_db();

$sql = 'SELECT * FROM sakebuzz ORDER BY product_name ASC';

$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";

foreach ($result as $record) {
  $output .= "
    <tr>
      <td>{$record["product_name"]}</td>
      <td>{$record["flavor"]}</td>
      <td>{$record["restaurant"]}</td>
      <td>
        <a href='sakebuzz_edit.php?id={$record["id"]}'>編集</a>
      </td>
      <td>
        <a href='sakebuzz_delete.php?id={$record["id"]}'>削除</a>
      </td>
    </tr>
  ";
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sakebuzz（一覧画面）</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      
    }
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
      background-color: #ffc1cc;
    }
    @media screen and (max-width: 600px) {
      table, thead, tbody, th, td, tr {
        display: block;
        
    }
    thead tr {
      position: absolute;
      top: -9999px;
      left: -9999px;
    }
    tr {
      border: 1px solid black;
      
    }
    td {
      border: none;
      border-bottom: 1px solid black;
      position: relative;
      padding-left: 50%;
      
    }
    td:before {
      position: absolute;
      top: 6px;
      left: 6px;
      width: 45%;
      padding-right: 10px;
      white-space: nowrap;
      content: attr(data-label);
      font-weight: bold;
    }
    }
  </style>
</head>

<body>
  <fieldset>
    <legend>sakebuzz（一覧画面）</legend>
    <h2>
        日本酒を飲んだ記録です。
    </h2>
    <table>
      <thead>
        <tr>
            <th>お酒の名前</th> 
            <th>味の特徴</th>
            <th>お店の名前</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>product_name</td><td>flavor</td><td>restaurant</td></tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
    <a href="sakebuzz_input.php">入力画面</a>  
 
  </fieldset>
</body>

</html>