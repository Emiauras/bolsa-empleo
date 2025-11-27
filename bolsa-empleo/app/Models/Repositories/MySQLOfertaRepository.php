<?php
namespace App\Models\Repositories;

use App\Core\Database;
use App\Models\Entities\OfertaLaboral;
use PDO;

class MySQLOfertaRepository implements OfertaRepositoryInterface
{
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function save(OfertaLaboral $oferta): bool
    {
        $sql = 'INSERT INTO ofertas_laborales (
            id_empresa, titulo, descripcion, id_rubro, id_tipo_postulante_objetivo,
            requisitos, rango_salarial_desde, id_estado_oferta
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

        $stmt = $this->db->prepare($sql);
        $success = $stmt->execute([
            $oferta->getIdEmpresa(),
            $oferta->getTitulo(),
            $oferta->getDescripcion(),
            $oferta->getIdRubro(),
            $oferta->getIdTipoPostulanteObjetivo() ?: 1,
            $oferta->getRequisitos(),
            $oferta->getRangoSalarialDesde(),
            1 // Estado 1 = Activa
        ]);

        if ($success) {
            $oferta->setIdOferta((int)$this->db->lastInsertId());
        }
        return $success;
    }

    public function findAllActive(): array
    {
        $stmt = $this->db->query('SELECT * FROM ofertas_laborales WHERE id_estado_oferta = 1 ORDER BY fecha_publicacion DESC');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map([$this, 'mapToEntity'], $results);
    }

    public function findByEmpresaId(int $idEmpresa): array
    {
        $stmt = $this->db->prepare('SELECT * FROM ofertas_laborales WHERE id_empresa = ? ORDER BY fecha_publicacion DESC');
        $stmt->execute([$idEmpresa]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map([$this, 'mapToEntity'], $results);
    }

    private function mapToEntity(array $data): OfertaLaboral
    {
        $oferta = new OfertaLaboral();
        $oferta->setIdOferta((int)$data['id_oferta'])
               ->setIdEmpresa((int)$data['id_empresa'])
               ->setTitulo($data['titulo'])
               ->setDescripcion($data['descripcion'])
               ->setRequisitos($data['requisitos'] ?? null)
               ->setRangoSalarialDesde($data['rango_salarial_desde'] ?? null)
               ->setFechaPublicacion($data['fecha_publicacion']);
        return $oferta;
    }
}