<?php

declare(strict_types=1);

#Let's load the application file from the framework directory:
require __DIR__ . "/../../vendor/autoload.php";

#Now use the App namespace:
use Framework\App;

#Create a new instance of the App class:
$app = new App();

#Lastly, let's return the $app variable:
return $app;