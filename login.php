<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';

$error = "";

if (!empty($_POST["login"])) {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username=:username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        header("Location: index.php");
        exit;
    } else {
        $error = "ユーザー名またはパスワードが違います";
    }
}
?>

<?php include __DIR__ . '/header.php'; ?>

<h2>ログイン</h2>

<?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form action="" method="post">
    ユーザー名：<input type="text" name="username" placeholder="ユーザー名を入力" required><br>
    パスワード：<input type="password" name="password" placeholder="パスワードを半角入力" required><br>
    <input type="submit" name="login" value="ログイン" class="btn-blue">
</form>

<p><a href="register.php"class="btn-white">新規登録はこちら</a></p>

</body>
</html>
