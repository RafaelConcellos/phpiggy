<?php

include __DIR__ . "/../src/App/functions.php";

# creates an instance of the App class
$app = include __DIR__ . "/../src/App/bootstrap.php";

$app->run();