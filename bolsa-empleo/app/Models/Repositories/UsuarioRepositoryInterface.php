<?php
declare(strict_types=1);

namespace App\Models\Repositories;

use App\Models\Entities\Usuario;

interface UsuarioRepositoryInterface
{
    public function guardar(Usuario $usuario): int; // retorna id insertado
    public function buscarPorEmail(string $email): ?Usuario;
    public function buscarPorUsername(string $username): ?Usuario;
    public function buscarPorId(int $id): ?Usuario;
}
