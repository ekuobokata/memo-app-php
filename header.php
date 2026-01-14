<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="site-title">
    <h1>メモるん</h1>
    <p>簡易授業内容メモサイト</p>
</div>

<div class="header">
<?php if (isset($_SESSION['user_id'])): ?>

    <div class="login-status">
        ログイン中：<?= htmlspecialchars($_SESSION["username"], ENT_QUOTES, "UTF-8") ?> さん
    </div>

    <form action="logout.php" method="post" style="display:inline;">
        <button type="submit" class="btn-blue">ログアウト</button>
    </form>

<?php else: ?>

    <div class="login-status">
        ログアウト中
    </div>

<?php endif; ?>

<hr>

</div>