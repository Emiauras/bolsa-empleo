<?php
// app/Models/Entities/OfertaLaboral.php

namespace App\Models\Entities;

use DateTimeImmutable;

class OfertaLaboral
{
    private ?int $id_oferta = null;
    private int $id_empresa;
    private string $titulo;
    private string $descripcion;
    private ?int $id_rubro = null;
    private int $id_tipo_postulante_objetivo; // 1=Persona, 2=Profesional
    private ?string $requisitos = null;
    private ?float $rango_salarial_desde = null;
    private ?DateTimeImmutable $fecha_publicacion = null;
    private int $id_estado_oferta = 1; // 1=Activa

    // --- Getters ---
    public function getIdOferta(): ?int { return $this->id_oferta; }
    public function getIdEmpresa(): int { return $this->id_empresa; }
    public function getTitulo(): string { return $this->titulo; }
    public function getDescripcion(): string { return $this->descripcion; }
    public function getRequisitos(): ?string { return $this->requisitos; }
    public function getFechaPublicacion(): ?DateTimeImmutable { return $this->fecha_publicacion; }
    public function getRangoSalarialDesde(): ?float { return $this->rango_salarial_desde; }
    public function getIdTipoPostulanteObjetivo(): int { return $this->id_tipo_postulante_objetivo; }
    public function getIdRubro(): ?int { return $this->id_rubro; }

    // --- Setters ---
    public function setIdOferta(int $id): self { $this->id_oferta = $id; return $this; }
    public function setIdEmpresa(int $id): self { $this->id_empresa = $id; return $this; }
    public function setTitulo(string $t): self { $this->titulo = $t; return $this; }
    public function setDescripcion(string $d): self { $this->descripcion = $d; return $this; }
    public function setRequisitos(?string $r): self { $this->requisitos = $r; return $this; }
    public function setRangoSalarialDesde($v): self { $this->rango_salarial_desde = $v ? (float)$v : null; return $this; }
    
    public function setIdTipoPostulanteObjetivo(int $t): self { 
        $this->id_tipo_postulante_objetivo = $t; return $this; 
    }
    public function setIdRubro($r): self { 
        $this->id_rubro = $r ? (int)$r : null; return $this; 
    }
    
    public function setFechaPublicacion($fecha): self {
        if (is_string($fecha)) {
            $this->fecha_publicacion = new DateTimeImmutable($fecha);
        } elseif ($fecha instanceof DateTimeImmutable) {
            $this->fecha_publicacion = $fecha;
        }
        return $this;
    }
    
    public function setIdEstadoOferta(int $e): self { $this->id_estado_oferta = $e; return $this; }
}