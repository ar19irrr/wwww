<?php
// غیرفعال کردن نمایش خطا به کاربر
error_reporting(E_ALL);
ini_set('display_errors', 0);

// دریافت داده از تلگرام
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// لاگ برای دیباگ
file_put_contents('bot_debug.log', date('Y-m-d H:i:s') . " | " . $json . "\n", FILE_APPEND);

// پاسخ حتماً باید 200 باشد
http_response_code(200);
echo json_encode(['ok' => true]);

// پردازش پیام
if (isset($data['message']['chat']['id'])) {
    $chatId = $data['message']['chat']['id'];
    $text = $data['message']['text'] ?? '';
    
    if ($text === '/start') {
        $token = "8520546535:AAGUOnE7GYqTKb3jvt49DO_RatT8bgcWSNA";
        $message = urlencode("سلام! ربات کار میکنه ✅");
        file_get_contents("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chatId}&text={$message}");
    }
}
?>