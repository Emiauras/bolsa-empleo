<?php
namespace App\Services;

use App\Models\Repositories\PersonaRepositoryInterface;
use App\Models\Repositories\EmpresaRepositoryInterface;
use App\Models\Repositories\ProfesionalRepositoryInterface;
use App\Models\Repositories\EmprendimientoRepositoryInterface;
use App\Models\Repositories\PostulanteRepositoryInterface;
use App\Models\Repositories\FormacionAcademicaRepositoryInterface;
use App\Models\Repositories\ExperienciaLaboralRepositoryInterface;

use App\Models\Entities\Persona;
use App\Models\Entities\Empresa;
use App\Models\Entities\Profesional;
use App\Models\Entities\Emprendimiento;

class PostulanteService
{
    private $personaRepo;
    private $empresaRepo;
    private $profesionalRepo;
    private $emprendimientoRepo;
    private $postulanteRepo;
    // ... otros repos

    public function __construct(
        PersonaRepositoryInterface $personaRepo,
        EmpresaRepositoryInterface $empresaRepo,
        ProfesionalRepositoryInterface $profesionalRepo,
        EmprendimientoRepositoryInterface $emprendimientoRepo,
        PostulanteRepositoryInterface $postulanteRepo,
        FormacionAcademicaRepositoryInterface $formacionRepo,
        ExperienciaLaboralRepositoryInterface $experienciaRepo
    ) {
        $this->personaRepo = $personaRepo;
        $this->empresaRepo = $empresaRepo;
        $this->profesionalRepo = $profesionalRepo;
        $this->emprendimientoRepo = $emprendimientoRepo;
        $this->postulanteRepo = $postulanteRepo;
    }

    public function getProfile(int $idPostulante): ?array
    {
        $postulante = $this->postulanteRepo->findById($idPostulante);
        if (!$postulante) return null;

        $perfil = ['postulante' => $postulante, 'datos_personales' => null];

        // 1. Cargar datos base (Persona o Empresa)
        if ($postulante->getTipo() == 4) {
            if (method_exists($postulante, 'getIdEmpresa')) {
                $perfil['datos_personales'] = $this->empresaRepo->findById($postulante->getIdEmpresa());
            }
        } else {
            if (method_exists($postulante, 'getIdPersona')) {
                $perfil['datos_personales'] = $this->personaRepo->findById($postulante->getIdPersona());
            }
        }

        // 2. Cargar datos extra (Profesional / Emprendedor)
        if ($postulante->getTipo() == 2) { // Profesional
            $perfil['profesional'] = $this->profesionalRepo->findByPostulanteId($idPostulante);
        }
        if ($postulante->getTipo() == 3) { // Emprendedor
            // Aquí podrías usar un método específico si la relación es 1 a 1, o una lista
            // $perfil['emprendimiento'] = ...
        }

        return $perfil;
    }

    public function updateProfile(int $idPostulante, int $tipo, array $data): void
    {
        $postulanteBase = $this->postulanteRepo->findById($idPostulante);
        
        // A. Actualizar Datos Personales Comunes (Teléfono, Dirección...)
        if ($tipo != 4 && method_exists($postulanteBase, 'getIdPersona')) {
             $persona = $this->personaRepo->findById($postulanteBase->getIdPersona());
             if ($persona) {
                 $persona->setFechaNacimiento($data['fecha_nacimiento'] ?? null)
                         ->setTelefono($data['telefono'] ?? null)
                         ->setLocalidad($data['localidad'] ?? null);
                 $this->personaRepo->update($persona);
             }
        }

        // B. Guardar Datos Específicos
        switch ($tipo) {
            case 2: // Profesional
                $prof = $this->profesionalRepo->findByPostulanteId($idPostulante);
                $nuevo = false;
                if (!$prof) {
                    $prof = new Profesional();
                    $prof->setIdPostulante($idPostulante);
                    $nuevo = true;
                }
                $prof->setTitulo($data['titulo'])
                     ->setInstitucion($data['institucion'])
                     ->setMatricula($data['matricula'] ?? null)
                     ->setAnioGraduacion($data['anio_graduacion'] ?? null)
                     ->setEstadoTitulo($data['estado_titulo'] ?? null);
                
                if ($nuevo) $this->profesionalRepo->save($prof);
                else $this->profesionalRepo->update($prof);
                break;

            case 3: // Emprendedor
                // Lógica similar para emprendimiento
                $emp = new Emprendimiento();
                $emp->setIdPostulanteEmprendedor($idPostulante)
                    ->setNombre($data['nombre_emprendimiento'])
                    ->setDescripcion($data['descripcion']);
                $this->emprendimientoRepo->save($emp);
                break;
                
            case 4: // Empresa (Ya lo tienes implementado)
                // ... copia tu lógica de empresa aquí ...
                break;
        }
    }
}