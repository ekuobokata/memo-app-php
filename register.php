<?php
require 'db.php';
require 'functions.php';

if (!empty($_POST["register"])) {
    $username = trim($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    header("Location: login.php");
    exit;
}
?>

<?php include 'header.php'; ?>

<h2>新規ユーザー登録</h2>

<form action="" method="post">
    ユーザー名：<input type="text" name="username" placeholder="ユーザー名を入力" required><br>
    パスワード：<input type="password" name="password" placeholder="パスワードを半角入力" required><br>
    <input type="submit" name="register" value="登録" class="btn-blue">
</form>

<p><a href="login.php" class="btn-white">ログイン画面へ戻る</a></p>


</body>
</html>