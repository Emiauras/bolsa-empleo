<?php
namespace App\Models\Repositories;

use App\Models\Entities\Empresa;

interface EmpresaRepositoryInterface
{
    public function findById(int $id): ?Empresa;
    public function save(Empresa $empresa): bool;
    public function update(Empresa $empresa): bool;
}