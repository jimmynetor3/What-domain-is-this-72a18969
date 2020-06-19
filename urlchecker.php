<?php

$patternProtocol = '/[a-z]{1,}[":"]/m';
$patternDomainShort = '/[\w]{1,}[.]{1}[\w]{2,}/m';
$patternDomainLong = '/[\w]{1,}[.]{1}[^\/]{1,}[.]{1}[\w]{2,}/m';
$patternPath = '/["\/"].{1,}/m';
$input = $argv[1];
$offset = 0;

$longDomain = false;
$shortDomain = false;

if (preg_match($patternProtocol, $input, $matches)) {
    $NumberOfLetters = strlen($matches[0]);
    $offset = $offset + $NumberOfLetters;

    foreach ($matches as $word) {
        echo("protocol : " . $word . PHP_EOL);
    }
} else {
    echo("geen protocol gevonden" . PHP_EOL);
}

if (preg_match($patternDomainShort, $input, $matchesShort)) {
    $shortDomain = true;
    foreach ($matchesShort as $word) {
        $shortDomainText = $word;
    }

    if (preg_match($patternDomainLong, $input, $matchesLong)) {
        if (isset($matchesLong)) {
            $longDomain = true;
            foreach ($matchesLong as $word) {
                $longDomainText = $word;
            }
        }
    }

    if (!$longDomain && $shortDomain) {
        $NumberOfLetters = strlen($matchesShort[0]);
        $offset = $offset + $NumberOfLetters;
        echo("domain : " . "$shortDomainText" . PHP_EOL);
    } elseif ($longDomain && $shortDomain) {
        $NumberOfLetters = strlen($matchesLong[0]);
        $offset = $offset + $NumberOfLetters;
        echo("domain : $longDomainText" . PHP_EOL);
    }
} elseif (!$longDomain && !$shortDomain) {
    exit("please enter a valid url");
}

if (preg_match($patternPath, $input, $matches, PREG_OFFSET_CAPTURE, $offset)) {
    foreach ($matches as $word) {
        echo("path : " . $word[0] . PHP_EOL);
    }
} else {
    echo("no path found");
}
