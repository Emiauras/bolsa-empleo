<?php
declare(strict_types=1);

namespace App\Models\Repositories;

use App\Models\Entities\Usuario;
use PDO;

class MySQLUsuarioRepository implements UsuarioRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function guardar(Usuario $usuario): int
    {
        $sql = "INSERT INTO usuarios (username, email, password_hash) VALUES (:username, :email, :password_hash)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':username' => $usuario->getUsername(),
            ':email' => $usuario->getEmail(),
            ':password_hash' => $usuario->getPasswordHash()
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    private function mapRowToUsuario(array $row): Usuario
    {
        return new Usuario(
            (int)$row['id_usuario'],
            $row['username'],
            $row['email'],
            $row['password_hash'],
            $row['fecha_alta'] ?? date('Y-m-d H:i:s'),
            (int)($row['activo'] ?? 1)
        );
    }

    public function buscarPorEmail(string $email): ?Usuario
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->mapRowToUsuario($row) : null;
    }

    public function buscarPorUsername(string $username): ?Usuario
    {
        $sql = "SELECT * FROM usuarios WHERE username = :username LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':username' => $username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->mapRowToUsuario($row) : null;
    }

    public function buscarPorId(int $id): ?Usuario
    {
        $sql = "SELECT * FROM usuarios WHERE id_usuario = :id LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->mapRowToUsuario($row) : null;
    }
}
