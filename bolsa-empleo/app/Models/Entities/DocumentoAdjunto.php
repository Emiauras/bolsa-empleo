<?php
namespace App\Models\Entities;

use DateTimeImmutable;

class DocumentoAdjunto
{
    private ?int $id_documento = null;
    private ?int $id_postulante = null;
    private int $id_tipo_documento; // 1=CV, 2=Foto, etc.
    private string $nombre_archivo_original;
    private string $nombre_archivo_sistema;
    private string $ruta_archivo;
    
    // Getters y Setters básicos
    public function getIdDocumento(): ?int { return $this->id_documento; }
    public function setIdDocumento(int $id): self { $this->id_documento = $id; return $this; }
    
    public function setIdPostulante(int $id): self { $this->id_postulante = $id; return $this; }
    public function getIdPostulante(): ?int { return $this->id_postulante; }
    
    public function setIdTipoDocumento(int $t): self { $this->id_tipo_documento = $t; return $this; }
    public function getIdTipoDocumento(): int { return $this->id_tipo_documento; }
    
    public function setNombreOriginal(string $n): self { $this->nombre_archivo_original = $n; return $this; }
    public function getNombreOriginal(): string { return $this->nombre_archivo_original; }
    
    public function setNombreSistema(string $n): self { $this->nombre_archivo_sistema = $n; return $this; }
    public function getNombreSistema(): string { return $this->nombre_archivo_sistema; }
    
    public function setRuta(string $r): self { $this->ruta_archivo = $r; return $this; }
    public function getRuta(): string { return $this->ruta_archivo; }
}