<?php
namespace App\Models\Repositories;
use App\Models\Entities\OfertaLaboral;

interface OfertaRepositoryInterface
{
    public function save(OfertaLaboral $oferta): bool;
    public function findAllActive(): array;
    public function findByEmpresaId(int $idEmpresa): array;
}