<?php
// app/Models/Entities/Empresa.php

namespace App\Models\Entities;

class Empresa
{
    private ?int $id_empresa = null;
    private string $razon_social;
    private string $cuit;
    private ?int $id_rubro = null;
    private ?string $direccion = null;
    private ?string $localidad = null;
    private ?string $email_contacto = null;
    private ?string $sitio_web = null;

    // --- GETTERS ---
    public function getIdEmpresa(): ?int { return $this->id_empresa; }
    public function getRazonSocial(): string { return $this->razon_social; }
    public function getCuit(): string { return $this->cuit; }
    public function getIdRubro(): ?int { return $this->id_rubro; }
    public function getDireccion(): ?string { return $this->direccion; }
    public function getLocalidad(): ?string { return $this->localidad; }
    public function getEmailContacto(): ?string { return $this->email_contacto; }
    public function getSitioWeb(): ?string { return $this->sitio_web; }

    // --- SETTERS (Estos son los que te faltaban) ---

    public function setIdEmpresa(int $id): self 
    { 
        $this->id_empresa = $id; 
        return $this; 
    }

    public function setRazonSocial(string $rs): self 
    { 
        $this->razon_social = $rs; 
        return $this; 
    }

    public function setCuit(string $cuit): self 
    { 
        $this->cuit = $cuit; 
        return $this; 
    }
    
    // ESTE ES EL MÉTODO QUE CAUSABA EL ERROR
    public function setIdRubro($rubro): self 
    {
        $this->id_rubro = !empty($rubro) ? (int)$rubro : null;
        return $this;
    }

    public function setDireccion(?string $val): self 
    { 
        $this->direccion = $val; 
        return $this; 
    }

    public function setLocalidad(?string $val): self 
    { 
        $this->localidad = $val; 
        return $this; 
    }

    public function setEmailContacto(?string $val): self 
    { 
        $this->email_contacto = $val; 
        return $this; 
    }

    public function setSitioWeb(?string $val): self 
    { 
        $this->sitio_web = $val; 
        return $this; 
    }
}