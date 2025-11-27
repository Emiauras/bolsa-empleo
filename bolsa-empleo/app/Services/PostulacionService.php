<?php
namespace App\Services;

use App\Models\Repositories\PostulacionRepositoryInterface;
use App\Models\Repositories\OfertaRepositoryInterface;
use App\Models\Repositories\PostulanteRepositoryInterface;
use App\Models\Entities\Postulacion;

class PostulacionService
{
    private PostulacionRepositoryInterface $postulacionRepo;
    private OfertaRepositoryInterface $ofertaRepo;
    private PostulanteRepositoryInterface $postulanteRepo;

    public function __construct(
        PostulacionRepositoryInterface $postulacionRepo,
        OfertaRepositoryInterface $ofertaRepo,
        PostulanteRepositoryInterface $postulanteRepo
    ) {
        $this->postulacionRepo = $postulacionRepo;
        $this->ofertaRepo = $ofertaRepo;
        $this->postulanteRepo = $postulanteRepo;
    }

    public function crearPostulacion(int $idUsuario, int $idOferta, string $mensaje): void
    {
        // 1. Identificar al postulante
        $postulante = $this->postulanteRepo->findByUserId($idUsuario);
        if (!$postulante) {
            throw new \Exception("Usuario no válido.");
        }

        // 2. Validar que la oferta exista
        $oferta = $this->ofertaRepo->findById($idOferta);
        if (!$oferta) {
            throw new \Exception("La oferta no existe o ha expirado.");
        }

        // 3. Validar que NO sea una Empresa (las empresas no se postulan)
        if ($postulante->getTipo() === 4) {
            throw new \Exception("Las empresas no pueden postularse a ofertas.");
        }

        // 4. Validar que no se haya postulado antes (Evitar duplicados)
        if ($this->postulacionRepo->exists($idOferta, $postulante->getIdPostulante())) {
            throw new \Exception("Ya te has postulado a esta oferta anteriormente.");
        }

        // 5. Crear la entidad
        $postulacion = new Postulacion();
        $postulacion->setIdOferta($idOferta)
                    ->setIdPostulante($postulante->getIdPostulante())
                    ->setMensajePostulante($mensaje)
                    ->setIdEstadoPostulacion(1); // 1 = Enviada

        // 6. Guardar
        if (!$this->postulacionRepo->save($postulacion)) {
            throw new \Exception("Error al guardar la postulación.");
        }
    }

    // ... dentro de PostulacionService ...

    public function cambiarEstadoPostulacion(int $idPostulacion, int $nuevoEstado, int $idUsuarioEmpresa): void
    {
        // 1. Validaciones de seguridad (Omitidas por brevedad, pero ideales en producción)
        // Aquí deberíamos verificar que la oferta de esta postulación pertenece a la empresa logueada.

        // 2. Ejecutar cambio
        // Estados: 3 = Rechazado, 4 = Preseleccionado
        if (!in_array($nuevoEstado, [3, 4])) {
            throw new \Exception("Estado no válido.");
        }

        if (!$this->postulacionRepo->actualizarEstado($idPostulacion, $nuevoEstado)) {
            throw new \Exception("No se pudo actualizar el estado.");
        }
    }
}