<?php
namespace App\Models\Repositories;
use App\Core\Database;
use App\Models\Entities\ExperienciaLaboral;
use PDO;

class MySQLExperienciaLaboralRepository implements ExperienciaLaboralRepositoryInterface {
    private PDO $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function findByPostulanteId(int $id): array { return []; }
    public function save(ExperienciaLaboral $e): bool { return true; }
    public function delete(int $id): bool { return true; }
}