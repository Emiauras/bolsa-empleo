<?php
// app/Models/Entities/FormacionAcademica.php

namespace App\Models\Entities;

/**
 * Entidad que representa la formación académica de un postulante.
 * [cite_start]Corresponde a la tabla 'formaciones_academicas'[cite: 563].
 */
class FormacionAcademica
{
    private ?int $id_formacion = null;
    private int $id_postulante;
    private int $id_nivel_estudio; // FK a niveles_estudio
    private string $titulo;
    private string $institucion;
    private ?int $anio_inicio = null;
    private ?int $anio_fin = null;
    private bool $en_curso = false;

    // --- Getters y Setters ---
    public function getIdFormacion(): ?int { return $this->id_formacion; }
    public function setIdFormacion(int $id_formacion): self
    {
        $this->id_formacion = $id_formacion;
        return $this;
    }
    public function getIdPostulante(): int { return $this->id_postulante; }
    public function setIdPostulante(int $id_postulante): self
    {
        $this->id_postulante = $id_postulante;
        return $this;
    }
    public function getIdNivelEstudio(): int { return $this->id_nivel_estudio; }
    public function setIdNivelEstudio(int $id_nivel_estudio): self
    {
        $this->id_nivel_estudio = $id_nivel_estudio;
        return $this;
    }
    public function getTitulo(): string { return $this->titulo; }
    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;
        return $this;
    }
    public function getInstitucion(): string { return $this->institucion; }
    public function setInstitucion(string $institucion): self
    {
        $this->institucion = $institucion;
        return $this;
    }
    public function getAnioInicio(): ?int { return $this->anio_inicio; }
    public function setAnioInicio(?int $anio_inicio): self
    {
        $this->anio_inicio = $anio_inicio;
        return $this;
    }
    public function getAnioFin(): ?int { return $this->anio_fin; }
    public function setAnioFin(?int $anio_fin): self
    {
        $this->anio_fin = $anio_fin;
        return $this;
    }
    public function isEnCurso(): bool { return $this->en_curso; }
    public function setEnCurso(bool $en_curso): self
    {
        $this->en_curso = $en_curso;
        return $this;
    }
}