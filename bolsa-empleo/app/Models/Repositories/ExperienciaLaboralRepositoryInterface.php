<?php
namespace App\Models\Repositories;
use App\Models\Entities\ExperienciaLaboral;

interface ExperienciaLaboralRepositoryInterface {
    public function findByPostulanteId(int $idPostulante): array;
    public function save(ExperienciaLaboral $experiencia): bool;
    public function delete(int $idExperiencia): bool;
}