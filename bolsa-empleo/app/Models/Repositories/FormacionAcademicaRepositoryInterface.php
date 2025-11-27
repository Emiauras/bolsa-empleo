<?php
namespace App\Models\Repositories;
use App\Models\Entities\FormacionAcademica;

interface FormacionAcademicaRepositoryInterface {
    public function findByPostulanteId(int $idPostulante): array;
    public function save(FormacionAcademica $formacion): bool;
    public function delete(int $idFormacion): bool;
}