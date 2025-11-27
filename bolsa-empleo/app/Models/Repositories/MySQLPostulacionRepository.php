<?php
// app/Models/Repositories/MySQLPostulacionRepository.php

namespace App\Models\Repositories;

use App\Core\Database;
use App\Models\Entities\Postulacion;
use PDO;

class MySQLPostulacionRepository implements PostulacionRepositoryInterface
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Guarda una nueva postulación en la base de datos.
     */
    public function save(Postulacion $postulacion): bool
    {
        $sql = 'INSERT INTO postulaciones (id_oferta, id_postulante, id_estado_postulacion, mensaje_postulante) 
                VALUES (?, ?, ?, ?)';
        $stmt = $this->db->prepare($sql);
        
        $success = $stmt->execute([
            $postulacion->getIdOferta(),
            $postulacion->getIdPostulante(),
            1, // Estado inicial (1 = Enviada)
            $postulacion->getMensajePostulante()
        ]);

        if ($success) {
            $postulacion->setIdPostulacion((int)$this->db->lastInsertId());
        }
        return $success;
    }

    /**
     * Verifica si un postulante ya se ha postulado a una oferta específica.
     */
    public function exists(int $idOferta, int $idPostulante): bool
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM postulaciones WHERE id_oferta = ? AND id_postulante = ?');
        $stmt->execute([$idOferta, $idPostulante]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Obtiene todas las postulaciones asociadas a una oferta (objeto simple).
     */
    public function findByOfertaId(int $idOferta): array
    {
        $sql = "SELECT * FROM postulaciones WHERE id_oferta = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idOferta]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map([$this, 'mapToEntity'], $results);
    }

    /**
     * Obtiene todas las postulaciones hechas por un candidato.
     */
    public function findByPostulanteId(int $idPostulante): array
    {
        $sql = "SELECT * FROM postulaciones WHERE id_postulante = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idPostulante]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map([$this, 'mapToEntity'], $results);
    }

    /**
     * Actualiza el estado de una postulación (Preseleccionado/Descartado).
     * @param int $idPostulacion
     * @param int $nuevoEstado
     */
    public function actualizarEstado(int $idPostulacion, int $nuevoEstado): bool
    {
        $sql = "UPDATE postulaciones SET id_estado_postulacion = ? WHERE id_postulacion = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nuevoEstado, $idPostulacion]);
    }

    /**
     * Obtiene los datos COMPLETOS de los candidatos (Nombre, DNI, Contacto)
     * haciendo JOIN con las tablas de personas y postulantes.
     * Esencial para la vista de gestión de candidatos de la empresa.
     */
    public function obtenerCandidatosPorOferta(int $idOferta): array
    {
        $sql = "
            SELECT 
                p.id_postulacion,        -- CRÍTICO: Necesario para los botones de acción
                p.fecha_postulacion,
                p.mensaje_postulante,
                p.id_estado_postulacion,
                per.nombre,
                per.apellido,
                per.email_contacto,
                per.telefono,
                per.dni
            FROM postulaciones p
            INNER JOIN postulantes pos ON p.id_postulante = pos.id_postulante
            INNER JOIN personas per ON pos.id_persona = per.id_persona
            WHERE p.id_oferta = ?
            ORDER BY p.fecha_postulacion DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idOferta]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // --- Helper para mapear la entidad base ---
    private function mapToEntity(array $data): Postulacion
    {
        $p = new Postulacion();
        $p->setIdPostulacion((int)$data['id_postulacion'])
          ->setIdOferta((int)$data['id_oferta'])
          ->setIdPostulante((int)$data['id_postulante'])
          ->setFechaPostulacion(isset($data['fecha_postulacion']) ? new \DateTimeImmutable($data['fecha_postulacion']) : null)
          ->setMensajePostulante($data['mensaje_postulante'] ?? null)
          ->setIdEstadoPostulacion((int)($data['id_estado_postulacion'] ?? 1));
        return $p;
    }
}