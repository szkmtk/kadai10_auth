<?php
session_start(); // セッションを開始
session_destroy(); // セッション変数を全て削除
header('Location: login.php'); // ログインページにリダイレクト
exit;
?>
