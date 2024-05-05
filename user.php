<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', 'error_log.txt');

session_start();

require_once('funcs.php');

if (!isset($_SESSION['user_id'])) {
    redirect('login.php');
}

$pdo = connectDb();
$stmt = $pdo->prepare("SELECT id, username FROM users ORDER BY id");
$stmt->execute();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー一覧</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f4f9;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {background-color: #f5f5f5;}
        .button-link {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            margin-top: 20px;
            margin-bottom: 20px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
            display: inline-block;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>登録ユーザー一覧</h1>
    <a href="signup.php" class="button-link">ユーザー登録</a>
    <table>
        <tr>
            <th>ID</th>
            <th>ユーザー名</th>
        </tr>
        <?php
        while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($user['id']) . "</td>";
            echo "<td>" . htmlspecialchars($user['username']) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <a href="admin.php" class="button-link">管理画面トップに戻る</a>
</body>
</html>
