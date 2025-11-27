<?php
namespace App\Models\Repositories;
use App\Models\Entities\DocumentoAdjunto;

interface DocumentoRepositoryInterface {
    public function save(DocumentoAdjunto $doc): bool;
    public function findByPostulanteId(int $idPostulante): array;
}