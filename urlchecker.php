<?php

$patternProtocol = '/[a-z]{1,}[":"]/m';
$patternDomainShort = '/(?<protocol>[\w]{1,}):\/\/(?<domain>[\S]{1,}[.]{1}[\w]{2,})\/(?<path>.{1,})/m';
$patternDomainLong = '/(?<protocol>[\w]{1,}):\/\/(?<domain>[\w]{1,}[.]{1}[^\/]{1,}[.]{1}[\w]{2,})\/(?<path>.{1,})/m';
$domainLong = '/[\w]{1,}[.]{1}[^\/]{1,}[.]{1}[\w]{2,}/m';
$domainShort = '/[\S]{1,}[.]{1}[\w]{2,}/m';
$patternPath = '/["\/"].{1,}/m';
$input = $argv[1];
$offset = 0;
$longDomain = false;
$shortDomain = false;
$longIncompleteDomain = false;
$shortIncompleteDomain = false;


//checks if a whole url is given
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
        echo("protocol : " . $matchesShort['protocol'] . PHP_EOL . "domain : " . $matchesShort['domain'] . PHP_EOL . "path : " . $matchesShort['path']);
    } elseif ($longDomain && $shortDomain) {
        echo("protocol : " . $matchesLong['protocol'] . PHP_EOL . "domain : " . $matchesLong['domain'] . PHP_EOL . "path : " . $matchesLong['path']);
    }
//    checks if an incomplete url is given
} elseif (!$longDomain && !$shortDomain) {
//    checks for protocol
    if (preg_match($patternProtocol, $input, $matches)) {
        $NumberOfLetters = strlen($matches[0]);
        $offset = $offset + $NumberOfLetters;

        foreach ($matches as $word) {
            echo("protocol : " . $word . PHP_EOL);
        }
    } else {
        echo("no protocol found" . PHP_EOL);
    }
//checks for domain
    if (preg_match($domainShort, $input, $matchesShort)) {
        $shortIncompleteDomain = true;
        foreach ($matchesShort as $word) {
            $shortDomainText = $word;
        }
    }
        if (preg_match($domainLong, $input, $matchesLong)) {
            if (isset($matchesLong)) {
                $longIncompleteDomain = true;
                foreach ($matchesLong as $word) {
                    $longDomainText = $word;
                }
            }
        }
        if (!$longIncompleteDomain && $shortIncompleteDomain) {
            foreach ($matchesShort as $word) {
                echo("domain : " . $word . PHP_EOL);
            }
        } elseif ($longIncompleteDomain && $shortIncompleteDomain) {
            foreach ($matchesLong as $word) {
                echo("domain : " . $word . PHP_EOL);
            }
        } elseif (!$longIncompleteDomain && !$shortIncompleteDomain) {
            echo('give a valid url ' . PHP_EOL);

        }



//checks for path
    if (preg_match($patternPath, $input, $matches)) {
        foreach ($matches as $word) {
            echo("path : " . $word . PHP_EOL);
        }
    } else {
        echo("no path found");
    }
}


