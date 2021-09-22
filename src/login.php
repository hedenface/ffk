<?php

require_once(dirname(__FILE__) . "/assets/common/includes.php");
ffk_session_start(true);


if (!empty($_POST["username"])) {
    if (login($_POST["username"], $_POST["password"]) == false) {
        $error = true;
    }
}


page_header("Login");

if ($error) {
    ?>

    <div class="alert alert-danger">
        There was an error attempting to login. Wrong credentials, perhaps?
    </div>

    <?php
}

?>

<form method="POST">
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
