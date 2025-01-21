<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sakebuzz（入力画面）</title>
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
  <form action="sakebuzz_create.php" method="POST">
    <fieldset>
      <legend>sakebuzz（入力画面）</legend>
      <h2>
        日本酒を飲んだ記録をつけましょう。
      </h2>
      <div>
        最近飲んだお酒の名前、味の特徴、お店の名前を投稿します。
      </div>
      <div>
        お酒の名前: <input type="text" name="product_name">
      </div>
      <div>
        味の特徴: <input type="text" name="flavor">
      </div>
      <div>
        お店の名前: <input type="text" name="restaurant">
      </div>
      <div>
        記入日: <input type="date" name="created_at">
      </div>
      <div>
        <button>投稿</button>
      </div>
      <a href="sakebuzz_read.php">一覧画面</a>
    </fieldset>
  </form>

</body>

</html>

