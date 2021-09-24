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


function set_option($name, $value)
{
    global $db;

    $stmt = $db->prepare("insert into options (name, value) values (:name, :value)");
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":value", $value);

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
        return false;
    }

    return true;
}


function get_option($name, $default = false)
{
    global $db;

    $stmt = $db->prepare("select * from options where name = :name");
    $stmt->bindParam(":name", $name);

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
    }

    foreach ($stmt as $row) {
        return $row["value"];
    }

    return $default;
}


function delete_option($name)
{
    global $db;

    $stmt = $db->prepare("delete from options where name = :name");
    $stmt->bindParam(":name", $name);

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
        return false;
    }

    return true;
}
