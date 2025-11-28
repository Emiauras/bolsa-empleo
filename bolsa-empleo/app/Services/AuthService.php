<?php
// app/Services/AuthService.php

namespace App\Services;

use App\Models\Repositories\UsuarioRepositoryInterface;
use App\Models\Repositories\PostulanteRepositoryInterface;
use App\Models\Repositories\PersonaRepositoryInterface;

use App\Models\Entities\Usuario;
use App\Models\Entities\Persona;
use App\Models\Entities\Postulante;
use App\Models\Entities\PersonaPostulante;

class AuthService
{
    private UsuarioRepositoryInterface $usuarioRepository;
    private PostulanteRepositoryInterface $postulanteRepository;
    private PersonaRepositoryInterface $personaRepository;

    public function __construct(
        UsuarioRepositoryInterface $usuarioRepository,
        PostulanteRepositoryInterface $postulanteRepository,
        PersonaRepositoryInterface $personaRepository
    ) {
        //Principio de Inversión de Dependencias 
        $this->usuarioRepository = $usuarioRepository;
        $this->postulanteRepository = $postulanteRepository;
        $this->personaRepository = $personaRepository;
    }

    public function register(array $data): ?Postulante
    {
        $idTipo = (int)($data['id_tipo_postulante'] ?? 1);

        // 1. Validaciones
        if ($this->usuarioRepository->findByEmail($data['email'])) {
            throw new \Exception("El email ya existe.");
        }
        if ($idTipo < 4 && $this->personaRepository->findByDni($data['dni'] ?? '')) {
             throw new \Exception("El DNI ya está registrado.");
        }
        
        // 2. Usuario
        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
        $usuario = (new Usuario())
                ->setUsername($data['username'])
                ->setEmail($data['email'])
                ->setPasswordHash($passwordHash)
                ->setActivo(true);
        
        if (!$this->usuarioRepository->save($usuario)) {
            throw new \Exception("Error al guardar credenciales.");
        }
        
        // 3. Entidad Base
        $postulanteBase = null;
        
        if ($idTipo < 4) { 
            $persona = (new Persona())
                    ->setNombre($data['nombre'])
                    ->setApellido($data['apellido'])
                    ->setDni($data['dni'])
                    ->setEmailContacto($data['email']);
            
            if (!$this->personaRepository->save($persona)) {
                throw new \Exception("Error al guardar datos personales.");
            }
            
            $postulanteBase = new PersonaPostulante($persona); 
            $postulanteBase->setIdUsuario($usuario->getIdUsuario());
            
        } elseif ($idTipo === 4) { 
            throw new \Exception("Registro de empresa no implementado aquí.");
        }
        
        // 4. Postulante
        if ($postulanteBase && $this->postulanteRepository->save($postulanteBase)) {
            return $postulanteBase;
        }

        throw new \Exception("Error al crear el vínculo postulante.");
    }
    
    public function login(string $usernameOrEmail, string $password): ?Postulante
    {
        // 1. Buscar
        $usuario = $this->usuarioRepository->findByUsername($usernameOrEmail);
        if (!$usuario) {
            $usuario = $this->usuarioRepository->findByEmail($usernameOrEmail);
        }

        // 2. Verificar (Si no existe o pass incorrecta, retorna null)
        if (!$usuario || !$usuario->verifyPassword($password)) {
            return null; 
        }
        
        // 3. Retornar Postulante
        return $this->postulanteRepository->findByUserId($usuario->getIdUsuario());
    }
}