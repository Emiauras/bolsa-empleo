<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Repositories\UsuarioRepositoryInterface;
use App\Models\Entities\Usuario;

class AuthService
{
    private UsuarioRepositoryInterface $repo;

    public function __construct(UsuarioRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function registrar(string $username, string $email, string $password): int
    {
        // Validaciones básicas
        if (empty($username) || empty($email) || empty($password)) {
            throw new \InvalidArgumentException('Campos obligatorios vacíos.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Email inválido.');
        }

        if ($this->repo->buscarPorEmail($email)) {
            throw new \RuntimeException('El email ya está en uso.');
        }

        if ($this->repo->buscarPorUsername($username)) {
            throw new \RuntimeException('El username ya está en uso.');
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $usuario = new Usuario(null, $username, $email, $hash, date('Y-m-d H:i:s'), 1);
        return $this->repo->guardar($usuario);
    }

    public function login(string $emailOrUsername, string $password): Usuario
    {
        // Permitir login por email o username
        $usuario = filter_var($emailOrUsername, FILTER_VALIDATE_EMAIL)
            ? $this->repo->buscarPorEmail($emailOrUsername)
            : $this->repo->buscarPorUsername($emailOrUsername);

        if (!$usuario) {
            throw new \RuntimeException('Credenciales inválidas.');
        }

        if (!password_verify($password, $usuario->getPasswordHash())) {
            throw new \RuntimeException('Credenciales inválidas.');
        }

        if (!$usuario->isActivo()) {
            throw new \RuntimeException('Usuario inactivo.');
        }

        return $usuario;
    }
}
