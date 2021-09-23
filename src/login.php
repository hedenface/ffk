<?php

require_once(dirname(__FILE__) . "/assets/common/includes.php");
ffk_session_start(true);


if (!empty($_POST["username"])) {

    $redirect_url = "";

    if (!empty($_POST["redirect_url"])) {
        $redirect_url = $_POST["redirect_url"];
    }

    if (login($_POST["username"], $_POST["password"], $redirect_url) == false) {
        $error = true;
    }
}


page_header("Login", "login.php");

if ($error) {
    ?>

    <div class="alert alert-danger">
        There was an error attempting to login. Wrong credentials, perhaps?
    </div>

    <?php
}

?>

<form method="POST">

    <?php if (!empty($_REQUEST["redirect"])) { ?>

    <input type="hidden" name="redirect_url" value="<?php echo htmlentities($_REQUEST["redirect"], ENT_HTML5); ?>" />

    <?php } ?>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" />
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="btn-group">
        <button type="submit" class="btn btn-primary">Login</button>
    </div>
</form>

<?php

page_footer();
