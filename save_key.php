<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ip = filter_input(INPUT_POST, 'ip', FILTER_VALIDATE_IP);
    $expiration = $_POST['expiration'];

    $expirationDate = new DateTime();
    switch ($expiration) {
        case '1day':
            $expirationDate->modify('+1 day');
            break;
        case '7days':
            $expirationDate->modify('+7 days');
            break;
        case '30days':
            $expirationDate->modify('+30 days');
            break;
        case '365days':
            $expirationDate->modify('+365 days');
            break;
        default:
            $expirationDate->modify('+1 day');
    }

    $key = bin2hex(random_bytes(8)); 
    $formattedExpirationDate = $expirationDate->format('Y-m-d');

    $filename = 'key.txt';
    $content = "{$key}={$ip}={$formattedExpirationDate}\n";
    file_put_contents($filename, $content, FILE_APPEND);

    echo "キーが正常に生成されました。キー: {$key}, 期限: {$formattedExpirationDate}";
} else {
    echo "このページはPOSTリクエスト専用です。";
}
?>