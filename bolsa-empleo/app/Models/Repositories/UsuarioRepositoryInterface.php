<?php
// app/Models/Repositories/UsuarioRepositoryInterface.php

namespace App\Models\Repositories;

use App\Models\Entities\Usuario; // Asumimos que ya creaste la clase Usuario en Entities

/**
 * Define el contrato de la capa de acceso a datos para la entidad Usuario.
 */
interface UsuarioRepositoryInterface
{
    public function findById(int $id): ?Usuario;
    public function findByUsername(string $username): ?Usuario;
    public function findByEmail(string $email): ?Usuario;
    public function save(Usuario $usuario): bool;
    // ... otros métodos como update, delete, findAll
}