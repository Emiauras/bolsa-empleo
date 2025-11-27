<?php
// app/Models/Repositories/MySQLPostulanteRepository.php

namespace App\Models\Repositories;

use App\Core\Database;
use App\Models\Entities\Postulante;
use App\Models\Entities\Persona;
use App\Models\Factories\PostulanteFactoryInterface;
use PDO;

class MySQLPostulanteRepository implements PostulanteRepositoryInterface
{
    private PDO $db;
    private PostulanteFactoryInterface $factory;

    public function __construct(PostulanteFactoryInterface $factory)
    {
        $this->db = Database::getInstance()->getConnection();
        $this->factory = $factory;
    }

    public function findById(int $id): ?Postulante 
    {
        $sql = "SELECT * FROM postulantes WHERE id_postulante = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$data) return null;

        return $this->factory->createFromDatabaseRow($data);
    }

    public function findByUserId(int $idUsuario): ?Postulante
    {
        $sql = "SELECT * FROM postulantes WHERE id_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idUsuario]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return $this->factory->createFromDatabaseRow($data);
    }

    public function save(Postulante $postulante): bool
    {
        $idPersona = null;
        $idEmpresa = null;

        if ($postulante->getTipo() <= 3) { 
             if (method_exists($postulante, 'getIdPersona')) {
                 $idPersona = $postulante->getIdPersona();
             }
        } elseif ($postulante->getTipo() == 4) { 
             if (method_exists($postulante, 'getIdEmpresa')) {
                 $idEmpresa = $postulante->getIdEmpresa();
             }
        }

        $sql = 'INSERT INTO postulantes (id_usuario, id_tipo_postulante, id_persona, id_empresa, id_estado_postulante)
                VALUES (?, ?, ?, ?, ?)';
        
        $stmt = $this->db->prepare($sql);
        
        $success = $stmt->execute([
            $postulante->getIdUsuario(),
            $postulante->getTipo(),
            $idPersona,
            $idEmpresa,
            1 
        ]);

        if ($success) {
            $postulante->setIdPostulante((int)$this->db->lastInsertId());
        }

        return $success;
    }

    public function search(array $criterios): array 
    {
        return [];
    }

    /**
     * MÉTODO CRÍTICO CORREGIDO
     * Actualiza el postulante para que sea Empresa y DEJA DE SER Persona.
     */
    public function vincularEmpresa(int $idPostulante, int $idEmpresa): bool
    {
        // La clave es "id_persona = NULL"
        $sql = "UPDATE postulantes 
                SET id_tipo_postulante = 4, 
                    id_empresa = ?, 
                    id_persona = NULL 
                WHERE id_postulante = ?";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$idEmpresa, $idPostulante]);
    }
}