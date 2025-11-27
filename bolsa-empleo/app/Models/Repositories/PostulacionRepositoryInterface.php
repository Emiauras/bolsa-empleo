<?php
namespace App\Models\Repositories;
use App\Models\Entities\Postulacion;

interface PostulacionRepositoryInterface
{
    public function save(Postulacion $postulacion): bool;
    // Verificar si ya se postuló para no duplicar
    public function exists(int $idOferta, int $idPostulante): bool;
    // Para que la empresa vea sus candidatos
    public function findByOfertaId(int $idOferta): array;
    // Para que el usuario vea sus postulaciones
    public function findByPostulanteId(int $idPostulante): array;
}