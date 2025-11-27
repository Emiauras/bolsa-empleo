<?php
namespace App\Models\Entities;

class EmpresaPostulante implements Postulante {
    private ?int $id_postulante = null;
    private int $id_usuario;
    private Empresa $empresa;

    public function __construct(Empresa $empresa) { $this->empresa = $empresa; }
    
    public function getIdPostulante(): ?int { return $this->id_postulante; }
    public function setIdPostulante(int $id): self { $this->id_postulante = $id; return $this; }
    public function getIdUsuario(): int { return $this->id_usuario; }
    public function setIdUsuario(int $id): self { $this->id_usuario = $id; return $this; }
    public function getTipo(): int { return 4; } // 4 = Empresa
    public function getIdEmpresa(): ?int { return $this->empresa->getIdEmpresa(); }
}