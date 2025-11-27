<?php
// app/Models/Entities/ExperienciaLaboral.php

namespace App\Models\Entities;

use DateTimeImmutable;

/**
 * Entidad que representa una experiencia laboral.
 * Corresponde a la tabla 'experiencias_laborales'.
 */
class ExperienciaLaboral
{
    private ?int $id_experiencia = null;
    private int $id_postulante;
    private string $empresa_nombre;
    private string $puesto;
    private ?DateTimeImmutable $fecha_desde = null;
    private ?DateTimeImmutable $fecha_hasta = null;
    private bool $actualmente = false;
    private ?string $descripcion = null;

    // --- Getters ---
    public function getIdExperiencia(): ?int { return $this->id_experiencia; }
    public function getIdPostulante(): int { return $this->id_postulante; }
    public function getEmpresaNombre(): string { return $this->empresa_nombre; }
    public function getPuesto(): string { return $this->puesto; }
    public function getFechaDesde(): ?DateTimeImmutable { return $this->fecha_desde; }
    public function getFechaHasta(): ?DateTimeImmutable { return $this->fecha_hasta; }
    public function isActualmente(): bool { return $this->actualmente; }
    public function getDescripcion(): ?string { return $this->descripcion; }

    // --- Setters (Chainable) ---
    public function setIdExperiencia(int $id_experiencia): self
    {
        $this->id_experiencia = $id_experiencia;
        return $this;
    }
    public function setIdPostulante(int $id_postulante): self
    {
        $this->id_postulante = $id_postulante;
        return $this;
    }
    public function setEmpresaNombre(string $empresa_nombre): self
    {
        $this->empresa_nombre = $empresa_nombre;
        return $this;
    }
    public function setPuesto(string $puesto): self
    {
        $this->puesto = $puesto;
        return $this;
    }
    public function setFechaDesde(?string $fecha): self
    {
        if ($fecha) $this->fecha_desde = new DateTimeImmutable($fecha);
        return $this;
    }
    public function setFechaHasta(?string $fecha): self
    {
        if ($fecha) $this->fecha_hasta = new DateTimeImmutable($fecha);
        return $this;
    }
    public function setActualmente(bool $actualmente): self
    {
        $this->actualmente = $actualmente;
        return $this;
    }
    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;
        return $this;
    }
}