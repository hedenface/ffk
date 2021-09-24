<?php

require_once(dirname(__FILE__) . "/assets/common/includes.php");

ffk_session_start();

if (!user_has_admin_access()) {
    exit();
}

$user_id = -1;
$username = "";
$enabled = true;
$admin = false;

if (isset($_REQUEST["uid"])) {
    if (intval($_REQUEST) > -1) {
        $user = get_user($_REQUEST["uid"]);

        $user_id = intval($_REQUEST["uid"]);
        $username = htmlentities($user["username"]);
        $enabled = boolval($user["enabled"]);
        $admin = boolval($user["admin"]);
    }
}


if (!empty($_POST["update"])) {
    if (edit_user($user_id, $_POST["username"], $_POST["pw"], $_POST["enabled"], $_POST["admin"])) {
        echo "success";
    } else {
        echo "failure";
    }
    exit();
}

?>

<form class="user" autocomplete="off">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>" />
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required="required" />
    </div>
    <div class="form-group">
        <label for="pw">Password</label>
        <input type="password" class="form-control" id="pw" name="pw" value="" autocomplete="false" />
        <div class="form-text">Leave blank to not update the password.</div>
    </div>
    <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" id="enabled" name="enabled"<?php is_checked($enabled); ?>>
          <label class="form-check-label" for="enabled">Enabled</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="admin" name="admin"<?php is_checked($admin); ?>>
        <label class="form-check-label" for="admin">Administrator</label>
    </div>
</form>
