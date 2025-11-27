<?php
// app/Models/Repositories/PersonaRepositoryInterface.php

namespace App\Models\Repositories;

use App\Models\Entities\Persona;

/**
 * Contrato que define los métodos obligatorios para manejar Personas.
 */
interface PersonaRepositoryInterface
{
    public function findById(int $id): ?Persona;
    
    public function findByDni(string $dni): ?Persona;
    
    public function save(Persona $persona): bool;
    
    public function update(Persona $persona): bool;
}