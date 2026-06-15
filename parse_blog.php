<?php
$html = file_get_contents('blog.html');
libxml_use_internal_errors(true);
$dom = new \DOMDocument();
$dom->loadHTML($html);
libxml_clear_errors();
$xpath = new \DOMXPath($dom);

$postNodes = $xpath->query('//article[contains(@class, "post")]');
$items = [];

foreach ($postNodes as $itemNode) {
    $imgNode = $xpath->query('.//div[contains(@class, "ttm-post-featured")]//img', $itemNode)->item(0);
    $titleNode = $xpath->query('.//h2[contains(@class, "entry-title")]/a', $itemNode)->item(0);
    $descNode = $xpath->query('.//div[contains(@class, "ttm-box-desc-text")]', $itemNode)->item(0);

    if ($titleNode) {
        $src = $imgNode ? $imgNode->getAttribute('src') : '';
        $title = trim($titleNode->textContent);
        $link = $titleNode->getAttribute('href');
        $desc = '';
        if ($descNode) {
            foreach ($descNode->childNodes as $child) {
                $desc .= $dom->saveHTML($child);
            }
            $desc = trim($desc);
        }
        
        if ($src && str_starts_with($src, '../')) {
            $src = 'https://shehala.com/' . substr($src, 3);
        } elseif ($src && !str_starts_with($src, 'http')) {
            $src = 'https://shehala.com' . (str_starts_with($src, '/') ? '' : '/') . $src;
        }

        $items[] = [
            'title' => $title,
            'image' => $src,
            'website_url' => $link,
            'description' => $desc
        ];
    }
}

echo json_encode($items, JSON_PRETTY_PRINT);
