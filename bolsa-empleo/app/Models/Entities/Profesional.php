<?php
namespace App\Models\Entities;

class Profesional {
    private ?int $id_profesional = null;
    private int $id_postulante;
    private string $titulo;
    private string $institucion;
    private ?string $matricula = null;
    private ?int $anio_graduacion = null;
    private ?string $estado_titulo = null;

    // Getters y Setters
    public function getIdProfesional() { return $this->id_profesional; }
    public function setIdProfesional($id) { $this->id_profesional = $id; return $this; }
    public function setIdPostulante($id) { $this->id_postulante = $id; return $this; }
    public function getIdPostulante() { return $this->id_postulante; }
    public function setTitulo($t) { $this->titulo = $t; return $this; }
    public function getTitulo() { return $this->titulo; }
    public function setInstitucion($i) { $this->institucion = $i; return $this; }
    public function getInstitucion() { return $this->institucion; }
    public function setMatricula($m) { $this->matricula = $m; return $this; }
    public function getMatricula() { return $this->matricula; }
    public function setAnioGraduacion($a) { $this->anio_graduacion = $a; return $this; }
    public function getAnioGraduacion() { return $this->anio_graduacion; }
    public function setEstadoTitulo($e) { $this->estado_titulo = $e; return $this; }
    public function getEstadoTitulo() { return $this->estado_titulo; }
}