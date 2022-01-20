<?php

function d($msg, $html = true)
{
    global $debug;

    if (!isset($debug) || !$debug) {
        return;
    }

    $final_msg = $msg;

    if (is_array($msg) || is_object($msg)) {
        $final_msg = print_r($msg, true);
    }

    if ($html == true) {
        echo "<br /><br /><pre>\n${final_msg}\n</pre><br /><br />";
    } else {
        echo $final_msg;
    }
}
