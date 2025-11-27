<?php
namespace App\Models\Entities;

use DateTimeImmutable;

class Postulacion
{
    private ?int $id_postulacion = null;
    private int $id_oferta;
    private int $id_postulante;
    private ?DateTimeImmutable $fecha_postulacion = null;
    private int $id_estado_postulacion = 1; // 1 = Enviada
    private ?string $mensaje_postulante = null;

    // --- Getters ---
    public function getIdPostulacion(): ?int { return $this->id_postulacion; }
    public function getIdOferta(): int { return $this->id_oferta; }
    public function getIdPostulante(): int { return $this->id_postulante; }
    public function getFechaPostulacion(): ?DateTimeImmutable { return $this->fecha_postulacion; }
    public function getMensajePostulante(): ?string { return $this->mensaje_postulante; }

    // --- Setters ---
    public function setIdPostulacion(int $id): self { $this->id_postulacion = $id; return $this; }
    public function setIdOferta(int $id): self { $this->id_oferta = $id; return $this; }
    public function setIdPostulante(int $id): self { $this->id_postulante = $id; return $this; }
    
    public function setFechaPostulacion($fecha): self {
        if (is_string($fecha)) {
            $this->fecha_postulacion = new DateTimeImmutable($fecha);
        } elseif ($fecha instanceof DateTimeImmutable) {
            $this->fecha_postulacion = $fecha;
        }
        return $this;
    }
    
    public function setIdEstadoPostulacion(int $id): self { $this->id_estado_postulacion = $id; return $this; }
    public function setMensajePostulante(?string $msg): self { $this->mensaje_postulante = $msg; return $this; }
}