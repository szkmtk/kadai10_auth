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
    <title>管理画面トップ</title>
</head>
<body>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 40px;
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
        .button-link {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .admin-link {
            background-color: #555;
            display: inline-block;
            width: auto;
            padding: 10px 15px;
        }
    </style>
    <h1>管理画面トップ</h1>
    <a href="read.php" class="button-link">アンケート一覧</a>
    <a href="user.php" class="button-link">ユーザー一覧</a>
    <a href="logout.php" class="button-link">ログアウト</a>
</body>
</html>
