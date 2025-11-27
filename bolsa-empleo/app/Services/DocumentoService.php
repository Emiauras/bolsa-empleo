<?php
namespace App\Services;

use App\Models\Repositories\DocumentoRepositoryInterface;
use App\Models\Entities\DocumentoAdjunto;

class DocumentoService
{
    private DocumentoRepositoryInterface $repo;

    public function __construct(DocumentoRepositoryInterface $repo) {
        $this->repo = $repo;
    }

    public function subirCv(int $idPostulante, array $archivo): void
    {
        // 1. Validaciones básicas
        if ($archivo['error'] !== UPLOAD_ERR_OK) {
            throw new \Exception("Error al subir el archivo.");
        }
        
        // 2. Mover archivo
        $nombreSistema = uniqid() . '_' . basename($archivo['name']);
        // Asegúrate de crear esta carpeta: C:\xampp-nuevo\htdocs\bolsa-empleo\public\uploads\
        $rutaDestino = __DIR__ . '/../../public/uploads/' . $nombreSistema;
        
        if (!move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
            throw new \Exception("No se pudo guardar el archivo en el servidor.");
        }

        // 3. Guardar en DB
        $doc = new DocumentoAdjunto();
        $doc->setIdPostulante($idPostulante)
            ->setIdTipoDocumento(1) // 1 = CV
            ->setNombreOriginal($archivo['name'])
            ->setNombreSistema($nombreSistema)
            ->setRuta('/uploads/' . $nombreSistema);

        $this->repo->save($doc);
    }
    
    public function getMisDocumentos(int $idPostulante): array {
        return $this->repo->findByPostulanteId($idPostulante);
    }
}