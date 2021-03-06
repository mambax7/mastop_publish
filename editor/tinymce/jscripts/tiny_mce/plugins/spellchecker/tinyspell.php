<?php
/**
 * $RCSfile: tinyspell.php,v $
 * $Revision: 1.3 $
 * $Date: 2007/03/10 20:49:15 $
 *
 * @author    Moxiecode
 * @copyright Copyright © 2004-2006, Moxiecode Systems AB, All rights reserved.
 */

// Ignore the Notice errors for now.
error_reporting(E_ALL ^ E_NOTICE);

require_once __DIR__ . '/config.php';

$id = sanitize($_POST['id'], 'loose');

if (!$spellCheckerConfig['enabled']) {
    header('Content-type: text/xml; charset=utf-8');
    echo '<?xml version="1.0" encoding="utf-8" ?><res id="' . $id . '" error="true" msg="You must enable the spellchecker by modifying the config.php file.">';
    die;
}

// Basic config
$defaultLanguage = $spellCheckerConfig['default.language'];
$defaultMode     = $spellCheckerConfig['default.mode'];

// Normaly not required to configure
$defaultSpelling = $spellCheckerConfig['default.spelling'];
$defaultJargon   = $spellCheckerConfig['default.jargon'];
$defaultEncoding = $spellCheckerConfig['default.encoding'];
$outputType      = 'xml'; // Do not change

// Get input parameters.

$check    = urldecode($_REQUEST['check']);
$cmd      = sanitize($_REQUEST['cmd']);
$lang     = sanitize($_REQUEST['lang'], 'strict');
$mode     = sanitize($_REQUEST['mode'], 'strict');
$spelling = sanitize($_REQUEST['spelling'], 'strict');
$jargon   = sanitize($_REQUEST['jargon'], 'strict');
$encoding = sanitize($_REQUEST['encoding'], 'strict');
$sg       = sanitize($_REQUEST['sg'], 'bool');
$words    = [];

$validRequest = true;

if (empty($check)) {
    $validRequest = false;
}

if (empty($lang)) {
    $lang = $defaultLanguage;
}

if (empty($mode)) {
    $mode = $defaultMode;
}

if (empty($spelling)) {
    $spelling = $defaultSpelling;
}

if (empty($jargon)) {
    $jargon = $defaultJargon;
}

if (empty($encoding)) {
    $encoding = $defaultEncoding;
}

function sanitize($str, $type = 'strict')
{
    switch ($type) {
        case 'strict':
            $str = preg_replace("/[^a-zA-Z0-9_\-]/i", '', $str);
            break;
        case 'loose':
            $str = preg_replace('/</i', '>', $str);
            $str = preg_replace('>/i', '&lt;', $str);
            break;
        case 'bool':
            if ('true' === $str || true === $str) {
                $str = true;
            } else {
                $str = false;
            }
            break;
    }

    return $str;
}

$result    = [];
$tinyspell = new $spellCheckerConfig['class']($spellCheckerConfig, $lang, $mode, $spelling, $jargon, $encoding);

if (0 == count($tinyspell->errorMsg)) {
    switch ($cmd) {
        case 'spell':
            // Space for non-exec version and \n for the exec version.
            $words  = preg_split("/ |\n/", $check, -1, PREG_SPLIT_NO_EMPTY);
            $result = $tinyspell->checkWords($words);
            break;

        case 'suggest':
            $result = $tinyspell->getSuggestion($check);
            break;

        default:
            // Just use this for now.
            $tinyspell->errorMsg[] = 'No command.';
            $outputType            = $outputType . 'error';
            break;
    }
} else {
    $outputType = $outputType . 'error';
}

if (!$result) {
    $result = [];
}

// Output data
switch ($outputType) {
    case 'xml':
        header('Content-type: text/xml; charset=utf-8');
        $body = '<?xml version="1.0" encoding="utf-8" ?>';
        $body .= "\n";

        if (0 == count($result)) {
            $body .= '<res id="' . $id . '" cmd="' . $cmd . '">';
        } else {
            $body .= '<res id="' . $id . '" cmd="' . $cmd . '">' . urlencode(implode(' ', $result)) . '</res>';
        }

        echo $body;
        break;
    case 'xmlerror':
        header('Content-type: text/xml; charset=utf-8');
        $body = '<?xml version="1.0" encoding="utf-8" ?>';
        $body .= "\n";
        $body .= '<res id="' . $id . '" cmd="' . $cmd . '" error="true" msg="' . implode(' ', $tinyspell->errorMsg) . '">';
        echo $body;
        break;
    case 'html':
        var_dump($result);
        break;
    case 'htmlerror':
        echo 'Error';
        break;
}
