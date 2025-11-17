<?php
declare(strict_types=1);

namespace App\Models\Entities;

class Usuario
{
    private ?int $id;
    private string $username;
    private string $email;
    private string $passwordHash;
    private string $fechaAlta;
    private int $activo;

    public function __construct(?int $id, string $username, string $email, string $passwordHash, string $fechaAlta, int $activo = 1)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->fechaAlta = $fechaAlta;
        $this->activo = $activo;
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getUsername(): string { return $this->username; }
    public function getEmail(): string { return $this->email; }
    public function getPasswordHash(): string { return $this->passwordHash; }
    public function getFechaAlta(): string { return $this->fechaAlta; }
    public function isActivo(): bool { return (bool)$this->activo; }

    // Setters (si necesitás)
    public function setPasswordHash(string $hash): void { $this->passwordHash = $hash; }
}
