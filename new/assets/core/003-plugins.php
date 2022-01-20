<?php

load_plugin_files();

function load_plugin_files()
{
    $dir = dirname(__FILE__);

    foreach (glob("${dir}/../plugins/*/*.php") as $file) {
        require_once($file);
    }
}
