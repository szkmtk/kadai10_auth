
<!DOCTYPE html>
<html>
<head>
    <title>ログイン</title>
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
        input[type="text"], input[type="email"], textarea {
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
    </style>
</head>
<body>
    <form action="login.php" method="post">
        <label>ユーザー名：<input type="text" name="username" required></label>
        <label>パスワード：<input type="password" name="password" required></label>
        <input type="submit" value="ログイン">
    </form>

    <?php
    session_start();
    require_once('funcs.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $pdo = connectDb();
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id'];  // Set user ID in session
            redirect('admin.php');
        } else {
            echo '<p style="color: red; text-align: center;">無効なログイン情報です。</p>';
        }
    }
    ?>
</body>
</html>
