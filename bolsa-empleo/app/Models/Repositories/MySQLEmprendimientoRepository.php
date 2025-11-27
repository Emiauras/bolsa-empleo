<?php
namespace App\Models\Repositories;

use App\Core\Database;
use App\Models\Entities\Emprendimiento;
use PDO;

class MySQLEmprendimientoRepository implements EmprendimientoRepositoryInterface
{
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findAll(): array {
        // Obtenemos todos los emprendimientos
        $stmt = $this->db->query('SELECT * FROM emprendimientos ORDER BY id_emprendimiento DESC');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $emprendimientos = [];
        foreach ($results as $row) {
            $e = new Emprendimiento();
            $e->setIdEmprendimiento($row['id_emprendimiento'])
              ->setNombre($row['nombre'])
              ->setDescripcion($row['descripcion']);
            // Aquí podrías setear más datos si los tuvieras
            $emprendimientos[] = $e;
        }
        return $emprendimientos;
    }

    public function save(Emprendimiento $e): bool {
        $sql = 'INSERT INTO emprendimientos (id_postulante_emprendedor, nombre, descripcion) VALUES (?, ?, ?)';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $e->getIdPostulanteEmprendedor() ?: 1, // Fallback si es nulo
            $e->getNombre(),
            $e->getDescripcion()
        ]);
    }
}