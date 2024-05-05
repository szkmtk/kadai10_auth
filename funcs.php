<?php
function connectDb() {
    $dsn = 'mysql:dbname=survey;charset=utf8;host=localhost';
    $user = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $user, $password);
        return $pdo;
    } catch (PDOException $e) {
        exit('データベース接続エラー:' . $e->getMessage());
    }
}

function insertData($name, $email, $book, $reason) {
    $pdo = connectDb();
    $sql = "INSERT INTO responses (name, email, book, reason) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $status = $stmt->execute([$name, $email, $book, $reason]);
    if ($status) {
        redirect('thanks.php');
    } else {
        sqlError($stmt);
    }
}

function updateData($id, $name, $email, $book, $reason) {
    $pdo = connectDb();
    $sql = "UPDATE responses SET name = ?, email = ?, book = ?, reason = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $status = $stmt->execute([$name, $email, $book, $reason, $id]);
    if ($status) {
        redirect('read.php');
    } else {
        sqlError($stmt);
    }
}

function deleteData($id) {
    $pdo = connectDb();
    $sql = "DELETE FROM responses WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $status = $stmt->execute([$id]);
    if ($status) {
        redirect('read.php');
    } else {
        sqlError($stmt);
    }
}

function sqlError($stmt) {
    $error = $stmt->errorInfo();
    exit("SQL実行エラー:" . $error[2]);
}

function redirect($page) {
    header("Location: " . $page);
    exit;
}
