<?php

require_once(dirname(__FILE__) . "/includes.php");


db_connection();


function db_connection()
{
    global $config;

    global $db;

    $db = new PDO("mysql:host=${config['mysql_host']};port=${config['mysql_port']};dbname=${config['mysql_db']}", $config["mysql_user"], $config["mysql_pass"]);
}
