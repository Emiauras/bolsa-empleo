<?php
namespace App\Services;

use App\Models\Repositories\EmprendimientoRepositoryInterface;

class EmprendimientoService
{
    private EmprendimientoRepositoryInterface $repo;

    public function __construct(EmprendimientoRepositoryInterface $repo) {
        $this->repo = $repo;
    }

    public function getAll(): array {
        return $this->repo->findAll();
    }
}