<?php
session_start(); 
require_once('funcs.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>ユーザー登録</title>
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
        input[type="text"], input[type="password"], input[type="email"], textarea {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
        }
        input[type="submit"], .admin-link {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
            display: inline-block;
        }
        .admin-link {
            background-color: #555;
            display: inline-block;
            width: auto;
            padding: 10px 15px;
        }
        .button-link {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
            display: inline-block;
            text-align: center;
        }
    </style>

</head>
<body>
<h1>ユーザー登録</h1>

    <form action="signup.php" method="post">
        <label>ユーザー名:<input type="text" name="username" required></label>
        <label>パスワード:<input type="password" name="password" required></label>
        <input type="submit" value="登録する">
    </form>

    <?php
    require_once('funcs.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt the password

        $pdo = connectDb();
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $status = $stmt->execute([$username, $password]);
        if ($status) {
            echo '<p>ユーザー登録しました</p>';
        } else {
            echo '<p>ユーザー登録に失敗しました</p>';
        }
    }
    ?>
    <a href="admin.php" class="button-link">管理画面トップに戻る</a>

</body>
</html>
