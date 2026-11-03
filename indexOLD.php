<?php

// Domain chính thức
$mainDomain = 'ngochoi.net';

// Domain hiện tại
$currentDomain = strtolower($_SERVER['HTTP_HOST'] ?? '');

// Loại bỏ port nếu có, ví dụ:
// ngochhoi.net:443 -> ngochhoi.net
$currentDomain = preg_replace('/:\d+$/', '', $currentDomain);

// Nếu domain hiện tại KHÔNG phải domain chính
if ($currentDomain !== $mainDomain) {

    // Giữ nguyên path và query string
    $path = $_SERVER['REQUEST_URI'] ?? '/';

    // Redirect vĩnh viễn (301)
    header(
        'Location: https://' . $mainDomain . $path,
        true,
        301
    );

    exit;
}


// Nếu đã đúng domain chính thì hiển thị Home.html
$contentFile = __DIR__ . '/Home.html';

if (is_file($contentFile)) {
    readfile($contentFile);
    exit;
}


// Không tìm thấy Home.html
http_response_code(500);
echo 'Home.html not found.';
?>
