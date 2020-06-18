<?php

$patternProtocol = '/[a-z]{1,}[":"]/m';
$patternDomain = '/[\w]{1,}[.]{1}.{1,}[.]{1}[\w]{2,}/m';
$patternPath = '/["\/"].{1,}/m';
$input = $argv[1];
$offset = 0;
if (preg_match($patternProtocol, $input, $matches)) {
    $NumberOfLetters = strlen($matches[0]);
    $offset = $offset + $NumberOfLetters;

    foreach ($matches as $word) {
        echo("protocol : " . $word . PHP_EOL);
    }
} else {
    echo("geen protocol gevonden" . PHP_EOL);
}

if (preg_match($patternDomain, $input, $matches)) {
    $NumberOfLetters = strlen($matches[0]);
    $offset = $offset + $NumberOfLetters;
    foreach ($matches as $word) {
        echo("domain : " . $word . PHP_EOL);
    }
} else {
    echo("no domain found het moet wel een werkende url zijn" . PHP_EOL);
    exit();
}

if (preg_match($patternPath, $input, $matches, PREG_OFFSET_CAPTURE, $offset)) {
    foreach ($matches as $word) {
        echo("path : " . $word[0] . PHP_EOL);
    }
}else{
    echo("no path found");
}
