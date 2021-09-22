<!doctype html>
<html lang="en">

<head>
    <title>basic board</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="./assets/css/bootstrap.css" />

    <script src="./assets/js/drag.js"></script>
    <link rel="stylesheet" href="./assets/css/main.css" />
    <link rel="stylesheet" href="./assets/css/ffk-default.css" />
</head>

<body>
    <div class="container">
        <div class="row">
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
        </div>
        <div class="row">
        </div>
    </div>
</body>

</html>
