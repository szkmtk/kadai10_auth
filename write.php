<?php
require_once('funcs.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '未記入';
    $email = $_POST['email'] ?? '未記入';
    $book = $_POST['book'] ?? '未記入';
    $reason = $_POST['reason'] ?? '未記入';

    insertData($name, $email, $book, $reason);
}
