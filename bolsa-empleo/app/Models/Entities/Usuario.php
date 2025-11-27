<?php
// app/Models/Entities/Usuario.php

namespace App\Models\Entities;

use DateTimeImmutable;

/**
 * Entidad de dominio que representa a un usuario del sistema (credenciales de acceso).
 */
class Usuario
{
    private ?int $id_usuario = null;
    private string $username;
    private string $email;
    private string $password_hash;
    private DateTimeImmutable $fecha_alta;
    private bool $activo;

    public function __construct()
    {
        // Valores por defecto consistentes con la tabla
        $this->fecha_alta = new DateTimeImmutable();
        $this->activo = true;
    }

    // --- Getters ---
    public function getIdUsuario(): ?int { return $this->id_usuario; }
    public function getUsername(): string { return $this->username; }
    public function getEmail(): string { return $this->email; }
    public function getPasswordHash(): string { return $this->password_hash; }
    public function getFechaAlta(): DateTimeImmutable { return $this->fecha_alta; }
    public function isActivo(): bool { return $this->activo; }

    // --- Setters (Chainable para conveniencia) ---
    public function setIdUsuario(int $id_usuario): self
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function setPasswordHash(string $password_hash): self
    {
        $this->password_hash = $password_hash;
        return $this;
    }
    
    public function setFechaAlta(DateTimeImmutable $fecha_alta): self
    {
        $this->fecha_alta = $fecha_alta;
        return $this;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;
        return $this;
    }

    /**
     * Verifica si la contraseña plana coincide con el hash almacenado.
     */
    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password_hash);
    }
}