<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// HTMLエスケープ
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// ログインしていなければ login.php へ
function ensure_logged_in() {
    if (empty($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }
}
