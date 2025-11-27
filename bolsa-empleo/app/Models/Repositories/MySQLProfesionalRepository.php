<?php
namespace App\Models\Repositories;

use App\Core\Database;
use App\Models\Entities\Profesional;
use PDO;

class MySQLProfesionalRepository implements ProfesionalRepositoryInterface
{
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByPostulanteId(int $id): ?Profesional {
        $stmt = $this->db->prepare('SELECT * FROM profesionales WHERE id_postulante = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$data) return null;
        
        $p = new Profesional();
        $p->setIdProfesional($data['id_profesional'])
          ->setIdPostulante($data['id_postulante'])
          ->setTitulo($data['titulo'])
          ->setInstitucion($data['institucion'])
          ->setMatricula($data['matricula'] ?? null)
          ->setAnioGraduacion($data['anio_graduacion'] ?? null)
          ->setEstadoTitulo($data['estado_titulo'] ?? null);
        return $p;
    }

    public function save(Profesional $p): bool {
        $sql = 'INSERT INTO profesionales (id_postulante, titulo, institucion, matricula, anio_graduacion, estado_titulo) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $p->getIdPostulante(), $p->getTitulo(), $p->getInstitucion(),
            $p->getMatricula(), $p->getAnioGraduacion(), $p->getEstadoTitulo()
        ]);
    }

    public function update(Profesional $p): bool {
        $sql = 'UPDATE profesionales SET titulo=?, institucion=?, matricula=?, anio_graduacion=?, estado_titulo=? WHERE id_postulante=?';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $p->getTitulo(), $p->getInstitucion(), $p->getMatricula(),
            $p->getAnioGraduacion(), $p->getEstadoTitulo(), $p->getIdPostulante()
        ]);
    }
}