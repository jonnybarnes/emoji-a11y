<?php

// this file generates the emoji array and regular expression from the full emoji list:
// http://unicode.org/emoji/charts/full-emoji-list.html

$emoji = [];

$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->loadHTMLFile('./full-emoji-list.html');
$rows = $dom->getElementsByTagName('tr');
foreach ($rows as $row) {
    if ($row->firstChild->nodeName == 'td') {
        $items = $row->childNodes;
        $emojiCode = $items->item(2)->nodeValue;
        $emojiDescription = $items->item(32)->nodeValue;
        $emoji[$emojiCode] = $emojiDescription;
    }
}

$points = array_map(function ($key) {
    return str_replace('U+', '', $key);
}, array_keys($emoji));

usort($points, function ($a, $b) {
    if (strlen($a) == strlen($b)) {
        return 0;
    }

    return (strlen($a) < strlen($b)) ? 1 : -1;
});

$search = '/';
foreach($points as $point) {
    $hexes = explode(' ', $point);
    foreach ($hexes as $hex) {
        $search .= '\x{' . $hex . '}';
    }
    $search .= '|';
}
$search = rtrim($search, '|') . '/u';

echo 'The emoji array: ' . PHP_EOL;
echo '[' . PHP_EOL;
foreach ($emoji as $key => $value) {
    echo "    '$key' => '$value'" . PHP_EOL;
}
echo ']' . PHP_EOL;
echo 'The regular expression: ' . PHP_EOL;
echo $search . PHP_EOL;
