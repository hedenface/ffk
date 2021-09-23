<?php

require_once(dirname(__FILE__) . "/assets/common/includes.php");

ffk_session_start();

$board = get_board();

page_header("Board", "board.php");

if ($board != false) {

?>

    <div class="row">

        <?php foreach (get_columns($board) as $col) { ?>

        <div class="col" id="col-<?php echo $col["id"]; ?>">

            <h4 class="col-title"><?php echo $col["column_name"]; ?></h4>

            <?php foreach (get_things($col) as $thing) { ?>

            <div class="card" draggable="true" data-card-id="<?php echo $thing["id"]; ?>" id="card-<?php echo $thing["id"]; ?>">
                <h5 class="card-title"><?php echo $thing["title"]; ?></h5>
                <p class="card-text">...</p>
            </div>

            <?php } ?>

        </div>

        <?php } ?>
<!-- 
        <div class="col">
            <h4 class="col-title">Backlog</h4>
            <div class="card" draggable="true" data-card-id="1" id="card1">
                <h5 class="card-title">story #1</h5>
                <p class="card-text">lorem ipsum</p>
            </div>
            <div class="card" draggable="true" data-card-id="2" id="card2">
                <h5 class="card-title">story #2</h5>
                <p class="card-text">lorem ipsum</p>
            </div>
            <div class="card" draggable="true" data-card-id="3" id="card3">
                <h5 class="card-title">story #3</h5>
                <p class="card-text">lorem ipsum</p>
            </div>
        </div>
        <div class="col">
            <h4 class="col-title">To-Do</h4>
            <div class="card" draggable="true" data-card-id="4" id="card4">
                <h5 class="card-title">story #4</h5>
                <p class="card-text">lorem ipsum</p>
            </div>                
        </div>
        <div class="col">
            <h4 class="col-title">Done</h4>
            <div class="card" draggable="true" data-card-id="5" id="card5">
                <h5 class="card-title">story #5</h5>
                <p class="card-text">lorem ipsum</p>
            </div>                
        </div>
    </div> -->
    <div class="row">
    </div>

<?php

} else { /* board == false */

    echo "<h1>No Board found!</h1>";

}

page_footer();
