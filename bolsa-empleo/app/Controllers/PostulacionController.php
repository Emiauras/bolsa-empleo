<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Container;
use App\Services\PostulacionService;
use App\Core\SessionHelper;
use App\Core\UrlHelper;

class PostulacionController extends Controller
{
    private PostulacionService $postulacionService;

    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->postulacionService = $container->get(PostulacionService::class);
    }

    /**
     * Procesa la postulación a una oferta.
     * Ruta: POST /ofertas/postular
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        // Verificar login
        if (!SessionHelper::get('user_id')) {
            SessionHelper::setFlash('error', 'Debes iniciar sesión para postularte.');
            header('Location: ' . UrlHelper::base('/login'));
            return;
        }

        $idOferta = (int)($_POST['id_oferta'] ?? 0);
        $mensaje = $_POST['mensaje'] ?? '';

        try {
            $this->postulacionService->crearPostulacion(SessionHelper::get('user_id'), $idOferta, $mensaje);
            
            SessionHelper::setFlash('success', '¡Te has postulado con éxito! Buena suerte 🍀');
        } catch (\Exception $e) {
            SessionHelper::setFlash('error', $e->getMessage());
        }

        // Volver a la lista de ofertas
        header('Location: ' . UrlHelper::base('/ofertas'));
    }
}