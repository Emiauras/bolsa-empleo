<?php
namespace App\Models\Entities;

class Emprendimiento
{
    private ?int $id_emprendimiento = null;
    private int $id_postulante_emprendedor;
    private string $nombre;
    private string $descripcion;
    // ... otros campos como rubro, estado, web ...

    // Getters
    public function getIdEmprendimiento(): ?int { return $this->id_emprendimiento; }
    public function getNombre(): string { return $this->nombre; }
    public function getDescripcion(): string { return $this->descripcion; }
    
    // Setters
    public function setIdEmprendimiento(int $id): self { $this->id_emprendimiento = $id; return $this; }
    public function setIdPostulanteEmprendedor(int $id): self { $this->id_postulante_emprendedor = $id; return $this; }
    public function setNombre(string $n): self { $this->nombre = $n; return $this; }
    public function setDescripcion(string $d): self { $this->descripcion = $d; return $this; }
}