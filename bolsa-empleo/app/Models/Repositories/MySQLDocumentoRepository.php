<?php
namespace App\Models\Repositories;

use App\Core\Database;
use App\Models\Entities\DocumentoAdjunto;
use PDO;

class MySQLDocumentoRepository implements DocumentoRepositoryInterface
{
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function save(DocumentoAdjunto $doc): bool {
        $sql = 'INSERT INTO documentos_adjuntos (id_postulante, id_tipo_documento, nombre_archivo_original, nombre_archivo_sistema, ruta_archivo) VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->db->prepare($sql);
        $success = $stmt->execute([
            $doc->getIdPostulante(),
            $doc->getIdTipoDocumento(),
            $doc->getNombreOriginal(),
            $doc->getNombreSistema(),
            $doc->getRuta()
        ]);
        if ($success) $doc->setIdDocumento((int)$this->db->lastInsertId());
        return $success;
    }

    public function findByPostulanteId(int $id): array {
        $stmt = $this->db->prepare('SELECT * FROM documentos_adjuntos WHERE id_postulante = ?');
        $stmt->execute([$id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $docs = [];
        foreach($results as $row) {
            $d = new DocumentoAdjunto();
            $d->setIdDocumento($row['id_documento'])
              ->setNombreOriginal($row['nombre_archivo_original'])
              ->setRuta($row['ruta_archivo']);
            $docs[] = $d;
        }
        return $docs;
    }
}