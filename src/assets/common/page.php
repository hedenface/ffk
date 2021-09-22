<?php

function page_header($title, $basedir = ".")
{
    ?>

<!doctype html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!--
    <script src="<?php echo $basedir; ?>/assets/js/jquery.js"></script>
    <script src="<?php echo $basedir; ?>/assets/js/bootstrap.bundle.js"></script>
    -->
    <link rel="stylesheet" href="<?php echo $basedir; ?>/assets/css/bootstrap.css" />

    <script src="<?php echo $basedir; ?>/assets/js/drag.js"></script>
    <link rel="stylesheet" href="<?php echo $basedir; ?>/assets/css/main.css" />
    <link rel="stylesheet" href="<?php echo $basedir; ?>/assets/css/ffk-default.css" />
</head>

<body>

<div class="wrapper">

<nav class="sidebar">
    <div class="list-group list-group-flush">

        <div class="sidebar-header border-bottom bg-light">FFK</div>

        <?php if (logged_in(false)) { ?>

        <a class="list-group-item list-group-item-action list-group-item-light new-item" href="#">
            <strong>New Item</strong>
            <span><strong>&plus;</strong></span>
        </a>
        <a class="list-group-item list-group-item-action list-group-item-light" href="board.php">Board</a>
        <a class="list-group-item list-group-item-action list-group-item-light" href="settings.php">Settings</a>
        <a class="list-group-item list-group-item-action list-group-item-light" href="users.php">Users</a>
        <a class="list-group-item list-group-item-action list-group-item-light new-item" href="new-board.php">New Board<span><strong>&plus;</strong></span></a>

        <?php } else { /* not logged in */ ?>

        <a class="list-group-item list-group-item-action list-group-item-light" href="users.php">Login</a>

        <?php } ?>

    </div>
</nav>

<div class="main">

<div class="title-bar">
    <?php echo $title; ?>

    <?php if (logged_in(false)) { ?>

    <div class="logout"><a href="logout.php">Logout</a></div>

    <?php } ?>

</div>

<div class="container">

    <?php
}


function page_footer()
{
    ?>

</div><!-- .container -->
</div><!-- .main -->
</div><!-- .wrapper -->
</body>
</html>

    <?php
}
