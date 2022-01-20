<?php

load_configuration_file();
load_core_files();

function load_core_files()
{
    global $config;
    $dir = dirname(__FILE__);

    if (!empty($config["theme"])) {
        foreach (glob("${dir}/../theme/${config['theme']}/*.php") as $file) {
            require_once($file);
        }
    }

    foreach (glob("${dir}/*.php") as $file) {
        require_once($file);
    }
}


function load_configuration_file()
{
    global $config;

    $dir = dirname(__FILE__);
    $configuration_file = "${dir}/../../config.php";

    if (!file_exists($configuration_file) || !is_readable($configuration_file)) {
        die("Unable to read ${configuration_file}!");
    }

    require_once($configuration_file);

    if (empty($config) || !isset($config)) {
        die("Unable to parse \$config array from ${configuration_file}!");
    }
}
