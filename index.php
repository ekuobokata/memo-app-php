<?php
require_once 'db.php';
require_once 'functions.php';

// ログイン必須
ensure_logged_in();

$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];



// 新規投稿 or 編集保存
if (!empty($_POST["save"])) {
    $title = trim($_POST["title"]);
    $content = trim($_POST["content"]);
    $pw = trim($_POST["password"]);
    $datetime = date("Y-m-d H:i:s");

    // 編集
    if (!empty($_POST["edit_id"])) {
        $id = $_POST["edit_id"];

        $sql = "UPDATE memos SET title=:title, content=:content, password=:pw, created_at=:dt 
                WHERE id=:id AND user_id=:uid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":pw", $pw);
        $stmt->bindParam(":dt", $datetime);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":uid", $user_id);
        $stmt->execute();

    } else {
        // 新規作成
        $sql = "INSERT INTO memos (user_id, title, content, password, created_at)
                VALUES (:uid, :title, :content, :pw, :dt)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":uid", $user_id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":pw", $pw);
        $stmt->bindParam(":dt", $datetime);
        $stmt->execute();
    }
}
