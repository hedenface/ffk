<?php

function get_columns($board)
{
    global $db;

    $stmt = $db->prepare("select id, column_name from columns where board_id = :board_id and enabled = 1");
    $stmt->bindParam(":board_id", $board["id"]);

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
    }

    $cols = array();

    foreach ($stmt as $row) {
        $cols[] = $row;
    }

    return $cols;
}
