<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$page = App\Models\Page::where('slug', 'contact-us')->first();
if ($page) {
    $content = $page->content;
    $content = str_replace('action="https://shehala.com/contact-us"', 'action="/contact-us"', $content);
    $page->content = $content;
    $page->save();
    echo "Updated contact-us action URL.";
} else {
    echo "Page not found.";
}
