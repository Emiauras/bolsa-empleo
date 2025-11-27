<?php
// app/Models/Entities/Persona.php

namespace App\Models\Entities;

use DateTimeImmutable;

/**
 * Entidad de dominio que representa los datos personales básicos.
 * Corresponde a la tabla 'personas'.
 */
class Persona
{
    private ?int $id_persona = null;
    private string $nombre;
    private string $apellido;
    private string $dni;
    private ?DateTimeImmutable $fecha_nacimiento = null;
    private ?string $telefono = null;
    private ?string $email_contacto = null; // El campo que faltaba
    private ?string $direccion = null;
    private ?string $localidad = null;
    private ?string $provincia = null;
    private ?string $pais = null;

    // --- Getters ---
    public function getIdPersona(): ?int { return $this->id_persona; }
    public function getNombre(): string { return $this->nombre ?? ''; }
    public function getApellido(): string { return $this->apellido ?? ''; }
    public function getDni(): string { return $this->dni ?? ''; }
    public function getFechaNacimiento(): ?DateTimeImmutable { return $this->fecha_nacimiento; }
    public function getTelefono(): ?string { return $this->telefono; }
    
    // ¡ESTE ES EL GETTER QUE FALTABA!
    public function getEmailContacto(): ?string { return $this->email_contacto; }
    
    public function getDireccion(): ?string { return $this->direccion; }
    public function getLocalidad(): ?string { return $this->localidad; }
    public function getProvincia(): ?string { return $this->provincia; }
    public function getPais(): ?string { return $this->pais; }

    // --- Setters (Chainable) ---
    
    public function setIdPersona(int $id_persona): self
    {
        $this->id_persona = $id_persona;
        return $this;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;
        return $this;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;
        return $this;
    }

    // ¡ESTE ES EL MÉTODO QUE CAUSABA EL ERROR!
    public function setEmailContacto(?string $email): self
    {
        $this->email_contacto = $email;
        return $this;
    }

    public function setFechaNacimiento($fecha_nacimiento): self
    {
        if ($fecha_nacimiento instanceof DateTimeImmutable) {
            $this->fecha_nacimiento = $fecha_nacimiento;
        } elseif (is_string($fecha_nacimiento) && !empty($fecha_nacimiento)) {
             try {
                $this->fecha_nacimiento = new DateTimeImmutable($fecha_nacimiento);
             } catch (\Exception $e) {
                $this->fecha_nacimiento = null;
             }
        } else {
            $this->fecha_nacimiento = null;
        }
        return $this;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;
        return $this;
    }
    
    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;
        return $this;
    }

    public function setLocalidad(?string $localidad): self
    {
        $this->localidad = $localidad;
        return $this;
    }

    public function setProvincia(?string $provincia): self
    {
        $this->provincia = $provincia;
        return $this;
    }

    public function setPais(?string $pais): self
    {
        $this->pais = $pais;
        return $this;
    }
}