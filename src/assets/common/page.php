<?php

function page_header($title, $basedir = ".")
{
    ?>

<!doctype html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="<?php echo $basedir; ?>/assets/css/bootstrap.css" />

    <script src="<?php echo $basedir; ?>/assets/js/drag.js"></script>
    <link rel="stylesheet" href="<?php echo $basedir; ?>/assets/css/main.css" />
    <link rel="stylesheet" href="<?php echo $basedir; ?>/assets/css/ffk-default.css" />
</head>

<body>
<div class="container">

    <?php
}


function page_footer()
{
    ?>

</div>
</body>
</html>

    <?php
}
