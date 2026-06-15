<?php
$html = file_get_contents('portfolio.html');
libxml_use_internal_errors(true);
$dom = new \DOMDocument();
$dom->loadHTML($html);
libxml_clear_errors();
$xpath = new \DOMXPath($dom);

$categoryNodes = $xpath->query('//ul[contains(@class, "tabs")]/li/a');
$categories = [];
foreach ($categoryNodes as $node) {
    $catName = trim($node->textContent);
    if ($catName && strtolower($catName) !== 'all') {
        $categories[] = $catName;
    }
}

$portfolioNodes = $xpath->query('//div[contains(@class, "featured-imagebox-portfolio")]');
$items = [];
foreach ($portfolioNodes as $itemNode) {
    $imgNode = $xpath->query('.//img', $itemNode)->item(0);
    $titleNode = $xpath->query('.//div[contains(@class, "featured-title")]//a', $itemNode)->item(0);
    $catNode = $xpath->query('.//div[contains(@class, "category")]//p', $itemNode)->item(0);

    if ($imgNode && $titleNode) {
        $src = $imgNode->getAttribute('src');
        $title = trim($titleNode->textContent);
        $link = $titleNode->getAttribute('href');
        $catText = $catNode ? trim($catNode->textContent) : 'General';
        
        if (str_starts_with($src, '../')) {
            $src = 'https://shehala.com/' . substr($src, 3);
        } elseif (!str_starts_with($src, 'http')) {
            $src = 'https://shehala.com' . (str_starts_with($src, '/') ? '' : '/') . $src;
        }

        $items[] = [
            'category' => $catText,
            'title' => $title,
            'image' => $src,
            'website_url' => $link
        ];
    }
}

echo "CATEGORIES:\n";
print_r($categories);
echo "\nITEMS:\n";
echo json_encode($items, JSON_PRETTY_PRINT);
