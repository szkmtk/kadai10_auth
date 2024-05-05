<!DOCTYPE html>
<html>
<head>
    <title>Edit Response</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f4f9;
            color: #333;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <?php
    require_once('funcs.php');
    $pdo = connectDb();
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        // IDに基づいてデータを取得
        $stmt = $pdo->prepare("SELECT * FROM responses WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $response = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($response) {
            echo "<h2>アンケート回答の編集</h2>";
            echo "<form action='edit.php' method='post'>";
            echo "<input type='hidden' name='id' value='{$response['id']}' />";
            echo "<label>Name: <input type='text' name='name' value='{$response['name']}' /></label>";
            echo "<label>Email: <input type='email' name='email' value='{$response['email']}' /></label>";
            echo "<label>Book: <input type='text' name='book' value='{$response['book']}' /></label>";
            echo "<label>Reason: <textarea name='reason'>{$response['reason']}</textarea></label>";
            echo "<input type='submit' value='更新' />";
            echo "</form>";
        } else {
            echo "該当するデータが見つかりません。";
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // フォームデータの更新を処理
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $book = $_POST['book'];
        $reason = $_POST['reason'];
        updateData($id, $name, $email, $book, $reason);
    }
    ?>
</body>
</html>
