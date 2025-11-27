<?php
namespace App\Models\Entities;

class ProfesionalPostulante implements Postulante {
    private ?int $id_postulante = null;
    private int $id_usuario;
    private Persona $persona;

    public function __construct(Persona $persona) { $this->persona = $persona; }

    public function getIdPostulante(): ?int { return $this->id_postulante; }
    public function setIdPostulante(int $id): self { $this->id_postulante = $id; return $this; }
    public function getIdUsuario(): int { return $this->id_usuario; }
    public function setIdUsuario(int $id): self { $this->id_usuario = $id; return $this; }
    public function getTipo(): int { return 2; } // 2 = Profesional
    public function getIdPersona(): ?int { return $this->persona->getIdPersona(); }
}