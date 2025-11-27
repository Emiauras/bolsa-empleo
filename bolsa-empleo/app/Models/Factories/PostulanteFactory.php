<?php
// app/Models/Factories/PostulanteFactory.php

namespace App\Models\Factories;

use App\Models\Entities\Postulante;
use App\Models\Entities\Persona;
use App\Models\Entities\Empresa;
use App\Models\Entities\PersonaPostulante;
use App\Models\Entities\ProfesionalPostulante;
use App\Models\Entities\EmprendedorPostulante;
use App\Models\Entities\EmpresaPostulante;
use Exception;

class PostulanteFactory implements PostulanteFactoryInterface
{
    /**
     * Crea el objeto específico de Postulante a partir de datos de la DB.
     */
    public function createFromDatabaseRow(array $data): Postulante
    {
        $idTipo = (int)($data['id_tipo_postulante'] ?? 0);
        $postulante = null;

        switch ($idTipo) {
            case 1: // Persona general
                $persona = $this->createPersonaEntity($data);
                $postulante = new PersonaPostulante($persona);
                break;
            
            case 2: // Profesional
                $persona = $this->createPersonaEntity($data);
                $postulante = new ProfesionalPostulante($persona); 
                break;
            
            case 3: // Emprendedor
                $persona = $this->createPersonaEntity($data);
                $postulante = new EmprendedorPostulante($persona);
                break;
            
            case 4: // Empresa
                $empresa = $this->createEmpresaEntity($data);
                $postulante = new EmpresaPostulante($empresa);
                break;
                
            default:
                throw new Exception("Tipo de postulante ({$idTipo}) no válido.");
        }

        if ($postulante) {
            $postulante->setIdPostulante((int)$data['id_postulante']);
            $postulante->setIdUsuario((int)$data['id_usuario']);
        }

        return $postulante;
    }
    
    public function createFromFormData(array $data): Postulante
    {
        throw new Exception("Método createFromFormData no requerido.");
    }

    private function createPersonaEntity(array $data): Persona
    {
        $persona = new Persona();
        if (!empty($data['id_persona'])) {
            $persona->setIdPersona((int)$data['id_persona']);
        }
        
        $persona->setNombre($data['nombre_persona'] ?? $data['nombre'] ?? '')
                ->setApellido($data['apellido_persona'] ?? $data['apellido'] ?? '')
                ->setDni($data['dni'] ?? '')
                ->setTelefono($data['telefono'] ?? null)
                ->setEmailContacto($data['email_contacto'] ?? null)
                ->setDireccion($data['direccion'] ?? null)
                ->setLocalidad($data['localidad'] ?? null)
                ->setProvincia($data['provincia'] ?? null)
                ->setPais($data['pais'] ?? null);

        if (!empty($data['fecha_nacimiento'])) {
            $persona->setFechaNacimiento($data['fecha_nacimiento']);
        }

        return $persona;
    }

    /**
     * Helper para hidratar una entidad Empresa.
     */
    private function createEmpresaEntity(array $data): Empresa
    {
        $empresa = new Empresa();
        
        if (!empty($data['id_empresa'])) {
            $empresa->setIdEmpresa((int)$data['id_empresa']);
        }
        
        // CORRECCIÓN AQUÍ: Usamos setIdRubro en lugar de setRubro
        // Y buscamos 'id_rubro' que es como viene de la DB
        $empresa->setRazonSocial($data['razon_social'] ?? '')
                ->setCuit($data['cuit'] ?? '')
                ->setIdRubro($data['id_rubro'] ?? $data['rubro'] ?? null) 
                ->setDireccion($data['direccion'] ?? null)
                ->setLocalidad($data['localidad'] ?? null)
                ->setEmailContacto($data['email_contacto'] ?? null)
                ->setSitioWeb($data['sitio_web'] ?? null);

        return $empresa;
    }
}