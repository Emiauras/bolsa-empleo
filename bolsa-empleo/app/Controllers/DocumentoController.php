<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Container;
use App\Services\DocumentoService;
use App\Core\SessionHelper;
use App\Core\UrlHelper;

class DocumentoController extends Controller
{
    private DocumentoService $documentoService;

    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->documentoService = $container->get(DocumentoService::class);
    }

    public function subir()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !SessionHelper::get('user_id')) {
            header('Location: ' . UrlHelper::base('/perfil'));
            return;
        }

        // Verificar si se envió un archivo
        if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
            SessionHelper::setFlash('error', 'Debes seleccionar un archivo válido.');
            header('Location: ' . UrlHelper::base('/perfil'));
            return;
        }

        try {
            $idPostulante = SessionHelper::get('postulante_id');
            $this->documentoService->subirCv($idPostulante, $_FILES['archivo']);
            
            SessionHelper::setFlash('success', 'Documento subido correctamente. 📄');
        } catch (\Exception $e) {
            SessionHelper::setFlash('error', $e->getMessage());
        }

        header('Location: ' . UrlHelper::base('/perfil'));
    }
}