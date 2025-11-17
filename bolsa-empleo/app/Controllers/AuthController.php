<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;
use App\Core\Database;
use App\Models\Repositories\MySQLUsuarioRepository;

class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $pdo = Database::getConnection();
        $repo = new MySQLUsuarioRepository($pdo);
        $this->authService = new AuthService($repo);
    }

    public function registrarHandler(array $post): array
    {
        try {
            $id = $this->authService->registrar($post['username'] ?? '', $post['email'] ?? '', $post['password'] ?? '');
            return ['success' => true, 'id' => $id];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function loginHandler(array $post): array
    {
        try {
            $usuario = $this->authService->login($post['email_or_username'] ?? '', $post['password'] ?? '');
            // guardar sesión
            $_SESSION['user_id'] = $usuario->getId();
            $_SESSION['username'] = $usuario->getUsername();
            return ['success' => true];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
