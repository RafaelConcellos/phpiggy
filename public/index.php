<?php
declare(strict_types=1);

# loading bootstrap.php, which returns data. So we can store it inside a variable.
$app = include __DIR__ . "/../src/App/bootstrap.php";

$app->Run();