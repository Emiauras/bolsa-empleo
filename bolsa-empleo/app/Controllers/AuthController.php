<?php
// app/Controllers/AuthController.php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Container;
use App\Core\SessionHelper; 
use App\Core\UrlHelper; 
use App\Services\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(Container $container)
    {
        parent::__construct($container); 
        $this->authService = $container->get(AuthService::class);
    }

    public function showLoginForm() { $this->view('auth/login'); }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . UrlHelper::base('/login')); 
            return;
        }
        
        $usernameOrEmail = $_POST['username_or_email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        try {
            $postulante = $this->authService->login($usernameOrEmail, $password);

            if ($postulante) {
                SessionHelper::set('user_id', $postulante->getIdUsuario());
                SessionHelper::set('postulante_id', $postulante->getIdPostulante());
                SessionHelper::set('postulante_tipo', $postulante->getTipo());
                SessionHelper::setFlash('success', '¡Bienvenida/o al sistema! 🌸');
                
                // Redirección limpia usando UrlHelper
                header('Location: ' . UrlHelper::base('/perfil'));
                return;
            } else {
                SessionHelper::setFlash('error', 'Credenciales incorrectas o usuario inactivo.');
            }
        } catch (\Exception $e) {
            SessionHelper::setFlash('error', $e->getMessage());
        }

        $this->view('auth/login', ['old_input' => $_POST]);
    }

    public function showRegisterForm()
    {
        $this->view('auth/register');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . UrlHelper::base('/registro'));
            return;
        }

        if (($_POST['password'] ?? '') !== ($_POST['password_confirm'] ?? '')) {
            SessionHelper::setFlash('error', 'Las contraseñas no coinciden.');
            $this->view('auth/register', ['old_input' => $_POST]);
            return;
        }
        
        try {
            $postulante = $this->authService->register($_POST);

            if ($postulante) {
                // Registro exitoso: Iniciar sesión y redirigir
                SessionHelper::set('user_id', $postulante->getIdUsuario());
                SessionHelper::set('postulante_id', $postulante->getIdPostulante());
                SessionHelper::set('postulante_tipo', $postulante->getTipo());
                SessionHelper::setFlash('success', '¡Registro exitoso! Por favor, selecciona tu tipo de perfil. ✨');
                
                // Redirección CRÍTICA con UrlHelper
                $redirectUrl = UrlHelper::base('/postulantes/seleccionar-tipo');
                header("Location: {$redirectUrl}"); // LÍNEA CRÍTICA 1
                return;
            }
        } catch (\Exception $e) {
            SessionHelper::setFlash('error', $e->getMessage());
        }

        $this->view('auth/register', ['old_input' => $_POST]);
    }

 public function logout()
    {
        // 1. Destruir sesión
        SessionHelper::destroy();
        
        // 2. Mensaje opcional (a veces no se ve si se destruye la sesión, pero es buena práctica)
        // SessionHelper::setFlash('success', 'Has cerrado sesión exitosamente.');
        
        // 3. Redirección SEGURA usando UrlHelper
        $loginUrl = UrlHelper::base('/login');
        header("Location: {$loginUrl}");
        exit; // ¡IMPORTANTE! Detiene la ejecución para evitar pantallas blancas
    }
}
// Sin etiqueta de cierre 