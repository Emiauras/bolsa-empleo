<?php
// app/Core/Container.php

namespace App\Core;

// --- 1. IMPORTAR TODAS LAS INTERFACES Y CLASES ---

// Repositorios Base
use App\Models\Repositories\UsuarioRepositoryInterface;
use App\Models\Repositories\MySQLUsuarioRepository;
use App\Models\Repositories\PersonaRepositoryInterface;
use App\Models\Repositories\MySQLPersonaRepository;

// Repositorios de Postulante y Factoría
use App\Models\Repositories\PostulanteRepositoryInterface;
use App\Models\Repositories\MySQLPostulanteRepository;
use App\Models\Factories\PostulanteFactoryInterface;
use App\Models\Factories\PostulanteFactory;

// Repositorios de Datos Anexos
use App\Models\Repositories\FormacionAcademicaRepositoryInterface;
use App\Models\Repositories\MySQLFormacionAcademicaRepository;
use App\Models\Repositories\ExperienciaLaboralRepositoryInterface;
use App\Models\Repositories\MySQLExperienciaLaboralRepository;

// Repositorios de Negocio (Empresa, Oferta, Postulacion, Profesional, Emprendimiento)
use App\Models\Repositories\EmpresaRepositoryInterface;
use App\Models\Repositories\MySQLEmpresaRepository;
use App\Models\Repositories\OfertaRepositoryInterface;
use App\Models\Repositories\MySQLOfertaRepository;
use App\Models\Repositories\PostulacionRepositoryInterface;
use App\Models\Repositories\MySQLPostulacionRepository;
use App\Models\Repositories\EmprendimientoRepositoryInterface;
use App\Models\Repositories\MySQLEmprendimientoRepository;
use App\Models\Repositories\ProfesionalRepositoryInterface;
use App\Models\Repositories\MySQLProfesionalRepository;

// ¡NUEVO! Repositorio de Documentos
use App\Models\Repositories\DocumentoRepositoryInterface;
use App\Models\Repositories\MySQLDocumentoRepository;

// Servicios
use App\Services\AuthService;
use App\Services\PostulanteService;
use App\Services\OfertaService;
use App\Services\PostulacionService;
use App\Services\EmprendimientoService;
use App\Services\DocumentoService; 

/**
 * Contenedor de dependencias (Service Locator).
 */
class Container
{
    private array $instances = [];

    public function __construct()
    {
        // --------------------------------------------------
        // PASO 1: INSTANCIAR FACTORÍAS
        // --------------------------------------------------
        $this->instances[PostulanteFactoryInterface::class] = new PostulanteFactory();

        // --------------------------------------------------
        // PASO 2: INSTANCIAR REPOSITORIOS (Acceso a Datos)
        // --------------------------------------------------
        
        // Usuarios y Personas
        $this->instances[UsuarioRepositoryInterface::class] = new MySQLUsuarioRepository();
        $this->instances[PersonaRepositoryInterface::class] = new MySQLPersonaRepository();
        
        // Anexos
        $this->instances[FormacionAcademicaRepositoryInterface::class] = new MySQLFormacionAcademicaRepository();
        $this->instances[ExperienciaLaboralRepositoryInterface::class] = new MySQLExperienciaLaboralRepository();

        // Negocio Principal
        $this->instances[EmpresaRepositoryInterface::class] = new MySQLEmpresaRepository();
        $this->instances[OfertaRepositoryInterface::class] = new MySQLOfertaRepository();
        $this->instances[PostulacionRepositoryInterface::class] = new MySQLPostulacionRepository();
        $this->instances[EmprendimientoRepositoryInterface::class] = new MySQLEmprendimientoRepository();
        $this->instances[ProfesionalRepositoryInterface::class] = new MySQLProfesionalRepository(); // <--- FALTABA ESTE

        // Documentos
        $this->instances[DocumentoRepositoryInterface::class] = new MySQLDocumentoRepository();

        // POSTULANTE (Depende de Factory, debe ir después de crear la factory)
        $this->instances[PostulanteRepositoryInterface::class] = 
            new MySQLPostulanteRepository($this->get(PostulanteFactoryInterface::class));

        // --------------------------------------------------
        // PASO 3: INSTANCIAR SERVICIOS (Lógica de Negocio)
        // --------------------------------------------------

        // AuthService
        $this->instances[AuthService::class] = new AuthService(
            $this->get(UsuarioRepositoryInterface::class),
            $this->get(PostulanteRepositoryInterface::class),
            $this->get(PersonaRepositoryInterface::class)
        );
        
        // PostulanteService - ORDEN CORREGIDO AQUÍ
        $this->instances[PostulanteService::class] = new PostulanteService(
            $this->get(PersonaRepositoryInterface::class),       // 1
            $this->get(EmpresaRepositoryInterface::class),       // 2
            $this->get(ProfesionalRepositoryInterface::class),   // 3 (Aquí fallaba antes)
            $this->get(EmprendimientoRepositoryInterface::class),// 4
            $this->get(PostulanteRepositoryInterface::class),    // 5
            $this->get(FormacionAcademicaRepositoryInterface::class), // 6
            $this->get(ExperienciaLaboralRepositoryInterface::class)  // 7
        );

        // OfertaService
        $this->instances[OfertaService::class] = new OfertaService(
            $this->get(OfertaRepositoryInterface::class),
            $this->get(PostulanteRepositoryInterface::class),
            $this->get(EmpresaRepositoryInterface::class),
            $this->get(PostulacionRepositoryInterface::class)
        );

        // PostulacionService
        $this->instances[PostulacionService::class] = new PostulacionService(
            $this->get(PostulacionRepositoryInterface::class),
            $this->get(OfertaRepositoryInterface::class),
            $this->get(PostulanteRepositoryInterface::class)
        );

        // EmprendimientoService
        $this->instances[EmprendimientoService::class] = new EmprendimientoService(
            $this->get(EmprendimientoRepositoryInterface::class)
        );

        // DocumentoService
        $this->instances[DocumentoService::class] = new DocumentoService(
            $this->get(DocumentoRepositoryInterface::class)
        );
    }

    public function get(string $class)
    {
        if (isset($this->instances[$class])) {
            return $this->instances[$class];
        }

        // Instanciación dinámica de Controladores
        if (str_contains($class, 'Controller')) {
            return new $class($this); 
        }

        throw new \Exception("Clase o interfaz no registrada en el Container: " . $class);
    }
}