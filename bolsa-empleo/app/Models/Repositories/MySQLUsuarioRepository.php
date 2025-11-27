<?php
// app/Models/Repositories/MySQLUsuarioRepository.php

namespace App\Models\Repositories;

use App\Core\Database; // Clase para obtener la conexión PDO
use App\Models\Entities\Usuario; // Entidad de dominio
use PDO;

class MySQLUsuarioRepository implements UsuarioRepositoryInterface
{
    // Propiedad para almacenar la conexión PDO
    private PDO $db; 

    public function __construct()
    {
        // Obtiene la conexión PDO segura del Singleton Database
        // Esta es la primera línea de código ejecutable dentro del constructor.
        $this->db = Database::getInstance()->getConnection();
    }
    
    //---------------------------------------------------------
    // BÚSQUEDA (Finders)
    //---------------------------------------------------------

    public function findById(int $id): ?Usuario 
    {
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE id_usuario = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? $this->mapToEntity($data) : null;
    }
    
    public function findByUsername(string $username): ?Usuario 
    {
        // Consulta para el login
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE username = ?');
        $stmt->execute([$username]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? $this->mapToEntity($data) : null;
    }
    
    public function findByEmail(string $email): ?Usuario 
    {
        // Consulta para verificar unicidad de email
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? $this->mapToEntity($data) : null;
    }

    //---------------------------------------------------------
    // PERSISTENCIA
    //---------------------------------------------------------

    /**
     * Guarda un nuevo usuario en la base de datos (Usado en el registro).
     */
    public function save(Usuario $usuario): bool
    {
        // Se incluyen activo y fecha_alta ya que son NOT NULL [cite: 449, 450]
        $sql = 'INSERT INTO usuarios (username, email, password_hash, activo, fecha_alta) 
                VALUES (?, ?, ?, ?, ?)';
        
        $stmt = $this->db->prepare($sql);

        $success = $stmt->execute([
            $usuario->getUsername(),
            $usuario->getEmail(),
            $usuario->getPasswordHash(),
            $usuario->isActivo(), 
            $usuario->getFechaAlta()->format('Y-m-d H:i:s') 
        ]);

        if ($success) {
            $usuario->setIdUsuario((int)$this->db->lastInsertId());
        }
        return $success;
    }
    
    /**
     * Actualiza los datos de un usuario existente.
     */
    public function update(Usuario $usuario): bool
    {
        if ($usuario->getIdUsuario() === null) {
            return false;
        }

        $sql = 'UPDATE usuarios SET 
                username = ?, email = ?, password_hash = ?, activo = ?
                WHERE id_usuario = ?';
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            $usuario->getUsername(),
            $usuario->getEmail(),
            $usuario->getPasswordHash(),
            $usuario->isActivo(),
            $usuario->getIdUsuario() 
        ]);
    }
    
    //---------------------------------------------------------
    // MAPEADOR (MAPPER)
    //---------------------------------------------------------

    /**
     * Convierte un array asociativo de la DB en un objeto Usuario.
     */
    private function mapToEntity(array $data): Usuario
    {
        $usuario = new Usuario();
        $usuario->setIdUsuario((int)$data['id_usuario'])
                ->setUsername($data['username'])
                ->setEmail($data['email'])
                ->setPasswordHash($data['password_hash'])
                // Convertir datetime/booleanos
                ->setFechaAlta(new \DateTimeImmutable($data['fecha_alta']))
                ->setActivo((bool)$data['activo']); 
        return $usuario;
    }
}