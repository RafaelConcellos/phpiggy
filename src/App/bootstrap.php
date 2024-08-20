<?php
# bootstrap

declare(strict_types=1);

# let's load the application file from the framework directory:
require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;

$app = new App();

return $app;