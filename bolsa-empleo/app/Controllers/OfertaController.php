<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Container;
use App\Services\OfertaService;
use App\Core\SessionHelper;
use App\Core\UrlHelper;
use App\Strategies\BusquedaPorTitulo;
use App\Strategies\BusquedaPorRubro;

class OfertaController extends Controller
{
    private OfertaService $ofertaService;

    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->ofertaService = $container->get(OfertaService::class);
    }

    /**
     * Muestra todas las ofertas (Página pública).
     */
    public function index()
    {
        // 1. Obtener todas las ofertas activas
        $ofertas = $this->ofertaService->getAllActive();

        // 2. Verificar si hay búsqueda (GET)
        $termino = $_GET['q'] ?? '';
        $tipoBusqueda = $_GET['tipo'] ?? 'titulo';

        if (!empty($termino)) {
            // 3. APLICAR PATRÓN STRATEGY
            $estrategia = null;

            if ($tipoBusqueda === 'rubro') {
                $estrategia = new BusquedaPorRubro();
            } else {
                $estrategia = new BusquedaPorTitulo();
            }

            if ($estrategia) {
                $ofertas = $estrategia->buscar($ofertas, $termino);
            }
        }

        $this->view('ofertas/listado', [
            'ofertas' => $ofertas,
            'termino' => $termino // Para mantener el texto en el input
        ]);
    }

    /**
     * Muestra el formulario de creación (Solo Empresas).
     */
    public function create()
    {
        // Verificar Login y Tipo Empresa (4)
        if (!SessionHelper::get('user_id') || SessionHelper::get('postulante_tipo') !== 4) {
            SessionHelper::setFlash('error', 'Debes iniciar sesión como Empresa para publicar.');
            header('Location: ' . UrlHelper::base('/login'));
            return;
        }
        $this->view('ofertas/crear');
    }

    /**
     * Guarda la oferta en la base de datos.
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        try {
            $this->ofertaService->crearOferta(SessionHelper::get('user_id'), $_POST);
            SessionHelper::setFlash('success', '¡Oferta publicada con éxito! 🌸');
            header('Location: ' . UrlHelper::base('/ofertas'));
        } catch (\Exception $e) {
            SessionHelper::setFlash('error', $e->getMessage());
            header('Location: ' . UrlHelper::base('/ofertas/publicar'));
        }
    }

    
    /**
     * Cambia el estado de un candidato (Aceptar/Rechazar).
     * Ruta: GET /ofertas/gestionar-candidato?id=X&estado=Y&oferta=Z
     */
    public function gestionarCandidato()
    {
        if (!SessionHelper::get('user_id') || SessionHelper::get('postulante_tipo') !== 4) {
            header('Location: ' . UrlHelper::base('/login'));
            return;
        }

        $idPostulacion = (int)($_GET['id'] ?? 0);
        $estado = (int)($_GET['estado'] ?? 0);
        $idOferta = (int)($_GET['oferta'] ?? 0);

        try {
            // Obtenemos el servicio directamente del contenedor (truco rápido)
            $postulacionService = $this->container->get(\App\Services\PostulacionService::class);
            
            $postulacionService->cambiarEstadoPostulacion($idPostulacion, $estado, SessionHelper::get('user_id'));
            
            $mensaje = ($estado == 4) ? "Candidato preseleccionado 🌟" : "Candidato descartado.";
            SessionHelper::setFlash('success', $mensaje);

        } catch (\Exception $e) {
            SessionHelper::setFlash('error', $e->getMessage());
        }

        // Volver a la lista
        header('Location: ' . UrlHelper::base('/ofertas/postulantes') . "?id={$idOferta}");
    }
}