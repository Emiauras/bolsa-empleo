<?php
// app/Models/Repositories/MySQLPersonaRepository.php

namespace App\Models\Repositories;

use App\Core\Database; // Necesario para la conexión PDO
use App\Models\Entities\Persona; // Necesario para la entidad
use PDO;

class MySQLPersonaRepository implements PersonaRepositoryInterface
{
    private PDO $db;

    public function __construct()
    {
        // Obtiene la conexión PDO segura del Singleton Database
        $this->db = Database::getInstance()->getConnection();
    }
    
    //---------------------------------------------------------
    // BÚSQUEDA
    //---------------------------------------------------------

    public function findById(int $id): ?Persona 
    {
        $stmt = $this->db->prepare('SELECT * FROM personas WHERE id_persona = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? $this->mapToEntity($data) : null;
    }
    
    public function findByDni(string $dni): ?Persona 
    {
        // Se usa para verificar unicidad en el registro (Requerimiento)
        $stmt = $this->db->prepare('SELECT * FROM personas WHERE dni = ?');
        $stmt->execute([$dni]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? $this->mapToEntity($data) : null;
    }

    //---------------------------------------------------------
    // PERSISTENCIA
    //---------------------------------------------------------

    /**
     * Guarda una nueva persona en la base de datos (Usado en el registro inicial).
     * @param Persona $persona Entidad con datos personales.
     */
    public function save(Persona $persona): bool
    {
        $sql = 'INSERT INTO personas 
                (nombre, apellido, dni, email_contacto, telefono, fecha_nacimiento, direccion, localidad, provincia, pais)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        
        $stmt = $this->db->prepare($sql);
        
        $success = $stmt->execute([
            $persona->getNombre(),
            $persona->getApellido(),
            $persona->getDni(),
            $persona->getEmailContacto(),
            $persona->getTelefono(),
            $persona->getFechaNacimiento() ? $persona->getFechaNacimiento()->format('Y-m-d') : null,
            $persona->getDireccion(),
            $persona->getLocalidad(),
            $persona->getProvincia(),
            $persona->getPais(),
        ]);
        
        // Asigna el ID generado por MySQL al objeto
        if ($success) {
            $persona->setIdPersona((int)$this->db->lastInsertId());
        }
        return $success;
    }
    
    /**
     * Actualiza los datos de una persona existente (Usado al editar el perfil).
     * @param Persona $persona Entidad con datos personales y ID.
     */
    public function update(Persona $persona): bool
    {
        if ($persona->getIdPersona() === null) {
            // No se puede actualizar si no hay ID.
            return false;
        }

        $sql = 'UPDATE personas SET 
                nombre = ?, apellido = ?, dni = ?, fecha_nacimiento = ?, 
                telefono = ?, email_contacto = ?, direccion = ?, localidad = ?, 
                provincia = ?, pais = ?
                WHERE id_persona = ?';
        
        $stmt = $this->db->prepare($sql);
        
        // Ejecución de la consulta con todos los campos
        return $stmt->execute([
            $persona->getNombre(),
            $persona->getApellido(),
            $persona->getDni(),
            $persona->getFechaNacimiento() ? $persona->getFechaNacimiento()->format('Y-m-d') : null,
            $persona->getTelefono(),
            $persona->getEmailContacto(),
            $persona->getDireccion(),
            $persona->getLocalidad(),
            $persona->getProvincia(),
            $persona->getPais(),
            $persona->getIdPersona() // Clave: WHERE por ID
        ]);
    }
    
    //---------------------------------------------------------
    // MAPEADOR (MAPPER)
    //---------------------------------------------------------

    /**
     * Convierte un array asociativo de la DB en un objeto Persona.
     */
    private function mapToEntity(array $data): Persona
    {
        $persona = new Persona();
        $persona->setIdPersona((int)$data['id_persona'])
                ->setNombre($data['nombre'])
                ->setApellido($data['apellido'])
                ->setDni($data['dni'])
                ->setFechaNacimiento($data['fecha_nacimiento']) 
                ->setTelefono($data['telefono'] ?? null)
                ->setEmailContacto($data['email_contacto'] ?? null)
                ->setDireccion($data['direccion'] ?? null)
                ->setLocalidad($data['localidad'] ?? null)
                ->setProvincia($data['provincia'] ?? null)
                ->setPais($data['pais'] ?? null);
        return $persona;
    }
}