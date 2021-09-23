<?php

function print_sidebar_link($url, $content, $page, $additional_classes = "", $data_title = "")
{
    if ($url == $page) {
        $additional_classes .= " active";
    }

    $additional_classes = " " . trim($additional_classes);

    if (!empty($data_title)) {
        $data_title = " data-title=\"$data_title\"";
    }

    echo "<a class=\"list-group-item list-group-item-action list-group-item-light$additional_classes\" href=\"$url\"$data_title>$content</a>\n";
}

function print_board_links($page)
{
    global $db;

    $stmt = $db->prepare("select * from boards where (id in (select board_id from board_users where user_id = :user_id) or global = 1) and enabled = 1");
    $stmt->bindParam(":user_id", $_SESSION["user_id"]);

    $stmt->execute();

    foreach ($stmt as $row) {

        if ($page == "board.php") {
            $page = "board.php?board=${_REQUEST['board']}";
        }

        print_sidebar_link("board.php?board=${row['id']}", htmlentities($row["board_name"]), $page);
    }
}

function page_header($title, $page, $basedir = ".")
{
    ?>

<!doctype html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- <script src="<?php echo $basedir; ?>/assets/js/jquery.js"></script> -->
    <script src="<?php echo $basedir; ?>/assets/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="<?php echo $basedir; ?>/assets/css/bootstrap.css" />

    <script src="<?php echo $basedir; ?>/assets/js/drag.js"></script>
    <script src="<?php echo $basedir; ?>/assets/js/new-item.js"></script>
    <link rel="stylesheet" href="<?php echo $basedir; ?>/assets/css/main.css" />
    <link rel="stylesheet" href="<?php echo $basedir; ?>/assets/css/ffk-default.css" />
</head>

<body>

<div class="wrapper">

<nav class="sidebar">
    <div class="list-group list-group-flush">
        <div class="sidebar-header border-bottom bg-light">FFK</div>

        <?php 

        if (logged_in(false)) {
            print_sidebar_link("new-item.php",  "<strong>New Item</strong><span><strong>&plus;</strong></span>", "none", "new-item", "New Item");
            print_board_links($page);

            if (user_has_admin_access()) {
                print_sidebar_link("settings.php",  "Settings",                                                      $page);
                print_sidebar_link("users.php",     "Users",                                                         $page);
            }
            print_sidebar_link("new-board.php", "New Board<span><strong>&plus;</strong></span>",                 "none", "new-item", "New Board");
        } else {
            print_sidebar_link("login.php",     "Login",                                                         $page);
        }

        ?>

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

<div class="modal fade" id="main-modal" tabindex="-1" role="dialog" aria-labelledby="modal-center-tile" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="main-modal-title"></h5>
                <button type="button" class="btn-close main-modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="main-modal-content">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary main-modal-close" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="main-modal-save">Save</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>

    <?php
}
