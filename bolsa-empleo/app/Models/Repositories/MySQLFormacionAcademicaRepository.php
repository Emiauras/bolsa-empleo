<?php
namespace App\Models\Repositories;
use App\Core\Database;
use App\Models\Entities\FormacionAcademica;
use PDO;

class MySQLFormacionAcademicaRepository implements FormacionAcademicaRepositoryInterface {
    private PDO $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function findByPostulanteId(int $id): array {
        // Retorna array vacío por ahora para que no falle
        return []; 
    }
    public function save(FormacionAcademica $f): bool { return true; }
    public function delete(int $id): bool { return true; }
}