<?php

require_once(dirname(__FILE__) . "/assets/common/includes.php");

ffk_session_start();

if (!user_has_admin_access()) {
    header("Location: index.php");
}

page_header("Users", "users.php");

$users = get_all_users(false);


function checkmark($checked, $enabled = true)
{
    if ($checked) {
        $checked = " checked=\"checked\"";
    } else {
        $checked = "";
    }

    if ($enabled == false) {
        $enabled = " disabled=\"disabled\"";
    } else {
        $enabled = "";
    }

    return "<input type=\"checkbox\"${checked}${enabled} />";
}

?>


<a class="btn <?php echo get_primary_button_classes(); ?> edit-user" data-title="New User" href="user.php">New User</a>


<table class="table table-striped user-table mt-5">
    <thead>
        <tr>
            <th>Username</th>
            <th>Enabled</th>
            <th>Administrator</th>
        </tr>
    </thead>
    <tbody>

<?php

    foreach ($users as $user) {

        $id = $user["id"];
        $username = $user["username"];
        $enabled = checkmark($user["enabled"], false);
        $admin = checkmark($user["admin"], false);

        ?>

            <tr>
                <td><a href="user.php?uid=<?php echo $id; ?>" data-title="Edit <?php echo $username; ?>" class="edit-user"><?php echo $username; ?></a></td>
                <td><?php echo $enabled; ?></td>
                <td><?php echo $admin; ?></td>
            </tr>

        <?php
    }

?>
    </tbody>
</table>

<?php

page_footer();
