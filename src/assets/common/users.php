<?php

function get_users($enabled = true)
{
    global $db;

    $stmt = $db->prepare("select * from users where enabled = :enabled");
    $stmt->bindParam(":enabled", intval($enabled));

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
    }

    $users = array();

    foreach ($stmt as $row) {
        $users[] = $row;
    }

    return $users;
}

function get_all_users()
{
    global $db;

    $stmt = $db->prepare("select * from users");

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
    }

    $users = array();

    foreach ($stmt as $row) {
        $users[] = $row;
    }

    return $users;
}

function get_users_for_datalist()
{
    $users = get_users();

    $datalist = "";

    foreach ($users as $user) {
        $datalist .= "<option value=\"${user['username']}\">\n";
    }

    return $datalist;
}

function get_user($id)
{
    global $db;

    $stmt = $db->prepare("select * from users where id = :id");
    $stmt->bindParam(":id", $id);

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
    }

    foreach ($stmt as $user) {
        return $user;
    }

    return false;
}

function edit_user($user_id, $username, $password, $enabled, $admin)
{
    global $db;

    if ($user_id > 0) {
        $stmt = $db->prepare("update users set username = :username, enabled = :enabled, admin = :admin where id = :user_id");
        $stmt->bindParam(":user_id", $user_id);
    } else {

        if (empty($password)) {
            return false;
        }

        $stmt = $db->prepare("insert into users (username, enabled, admin) values (:username, :enabled, :admin)");
    }

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":enabled", $enabled);
    $stmt->bindParam(":admin", $admin);

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
        return false;
    }

    if (empty($password)) {
        return true;
    }

    $stmt = $db->prepare("update users set hash = concat(md5(:password),md5(reverse(:password))) where username = :username");

    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":username", $username);

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
        return false;
    }

    return true;
}
