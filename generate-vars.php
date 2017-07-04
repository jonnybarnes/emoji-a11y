<?php

/*
 * The file `src/EmojiModifier.php` contains two variables defined in the
 * contructor. An array where the keys are the unicode codepoints of the various
 * emoji sequences, and the values are the associated descriptions. There is
 * also a string which is a regular expression to match the emoji sequences.
 * These variables are derived from the unicode conosrtium maintained full emoji
 * list. This can be found at:
 * <http://unicode.org/emoji/charts/full-emoji-list.html>.
 */

try {
    $fullEmojiList = new SplFileObject('./full-emoji-list.html');
} catch (RuntimeException $exception) {
    //file doesn’t exist, so lets create it.
    echo 'Getting source file.' . PHP_EOL;
    $fullEmojiList = new SplFileObject('./full-emoji-list.html', 'w');
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => 'http://unicode.org/emoji/charts/full-emoji-list.html',
        CURLOPT_HEADER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
    ]);
    $html = curl_exec($ch);
    $fullEmojiList->fwrite($html);
}

$emoji = [];

echo 'Reading/parsing the html file.' . PHP_EOL;
libxml_use_internal_errors(true);
$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->loadHTMLFile('./full-emoji-list.html');
$rows = $dom->getElementsByTagName('tr');
foreach ($rows as $row) {
    if ($row->firstChild->nodeName == 'td') {
        $items = $row->childNodes;
        $emojiCode = $items->item(2)->nodeValue;
        $emojiDescription = $items->item(30)->nodeValue;
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
    $value = ltrim($value, '⊛ ');
    echo "    '$key' => '$value'," . PHP_EOL;
}
echo ']' . PHP_EOL;
echo 'The regular expression: ' . PHP_EOL;
echo $search . PHP_EOL;
