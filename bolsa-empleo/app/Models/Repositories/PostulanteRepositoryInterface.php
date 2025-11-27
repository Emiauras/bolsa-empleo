<?php
// app/Models/Repositories/PostulanteRepositoryInterface.php

namespace App\Models\Repositories;

use App\Models\Entities\Postulante;

interface PostulanteRepositoryInterface
{
    public function findById(int $id): ?Postulante;
    
    public function findByUserId(int $idUsuario): ?Postulante;
    
    public function save(Postulante $postulante): bool;
    
    public function search(array $criterios): array;

    /**
     * Actualiza el tipo de postulante y lo vincula a una empresa.
     * SOLO LA DEFINICIÓN, SIN CÓDIGO.
     */
    public function vincularEmpresa(int $idPostulante, int $idEmpresa): bool;
}