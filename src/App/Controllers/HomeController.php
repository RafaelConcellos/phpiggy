<?php
#HomeController

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class HomeController
{
    private TemplateEngine $view;

    public function __construct()
    {
        $this->view = new TemplateEngine(Paths::VIEW);
    }

    public function home()
    {
        $secret = "sdçgfk";
        $this->view->render("index.php");
    }
}
