<?php

require_once(dirname(__FILE__) . "/includes.php");


if (!function_exists("get_primary_button_classes"))
{
    function get_primary_button_classes()
    {
        return "btn-primary";
    }
}


if (!function_exists("get_secondary_button_classes"))
{
    function get_secondary_button_classes()
    {
        return "btn-secondary";
    }
}


// todo: make this work
function get_default_new_item()
{
    return 2;
}


function is_checked($checked, $print = true)
{
    if ($checked == true) {
        $checked = " checked=\"checked\"";
    } else {
        $checked = "";
    }

    if ($print == true) {
        echo $checked;
    }

    return $checked;
}
