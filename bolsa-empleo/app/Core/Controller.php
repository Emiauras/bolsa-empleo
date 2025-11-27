<?php
// app/Core/Controller.php

namespace App\Core;

use App\Core\View;
use App\Core\Container; 

abstract class Controller
{
    protected Container $container;

    public function __construct(Container $container) 
    {
        $this->container = $container;
    }

    protected function view(string $viewName, array $data = []) 
    {
        View::render($viewName, $data);
    }
}
// Sin etiqueta de cierre ?>