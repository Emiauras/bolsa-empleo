<?php
namespace App\Services;

use App\Models\Repositories\OfertaRepositoryInterface;
use App\Models\Repositories\PostulanteRepositoryInterface;
use App\Models\Repositories\EmpresaRepositoryInterface;
use App\Models\Entities\OfertaLaboral;

class OfertaService
{
    private OfertaRepositoryInterface $ofertaRepository;
    private PostulanteRepositoryInterface $postulanteRepository;
    private EmpresaRepositoryInterface $empresaRepository;

    public function __construct(
        OfertaRepositoryInterface $ofertaRepo,
        PostulanteRepositoryInterface $postulanteRepo,
        EmpresaRepositoryInterface $empresaRepo
    ) {
        $this->ofertaRepository = $ofertaRepo;
        $this->postulanteRepository = $postulanteRepo;
        $this->empresaRepository = $empresaRepo;
    }

    public function getAllActive(): array
    {
        return $this->ofertaRepository->findAllActive();
    }

    public function crearOferta(int $idUsuario, array $data): void
    {
        // 1. Verificar usuario y obtener Postulante
        $postulante = $this->postulanteRepository->findByUserId($idUsuario);
        
        // Validar que sea tipo 4 (Empresa)
        if (!$postulante || $postulante->getTipo() !== 4) {
            throw new \Exception("Acceso denegado: Solo las empresas registradas pueden publicar ofertas.");
        }

        // 2. Obtener el ID real de la empresa
        // El método getIdEmpresa() viene del wrapper EmpresaPostulante
        if (!method_exists($postulante, 'getIdEmpresa') || !$postulante->getIdEmpresa()) {
            throw new \Exception("Debes completar tu perfil de empresa antes de publicar.");
        }

        $idEmpresa = $postulante->getIdEmpresa();

        // 3. Crear la entidad OfertaLaboral
        $oferta = new OfertaLaboral();
        $oferta->setIdEmpresa($idEmpresa)
               ->setTitulo($data['titulo'])
               ->setDescripcion($data['descripcion'])
               ->setIdRubro($data['rubro'] ?? null)
               ->setIdTipoPostulanteObjetivo($data['tipo_objetivo'] ?? 1)
               ->setRequisitos($data['requisitos'] ?? null)
               ->setRangoSalarialDesde($data['salario_desde'] ?? null)
               ->setIdEstadoOferta(1); // 1 = Activa

        // 4. Guardar
        if (!$this->ofertaRepository->save($oferta)) {
            throw new \Exception("Ocurrió un error al guardar la oferta en la base de datos.");
        }
    }
}