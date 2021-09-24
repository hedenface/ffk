<?php

require_once(dirname(__FILE__) . "/assets/common/includes.php");

ffk_session_start();

$thing_definitions = get_thing_definitions();
$thing_type_selected = get_preferred_thing_type($thing_definitions);


function get_preferred_thing_type($thing_definitions)
{
    if (!empty($_SESSION["default_new_item"])) {
        $thing_type_selected = $_SESSION["default_new_item"];
    }

    // todo: look up the same key in boards_users table to override user preferences

    if (isset($_REQUEST["t"])) {
        $thing_type_selected = intval($_REQUEST["t"]);
    }

    if (!isset($thing_type_selected)) {
        $thing_type_selected = $thing_definitions[0]["id"];
    }

    return $thing_type_selected;
}



?>

<div class="container">
<form method="POST">
    <div class="form-group">
        <label for="type-selector">Type of new item</label>
        <select class="form-select" aria-label="Type of item to create." name="type-selector" id="type-selector">
            <?php

                foreach ($thing_definitions as $thing_definition) {

                    $selected = "";
                    if ($thing_type_selected == $thing_definition["id"]) {
                        $selected = " selected=\"selected\"";
                    }

                    ?>
                    <option value="<?php echo $thing_definition["id"]; ?>"<?php echo $selected; ?>><?php echo $thing_definition["thing_name"]; ?></option>
                    <?php
                }
            ?>
        </select>
    </div>

<?php

function show_fields($thing_definition_id)
{
    global $db;

    $stmt = $db->prepare("select * from thing_attribute_definitions where thing_definition_id = :thing_definition_id or thing_definition_id is null");
    $stmt->bindParam(":thing_definition_id", $thing_definition_id);

    $stmt->execute();
    foreach ($stmt as $row) {


        if ($row["enabled"] != 1 || $row["user_can_change"] != 1) {
            continue;
        }

        $id = $row["id"];
        $name = $row["attribute_name"];
        $title = $row["attribute_title"];
        $desc = $row["attribute_description"];
        $type = $row["attribute_type"];
        $options = $row["attribute_options"];
        $rules = $row["rules"];
        $linked = $row["linked"];
        $linked_rules = $row["linked_rules"];

        ?>
        <div class="form-group">
            <label for="<?php echo $name; ?>"><?php echo $title; ?></label>

                <?php

                switch ($type) {

                case "text":
                    ?>
                    <input type="text" name="<?php echo $name; ?>" class="form-control" />
                    <?php
                    break;

                case "large-text":
                    ?>
                    <textarea name="<?php echo $name; ?>" class="form-control" rows=3></textarea>
                    <?php
                    break;

                case "select":
                    break;

                case "number":
                    ?>
                    <input type="number" name="<?php echo $name; ?>" class="form-control number" />
                    <?php
                    break;

                case "user":
                    ?>
                    <input class="form-control" list="<?php echo $name; ?>-list" placeholder="Type to search..." />
                    <datalist id="<?php echo $name; ?>-list">
                        <?php echo get_users_for_datalist(); ?>
                    </datalist>
                    <?php
                    break;
                }
                ?>
            <div class="form-text"><?php echo $desc; ?>
        </div>
        <?php
    }
}

show_fields($thing_type_selected);

?>

</form>
</div>
