<?php
$css = file_get_contents('https://www.shehala.com/public/frontend/css/custom.css');
preg_match_all('/background-image:\s*url\([\'"]?(.*?)[\'"]?\)/i', $css, $matches);
foreach ($matches[1] as $img) {
    if (strpos($img, 'col-bg') !== false || strpos($img, 'banner') !== false) {
        echo "Found: " . $img . "\n";
    }
}
