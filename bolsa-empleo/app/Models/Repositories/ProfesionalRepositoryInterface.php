<?php
namespace App\Models\Repositories;
use App\Models\Entities\Profesional;

interface ProfesionalRepositoryInterface {
    public function findByPostulanteId(int $id): ?Profesional;
    public function save(Profesional $profesional): bool;
    public function update(Profesional $profesional): bool;
}