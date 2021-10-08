<?php

require_once(dirname(__FILE__) . "/../../config.php");
require_once(dirname(__FILE__) . "/debug.php");
require_once(dirname(__FILE__) . "/hooks.php");

if (!empty($config["theme"])) {
    include(dirname(__FILE__) . "/../theme/" . $config["theme"] . ".php");
}

require_once(dirname(__FILE__) . "/utils.php");

require_once(dirname(__FILE__) . "/db.php");
require_once(dirname(__FILE__) . "/auth.php");
require_once(dirname(__FILE__) . "/page.php");


require_once(dirname(__FILE__) . "/users.php");
require_once(dirname(__FILE__) . "/boards.php");
require_once(dirname(__FILE__) . "/columns.php");
require_once(dirname(__FILE__) . "/things.php");
