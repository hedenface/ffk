<?php

function d($msg, $html = true)
{
    global $debug;

    if (!isset($debug)) {
        $debug = false;
    }

    if ($debug == false) {
        return;
    }

    if ($html == true) {
        echo "\n\n<pre>\n";
    }

    if (is_array($msg) || is_object($msg)) {
        print_r($msg);
    } else {
        echo $msg;
    }

    echo "\n</pre>\n\n";
}
