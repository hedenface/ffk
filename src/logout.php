<?php

require_once(dirname(__FILE__) . "/assets/common/includes.php");

ffk_session_start();
unset($_SESSION["user_id"]);
unset($_SESSION["username"]);
unset($_SESSION[session_name()]);
ffk_session_destroy();

header("Location: login.php");
