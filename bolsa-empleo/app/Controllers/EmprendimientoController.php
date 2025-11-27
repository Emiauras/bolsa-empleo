<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Container;
use App\Services\EmprendimientoService;

class EmprendimientoController extends Controller
{
    private EmprendimientoService $service;

    public function __construct(Container $container) {
        parent::__construct($container);
        $this->service = $container->get(EmprendimientoService::class);
    }

    public function index() {
        $emprendimientos = $this->service->getAll();
        $this->view('emprendimientos/listado', ['emprendimientos' => $emprendimientos]);
    }
}