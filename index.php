<?php
$admin_password = 'is_admin';

function sanitize($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'] ?? '';
    $action = $_POST['action'] ?? '';
    $filename = sanitize($_POST['filename'] ?? '');
    $content = $_POST['content'] ?? '';

    if ($password !== $admin_password) {
        die('不正なパスワードです。');
    }

    switch ($action) {
        case 'add':
            file_put_contents($filename, $content);
            break;
        case 'edit':
            file_put_contents($filename, $content);
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no>
<title>ファイルマネージャー</title>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #121212; 
        color: #fff;
        padding: 20px;
    }
    input, textarea, select {
        display: block;
        margin-top: 10px;
        width: 300px;
        padding: 10px;
        background-color: #333; 
        border: 1px solid #555; 
        border-radius: 20px; 
        color: #fff;
    }
    input[type="submit"] {
        background: linear-gradient(145deg, #6a3093, #a044ff); 
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        transition: transform 0.2s ease; 
        border-radius: 30px; 
    }
    input[type="submit"]:hover {
        background: linear-gradient(145deg, #a044ff, #6a3093); 
        transform: scale(1.1); 
    }
</style>
</head>
<body>
<h1>ファイルマネージャー</h1>
<form method="POST">
    <label for="password">管理パスワード:</label>
    <input type="password" id="password" name="password" required>

    <label for="action">アクションを選択:</label>
    <select id="action" name="action" required>
        <option value="add">追加</option>
        <option value="edit">編集</option>
    </select>

    <label for="filename">ファイル名:</label>
    <input type="text" id="filename" name="filename">

    <label for="content">内容:</label>
    <textarea id="content" name="content"></textarea>

    <input type="submit" value="実行">
</form>
</body>
</html>

