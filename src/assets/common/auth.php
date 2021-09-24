<?php

function ffk_session_start($login_page = false)
{
    if (!session_id()) {

        session_name("ffk");

        // daily
        $lifetime = 60 * 60 * 24;

        ini_set("session.use_cookies", "1");
        ini_set("session.use_only_cookies", "1");
        ini_set("session.cookie_lifetime", "0");
        ini_set("session.upload_progress.enabled", "0");
        ini_set("session.use_strict_mode", "1");
        session_set_cookie_params($lifetime, "/", "", !empty($_SERVER["HTTPS"]), true);
        ini_set("session.gc_maxlifetime", $lifetime + 60 * 20);

        session_start();
    }

    $redirect = true;
    if ($login_page) {
        $redirect = false;
    }

    logged_in($redirect);
}


function ffk_session_destroy()
{
    if (!empty($_COOKIE[session_name()])) {
        setcookie(session_name(), "", time() - 60 * 60 * 24, "/", "", false, true);
    }
}


function logged_in($redirect = true)
{
    if (isset($_SESSION["user_id"]) && !empty($_SESSION["username"]) && !empty($_SESSION[session_name()])) {
        return true;
    }

    if ($redirect) {

        $url = $_SERVER["PHP_SELF"];
        if (!empty($_SERVER["QUERY_STRING"])) {
            $url .= urlencode("?") . urlencode($_SERVER["QUERY_STRING"]);
        }

        header("Location: login.php?redirect=" . $url);
    }
    return false;
}


function login($username, $password, $redirect_url = "")
{
    global $db;
    
    $stmt = $db->prepare("select id, default_new_item from users where username = :username and hash = concat(md5(:password),md5(reverse(:password))) and enabled = 1");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
    }

    foreach ($stmt as $row) {
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["username"] = $username;
        $_SESSION["default_new_item"] = $row["default_new_item"];
        $_SESSION[session_name()] = session_name();

        if (empty($redirect_url)) {
            $redirect_url = "board.php";
        }

        header("Location: $redirect_url");

        return true;
    }

    return false;
}


function user_has_admin_access()
{
    global $db;

    $stmt = $db->prepare("select id from users where username = :username and id = :user_id and enabled = 1 and admin = 1");
    $stmt->bindParam(":username", $_SESSION["username"]);
    $stmt->bindParam(":user_id", $_SESSION["user_id"]);

    if ($stmt->execute() === false) {
        d($stmt->errorInfo());
    }

    foreach ($stmt as $row) {
        return true;
    }

    return false;
}
