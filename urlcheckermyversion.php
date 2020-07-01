<?php

$input = $argv[1];
$patternIncorrectProtocol = "/http/m";
$patternCorrectProtocol = "/https/m";
$patternIncorrectBackslash = "/\\\/m";
$replacementProtocol = "https";
$replacementBackslash = "/";

//checks if correct protocol is given
if (preg_match($patternCorrectProtocol, $input)) {
    if (preg_match($patternIncorrectBackslash, $input)) {
        echo preg_replace($patternIncorrectBackslash, $replacementBackslash, $input);
    } else {
        echo("nothing to replace");
    }
} else {
//   replaces http with https
    $newUrl = preg_replace($patternIncorrectProtocol, $replacementProtocol, $input);
    //check for \ and replaces them with /
    if (preg_match($patternIncorrectBackslash, $newUrl)) {
        echo preg_replace($patternIncorrectBackslash, $replacementBackslash, $newUrl);
    } else {
        //check for \ and replaces them with / if https was given from the start
        if (preg_match($patternIncorrectBackslash, $input)) {
            echo preg_replace($patternIncorrectBackslash, $replacementBackslash, $input);
        } else {
            echo($newUrl);
        }
    }
}