<?php

function get_things($column)
{
    global $db;

    $stmt = $db->prepare("select things.id from things join thing_definitions on thing_definitions.id = things.thing_definition_id where things.column_id = :column_id and things. archived = 0");
    $stmt->bindParam(":column_id", $column["id"]);

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
    }

    $things = array();

    foreach ($stmt as $row) {
        $things[] = get_thing($row["id"]);
    }

    return $things;
}


function get_thing_definitions()
{
    global $db;

    $stmt = $db->prepare("select * from thing_definitions where enabled = 1");

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
    }

    $thing_definitions = array();

    foreach ($stmt as $row) {
        $thing_definitions[] = $row;
    }

    return $thing_definitions;
}


function get_thing($id)
{
    global $db;

    $stmt = $db->prepare("select * from things where id = :id");
    $stmt->bindParam(":id", $id);

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
    }

    $thing = array();

    foreach ($stmt as $row) {
        $thing[] = array_merge(get_thing_definition($row["thing_definition_id"]), $row);
    }

    return $thing;
}


function get_thing_definition($id)
{
    global $db;

    $stmt = $db->prepare("select * from thing_definitions where id = :id");
    $stmt->bindParam(":id", $id);

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
    }

    $thing_definitions = array();

    foreach ($stmt as $row) {
        $thing_definitions[] = $row;
    }

    return $thing_definitions;

}


function get_thing_attributes($thing_id, $card = false)
{
    global $db;

    $stmt = $db->prepare("select * from thing_attributes where thing_id = :thing_id");
    $stmt->bindParam(":id", $id);

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
    }

    $thing_attributes = array();

    foreach ($stmt as $row) {
        $thing_attribute_definitions = get_thing_attribute_definitions($row["thing_attribute_definition_id"]);

        if (empty($thing_attribute_definitions["enabled"])) {
            continue;
        }

        if ($card == true && empty($thing_attribute_definitions["display_on_card"])) {
            continue;
        }

        $thing_attributes[] = array_merge($thing_attribute_definitions, $row);
    }

    return $thing_attributes;
}


function get_thing_attribute_definitions($id, $card = false)
{
    global $db;

    $stmt = $db->prepare("select * from thing_attribute_definitions where id = :id");
    $stmt->bindParam(":id", $id);

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
    }

    $thing_attribute_definitions = array();

    foreach ($stmt as $row) {
        $thing_attribute_definitions[] = $row;
    }

    return $thing_attribute_definitions;
}
