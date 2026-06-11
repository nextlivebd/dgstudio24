<?php
// Fix broken asset paths in all frontend blade views

$files = [
    __DIR__ . '/resources/views/frontend/pages/home.blade.php',
    __DIR__ . '/resources/views/frontend/pages/about.blade.php',
];

// Also scan for any other blade files in frontend/pages
$pagesDir = __DIR__ . '/resources/views/frontend/pages';
if (is_dir($pagesDir)) {
    foreach (glob($pagesDir . '/*.blade.php') as $f) {
        if (!in_array($f, $files)) {
            $files[] = $f;
        }
    }
}

$bad  = "{{ asset('frontend/') }}/{{ asset('frontend/images/') }}/";
$good = "{{ asset('frontend/images/') }}";

$badCss  = "{{ asset('frontend/') }}/";
$goodCss = "{{ asset('frontend/') }}";  // already correct, skip

foreach ($files as $file) {
    if (!file_exists($file)) {
        echo "SKIP (not found): $file\n";
        continue;
    }
    $content = file_get_contents($file);
    $count = substr_count($content, $bad);
    if ($count > 0) {
        $content = str_replace($bad, $good, $content);
        file_put_contents($file, $content);
        echo "FIXED ($count replacements): $file\n";
    } else {
        echo "OK (no bad paths): $file\n";
    }
}

echo "\nDone!\n";
