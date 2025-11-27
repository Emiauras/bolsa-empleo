<?php
// app/Controllers/HomeController.php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Container;

class HomeController extends Controller
{
    /**
     * Constructor estándar que recibe el Contenedor de Dependencias.
     * Aunque este controlador sea simple, mantenemos la consistencia con el Router.
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    /**
     * Muestra la página de inicio (Landing Page).
     * Ruta: GET /
     */
    public function index()
    {
        // Renderiza la vista 'home/index.php' ubicada en app/Views/home/
        $this->view('home/index');
    }
}