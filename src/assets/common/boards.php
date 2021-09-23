<?php

function get_board()
{
    global $db;

    if (!empty($_REQUEST["board"])) {
        $stmt = $db->prepare("select * from boards where id = :board_id and enabled = 1");
        $stmt->bindParam(":board_id", $_REQUEST["board"]);
    } else {
        $stmt = $db->prepare("select * from boards where global = 1 and enabled = 1 limit 1");
    }

    $stmt->execute();
    
    foreach ($stmt as $row) {
        return $row;
    }

    return false;
}
