<?php
namespace App\Models\Repositories;

use App\Models\Entities\Emprendimiento;

interface EmprendimientoRepositoryInterface
{
    public function findAll(): array;
    public function save(Emprendimiento $emprendimiento): bool;
}