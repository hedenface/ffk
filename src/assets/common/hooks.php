<?php


function apply_filter_callbacks($filter, &$data)
{
    foreach (get_callbacks("filter", $filter) as $callback) {
        $data = $callback($data);
    }
}


function apply_action_callbacks($action, &$data = null)
{
    foreach (get_callbacks("action", $action) as $callback) {
        $callback($data);
    }
}


function define_filter_callback($filter, $callback)
{
    define_callback("filter", $filter, $callback);
}


function define_action_callback($action, $callback)
{
    define_callback("action", $action, $callback);
}


function setup_callbacks()
{
    global $callbacks;

    if (!isset($callbacks) || !is_array($callbacks) || !is_array($callbacks["filter"]) || !is_array($callbacks["action"])) {
        $callbacks = array("filter" => array(),
                           "action" => array());
    }
}


function define_callback($type, $name, $callback)
{
    global $callbacks;

    setup_callbacks();

    $callbacks[$type][$name][] = $callback;
}


function get_callbacks($type, $name)
{
    global $callbacks;

    setup_callbacks();

    $callbacks_arr = array();

    if (is_array($callbacks[$type][$name])) {
        $callbacks_arr = $callbacks[$type][$name];
    }

    return $callbacks_arr;
}
