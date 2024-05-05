
<?php
session_start(); // Start the session.
require_once('funcs.php');

// Check if the user is logged in, if not redirect to 'index.php'.
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>アンケート結果</title>
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
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
            display: inline-block;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>アンケート結果一覧</h1>
    <table>
        <tr>
            <th>名前</th>
            <th>Email</th>
            <th>好きな本</th>
            <th>理由</th>
            <th>操作</th>
        </tr>
        <?php
        $pdo = connectDb();
        $stmt = $pdo->prepare("SELECT id, name, email, book, reason FROM responses ORDER BY id DESC");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['book']}</td>";
            echo "<td>{$row['reason']}</td>";
            echo "<td><a href='edit.php?id={$row['id']}'>編集</a> | <a href='delete.php?id={$row['id']}'>削除</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <a href="admin.php" class="button-link">管理画面トップに戻る</a>
</body>
</html>
